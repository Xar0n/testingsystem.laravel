@extends('layouts.admin')
@section('content')
<?php
    $datetime1 = new DateTime($test_s->date_first);
    $date_first = $datetime1->format('Y-m-d');
    $time_first = $datetime1->format('H:i');
    $datetime2 = new DateTime($test_s->date_last);
    $date_last = $datetime2->format('Y-m-d');
    $time_last = $datetime2->format('H:i');
    $datetime3 = new DateTime($test_s->time);
    $time = $datetime2->format('H:i');
?>
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
			<strong>Редакирование теста {{$test->name}} группы {{$group->name}}</strong>
		</div>
		<div class="card-body card-block">
			<form action="{{ url("/admin_panel/groups/scheduled_tests/edit/$test_s->id") }}" method="post" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group row">
				<label for="time-input" class="col col-md-3">Время выполнения</label>
				<div class="col-12 col-md-9">
					<input class="form-control" type="time" name="time" value="{{ $time }}" id="time-input">
				</div>
			</div>
			<div class="form-group row">
				<label for="example-date-input" class="col col-md-3">Дата начала</label>
				<div class="col-12 col-md-9">
					<input class="form-control" name="date_first" type="date" value="{{ $date_first }}" id="example-date-input">
				</div>
			</div>
			<div class="form-group row">
				<label for="time-input2" class="col col-md-3">Время начала</label>
				<div class="col-12 col-md-9">
					<input class="form-control" type="time" name="time_first" value="{{ $time_first }}" id="time-input2">
				</div>
			</div>
			<div class="form-group row">
				<label for="example-date-input" class="col col-md-3">Дата конца</label>
				<div class="col-12 col-md-9">
					<input class="form-control" name="date_last" type="date" value="{{ $date_last }}" id="example-date-input">
				</div>
			</div>
			<div class="form-group row">
				<label for="time-input2" class="col col-md-3">Время конца</label>
				<div class="col-12 col-md-9">
					<input class="form-control" type="time" name="time_last" value="{{ $time_last }}" id="time-input2">
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
