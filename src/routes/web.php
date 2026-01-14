<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard\DashboardPage;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardPage::class)->name('dashboard');
});

require __DIR__.'/auth.php';
