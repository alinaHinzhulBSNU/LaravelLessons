@extends("layout")

@section("app-title", "Список книг")
@section("page-title", "Редагувати книгу")

@section("page-content")
	<form class="text-left" method="post" action="/author/{{ $author_filter_id }}/books/{{ $book->id }}">
		@csrf
		{{ method_field("patch") }}
		<div class="form-group">
			@include("includes/input", [
				'fieldId' => 'book-name',
				'labelText' => 'Назва',
				'placeholderText' => 'Введіть назву',
				'fieldValue' => $book->name,
			])
			@include("includes/validationError", [
				'errFieldName' => 'book-name',
			])
		</div>
		<div class="form-group">
			<label for="book-author">Автор</label>
			<select class="browser-default custom-select" name="book-author">
				<option selected disabled value="0">Оберіть автора</option>
				@foreach($authors as $author)
					<option @if($book->author->id == $author->id) selected @endif value="{{ $author->id }}">{{  $author->authorName }}</option>
				@endforeach
			</select>
			@include("includes/validationError", [
				'errFieldName' => 'book-author',
			])
		</div>
		<button type="submit" class="btn btn-primary">Змінити</button>
		@can('delete', App\Book::class)
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Видалити</button>
		@endcan
		@if($errors->any())
		<div class="row border border-danger rounded text-danger" style="margin: 20px; padding: 10px;">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</form>

	<!--Modal-->
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ModalLabel">
						<p>Підтвердіть видалення книги</p>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">x</span>
					</button>
				</div>
				<div class="modal-body text-left">
					Видалити книгу {{ $book->name }} ?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Ні</button>
					<button type="button" class="btn btn-danger" id="delete-book">Видалити</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			$("#delete-book").click(function(){
				var id = {!! $book->id !!};
				$.ajax({
					url: '/author/{{ $author_filter_id }}/books/' + id,
					type: 'post',
					data: {
						_method: 'delete',
						_token: "{!! csrf_token() !!}"
					},
					success:function(msg){
						location.href="/author/{{ $author_filter_id }}/books";
					}
				});
			});
		});
	</script>
@endsection