<?php

use App\Livewire\DashboardPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardPage::class)
        ->name('dashboard');
});

require __DIR__.'/auth.php';
