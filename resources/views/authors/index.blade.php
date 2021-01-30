@extends("layout")

@section("app-title", "Автори")
@section("page-title", "Автори книг")

@section("page-content")

@can('add', App\Author::class)
	<a href="/authors/create" class="btn btn-outline-success float-left" style="margin-bottom: 20px; margin-top: 10px;">Додати автора</a>
@endcan
<table class="table table-striped table-dark">
	<thead>
		<tr>
			<th scope="col">Ім'я</th>
			<th scope="col">Країна</th>
			<th scope="col"></th>
			<th scope="col"></th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
		@foreach($authors as $author)
		<tr>
			<td>{{ $author->authorName }}</td>
			<td>{{ $author->country }}</td>
			<td>
			@can('view', App\Author::class)
				<a href="/authors/{{ $author->id }}" class="btn btn-outline-secondary">Переглянути</a>
			@endcan
			</td>
			<td>
			@can('view', App\Author::class)
				<a href="/author/{{ $author->id }}/books" class="btn btn-outline-info">Книги</a>
			@endcan
			</td>
			<td>
			@can('update', App\Author::class)
				<a href="/authors/{{ $author->id }}/edit" class="btn btn-outline-primary">Редагувати</a>
			@endcan
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection