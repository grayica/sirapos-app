<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\JadwalController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('posyandu', PosyanduController::class);
    Route::resource('peserta', PesertaController::class)
    ->parameters(['peserta' => 'peserta']);
    Route::resource('jadwal', JadwalController::class)
    ->parameters(['jadwal' => 'jadwal']);
});

require __DIR__.'/auth.php';
