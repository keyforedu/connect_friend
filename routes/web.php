<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::get('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/login', [UserController::class, 'check_credential'])->middleware('guest');
Route::get('/register', [HomepageController::class, 'register'])->middleware('guest');
Route::post('/register', [UserController::class, 'store'])->middleware('guest');
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/home', [HomepageController::class, 'index'])->middleware('auth');
Route::get('/liked', [UserController::class, 'liked'])->middleware('auth');
Route::get('/user/{id}', [HomepageController::class, 'like'])->middleware('auth');
Route::get('/dislike/{id}', [HomepageController::class, 'dislike'])->middleware('auth');
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth');
Route::post('/profile/addcoin', [UserController::class, 'addcoin'])->middleware('auth');
Route::post('/profile/changeVisibility', [UserController::class, 'changeVisibility'])->middleware('auth');
