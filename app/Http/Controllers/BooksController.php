<?php
/**
 * Файл контролера для керування даними про книги
 */

namespace App\Http\Controllers;

use App\Book;
use App\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use PDF;

/**
 * Контролер для керування даними про книги
 * 
 * @author Alina Hinzhul
 */
class BooksController extends Controller
{
    
    /**
     * Конструктор контролера
     * 
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    /**
     * Перегляд списку книг
     * 
     * @return string (HTML)
     */
    public function index()
    {
    	return view('books/index', [
    			'books' => Book::all()->sortBy('name'),
    			'pageTitle' => "Книги",
                'authors' => Author::all()->sortBy('authorName'),
    	]);
    }

    /**
     * Перрехід на форму створення книги
     * 
     * @return string (HTML)
     */
    public function create()
    {
        if(Gate::allows('admin')){
            return view('books/create', [
                'authors' => \App\Author::all()->sortBy('authorName'),
            ]);
        }

        return redirect("/books");
    }

    /**
     * Збереження створеної книги
     * 
     * @return string (HTML)
     */
    public function store()
    {
        if(Gate::allows('admin')){
            $data = $this->validateData(\request());
            Book::create($data);
        }

        return redirect("/books");
    }

    /**
     * Перехід на форму редагування книги
     * 
     * @param Book $book
     * 
     * @return string (HTML)
     */
    public function edit(Book $book)
    {
        if(Gate::allows('admin')){
            return view("books/edit", [
                'book' => $book,
                'authors' => \App\Author::all()->sortBy('authorName'),
            ]);
        }else{
            return redirect("/books");
        }
    }

    /**
     * Збереження створених при редагуванні змін
     * 
     * @param Book $book
     * 
     * @return string (HTML)
     */
    public function update(Book $book)
    {
        if(Gate::allows('admin')){
            $data = $this->validateData(\request());

            $book->name = $data['name'];
            $author = \App\Author::find($data['author_id']);
            $book->author()->associate($author);

            $book->save();
        }

        return redirect("/books");
    }

    /**
     * Виведення інформації про одну книгу
     * 
     * @param Book $book
     * 
     * @return string (HTML)
     */
    public function show(Book $book)
    {
        return view("books/show", [
            'book' => $book,
        ]);
    }

    /**
     * Видалення книги
     * 
     * @param Book $book
     * 
     * @return string (HTML)
     */
    public function destroy(Book $book)
    {
        if(Gate::allows('admin')){
            $book->delete();
        }

        return redirect("/books");
    }
    
    /**
     * Завантаження списку книг в форматі PDF
     * 
     * @return string (PDF)
     */
    public function download()
    {
        $books = Book::all()->sortBy("name");

        $pdf = PDF::loadView('books/download', [
            'books' => $books,
        ]);

        return $pdf->download('books.pdf');
    }

    /**
     * Валідація створених або відредагованих даних
     * 
     * @param mixed $data
     * 
     * @return mixed
     */
    private function validateData($data){
        return $this->validate($data, [
            'name' => ['required', 'max:100'],
            'author_id' => ['required', Rule::exists('authors', 'id')],
        ], [
            'name.required' => 'Назва книги має бути заповнена!',
            'name.max' => 'Назва книги має бути більше 100 символів!',
            'author_id.required' => "Ім'я автора має бути заповнене!",
            'book-author.exists' => "Ви обрали неіснуючого автора!",
        ]);
    }
}
