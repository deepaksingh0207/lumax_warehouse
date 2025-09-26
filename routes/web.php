<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemLabelsController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    Route::post('/dashboard/import-user' , [DashboardController::class,'importUser'])->name('dashboard.import_user');
    Route::get('/item-labels', [ItemLabelsController::class, 'index'])->name('item-labels');
    Route::post('/item-labels', [ItemLabelsController::class, 'index'])->name('item-labels');
    Route::get('/item-labels/generate' , [ItemLabelsController::class, 'generate'])->name('items_labels.generate');
    // Route::get('/item-labels/create-pdf' , [ItemLabelsController::class, 'createPdf'])->name('items_labels.create_pdf');
    Route::post('/item-labels/create-pdf' , [ItemLabelsController::class, 'createPdf'])->name('items_labels.create_pdf');
});