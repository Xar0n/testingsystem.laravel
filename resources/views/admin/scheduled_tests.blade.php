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
		<div class="card-header">
			<strong class="card-title">Запланированные тесты для группы: {{ $group->name }}</strong>
		</div>
		<div class="card-body">
			<table class="table table-bordered">
				<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Название</th>
					<th scope="col">Время выполнения</th>
					<th scope="col">Доступен с</th>
					<th scope="col">Доступен до</th>
					<th scope="col">Действия</th>
				</tr>
				</thead>
				<tbody>
				@if(isset($tests))
				@foreach($tests as $test)
				<tr>
					<th scope="row">{{ $test->id }}</th>
					<td>{{ $test->name }}</td>
					<td>{{ $test->time }}</td>
					<td>{{ $test->date_first }}</td>
					<td>{{ $test->date_last }}</td>
					<td>
						<div class="btn-group" role="group">
							<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Выберите действие
							</button>
							<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								<a class="dropdown-item" href="{{ url("/admin_panel/tests/edit/$test->id/") }}">Редактировать</a>
								<a class="dropdown-item" href="#">Добавить вопросы</a>
								<a class="dropdown-item color-red" href="{{ url("/admin_panel/tests/delete/$test->id/") }}">Удалить</a>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
				@else
				<div class="alert alert-danger" role="alert">
					Запланированные тесты отстствуют
				</div>
				@endif

				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection