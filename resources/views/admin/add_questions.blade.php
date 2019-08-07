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
			<strong>Добавление вопросов к тесту: {{ $test->name }}</strong>
		</div>
		<div class="card-body card-block">
			<form action="{{ url('/admin_panel/tests/questions/add') }}" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="name" placeholder="Введите название группы" class="form-control"></div>
				</div>
				<div class="col-lg-4">
					<button type="submit" class="btn btn-success btn-block">Добавить</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection