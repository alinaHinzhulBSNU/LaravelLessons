<?php

use Illuminate\Support\Facades\Route;

// Auth
Auth::routes();

// Books
Route::get('/books/download', [\App\Http\Controllers\BooksController::class, 'download']);
Route::resource("/books", "BooksController");

// Authors
Route::resource("/authors", "AuthorController");

// Admin
Route::get('/admin/users/{id}/delete', 'UserRightController@destroy');
Route::resource("/admin/users", "UserRightController");

// Other
Route::get('/', "PagesController@home")->middleware('dinner');
Route::get('/about', "PagesController@about");
Route::get('/home', 'HomeController@index')->name('home');