@extends("layout")

@section("app-title", "Список книг")
@section("page-title", "Перегляд даних книги")

@section("page-content")
	<h2 class="text-info">Книга "{{ $book->name }}"</h2>
	<h5>Автор {{ $book->author->authorName }}</h5>
	<a href="/author/{{ $author_filter_id }}/books/" style="..." class="btn btn-outline-info">Повернутися до списку</a>
@endsection