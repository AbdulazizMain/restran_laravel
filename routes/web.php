<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;



Route::get('/',[PageController::class,"index"]);

Route::get('/logout',           [AuthController::class,"logout"]);
Route::get('/admin',            [AuthController::class,"login"])->name("login");
Route::post('/admin',           [AuthController::class,"check_login"]);

// Admin Route:
Route::get('/admin/product',    [AdminController::class,"admin"])->middleware('auth');
Route::get('/add',              [AdminController::class,"add"])->middleware('auth');
Route::post('/add',             [AdminController::class,"add_create"])->middleware('auth');
Route::get('/edit/{id}',        [AdminController::class,"edit"])->middleware('auth');
Route::post('/edit/{id}',       [AdminController::class,"edit_update"])->middleware('auth');
Route::get('/delete/{id}',      [AdminController::class,"delete"])->middleware('auth');








