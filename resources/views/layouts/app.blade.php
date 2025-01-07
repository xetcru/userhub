<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserHub</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-5">
        <a class="btn btn-primary" href="/users">Список пользователей</a>
        <a class="btn btn-primary" href="/users/create">Создать</a>
    </div>
    <div class="container mt-5">
        @yield('content')
    </div>
</body>
</html>
