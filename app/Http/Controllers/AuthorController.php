<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        return view("authors/index", [
            "authors" => Author::all()->sortBy("authorName"), 
        ]);
    }

    public function create()
    {
        if(Gate::allows('admin')){
            return view("authors/create", [
                "books"=>\App\Book::all()->sortBy("name"),
            ]);
        }
    }

    public function store()
    {
        if(Gate::allows('admin')){
            $data = $this->ValidateData(\request());
            \App\Author::create($data);
        }

        return redirect("/authors");
    }

    public function edit(Author $author)
    {
        if(Gate::allows('admin')){
            return view('authors/edit', [
                'author' => $author,
                'books'=>$author->books->sortBy('name'),
            ]);
        }else{
            return redirect('/authors');
        }
    }

    public function update(Author $author)
    {
        if(Gate::allows('admin')){
            $data = $this->ValidateData(\request());

            $author->authorName = $data['authorName'];
            $author->country = $data['country'];
    
            $author->save();
        }

        return redirect('/authors');
    }

    public function show(Author $author)
    {
        return view('authors/show', [
            'author' => $author,
        ]);
    }

    public function destroy(Author $author)
    {
        if(Gate::allows('admin')){
            $author->delete();
        }
    }

    //VALIDATION
    private function ValidateData($data){
        return $this->validate($data, [
            'authorName' => ['required', 'max:100'],
            'country' => ['required', 'min:3', 'max:100'],
        ], [
            'authorName.required' => 'Ім`я автора має бути заповнене!',
            'authorName.max' => 'Ім`я автора має бути не більше 100 символів!',
            'country.required' => "Країна має бути задана!",
            'country.min' => "Назва країни не має бути менше 3 символів!",
            'country.max' => "Назва країни не має бути більше 100 символів!",
        ]);
    }
}
