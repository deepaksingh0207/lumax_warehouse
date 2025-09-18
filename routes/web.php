<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemLabelsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Public routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/create-user', [AuthController::class, 'createUser'])->name('create-user');

Route::get('/', function () {
    return redirect()->route('login');
});

// Protected routes (only logged-in users can access)
Route::middleware(['web','auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/item-labels', [ItemLabelsController::class, 'index'])->name('item-labels');
});