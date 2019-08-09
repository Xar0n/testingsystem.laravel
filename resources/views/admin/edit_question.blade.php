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
			<strong>Редактирование вопроса теста: {{ $test->name }}</strong>
		</div>
		<div class="card-body card-block">
			<form action="{{ url("/admin_panel/tests/questions/edit/$question->id") }}" method="post" class="form-horizontal">
			<div class="row form-group">
				<div class="col col-md-3"><label for="question" class=" form-control-label">Вопрос</label></div>
				<div class="col-12 col-md-9"><input type="text" id="question" name="question" placeholder="Вопрос" class="form-control" value="{{ $question->description }}" required></div>
			</div>
			@if($question->type == 2)
			<?php $j = 0 ?>
			@foreach($variants as $variant)
			<?php $j++ ?>
			@if($j % 2 == 1)
			<div class="form-row">
				@endif
				<div class="col-md-6 mb-3">
					<label for="variant{{ $j }}">Вариант {{ $j }}</label>
					<input type="text" class="form-control" id="variant{{ $j }}" placeholder="Вариант {{ $j }}" name="variant[{{ $j }}]" value="{{ $variant->description }}"  required>
				</div>
                @if($j % 2 == 0)
			</div>
			@endif
			@endforeach
			@endif
			<div class="row form-group">
				<div class="col col-md-3"><label for="answer" class=" form-control-label">Ответ</label></div>
				<div class="col-12 col-md-9"><input type="text" id="answer" name="answer" placeholder="Ответ" class="form-control" value="{{ $question->true_answer }}" required></div>
			</div>
			<hr>
			{{ csrf_field() }}
			<div class="col-lg-4">
				<button type="submit" class="btn btn-success btn-block">Редактировать</button>
			</div>
			</form>
		</div>
	</div>
</div>
@endsection