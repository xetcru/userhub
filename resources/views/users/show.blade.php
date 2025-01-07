@extends('layouts.app')

@section('content')
<h1>Пользователь {{ $user->name }}</h1>
<a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">В список</a>
<div class="card">
    <div class="card-header">
        <h2>{{ $user->name }}</h2>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>Имя:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>IP:</strong> {{ $user->ip }}</p>
        <p><strong>Комментарий:</strong> {{ $user->comment }}</p>
    </div>
</div>
@endsection
