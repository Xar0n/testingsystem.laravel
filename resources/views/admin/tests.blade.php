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
        <a href="{{ url('/admin_panel/tests/add') }}" class="btn btn-primary">Добавить тест</a>
		<div class="card-header">
			<strong class="card-title">Тесты</strong>
		</div>
		<div class="card-body">
			<form class="form-inline" method="post" action="{{ url('/admin_panel/tests') }}">
				{{ csrf_field() }}
				<div class="form-group  mb-2">
					<label for="inputPassword2" class="sr-only">Введите id теста</label>
					<input type="text" name="id" class="form-control" id="inputPassword2" placeholder="Введите id теста">
				</div>
				<button type="submit" class="btn btn-primary mb-2">Найти</button>
			</form>
			<table class="table table-bordered">
				<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Название</th>
					<th scope="col">Описание</th>
					<th scope="col">Действия</th>
				</tr>
				</thead>
				<tbody>
                @if(isset($tests))
				@foreach($tests as $test)
					<tr>
						<th scope="row">{{ $test->id }}</th>
                        <td>{{ $test->name }}</td>
                        <td>{{ $test->description }}</td>
						<td>
							<div class="btn-group" role="group">
								<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Выберите действие
								</button>
								<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
									<a class="dropdown-item" href="{{ url("/admin_panel/tests/edit/$test->id/") }}">Редактировать</a>
									<a id="{{ $test->id }}" class="dropdown-item questions_add" data-toggle="modal" data-target="#exampleModal" href="#exampleModal" title="{{$test->name}}">Добавить вопросы</a>
									<a class="dropdown-item color-red" href="{{ url("/admin_panel/tests/delete/$test->id/") }}">Удалить</a>
								</div>
							</div>
						</td>
					</tr>
				@endforeach
                @elseif(isset($test))
                <tr>
                    <th scope="row">{{ $test->id }}</th>
                    <td>{{ $test->name }}</td>
                    <td>{{ $test->description }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Выберите действие
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="{{ url("/admin_panel/edit/$test->id") }}">Редактировать</a>
                                <a id="{{ $test->id }}" class="dropdown-item questions_add" data-toggle="modal" data-target="#exampleModal" href="#exampleModal" title="{{$test->name}}">Добавить вопросы</a>
                                <a class="dropdown-item color-red" href="{{ url("/admin_panel/delete/$test->id") }}">Удалить</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @else
                    <div class="alert alert-danger" role="alert">
                        Тесты отстствуют
                    </div>
                @endif
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
    $(".questions_add").bind('click',function(event){
        event.preventDefault();
        test_id = $(this).attr('id');
        title = $(this).attr('title');
        document.getElementById("test_id").setAttribute('action', '{{ url('/admin_panel/tests/questions/add_form/') }}'+'/'+test_id);
        document.getElementById("test_title").innerHTML = title;
    });

    function toggle_visibility(id) {
        var e = document.getElementById(id);
        e.style.display = '';
    }
    function toggle_unvisibility(id) {
        var e = document.getElementById(id);
        e.style.display = 'none';
    }
</script>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                </h5 class="modal-title" id="exampleModalLabel">Добавить вопросы к тесту: <el id="test_title"></el></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="test_id"  method="post">
                    {{ csrf_field() }}
                    <div class="row form-group">
                        <div class="col col-md-5"><label for="text-input2" class=" form-control-label">Количество вопросов</label></div>
                        <div class="col-5 col-md-7"><input type="text" maxlength="3" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="text-input2"  class="form-control" name="count" placeholder="Введите количество вопросов" value="1"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4"><label class=" form-control-label">Тип вопросов</label></div>
                        <div class="col col-md-8">
                            <div class="form-check-inline form-check">
                                <label for="text" class="form-check-label form-check-inline">
                                    <input type="radio" id="text" name="type" value="1" class="form-check-input" onclick="toggle_unvisibility('count_variants');" checked>Текстовый
                                </label>
                                <label for="variant" class="form-check-label form-check-inline">
                                    <input type="radio" id="variant" name="type" value="2" class="form-check-input" onclick="toggle_visibility('count_variants');" >Вариативный
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group" id="count_variants" style="display: none">
                        <div class="col col-md-6"><label for="text-input2" class=" form-control-label">Количество вариантов</label></div>
                        <div class="col-5 col-md-6"><input type="text" maxlength="1" oninput="this.value = this.value.replace(/[^2-9]/g, '')" id="text-input2"  class="form-control" name="count_variants" placeholder="Введите количество вариантов" value="2"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Добавить</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection