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
		<a href="{{ url('/admin_panel/groups/add') }}" class="btn btn-primary">Добавить группу</a>
		<div class="card-header">
			<strong class="card-title">Группы</strong>
		</div>
		<div class="card-body">
			<form class="form-inline" method="post" action="{{ url('/admin_panel/groups') }}">
				{{ csrf_field() }}
				<div class="form-group  mb-2">
					<label for="inputPassword2" class="sr-only">Введите id группы</label>
					<input type="text" name="id" class="form-control" id="inputPassword2" placeholder="Введите id группы">
				</div>
				<button type="submit" class="btn btn-primary mb-2">Найти</button>
			</form>
			<table class="table table-bordered">
				<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Название</th>
					<th scope="col">Действия</th>
				</tr>
				</thead>
				<tbody>
				@if(isset($groups))
				@foreach($groups as $group)
				<tr>
					<th scope="row">{{ $group->id }}</th>
					<td>{{ $group->name }}</td>
					<td>
						<div class="btn-group" role="group">
							<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Выберите действие
							</button>
							<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								<a class="dropdown-item" href="{{ url("/admin_panel/groups/edit/$group->id") }}">Редактировать</a>
                                <a class="dropdown-item" href="{{ url("/admin_panel/groups/scheduled_tests/$group->id") }}">Показать тесты</a>
								<a class="dropdown-item" href="{{ url("/admin_panel/groups/add_test/$group->id") }}">Добавить тест</a>
								<a class="dropdown-item color-red" href="{{ url("/admin_panel/groups/delete/$group->id/") }}">Удалить</a>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
				@elseif(isset($group))
				<tr>
					<th scope="row">{{ $group->id }}</th>
					<td>{{ $group->name }}</td>
					<td>
						<div class="btn-group" role="group">
							<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Выберите действие
							</button>
							<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								<a class="dropdown-item" href="{{ url("/admin_panel/groups/edit/$group->id") }}">Редактировать</a>
                                <a class="dropdown-item" href="{{ url("/admin_panel/groups/scheduled_tests/$group->id") }}">Показать тесты</a>
                                <a class="dropdown-item" href="{{ url("/admin_panel/groups/add_test/$group->id") }}">Добавить тест</a>
								<a class="dropdown-item color-red" href="{{ url("/admin_panel/groups/delete/$group->id") }}">Удалить</a>
							</div>
						</div>
					</td>
				</tr>
				@else
				<div class="alert alert-danger" role="alert">
					Группы отстствуют
				</div>
				@endif

				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection