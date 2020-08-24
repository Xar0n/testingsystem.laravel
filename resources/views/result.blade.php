@extends('layouts.layout')
@section('title', "Результат теста: $test->name")
@section('content')
<div class="container">
    <p class="mt-3 lead">Тест: {{ $test->name }} <h1 class="mt-5">
	<p class="mt-3 lead">Ваш результат: {{$points/$points_total}}%</p>
</div>
@endsection