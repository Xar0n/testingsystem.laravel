@extends('layouts.app')
@section('title', '<title>Выполнение теста</title>')
@section('content')
<div class="container">
	<form action="" method="post">
		{{ csrf_field() }}
		@foreach ($questions as $question)
			<p class="mt-3 lead">{{ $question->description }}</p>
			@if ($question->type = 1)
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
					<label class="custom-control-label" for="customRadioInline1">Toggle this custom radio</label>
				</div>

			@endif
			@if ($question->type = 0)
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="customRadioInline2" name="customRadioInline2" class="custom-control-input">
					<label class="custom-control-label" for="customRadioInline2">Or toggle this other custom radio</label>
				</div>
			@endif
		@endforeach
		<button type="submit" class="btn btn-success">Завершить</button>
	</form>
</div>
@endsection