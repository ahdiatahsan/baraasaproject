<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:event-view'])->only(['index', 'show', 'display', 'datatable']);
        $this->middleware(['permission:event-create'])->only(['create', 'store', 'participant']);
        $this->middleware(['permission:event-update'])->only(['edit', 'update']);
        $this->middleware(['permission:event-delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate_request($request);
        $request->validate([
            'thumbnail' => 'required|file|max:3048|mimes:jpeg,jpg,png,webp'
        ]);

        if (strtotime($request->input('date_start')) > strtotime($request->input('date_end'))) {
            return redirect()->route('event.create')->with('warning', 'Waktu mulai tidak boleh lebih besar dari waktu selesai');
        }

        $slug = Str::slug($request->input('title') . '-' . time());
        $photoFile = $request->file('thumbnail');
        $photoName = $slug . '.' . $photoFile->getClientOriginalExtension();
        Storage::putFileAs('public/event', $photoFile, $photoName);

        Event::create([
            'title' => $request->input('title'),
            'slug' => $slug,
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'location' => $request->input('location'),
            'event_status' => $request->input('event_status'),
            'body' => $request->input('body'),
            'thumbnail' => $photoName
        ]);

        return redirect()->route('event.create')->with('success', 'Acara berhasil ditambahkan.');
    }

    /**
     * Direct to participant create with event id
     */
    public function participant($event)
    {
        $eventGet = Event::where('id', '=', $event)->first();

        return view('dashboard.event.participant', compact('eventGet'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, Request $request)
    {
        if ($request->ajax()) {
            $participants = Participant::with('user')->where('event_id', '=', $event->id)->get();

            return DataTables::of($participants)
                ->addColumn('status', function ($participant) {
                    return view('dashboard.participant.status', compact('participant'))->render();
                })
                ->addColumn('certificate', function ($participant) {
                    return view('dashboard.participant.certificate', compact('participant'))->render();
                })
                ->addColumn('action', function ($participant) {
                    return view('dashboard.event.action_show', compact('participant'))->render();
                })
                ->rawColumns(['status', 'certificate', 'action'])
                ->addIndexColumn()
                ->make(true);
        }

        // Tanggal Mulai //
        $date_start = Carbon::parse($event->date_start)->locale('id');
        $date_start->settings(['formatFunction' => 'translatedFormat']);

        // Tanggal Selesai //
        $date_end = Carbon::parse($event->date_end)->locale('id');
        $date_end->settings(['formatFunction' => 'translatedFormat']);

        $date_event = $date_start->format('l, j F Y') . ' - ' . $date_end->format('l, j F Y');

        return view('dashboard.event.show', compact('event', 'date_event'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function display(Event $event)
    {
        // Tanggal Mulai //
        $date_start = Carbon::parse($event->date_start)->locale('id');
        $date_start->settings(['formatFunction' => 'translatedFormat']);

        // Tanggal Selesai //
        $date_end = Carbon::parse($event->date_end)->locale('id');
        $date_end->settings(['formatFunction' => 'translatedFormat']);

        $date_event = $date_start->format('l, j F Y') . ' - ' . $date_end->format('l, j F Y');

        return view('dashboard.event.display', compact('event', 'date_event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('dashboard.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $this->validate_request($request);

        if (strtotime($request->input('date_start')) > strtotime($request->input('date_end'))) {
            return redirect()->route('event.edit', $event->id)->with('warning', 'Waktu mulai tidak boleh lebih besar dari waktu selesai');
        }

        $slug = Str::slug($request->input('title') . '-' . time());

        if ($request->file() != null) {
            $request->validate([
                'thumbnail' => 'nullable|file|max:3048|mimes:jpeg,jpg,png,webp'
            ]);

            if (Storage::exists('public/event/' . $event->thumbnail)) {
                Storage::delete('public/event/' . $event->thumbnail);
            }

            $photoFile = $request->file('thumbnail');
            $photoName = $slug . '.' . $photoFile->getClientOriginalExtension();
            Storage::putFileAs('public/event', $photoFile, $photoName);

            $event->thumbnail = $photoName;
        }

        $event->title = $request->input('title');
        $event->slug  = $slug;
        $event->body = $request->input('body');
        $event->date_start = $request->input('date_start');
        $event->date_end = $request->input('date_end');
        $event->location = $request->input('location');
        $event->event_status = $request->input('event_status');
        $event->save();

        return redirect()->route('event.edit', $event->id)->with('success', 'Acara telah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        Session::flash('success', 'Acara telah dihapus.');

        if (Storage::exists('public/event/' . $event->thumbnail)) {
            Storage::delete('public/event/' . $event->thumbnail);
        }

        $event->delete();
    }

    /**
     * Select2 User
     */
    public function select2_user(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->input('q');

            if (Auth::user()->hasRole('super_administrator')) {
                $assets = User::select('id', 'name')
                    ->where('name', 'LIKE', '%' . $q . '%')
                    ->role([
                        'super_administrator',
                        'administrator',
                        'member',
                        'general'
                    ])->get();
            } else {
                $assets = User::select('id', 'name')
                    ->where('name', 'LIKE', '%' . $q . '%')
                    ->role([
                        'administrator',
                        'member',
                        'general'
                    ])->get();
            }
            return response()->json($assets, 200);
        }
    }

    /**
     * Yajra datatable
     */
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $events = Event::all();

            return DataTables::of($events)
                ->addColumn('status', function ($event) {
                    return view('dashboard.event.status', compact('event'))->render();
                })
                ->addColumn('action', function ($event) {
                    return view('dashboard.event.action', compact('event'))->render();
                })
                ->rawColumns(['status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    /**
     * Validate request
     */
    public function validate_request($request)
    {
        $request->validate([
            'title' => 'required|string|max:300',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'location' => 'required|string|max:300',
            'event_status' => 'required|boolean',
            'body' => 'required|string'
        ]);
    }
}
