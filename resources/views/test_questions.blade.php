@extends('layouts.layout')
@section('title', 'Выполнение теста')
@section('content')
    @if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <!--<p class="mt-3 lead">Оставшееся время: </p>-->
    <p class="mt-3 lead">Текущее время: {{ Carbon\Carbon::now() }}</p>
    <hr>
    <div class="col-sm-5">
	<form action="{{ url('/result') }}" method="post">
		{{ csrf_field() }}
        <?php $j = 1 ?>
		@foreach ($questions as $question)
			<p class="mt-3 lead">Вопрос {{ $j }}: {{ $question->description }}</p>
			@if ($question->type == 2)
                <?php $i = 1 ?>
                <fieldset class="form-group">
                @foreach($variants[$question->id] as $variant)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="inlineRadio{{ $i }}" value="{{ $variant->description }}">
                        <label class="form-check-label" for="inlineRadio{{ $i }}">{{$variant->description}}</label>
                    </div>
                <?php $i++ ?>
                @endforeach
                </fieldset>
            @endif
			@if ($question->type == 1)
                <input type="text" class="form-control" name="answers[{{ $question->id }}]" id="formGroupExampleInput">
			@endif
            <hr>
        <?php $j++ ?>
		@endforeach
        <div class="form-group">
            <button type="submit" class="btn btn-success">Завершить</button>
        </div>
	</form>
    </div>
@endsection
