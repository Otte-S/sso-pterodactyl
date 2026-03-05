<?php

use Illuminate\Support\Facades\Route;
use BuiltByOtte\Sso\Http\Controllers\SsoController;

Route::middleware(['web'])->group(function () {
    Route::get('/sso', [SsoController::class, 'webhook']);
    Route::get('/sso/{token}', [SsoController::class, 'handle'])->name('sso.login');
});
