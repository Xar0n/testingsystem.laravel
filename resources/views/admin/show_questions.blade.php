@extends('layouts.admin')
@section('content')
<?php
    $j = 0;
    $i = 0;
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
			<strong>Просмотр теста: {{ $test->name }}</strong>
		</div>
		<div class="card-body card-block">
            {{ csrf_field() }}
            @foreach($questions as $question)
            <?php $i++ ?>
            <div class="row form-group">
                <div class="col-lg-4">
                    <p>Вопрос {{ $i }}: {{ $question->description }}</p>
                    @if($question->type == 2)
                        <ol class="list-group">
                            <?php $j = 0?>
                        @foreach($variants[$question->id] as $variant)
                            <?php $j++ ?>
                            <li class="list-group item"><p>Вариант {{ $j }}: {{ $variant->description }}</p></li>
                        @endforeach
                        </ol>
                    @endif
                    <p>Ответ: {{ $question->true_answer }}</p>
                    <a href="{{ url("/admin_panel/tests/questions/edit/$question->id") }}" class="btn btn-success btn-block">Редактировать</a>
                </div>
            </div>
            <hr>
            @endforeach
	</div>
</div>
@endsection