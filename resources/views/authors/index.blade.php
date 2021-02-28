@extends("layout")

@section("app-title", "Автори")
@section("page-title", "Автори книг")

@section("page-content")

@can('add', App\Author::class)
	<a href="/authors/create" class="btn btn-success mb-4">Додати автора</a>
@endcan
<table class="table table-hover table-bordered">
	<thead class="bg-info">
		<tr>
			<th class="text-center align-middle" scope="col">Ім'я</th>
			<th class="text-center align-middle" scope="col">Країна</th>
			<th scope="col"></th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
		@foreach($authors as $author)
		<tr>
			<td class="text-left align-middle">{{ $author->authorName }}</td>
			<td class="text-left align-middle">{{ $author->country }}</td>
			<td class="text-center align-middle">
			@can('view', App\Author::class)
				<a href="/authors/{{ $author->id }}" class="btn btn-secondary">Переглянути</a>
			@endcan
			</td>
			<td class="text-center align-middle">
			@can('update', App\Author::class)
				<a href="/authors/{{ $author->id }}/edit" class="btn btn-primary">Редагувати</a>
			@endcan
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection