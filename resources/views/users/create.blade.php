@extends("layout")

@section("app-title")
	Адміністрування
@endsection

@section("page-title", "Адміністрування користувачів")

@section("page-content")
	<form class="text-left" method="post" action="/admin/users">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="book-author">Модель</label>
			<select class="browser-default custom-select" name="model">
				<option selected disabled value="0">Оберіть модель</option>
				<option value="book">book</option>
				<option value="author">author</option>
			</select>
		</div>
		<div class="form-group">
			<label for="book-author">Право</label>
			<select class="browser-default custom-select" name="right">
				<option selected disabled value="0">Оберіть право</option>
				<option value="add">add</option>
				<option value="view">view</option>
				<option value="update">update</option>
				<option value="delete">delete</option>
			</select>
		</div>
		<div class="form-group">
			<label for="book-author">Користувач</label>
			<select class="browser-default custom-select" name="user">
				<option selected disabled value="0">Оберіть користувача</option>
				@foreach($users as $user)
					<option value="{{ $user->id }}">{{  $user->name }}</option>
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