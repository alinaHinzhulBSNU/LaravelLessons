@extends("layout")

@section("app-title")
	Список книг
@endsection

@section("page-title")
	{{ $pageTitle }} 
@endsection

@section("page-content")
	@can('add', App\Book::class)
		<a href="/books/create" class="btn btn-success mb-4">Додати книгу</a>
		<a href="/books/download" class="btn btn-warning mb-4">Завантажити PDF</a>
	@endcan
	
	<table class="table table-hover table-bordered">
		<thead class="bg-info">
			<tr>
				<th class="text-center align-middle" scope="col">Назва</th>
				<th class="text-center align-middle" scope="col">Автор</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($books as $book)
			<tr>
				<td class="text-left align-middle">{{ $book->name }}</td>
				<td class="text-left align-middle">{{ $book->author->authorName }}</td>
				<td class="text-center align-middle">
				@can('view', App\Book::class)
					<a href="/books/{{ $book->id }}" class="btn btn-secondary">Переглянути</a>
				@endcan
				</td>
				<td class="text-center align-middle">
				@can('update', App\Book::class)
					<a href="/books/{{ $book->id }}/edit" class="btn btn-primary">Редагувати</a>
				@endcan
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection