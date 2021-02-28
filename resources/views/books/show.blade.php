@extends("layout")

@section("app-title", "Список книг")
@section("page-title", "Перегляд даних книги")

@section("page-content")
	<h2 class="pb-3">Книга "{{ $book->name }}"</h2>
	<h5 class="pb-3">Автор {{ $book->author->authorName }}</h5>
	<a href="/books/" style="..." class="btn btn-success mb-3">Повернутися до списку</a>
@endsection