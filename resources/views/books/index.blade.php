@extends("layout")

@section("app-title")
	Список книг
@endsection

@section("page-title")
	{{ $pageTitle }}
@endsection

@section("page-content")
	<div class="form-group">
		<select class="browser-default custom-select" name="book-author-filter" id="book-author-filter">
			<option value="0">Всі автори</option>
			@foreach($authors as $author)
			<option
			@if ($author->id==$author_filter_id) selected @endif value="{{ $author->id }}">{{ $author->authorName }}</option>
			@endforeach
		</select>
		<script>
			$('#book-author-filter').change(() => {
				var id = $('#book-author-filter').val();
				var url = "/author/" + id + "/books";
				location.href = url;
			});
		</script>
	</div>

	@can('add', App\Book::class)
		<a href="/author/{{ $author_filter_id }}/books/create" class="btn btn-success mb-4">Додати книгу</a>
		<a href="/books/download" class="btn btn-warning mb-4">Завантажити PDF</a>
	@endcan
	
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col">Назва</th>
				<th scope="col">Автор</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($books as $book)
			<tr>
				<td>{{ $book->name }}</td>
				<td>{{ $book->author->authorName }}</td>
				<td>
				@can('view', App\Book::class)
					<a href="/author/{{ $author_filter_id }}/books/{{ $book->id }}" class="btn btn-secondary">Переглянути</a>
				@endcan
				</td>
				<td>
				@can('update', App\Book::class)
					<a href="/author/{{ $author_filter_id }}/books/{{ $book->id }}/edit" class="btn btn-primary">Редагувати</a>
				@endcan
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection