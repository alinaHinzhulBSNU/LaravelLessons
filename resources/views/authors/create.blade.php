@extends("layout")

@section("app-title", "Автори")
@section("page-title", "Додати автора")

@section("page-content")
	<form class="text-left" method="post" action="/authors">
		{{ csrf_field() }}
		<div class="form-group">
			@include("includes/input", [
				'fieldId' => 'authorName',
				'labelText' => 'Ім`я',
				'placeholderText' => 'Введіть ім`я автора',
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
			])
			@include("includes/validationError", [
				'errFieldName' => 'country',
			])
		</div>
		<div class="form-group">
			<label for="book">Найвідоміша книга</label>
			<select class="browser-default custom-select" name="book_id">
				<option selected disabled value="0">
					Оберіть книгу
				</option>
				@foreach($books as $book)
					<option value="{{ $book->id }}">
						{{ $book->name }}
					</option>
				@endforeach
			</select>
			@include("includes/validationError", [
				'errFieldName' => 'book_id',
			])
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