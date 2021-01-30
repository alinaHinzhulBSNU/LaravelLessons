@extends("layout")

@section("app-title")
	Адміністрування
@endsection

@section("page-title", "Адміністрування користувачів")

@section("page-content")
	<form class="text-left" method="post" action="/admin/users/{{ $right->id }}">
		@csrf
		{{ method_field("patch") }}

		<div class="form-group">
			<label for="book-author">Модель</label>
			<select class="browser-default custom-select" name="model">
				<option selected disabled value="0">Оберіть модель</option>
				<option @if($right->model == "book") selected @endif value="book">book</option>
				<option @if($right->model == "author") selected @endif value="author">author</option>
			</select>
		</div>
		<div class="form-group">
			<label for="book-author">Право</label>
			<select class="browser-default custom-select" name="right">
				<option selected disabled value="0">Оберіть право</option>
				<option @if($right->right == "add") selected @endif value="add">add</option>
				<option @if($right->right == "view") selected @endif value="view">view</option>
				<option @if($right->right == "update") selected @endif value="update">update</option>
				<option @if($right->right == "delete") selected @endif value="delete">delete</option>
			</select>
		</div>
		<div class="form-group">
			<label for="book-author">Користувач</label>
			<select class="browser-default custom-select" name="user">
				<option selected disabled value="0">Оберіть користувача</option>
				@foreach($users as $user)
					<option @if($right->user->id == $user->id) selected @endif value="{{ $user->id }}">{{  $user->name }}</option>
				@endforeach
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Змінити</button>
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