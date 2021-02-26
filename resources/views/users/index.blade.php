@extends("layout")

@section("app-title")
	Адміністрування
@endsection

@section("page-title", "Адміністрування користувачів")

@section("page-content")
	<a href="/admin/users/create" class="btn btn-success mb-4">Додати права</a>
	
	<table class="table table-hover table-bordered">
		<input type="hidden" name="_method" value="edit" />
		<thead>
			<tr>
				<th class="text-center align-middle" scope="col">Модель</th>
				<th class="text-center align-middle" scope="col">Право</th>
				<th class="text-center align-middle" scope="col">Користувач</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($rights as $right)
			<tr>
				<td class="text-center align-middle">{{ $right->model }}</td>
				<td class="text-center align-middle">{{ $right->right }}</td>
				<td class="text-center align-middle">{{ $right->user->name }}</td>
				<td class="text-center align-middle">
					<a href="/admin/users/{{ $right->id }}/edit" class="btn btn-primary">Редагувати</a>
				</td>
				<td class="text-center align-middle">
					<a href="/admin/users/{{ $right->id }}/delete" class="btn btn-danger">Видалити</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection