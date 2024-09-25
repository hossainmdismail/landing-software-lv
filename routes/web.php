<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ThemeController;



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::post('/welcome/store', [WelcomeController::class, 'welcome_store'])->name('welcome.store');
//login
Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/login', [AdminController::class, 'login_check'])->name('admin.login_check');
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');


Route::middleware(['auth'])->group(function () {
    // Admin
    Route::get('/profile', [AdminController::class, 'index'])->name('admin.profile');


    //Esmail Commit
    Route::get('/appearance', [ThemeController::class, 'index'])->name('appearance');
});
