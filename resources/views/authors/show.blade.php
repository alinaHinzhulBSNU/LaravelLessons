@extends("layout")

@section("app-title", "Автори")
@section("page-title", "Перегляд даних автора")

@section("page-content")
	<h2 class="text-info">Ім`я автора: {{ $author->authorName }}</h2>
	<h5>Країна: {{ $author->country }}</h5>
	<h4>Найвідоміша книга: {{ $author->book->name }}</h4>
	<a href="/authors" style="..." class="btn btn-outline-info">Повернутися до списку</a>
@endsection