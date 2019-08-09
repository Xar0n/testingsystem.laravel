@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
	<div class="card">
		@if ($errors->any())
		<ul class="alert alert-danger">
			@foreach ($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
		@endif

		<div class="card-header">
			<strong>Добавление пользователя</strong>
		</div>
		<div class="card-body card-block">
			<form action="{{ url('/admin_panel/tests/add') }}" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Логин</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="login" placeholder="Введите логин пользователя" class="form-control"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Пароль</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="password" placeholder="Введите пароль пользователя" class="form-control"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Email</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="email" placeholder="Введите email пользователя" class="form-control"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Имя</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="name" placeholder="Введите имя пользователя" class="form-control"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Фамилия</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="surname" placeholder="Введите фамилию пользователя" class="form-control"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Отчество</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="patronymic" placeholder="Введите отчество пользователя" class="form-control"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Город</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="city" placeholder="Введите город пользователя" class="form-control"></div>
				</div>
				<div class="col-lg-4">
					<button type="submit" class="btn btn-success btn-block">Добавить</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection