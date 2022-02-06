<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('dashboard')->group(function () {
    # Beranda
    Route::get('/', [HomeController::class, 'index'])->name('home');

    # Profil
    Route::get('profile/{user}', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('profile/password/{user}', [ProfileController::class, 'password'])->name('profile.password');
    Route::get('profile-datatable', [ProfileController::class, 'datatable'])->name('profile.datatable');

    /*
    |--------------------------------------------------------
    | Postingan
    |--------------------------------------------------------
    */
    # Blog
    Route::resource('blog', BlogController::class);

    # Forum
    Route::resource('thread', ThreadController::class);

    # Komentar
    Route::resource('comment', CommentController::class);

    # Jurnal
    Route::resource('research', ResearchController::class);

    /*
    |--------------------------------------------------------
    | Kegiatan
    |--------------------------------------------------------
    */
    # Acara
    Route::resource('event', EventController::class);

    # Peserta
    Route::resource('participant', ParticipantController::class);

    # Perekrutan
    Route::resource('recruitment', RecruitmentController::class);

    /*
    |--------------------------------------------------------
    | Pengguna
    |--------------------------------------------------------
    */
    # Anggota
    Route::resource('member', MemberController::class);

    # Divisi
    Route::resource('division', DivisionController::class);
    Route::get('division-datatable', [DivisionController::class, 'datatable'])->name('division.datatable');
    Route::get('division/{division}/position', [DivisionController::class, 'position'])->name('division.position');

    # Posisi
    Route::resource('position', PositionController::class);
    Route::get('position-datatable', [PositionController::class, 'datatable'])->name('position.datatable');
    Route::get('position-select2-division', [PositionController::class, 'select2_division'])->name('position.select2-division');

    # Umum
    Route::resource('general', GeneralController::class);

    /*
    |--------------------------------------------------------
    | Pengaturan
    |--------------------------------------------------------
    */
    # Administrator
    Route::resource('administrator', AdministratorController::class);
    Route::get('administrator-datatable', [AdministratorController::class, 'datatable'])->name('administrator.datatable');

    # Aplikasi
    Route::resource('setting', SettingController::class)->only(['edit', 'update']);
});
