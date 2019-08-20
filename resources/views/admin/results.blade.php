@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
    @if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Результаты группы: {{ $group->name }}. Теста: {{ $test->name  }}</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Пользователь</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Баллы</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($results[0]))
                @foreach($results as $result)
                <tr>
                    <th scope="row">{{ $result->id }}</th>
                    <td>{{ $result->user_login }}</td>
                    <td>{{ $result->date }}</td>
                    <td>{{ $result->points }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Выберите действие
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="{{ url("/admin_panel/results/show/$result->id") }}">Просмотр ответов</a>
                                <a class="dropdown-item" href="{{ url("/admin_panel/results/delete/$result->id") }}">Удалить</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <div class="alert alert-danger" role="alert">
                    Результаты отстствуют
                </div>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection