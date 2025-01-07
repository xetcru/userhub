@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 80vh; text-align: center;">
    <div>
        <h1>Добро пожаловать в панель управления пользователями</h1>
        <p class="mt-3">Здесь могла быть форма регистрации и авторизации, но в ТЗ этого не требовалось.</p>
        <a href="{{ route('users.index') }}" class="btn btn-primary mt-3">к списку пользователей</a>
    </div>
</div>
@endsection