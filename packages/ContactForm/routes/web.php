<?php

use Illuminate\Support\Facades\Route;
use ContactForm\Http\Controllers\AdminAuthController;
use ContactForm\Http\Controllers\AdminContactFormController;

Route::middleware(['web'])->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    Route::middleware(['admin.web'])->prefix('admin/contact')->group(function () {
        Route::get('/', [AdminContactFormController::class, 'index'])->name('admin.dashboard');
        Route::get('/{contactForm}', [AdminContactFormController::class, 'show']);
        Route::delete('/{contactForm}', [AdminContactFormController::class, 'destroy']);
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});

