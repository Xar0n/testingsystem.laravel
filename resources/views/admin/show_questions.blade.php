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
			<strong>Просмотр вопросов теста: {{ $test->name }}</strong>
		</div>
		<div class="card-body card-block">
            @if(isset($questions[0]))
            @foreach($questions as $question)
            <?php $i++ ?>
            <div class="row form-group">
                <div class="col-lg-12">
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
                    <div class="row form-group">
                        <div class="col-lg-4">
                            <a href="{{ url("/admin_panel/tests/questions/edit/$question->id") }}" class="btn btn-success btn-block">Редактировать</a>
                        </div>
                        <div class="col-lg-4">
                            <a href="{{ url("/admin_panel/tests/questions/delete/$question->id") }}" class="btn btn-danger btn-block">Удалить</a>
                        </div>
                    </div>
                    </div>
                </div>
            <hr>
            @endforeach
            @else
            <div class="alert alert-danger" role="alert">
                Вопросы для данного теста отстутствуют
            </div>
            @endif
        </div>
	</div>
</div>
@endsection