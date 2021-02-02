<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("authors/index", [
            "authors" => Author::all()->sortBy("authorName"), 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user() && Auth::user()->can('add', Author::class)){
            return view("authors/create", [
                "books"=>\App\Book::all()->sortBy("name"),
            ]);
        }
    }

    private function ValidateData($data){
        return $this->validate($data, [
            'authorName' => ['required', 'max:100'],
            'country' => ['required', 'min:3', 'max:100'],
            'book_id' => ['required', Rule::exists('books', 'id')],
        ], [
            'authorName.required' => 'Ім`я автора має бути заповнене!',
            'authorName.max' => 'Ім`я автора має бути не більше 100 символів!',
            'country.required' => "Країна має бути задана!",
            'country.min' => "Назва країни не має бути менше 3 символів!",
            'country.max' => "Назва країни не має бути більше 100 символів!",
            'book_id.required' => "Оберіть книгу!",
            'book_id.exists' => "Ви обрали книгу, якої не існує!",
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user() && Auth::user()->can('update', Author::class)){
            $data = $this->ValidateData(\request());
            \App\Author::create($data);
            return redirect("/authors");  
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        if(Auth::user() && Auth::user()->can('view', Author::class)){
            return view('authors/show', [
                'author' => $author,
            ]);
        }else{
            return redirect('authors/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        if(Auth::user() && Auth::user()->can('update', Author::class)){
            return view('authors/edit', [
                'author' => $author,
                'books'=>$author->books->sortBy('name'),
            ]);
        }else{
            return redirect('authors/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Author $author)
    {
        $data = $this->ValidateData(\request());

        $author->authorName = $data['authorName'];
        $author->country = $data['country'];

        $book = \App\Book::find($data['book_id']);
        $author->book()->associate($book);

        $author->save();
        return redirect('/authors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if(Auth::user() && Auth::user()->can('delete', Author::class)){
            $author->delete();
        }
    }
}
