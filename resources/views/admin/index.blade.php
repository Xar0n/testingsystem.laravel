@extends('layouts.admin')
@section('content')
<!-- Animated -->
<div class="animated fadeIn">
	<div class="clearfix"></div>
	<!-- Orders -->
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Результаты</strong>
                    </div>
                    <div class="card-body">
                        <form class="form-inline" method="post" action="{{ url('/admin_panel/results') }}">
                            {{ csrf_field() }}
                            <div class="form-result  mb-2">
                                <label for="inputPassword2" class="sr-only">Введите id результата</label>
                                <input type="text" name="id" class="form-control" id="inputPassword2" placeholder="Введите id результата">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Найти</button>
                        </form>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Пользователь</th>
                                <th scope="col">Дата</th>
                                <th scope="col">Тест</th>
                                <th scope="col">Баллы</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($results))
                            @foreach($results as $result)
                            <tr>
                                <th scope="row">{{ $result->id }}</th>
                                <td>{{ $result->name }}</td>
                                <td>
                                    <div class="btn-result" role="result">
                                        <button id="btnresultDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Выберите действие
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnresultDrop1">
                                            <a class="dropdown-item" href="{{ url("/admin_panel/results/edit/$result->id") }}">Редактировать</a>
                                            <a class="dropdown-item" href="{{ url("/admin_panel/results/scheduled_tests/$result->id") }}">Показать тесты</a>
                                            <a class="dropdown-item color-red" href="{{ url("/admin_panel/results/delete/$result->id/") }}">Удалить</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @elseif(isset($result))
                            <tr>
                                <th scope="row">{{ $result->id }}</th>
                                <td>{{ $result->name }}</td>
                                <td>
                                    <div class="btn-result" role="result">
                                        <button id="btnresultDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Выберите действие
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnresultDrop1">
                                            <a class="dropdown-item" href="{{ url("/admin_panel/results/edit/$result->id") }}">Редактировать</a>
                                            <a class="dropdown-item" href="{{ url("/admin_panel/results/scheduled_tests/$result->id") }}">Показать тесты</a>
                                            <a class="dropdown-item color-red" href="{{ url("/admin_panel/results/delete/$result->id") }}">Удалить</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @else
                            <div class="alert alert-danger" role="alert">
                                Результаты отстствуют
                            </div>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
			</div>  <!-- /.col-lg-8 -->
		</div>
	</div>
	<!-- /.orders -->
</div>

@endsection