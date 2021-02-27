<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use PDF;

class BooksController extends Controller
{
    private $author;
    
    public function __construct(Request $request){
        $this->middleware('auth');
        
        $this->author = \App\Author::find($request->route('authorid'));
        view()->share(
            'author_filter_id', $request->route('authorid')
        );
    }

    public function index($athr){
        if($this->author){
            $books = $this->author->books->sortBy("name");
        }else{
            $books = \App\Book::all()->sortBy("name");
        }

    	return view('books/index', [
    			'books' => $books,
    			'pageTitle' => "Книги",
                'authors' => \App\Author::all()->sortBy('authorName'),
    	]);
    }

    public function create($athr){
        if(Gate::allows('admin')){
            return view('books/create', [
                'authors' => \App\Author::all()->sortBy('authorName'),
            ]);
        }
    }

    public function store($athr){
        if(Gate::allows('admin')){
            $data = $this->validateData(\request());

            \App\Book::create([
                'name' => $data['book-name'],
                'author_id' => $data['book-author'],
            ]);
            
            return redirect("author/".$athr."/books");
        }
    }

    public function edit($athr, \App\Book $book){
        if(Gate::allows('admin')){
            return view("books/edit", [
                'book' => $book,
                'authors' => \App\Author::all()->sortBy('authorName'),
            ]);
        }else{
            return redirect("author/".$athr."/books");
        }
    }

    public function update($athr, \App\Book $book){
        if(Gate::allows('admin')){
            $data = $this->validateData(\request());

            $book->name = $data['book-name'];
            $author = \App\Author::find($data['book-author']);
            $book->author()->associate($author);

            $book->save();
            return redirect("author/".$athr."/books");
        }
    }

    public function show($athr, \App\Book $book){
        if(Gate::allows('admin')){
            return view("books/show", [
                'book' => $book,
            ]);
        }else{
            return redirect("author/".$athr."/books");
        }
    }

    public function destroy($athr, \App\Book $book){
        if(Gate::allows('admin')){
            $book->delete();
        }
    }
    
    //Download list of books in PDF
    public function download(){
        $books = \App\Book::all()->sortBy("name");

        $pdf = PDF::loadView('books/download', [
            'books' => $books,
        ]);

        return $pdf->download('books.pdf');
    }

    //VALIDATION
    private function validateData($data){
        return $this->validate($data, [
            'book-name' => ['required', 'max:100'],
            'book-author' => ['required', Rule::exists('authors', 'id')],
        ], [
            'book-name.required' => 'Назва книги має бути заповнена!',
            'book-name.max' => 'Назва книги має бути більше 100 символів!',
            'book-author.required' => "Ім'я автора має бути заповнене!",
            'book-author.exists' => "Ви обрали неіснуючу групу!",
        ]);
    }
}
