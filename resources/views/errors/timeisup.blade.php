@extends('layouts.layout')
@section('title', "Выполнение теста: $test->name")
@section('content')
<div class="alert alert-danger" role="alert">
	Время выполнения теста истекло
</div>
@endsection