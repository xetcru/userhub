# UserHub

**UserHub** — демонстрационный проект REST API для управления пользователями, созданный с использованием фреймворка Laravel. Проект предназначен для работы под следующей конфигурацией:

- **PHP**: 8.0
- **MySQL**: 8
- **NGINX**
- **Laravel**: 9.x

---

## Функционал API

API предоставляет следующие возможности:

1. Получение списка пользователей с пагинацией и возможностью поиска и сортировки по имени.
2. Получение данных конкретного пользователя по ID.
3. Создание нового пользователя.
4. Обновление данных существующего пользователя (имя, IP, комментарий, пароль).
5. Удаление пользователя.

API возвращает ответы в формате JSON и использует **Eloquent ORM** для работы с базой данных.

---

## Развёртывание проекта

Для успешного запуска проекта выполните следующие шаги:

### 1. Установка зависимостей

Склонируйте репозиторий:
git clone https://github.com/xetcru/userhub.git
cd userhub

Установите зависимости Composer:
composer install

### 2. Настройка окружения

Скопируйте файл .env.example в .env:
cp .env.example .env

Настройте подключение к базе данных в файле .env:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

Сгенерируйте ключ приложения:
php artisan key:generate

### 3. Выполнение миграций и сидеров

Создайте таблицы в базе данных:
php artisan migrate

Заполните базу тестовыми данными:
php artisan db:seed

### 4. Установка Sanctum

Для использования API-токенов установите пакет Laravel Sanctum:
composer require laravel/sanctum

Опубликуйте конфигурацию Sanctum:
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

### 5. Генерация токена

Для работы с API создайте токен авторизации для существующего пользователя, например test@example.com:
php artisan generate:token test@example.com

Сохраните этот токен для последующего использования в API-запросах.

### 6. Автотестирование

Проект включает автотестрование. Для запуска тестов:
php artisan test

## Тестирование API

Для взаимодействия с API можно использовать любой инструмент, поддерживающий HTTP-запросы, например Postman или cURL. Ниже приведены основные маршруты:

- GET /api/users — получение списка пользователей (параметры name и sort для фильтрации).
- GET /api/users/{id} — получение данных пользователя по ID.
- POST /api/users — создание нового пользователя.
- PUT /api/users/{id} — обновление данных пользователя по ID.
- DELETE /api/users/{id} — удаление пользователя.

Пример коллекции запросов находится в tests/for_postman/postman_collection.json
Его достаточно отредактировать (base_url и API_TOKEN) и импортировать в Postman: File -> Import...