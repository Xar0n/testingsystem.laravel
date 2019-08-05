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
			<strong>Редактирование теста</strong>
		</div>
		<div class="card-body card-block">
			<form action="{{ url("/admin_panel/tests/edit/$test->id") }}" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<div class="row form-group">
					<div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
					<div class="col-12 col-md-9"><input type="text" id="text-input" name="title" placeholder="Название теста" value="{{ $test->title }}" class="form-control"></div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Описание</label></div>
					<div class="col-12 col-md-9"><textarea name="description" id="textarea-input" rows="9" placeholder="Описание теста" class="form-control">{{ $test->description }}</textarea></div>
				</div>
				<div class="form-group row">
					<label for="time-input" class="col col-md-3">Время выполнения</label>
					<div class="col-12 col-md-9">
						<input class="form-control" type="time" name="time" value="00:00" id="time-input">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-date-input" class="col col-md-3">Дата проведения</label>
					<div class="col-12 col-md-9">
						<input class="form-control" name="date" type="date" value="2019-09-19" id="example-date-input">
					</div>
				</div>
				<div class="form-group row">
					<label for="time-input2" class="col col-md-3">Время проведения</label>
					<div class="col-12 col-md-9">
						<input class="form-control" type="time" name="time_date" value="00:00" id="time-input2">
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