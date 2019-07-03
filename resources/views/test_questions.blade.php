@extends('layouts.app')
@section('title', '<title>Выполнение теста</title>')
@section('content')
<div class="container">
	<form action="{{ url("result") }}" method="post">
		{{ csrf_field() }}
		@foreach ($questions as $question)
			<p class="mt-3 lead">{{ $question->description }}</p>
			@if ($question->type == 1)
                <?php $i = 1 ?>
                <fieldset class="form-group">
                @foreach($variants[$question->id] as $variant)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions{{ $question->id }}" id="inlineRadio{{ $i }}" value="option{{ $i }}">
                        <label class="form-check-label" for="inlineRadio{{ $i }}">{{$variant->decription}}</label>
                    </div>
                <?php $i++ ?>
                @endforeach
                </fieldset>
            @endif
			@if ($question->type == 0)
                <input type="text" class="form-control" name="question{{ $question->id }}" id="formGroupExampleInput">
			@endif
		@endforeach
		<button type="submit" class="btn btn-success">Завершить</button>
	</form>
</div>
@endsection