@extends('layouts.app')

@section('content')
<h1>Список пользователей</h1>
<form method="GET" action="{{ route('users.index') }}">
    <input type="text" name="search" value="{{ $search }}" placeholder="Поиск пользователя" class="form-control mb-3">
    <button type="submit" class="btn btn-primary">Поиск</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th>
                <a href="{{ route('users.index', ['sort' => 'id', 'direction' => $sortColumn === 'id' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                    ID
                    @if ($sortColumn === 'id')
                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('users.index', ['sort' => 'name', 'direction' => $sortColumn === 'name' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                    Name
                    @if ($sortColumn === 'name')
                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('users.index', ['sort' => 'email', 'direction' => $sortColumn === 'email' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">
                    Email
                    @if ($sortColumn === 'email')
                        <span>{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                    @endif
                </a>
            </th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info"><i class="bi bi-eye"></i></a>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('users.create') }}" class="btn btn-success mb-3">Создать</a>
{{ $users->links() }}
@endsection
