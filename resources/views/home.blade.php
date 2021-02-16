@extends("layout")

@section("app-title")
	Довідник книг
@endsection

@section("page-title", " Головна сторінка ")

@section("page-content")
<p class="lead"></p>
<p class="lead">
	<a href="/author/0/books" class="btn btn-primary">Книги</a>
	<a href="/authors" class="btn btn-primary">Автори</a>
</p>
@endsection