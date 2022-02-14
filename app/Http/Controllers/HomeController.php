<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Thread;
use App\Models\Research;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $counter = [
            'blog' => Blog::select('id')->where('publication_status', '=', 1)->count(),
            'thread' => Thread::select('id')->where('publication_status', '=', 1)->count(),
            'research' =>  Research::select('id')->count(),
            'event' => Event::select('id')->count(),
            'user' => User::select('id')->count()
        ];

        $members = User::select('id')->role(['super_administrator','administrator','member'])->get();
        $generals = User::select('id')->role('general')->get();
        $userRoles = [
            'member' => $members->count(),
            'general' => $generals->count()
        ];

        $event = Event::orderBy('created_at', 'desc')->first();

        // Tanggal Mulai //
        $date_start = Carbon::parse($event->date_start)->locale('id');
        $date_start->settings(['formatFunction' => 'translatedFormat']);
        $date_end = Carbon::parse($event->date_end)->locale('id');
        $date_end->settings(['formatFunction' => 'translatedFormat']);
        $date_event = $date_start->format('j M Y') . ' - ' . $date_end->format('j M Y');

        return view('dashboard.home.index', compact(
            'counter',
            'userRoles',
            'event',
            'date_event'
        ));
    }
}
