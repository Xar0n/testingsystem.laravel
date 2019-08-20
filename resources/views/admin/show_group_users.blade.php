@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">Просмотр пользователей группы: {{ $group->name }}</strong>
		</div>
		<div class="card-body">
			<table class="table table-bordered">
				<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Логин</th>
					<th scope="col">Email</th>
					<th scope="col">Фамилия</th>
					<th scope="col">Имя</th>
					<th scope="col">Отчество</th>
					<th scope="col">Город</th>
					<th scope="col">Группа</th>
					<th scope="col">Действия</th>
				</tr>
				</thead>
				<tbody>
				@if(isset($users[0]))
				@foreach($users as $user)
				<tr>
					<th scope="row">{{ $user->id }}</th>
					<td>{{ $user->login }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->surname }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->patronymic }}</td>
					<td>{{ $user->city }}</td>
					<td>{{ $user->group_id }}</td>
					<td>
						<div class="btn-group" role="group">
							<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Выберите действие
							</button>
							<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								<a class="dropdown-item" href="{{ url("/admin_panel/users/edit/$user->id") }}">Редактировать</a>
								<a class="dropdown-item color-red" href="{{ url("/admin_panel/users/delete/$user->id/") }}">Удалить</a>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
				@else
				<div class="alert alert-danger" role="alert">
					Пользователи в этой группе отстствуют
				</div>
				@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection