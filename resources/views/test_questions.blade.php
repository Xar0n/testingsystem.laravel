@extends('layouts.layout')
@section('title', 'Выполнение теста')
@section('content')
<script type="text/javascript">
    function startTimer(duration, display) {
        var start = Date.now(),
            diff,
            minutes,
            seconds;
        function timer() {
            diff = duration - (((Date.now() - start) / 1000) | 0);
            minutes = (diff / 60) | 0;
            seconds = (diff % 60) | 0;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            display.textContent = minutes + ":" + seconds;
            if (diff <= 0) {
                start = Date.now() + 1000; //Здесь можно поставить отправку формы
            }
        };
        timer();
        setInterval(timer, 1000);
    }
    window.onload = function () {
        var time = {{$time->h * 60 * 60 + $time->i * 60 + $time->s}}
            display = document.querySelector('#time');
        startTimer(time, display);
    };
</script>
    @if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <p class="mt-3 lead">Оставшееся время: <span id="time"></span></p>
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
