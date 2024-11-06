<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home#index');
Route::get('/about', [HomeController::class, 'about'])->name('home#about');
Route::get('/contact', [HomeController::class, 'contact'])->name('home#contact');

Route::get('/register', [AuthController::class, 'registration'])->name('auth.registration');
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/post_login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::post('/post_register', [UserController::class, 'store'])->name('store');

Route::resource('/companies', CompanyController::class);
Route::resource('/employees', EmployeeController::class);
