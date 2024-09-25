<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/',[WelcomeController::class, 'welcome'])->name('welcome');
Route::post('/welcome/store',[WelcomeController::class, 'welcome_store'])->name('welcome.store');
Route::middleware(['auth'])->group(function () {
    // Admin
    Route::get('/profile', [AdminController::class, 'index'])->name('admin.profile');
});
