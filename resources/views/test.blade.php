@extends('layouts.layout')
@section('title', "Тест: $test->name")
@section('content')
	<div class="container">
		<h1 class="mt-5">{{ $test->name }}</h1>
		<p class="mt-3 lead">{{ $test->description }}</p>
        <form action="{{ url("/test/do/$test->id") }}" method="post">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Начать тест</button>
        </form>
	</div>
@endsection