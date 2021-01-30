@extends("layout")

@section("app-title")
	Довідник книг
@endsection

@section("page-title", " Головна сторінка ")

@section("page-content")
<p class="lead"></p>
<p class="lead">
	<a href="/author/0/books" class="btn btn-lg btn-secondary">Книги</a>
	<a href="/authors" class="btn btn-lg btn-secondary">Автори</a>
</p>
@endsection