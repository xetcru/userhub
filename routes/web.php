<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebUserController;

Route::get('/', function () {
    return view('welcome');
});

// for dev
/*
Route::get('/test', function () {
    return 'It works!';
});

Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();
        return 'Database connection is working!';
    } catch (\Exception $e) {
        return 'Database connection failed: ' . $e->getMessage();
    }
});

Route::get('/user-test', function () {
    \App\Models\User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);
    return 'User created successfully!';
});//*/

//
Route::get('/login', function () {
    return 'This is a placeholder for login route.';
})->name('login');
//
Route::resource('users', WebUserController::class);