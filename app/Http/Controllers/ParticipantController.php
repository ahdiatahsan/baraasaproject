<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ParticipantController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:participant-view'])->only(['index', 'datatable']);
        $this->middleware(['permission:participant-create'])->only(['create', 'store']);
        $this->middleware(['permission:participant-update'])->only(['edit', 'update', 'certificate']);
        $this->middleware(['permission:participant-delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.participant.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.participant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate_request($request);
        $request->validate([
            'file' => 'required|file|max:3048|mimes:pdf'
        ]);

        $user = User::where('id', '=', $request->input('user_id'))->first();
        $event = Event::where('id', '=', $request->input('event_id'))->first();

        $slugName = Str::slug($user->name);
        $slugEvent = Str::slug($event->title);
        $docFile = $request->file('file');
        $docName = $slugEvent . '-' . $slugName . '.' . $docFile->getClientOriginalExtension();
        Storage::putFileAs('public/participant/file', $docFile, $docName);

        Participant::create([
            'event_id' => $request->input('event_id'),
            'user_id' => $request->input('user_id'),
            'reason' => $request->input('reason'),
            'email' => $request->input('email'),
            'file' => $docName,
            'data_status' => $request->input('data_status')
        ]);

        return redirect()->route('participant.create')->with('success', 'Peserta berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        return view('dashboard.participant.edit', compact('participant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        $this->validate_request($request);

        $user = User::where('id', '=', $request->input('user_id'))->first();
        $event = Event::where('id', '=', $request->input('event_id'))->first();

        $slugName = Str::slug($user->name);
        $slugEvent = Str::slug($event->title);

        if ($request->input('file') != null) {
            $request->validate([
                'file' => 'nullable|file|max:3048|mimes:pdf',
            ]);

            if (Storage::exists('public/participant/file/' . $participant->file)) {
                Storage::delete('public/participant/file/' . $participant->file);
            }

            $docFile = $request->file('file');
            $docName = $slugEvent . '-' . $slugName . '.' . $docFile->getClientOriginalExtension();
            Storage::putFileAs('public/participant/file', $docFile, $docName);

            $participant->file = $docName;
        }

        if ($request->input('certificate') != null) {
            $request->validate([
                'certificate' => 'nullable|file|max:3048|mimes:jpeg,jpg,png,webp'
            ]);

            if (Storage::exists('public/participant/certificate/' . $participant->certificate)) {
                Storage::delete('public/participant/certificate/' . $participant->certificate);
            }

            $cerFile = $request->file('certificate');
            $cerName = $slugEvent . '-' . $slugName . '.' . $cerFile->getClientOriginalExtension();
            Storage::putFileAs('public/participant/certificate', $cerFile, $cerName);

            $participant->certificate = $cerName;
        }

        $participant->event_id = $request->input('event_id');
        $participant->user_id = $request->input('user_id');
        $participant->reason = $request->input('reason');
        $participant->data_status = $request->input('data_status');
        $participant->save();

        return redirect()->route('participant.edit', $participant->id)->with('success', 'Peserta telah diubah.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function certificate(Request $request, Participant $participant)
    {
        $request->validate([
            'certificate' => 'required|file|max:3048|mimes:jpeg,jpg,png,webp'
        ]);

        if (Storage::exists('public/participant/certificate/' . $participant->certificate)) {
            Storage::delete('public/participant/certificate/' . $participant->certificate);
        }

        $slugname = Str::slug($request->input('name'));
        $slugtitle = Str::slug($request->input('title'));
        $cerFile = $request->file('certificate');
        $cerName = $slugname . '-' . $slugtitle . '.' . $cerFile->getClientOriginalExtension();
        Storage::putFileAs('public/participant/certificate', $cerFile, $cerName);

        $participant->certificate = $cerName;
        $participant->save();

        return redirect()->route('participant.index')->with('success', 'Sertifikat berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        Session::flash('success', 'Peserta ' . $participant->name . ' telah dihapus.');

        $participant->delete();
    }

    /**
     * Select2 Event
     */
    public function select2_event(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->input('q');

            $assets = Event::select('id', 'title')
                ->where('title', 'LIKE', '%' . $q . '%')
                ->get();

            return response()->json($assets, 200);
        }
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
            $participants = Participant::with('user', 'event')->get();

            return DataTables::of($participants)
                ->addColumn('action', function ($participant) {
                    return view('dashboard.participant.action', compact('participant'))->render();
                })
                ->rawColumns(['action'])
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
            'event_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'reason' => 'required|string',
            'data_status' => 'required|boolean'
        ]);
    }
}
