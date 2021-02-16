@extends("layout")

@section("app-title", "Автори")
@section("page-title", "Перегляд даних автора")

@section("page-content")
	<h2 class="pb-3">Ім`я автора: {{ $author->authorName }}</h2>
	<h5 class="pb-3">Країна: {{ $author->country }}</h5>
	<h4 class="pb-3">Найвідоміша книга: {{ $author->book->name }}</h4>
	<a href="/authors" style="..." class="btn btn-success mb-3">Повернутися до списку</a>
@endsection