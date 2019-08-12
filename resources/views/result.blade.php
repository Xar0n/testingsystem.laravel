@extends('layouts.layout')
@section('title', '<title>Результат теста</title>')
@section('content')
<div class="container">
    <p class="mt-3 lead">Тест {{ $test->title }} <h1 class="mt-5">
	<p class="mt-3 lead">Ваш результат: {{ $points }} из {{ $points_total }}</p>
</div>
@endsection