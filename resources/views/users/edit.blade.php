@extends('layouts.app')

@section('content')
<h1>Редактирование пользователя</h1>
<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Имя</label>
        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Пароль</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>IP</label>
        <input type="text" name="ip" value="{{ $user->ip }}" class="form-control">
    </div>
    <div class="mb-3">
        <label>Комментарий</label>
        <textarea name="comment" class="form-control">{{ $user->comment }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Обновить</button>
</form>
@endsection
