@extends("layout")

@section("app-title", "Автори")
@section("page-title", "Редагувати дані про автора")

@section("page-content")
	<form class="text-left" method="post" action="/authors/{{ $author->id }}">
		@csrf
		{{ method_field("patch") }}
		<div class="form-group">
			@include("includes/input", [
				'fieldId' => 'authorName',
				'labelText' => 'Ім`я',
				'placeholderText' => 'Введіть ім`я автора',
				'fieldValue' => $author->authorName,
			])
			@include("includes/validationError", [
				'errFieldName' => 'authorName',
			])
		</div>
		<div class="form-group">
			@include("includes/input", [
				'fieldId' => 'country',
				'labelText' => 'Країна',
				'placeholderText' => 'Введіть назву країни',
				'fieldValue' => $author->country,
			])
			@include("includes/validationError", [
				'errFieldName' => 'country',
			])
		</div>
		<div class="form-group">
			<label for="book">Найвідоміша книга</label>
			<select class="browser-default custom-select" name="book_id">
				<option disabled value="0">
					Оберіть книгу
				</option>
				@foreach($books as $book)
					<option @if($author->book->id == $book->id) selected @endif value="{{ $book->id }}">
						{{ $book->name }}
					</option>
				@endforeach
			</select>
			@include("includes/validationError", [
				'errFieldName' => 'book_id',
			])
		</div>
		<button type="submit" class="btn btn-primary">Змінити</button>
		@can('delete', App\Author::class)
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
						<p>Підтвердіть видалення даних про автора</p>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">x</span>
					</button>
				</div>
				<div class="modal-body text-left">
					Видалити дані про автора {{ $author->authorName }} ?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Ні</button>
					<button type="button" class="btn btn-danger" id="delete-author">Видалити</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$("#delete-author").click(function(){
				var id = {!! $author->id !!};
				$.ajax({
					url: '/authors/' + id,
					type: 'post',
					data: {
						_method: 'delete',
						_token: "{!! csrf_token() !!}"
					},
					success:function(msg){
						location.href="/authors";
					}
				});
			});
		});
	</script>
	@endsection