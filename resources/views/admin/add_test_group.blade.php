@extends('layouts.admin')
@section('content')
<?php
    $mytime = Carbon\Carbon::now();
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
			<strong>Добавление теста {{$test->name}} к группе {{$group->name}}</strong>
		</div>
		<div class="card-body card-block">
			<form action="{{ url("/admin_panel/groups/scheduled_tests/$group->id/add/$test->id") }}" method="post" class="form-horizontal">
				{{ csrf_field() }}
                <div class="form-group row">
                    <label for="time-input" class="col col-md-3">Время выполнения</label>
                    <div class="col-12 col-md-9">
                        <input class="form-control" type="time" name="time" value="00:00" id="time-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col col-md-3">Дата начала</label>
                    <div class="col-12 col-md-9">
                        <input class="form-control" name="date_first" type="date" value="{{ $mytime->toDateString() }}" id="example-date-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="time-input2" class="col col-md-3">Время начала</label>
                    <div class="col-12 col-md-9">
                        <input class="form-control" type="time" name="time_first" value="00:00" id="time-input2">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col col-md-3">Дата конца</label>
                    <div class="col-12 col-md-9">
                        <input class="form-control" name="date_last" type="date" value="{{ $mytime->toDateString() }}" id="example-date-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="time-input2" class="col col-md-3">Время конца</label>
                    <div class="col-12 col-md-9">
                        <input class="form-control" type="time" name="time_last" value="00:00" id="time-input2">
                    </div>
                </div>
				<div class="col-lg-4">
					<button type="submit" class="btn btn-success btn-block">Добавить</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
