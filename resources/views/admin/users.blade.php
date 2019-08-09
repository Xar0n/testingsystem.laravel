@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
	@if ($errors->any())
	<ul class="alert alert-danger">
		@foreach ($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>
	@endif
	<div class="card">
		<a href="{{ url('/admin_panel/users/add') }}" class="btn btn-primary">Добавить пользователя</a>
		<div class="card-header">
			<strong class="card-title">Пользователи</strong>
		</div>
		<div class="card-body">
			<form class="form-inline" method="post" action="{{ url('/admin_panel/users') }}">
				{{ csrf_field() }}
				<div class="form-group  mb-2">
					<label for="inputPassword2" class="sr-only">Введите id пользователя</label>
					<input type="text" name="id" class="form-control" id="inputPassword2" placeholder="Введите id группы">
				</div>
				<button type="submit" class="btn btn-primary mb-2">Найти</button>
			</form>
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
				@if(isset($users))
				@foreach($users as $user)
				<tr>
					<th scope="row">{{ $user->id }}</th>
					<td>{{ $user->login }}</td>
					<td>{{ $user->email }}</td>
                    <td>{{ $user->surname }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->patronymic }}</td>
					<td>{{ $user->city }}</td>
					<td>{{ $groups[$user->group_id]->name }}</td>
					<td>
						<div class="btn-group" role="group">
							<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Выберите действие
							</button>
							<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								<a class="dropdown-item" href="{{ url("/admin_panel/users/edit/$user->id") }}">Редактировать</a>
                                <a class="dropdown-item" href="{{ url("/admin_panel/groups/$user->group_id") }}">Посмотреть группу</a>
                                <a class="dropdown-item color-red" href="{{ url("/admin_panel/users/delete/$user->id/") }}">Удалить</a>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
				@elseif(isset($user))
				<tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->login }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->patronymic }}</td>
                    <td>{{ $user->city }}</td>
                    <td>{{ $groups[$user->group_id]->name }}</td>
                    <td>
						<div class="btn-group" role="group">
							<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Выберите действие
							</button>
							<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="{{ url("/admin_panel/users/edit/$user->id") }}">Редактировать</a>
                                <a class="dropdown-item" href="{{ url("/admin_panel/groups/$user->group_id") }}">Посмотреть группу</a>
                                <a class="dropdown-item color-red" href="{{ url("/admin_panel/users/delete/$user->id/") }}">Удалить</a>
							</div>
						</div>
					</td>
				</tr>
				@else
				<div class="alert alert-danger" role="alert">
					Пользователи отстствуют
				</div>
				@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection