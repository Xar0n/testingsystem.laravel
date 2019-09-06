@extends('layouts.layout')
@section('title', 'Доступные тесты')
@section('content')
@if (isset($tests[0]))
    {{ $date }}
    <h1 class="mt-3">Доступные тесты</h1>
    @foreach ($tests as $test)
    <p><a class="mt-3 lead" href="/test/{{ $test->id }}">{{ $test->name }}</a></p>
    @endforeach
@else
    <div class="alert alert-danger" role="alert">
        Тесты отстствуют
    </div>
@endif
@endsection