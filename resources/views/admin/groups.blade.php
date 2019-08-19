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
		<a href="{{ url('/admin_panel/groups/add') }}" class="btn btn-primary">Добавить группу</a>
		<div class="card-header">
			<strong class="card-title">Группы</strong>
		</div>
		<div class="card-body">
			<form class="form-inline" method="post" action="{{ url('/admin_panel/groups') }}">
				{{ csrf_field() }}
				<div class="form-group  mb-2">
					<label for="inputPassword2" class="sr-only">Введите id группы</label>
					<input type="text" name="id" class="form-control" id="inputPassword2" placeholder="Введите id группы">
				</div>
				<button type="submit" class="btn btn-primary mb-2">Найти</button>
			</form>
			<table class="table table-bordered">
				<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Название</th>
					<th scope="col">Действия</th>
				</tr>
				</thead>
				<tbody>
				@if(isset($groups))
				@foreach($groups as $group)
				<tr>
					<th scope="row">{{ $group->id }}</th>
					<td>{{ $group->name }}</td>
					<td>
						<div class="btn-group" role="group">
							<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Выберите действие
							</button>
							<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item show_results" data-toggle="modal" data-target="#showResults" href="#showResults" title="{{ $group->name }}" id="{{ $group->id }}">Посмотреть результаты</a>
								<a class="dropdown-item" href="{{ url("/admin_panel/groups/edit/$group->id") }}">Редактировать</a>
                                <a class="dropdown-item" href="{{ url("/admin_panel/groups/scheduled_tests/$group->id") }}">Показать тесты</a>
								<a class="dropdown-item color-red" href="{{ url("/admin_panel/groups/delete/$group->id/") }}">Удалить</a>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
				@elseif(isset($group))
				<tr>
					<th scope="row">{{ $group->id }}</th>
					<td>{{ $group->name }}</td>
					<td>
						<div class="btn-group" role="group">
							<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Выберите действие
							</button>
							<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item show_results" id="{{ $group->id }}" href="{{ url("/admin_panel/show/$group->id") }}">Посмотреть результаты</a>
								<a class="dropdown-item" href="{{ url("/admin_panel/groups/edit/$group->id") }}">Редактировать</a>
                                <a class="dropdown-item" href="{{ url("/admin_panel/groups/scheduled_tests/$group->id") }}">Показать тесты</a>
								<a class="dropdown-item color-red" href="{{ url("/admin_panel/groups/delete/$group->id") }}">Удалить</a>
							</div>
						</div>
					</td>
				</tr>
				@else
				<div class="alert alert-danger" role="alert">
					Группы отстствуют
				</div>
				@endif

				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
    function ajax(data) {
        $.ajax({
            type: "GET",
            url:  "{{ url('/admin_panel/get_tests') }}",
            data: data,
            success: function (data) {
                arr = JSON.parse(data);
                $('#tests_s').html('');
                $(arr).each(function(index, item) {
                    $('#tests_s').append('<option value="'+ item.id +'">' + item.name + '</option>');
                });
            }
        });
    }
    $(".show_results").bind('click',function(event){
        event.preventDefault();
        group_id = $(this).attr('id');
        title = $(this).attr('title');
        data = {group: group_id};
        ajax(data);
        document.getElementById("group_title").innerHTML = title;

    });
</script>
<div class="modal fade" id="showResults" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                </h5 class="modal-title" id="exampleModalLabel">Посмотреть результаты группы: <el id="group_title"></el></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="test_id"  method="post" action="{{url('/admin_panel/results')}}">
                    {{ csrf_field() }}
                    <div class="row form-group" id="count_variants">
                        <div class="col col-md-3"><label for="select" class=" form-control-label">Выберите тест</label></div>
                        <div class="col-6 col-md-9">
                            <select id="tests_s" name="id" id="select" class="form-control">
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Посмотреть результаты</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection