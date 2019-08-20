@extends('layouts.admin')
@section('content')
<?php
$j = 0;
$i = 0;
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong>Просмотр ответов пользователя: {{ $user->login }}. Теста: {{ $test->name }}</strong>
		</div>
		<div class="card-body card-block">
			@if(isset($questions[0]))
			@foreach($questions as $question)
			<?php $i++ ?>
			<div class="row form-group">
				<div class="col-lg-12">
					<p>Вопрос {{ $i }}: {{ $question->description }}</p>
					<p>Правильный ответ: {{ $question->true_answer }}</p>
					<p>Ответ пользователя: {{ $result_questions[$question->id]->answer }}</p>
				</div>
			</div>
			<hr>
			@endforeach
            <div class="row form-group">
                <div class="col-lg-12">
                    <strong>Баллов: {{ $result->points }}</strong>
                </div>
            </div>
			@else
			<div class="alert alert-danger" role="alert">
				Ответы для данного теста отсутствуют
			</div>
			@endif
		</div>
	</div>
</div>
@endsection