@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
    <div class="card">
        @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif

        <div class="card-header">
            <strong>Добавление теста</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ url('/admin_panel/tests/add') }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Название</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="text-input" name="title" placeholder="Введите название теста" class="form-control" value="{{ old('title') }}"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Описание</label></div>
                    <div class="col-12 col-md-9"><textarea name="description" id="textarea-input" rows="9" placeholder="Введите описание теста" class="form-control">{{ old('name') }}"</textarea></div>
                </div>
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-success btn-block">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection