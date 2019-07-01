@extends('layouts.app')
@section('title', '<title>Доступные тесты</title>')
@section('content')
@if (count($tests) > 0)
    <div class="container">
        <h1 class="mt-3">Доступные тесты</h1>
        @foreach ($tests as $test)
            <a class="mt-3 lead" href="/test/{{ $test->id }}">{{ $test->title }}</a>
        @endforeach
    </div>
@endif
@endsection