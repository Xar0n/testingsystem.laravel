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
			<strong>Добавление вопросов к тесту: {{ $test->name }}</strong>
		</div>
		<div class="card-body card-block">
			<form action="{{ url("/admin_panel/tests/questions/add/$test->id") }}" method="post" class="form-horizontal">
                @for($i = 1; $i <= $count; $i++)
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="question{{ $i }}" class=" form-control-label">Вопрос {{$i}}</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="question{{ $i }}" name="question[{{ $i }}]" placeholder="Введите вопрос" class="form-control" required></div>
                    </div>
                    @if($type == 2)
                        @for($j = 1; $j <= $count_variants; $j++)
                            @if($j % 2 == 1)
                                <div class="form-row">
                            @endif
                                    <div class="col-md-6 mb-3">
                                    <label for="question{{ $i }}_variant{{ $j }}">Вариант {{ $j }}</label>
                                    <input type="text" class="form-control" id="question{{ $i }}_variant{{ $j }}" placeholder="Вариант {{ $j }}" name="variant[{{ $i }}][{{ $j }}]" value="{{ old("variant.$i.$j") }}"  required>
                                    </div>
                                    @if($j % 2 == 0)
                                </div>
                                    @endif
                        @endfor
                    @endif
                <div class="row form-group">
                    <div class="col col-md-3"><label for="answer{{ $i }}" class=" form-control-label">Ответ</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="answer{{ $i }}" name="answer[{{ $i }}]" placeholder="Введите ответ" class="form-control" value="{{ old("answer.question->id") }}" required></div>
                </div>
                    <hr>
                @endfor
				{{ csrf_field() }}
                <input type="hidden" value="{{ $type }}" name="type">
				<div class="col-lg-4">
					<button type="submit" class="btn btn-success btn-block">Добавить</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection