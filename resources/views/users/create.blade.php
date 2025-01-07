@extends('layouts.app')

@section('content')
<h1>Создание пользователя</h1>
<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <div class="mb-3">
        <label>Имя</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Пароль</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>IP</label>
        <input type="text" name="ip" class="form-control">
    </div>
    <div class="mb-3">
        <label>Комментарий</label>
        <textarea name="comment" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Сохранить</button>
</form>
@endsection
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
