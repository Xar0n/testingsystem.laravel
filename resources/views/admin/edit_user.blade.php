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
			<strong>Редактирование пользователя</strong>
		</div>
		<div class="card-body card-block">
			<form action="{{ url("/admin_panel/users/edit/$user->id") }}" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input4" class=" form-control-label">Имя</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input4" name="name" placeholder="Введите имя пользователя" class="form-control" value="{{ $user->name }}"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input5" class=" form-control-label">Фамилия</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input5" name="surname" placeholder="Введите фамилию пользователя" class="form-control" value="{{ $user->surname }}"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input6" class=" form-control-label">Отчество</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input6" name="patronymic" placeholder="Введите отчество пользователя" class="form-control" required value="{{ $user->patronymic }}"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input7" class=" form-control-label">Город</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input7" name="city" placeholder="Введите город пользователя" class="form-control" required value="{{ $user->city }}"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="group" class=" form-control-label">Группа</label></div>
					<div class="col-12 col-md-9">
						<select name="group_id" id="group" class="form-control" required>
							@foreach($groups as $group)
								@if($group->id == $user->group_id)
									<option selected value="{{ $group->id }}">{{ $group->name }}</option>
								@else
									<option value="{{ $group->id }}">{{ $group->name }}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-4">
					<button type="submit" class="btn btn-success btn-block">Редактировать</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection