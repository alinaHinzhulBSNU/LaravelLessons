@extends("layout")

@section("app-title")
	Адміністрування
@endsection

@section("page-title", "Адміністрування користувачів")

@section("page-content")
	<a href="/admin/users/create" class="btn btn-outline-success float-left" style="margin-bottom: 20px; margin-top: 10px;">Додати права</a>
	
	<table class="table table-striped table-dark">
		<input type="hidden" name="_method" value="edit" />
		<tr>
			<th scope="col">Модель</th>
			<th scope="col">Право</th>
			<th scope="col">Користувач</th>
			<th></th>
			<th></th>
		</tr>
		@foreach($rights as $right)
			<tr>
				<td>{{ $right->model }}</td>
				<td>{{ $right->right }}</td>
				<td>{{ $right->user->name }}</td>
				<td>
					<a href="/admin/users/{{ $right->id }}/edit" class="btn btn-warning">Редагувати</a>
				</td>
				<td>
					<a href="/admin/users/{{ $right->id }}/delete" class="btn btn-danger">Видалити</a>
				</td>
			</tr>
		@endforeach
	</table>
@endsection