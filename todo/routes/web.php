<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\control;
use App\Http\Controllers\redirect;


Route::get('/', function () {
    return view('welcome');
});

Route::get('loginpage', [control::class, 'loginpage'])->name('loginpage');
Route::get('registerpage', [control::class, 'registerpage']);

Route::post('login', [control::class, 'login']);
Route::post('register', [control::class, 'register']);

Route::get('home', [redirect::class, 'home'])->name('home');
Route::get('logout', [control::class, 'logout']);