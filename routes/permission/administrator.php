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
    Route::get('blog-datatable', [BlogController::class, 'datatable'])->name('blog.datatable');

    # Forum
    Route::resource('thread', ThreadController::class);
    Route::get('thread-datatable', [ThreadController::class, 'datatable'])->name('thread.datatable');
    Route::post('thread-comment', [ThreadController::class, 'comment'])->name('thread.comment');

    # Komentar
    Route::resource('comment', CommentController::class);

    # Jurnal
    Route::resource('research', ResearchController::class);
    Route::get('research-datatable', [ResearchController::class, 'datatable'])->name('research.datatable');

    /*
    |--------------------------------------------------------
    | Kegiatan
    |--------------------------------------------------------
    */
    # Acara
    Route::resource('event', EventController::class);
    Route::get('event-datatable', [EventController::class, 'datatable'])->name('event.datatable');
    Route::get('event/display/{event}', [EventController::class, 'display'])->name('event.display');
    Route::get('event/{event}/participant', [EventController::class, 'participant'])->name('event.participant');
    Route::get('event-select2-user', [EventController::class, 'select2_user'])->name('event.select2-user');

    # Peserta
    Route::resource('participant', ParticipantController::class);
    Route::get('participant-datatable', [ParticipantController::class, 'datatable'])->name('participant.datatable');
    Route::patch('participant/certificate/{participant}', [ParticipantController::class, 'certificate'])->name('participant.certificate');
    Route::get('participant-select2-event', [ParticipantController::class, 'select2_event'])->name('participant.select2-event');
    Route::get('participant-select2-user', [ParticipantController::class, 'select2_user'])->name('participant.select2-user');

    # Perekrutan
    Route::resource('recruitment', RecruitmentController::class);
    Route::get('recruitment-datatable', [RecruitmentController::class, 'datatable'])->name('recruitment.datatable');
    Route::get('recruitment-select2-user', [RecruitmentController::class, 'select2_user'])->name('recruitment.select2-user');

    /*
    |--------------------------------------------------------
    | Pengguna
    |--------------------------------------------------------
    */
    # Anggota
    Route::resource('member', MemberController::class);
    Route::get('member-datatable', [MemberController::class, 'datatable'])->name('member.datatable');
    Route::get('member/general/create', [MemberController::class, 'general'])->name('member.general');
    Route::patch('member/general/assign', [MemberController::class, 'generalAssign'])->name('member.general-assign');
    Route::get('member-select2-user', [MemberController::class, 'select2_user'])->name('member.select2-user');
    Route::get('member-select2-division', [MemberController::class, 'select2_division'])->name('member.select2-division');
    Route::get('member-select2-position', [MemberController::class, 'select2_position'])->name('member.select2-position');
    Route::get('get/general/{id}', [MemberController::class, 'getGeneral'])->name('member.get-general');

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
    Route::get('general-datatable', [GeneralController::class, 'datatable'])->name('general.datatable');

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
