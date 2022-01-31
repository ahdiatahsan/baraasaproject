<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('administrator')->group(function () {
    # Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    # Profile
    Route::get('profil/{user}', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('profil/{user}', [ProfileController::class, 'update'])->name('profile.update');

    /*
    |--------------------------------------------------------
    | Postingan
    |--------------------------------------------------------
    */

    /*
    |--------------------------------------------------------
    | Kegiatan
    |--------------------------------------------------------
    */

    /*
    |--------------------------------------------------------
    | Pengguna
    |--------------------------------------------------------
    */

    /*
    |--------------------------------------------------------
    | Pengaturan
    |--------------------------------------------------------
    */

    # Setting
    Route::resource('setting', SettingController::class)->only(['edit', 'update']);
});
