@extends('layouts.app')
@section('title', '<title>Тест</title>')
@section('content')
	<div class="container">
		<h1 class="mt-5">{{ $test->title }}</h1>
		<p class="mt-3 lead">{{ $test->description }}</p>
        <form action="{{ url("/test/$test->id") }}" method="post">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Начать тест</button
        </form>
	</div>
@endsection