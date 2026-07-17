<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

// Homepage
Route::get('/', [PropertyController::class, 'index'])->name('home');

// Landlord routes

Route::middleware(['auth', 'landlord'])->group(function () {
    Route::get('/landlord/dashboard', [PropertyController::class, 'dashboard'])
        ->name('landlord.dashboard');

    Route::get('/landlord/listings/create', [PropertyController::class, 'create'])
        ->name('landlord.listings.create');
    Route::post('/landlord/listings', [PropertyController::class, 'store'])
        ->name('landlord.listings.store');

    // Edit & update
    Route::get('/landlord/listings/{property}/edit', [PropertyController::class, 'edit'])
        ->name('landlord.listings.edit');
    Route::put('/landlord/listings/{property}', [PropertyController::class, 'update'])
        ->name('landlord.listings.update');

    // Delete
    Route::delete('/landlord/listings/{property}', [PropertyController::class, 'destroy'])
        ->name('landlord.listings.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';
