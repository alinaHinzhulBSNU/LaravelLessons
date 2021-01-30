<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "PagesController@home")->middleware('dinner');
Route::get('/about', "PagesController@about");

Route::resource("author/{authorid}/books", "BooksController");
Route::resource("/authors", "AuthorController");

Route::resource("/admin/users", "UserRightController")->middleware('admin');
Route::get('/admin/users/{id}/delete', 'UserRightController@destroy')->middleware('admin');

Route::get('/books-json', "BooksController@getList");
Route::get('books/author/{id}', "BooksController@index");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
