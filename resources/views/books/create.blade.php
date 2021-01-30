@extends("layout")

@section("app-title", "Список книг")
@section("page-title", "Додати книгу")

@section("page-content")
	<form class="text-left" method="post" action="/author/{{ $author_filter_id }}/books">
		{{ csrf_field() }}
		<div class="form-group">
			@include("includes/input", [
				'fieldId' => 'book-name',
				'labelText' => 'Назва',
				'placeholderText' => 'Введіть назву',
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
					<option value="{{ $author->id }}" @if($author_filter_id == $author->id) selected @endif>{{  $author->authorName }}</option>
				@endforeach
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Додати</button>

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
@endsection