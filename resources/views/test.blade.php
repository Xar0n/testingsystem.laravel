@extends('layouts.app')
@section('title', '<title>Тест</title>')
@section('content')
	<div class="container">
		<h1 class="mt-5">{{ $test->title }}</h1>
		<p class="mt-3 lead">{{ $test->description }}</p>
	</div>
@endsection