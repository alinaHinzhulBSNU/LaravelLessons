@extends("layout")

@section("app-title")
	Список книг
@endsection

@section("page-title")
	{{ $pageTitle }}
@endsection

@section("page-content")
	<div class="form-group" style="margin-top: 20px;">
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
		<a href="/author/{{ $author_filter_id }}/books/create" class="btn btn-outline-success float-left" style="margin-bottom: 20px; margin-top: 10px;">Додати книгу</a>
	@endcan
	
	<table class="table table-striped table-dark">
		<tr>
			<th scope="col">Назва</th>
			<th scope="col">Автор</th>
			<th></th>
			<th></th>
		</tr>
		@foreach($books as $book)
			<tr>
				<td>{{ $book->name }}</td>
				<td>{{ $book->author->authorName }}</td>
				<td>
				@can('view', App\Book::class)
					<a href="/author/{{ $author_filter_id }}/books/{{ $book->id }}" class="btn btn-outline-secondary">Переглянути</a>
				@endcan
				</td>
				<td>
				@can('update', App\Book::class)
					<a href="/author/{{ $author_filter_id }}/books/{{ $book->id }}/edit" class="btn btn-outline-primary">Редагувати</a>
				@endcan
				</td>
			</tr>
		@endforeach
	</table>
@endsection