<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Participant;
use App\Models\Thread;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class GeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:general-view'])->only(['index', 'show', 'datatable']);
        $this->middleware(['permission:general-create'])->only(['create', 'store']);
        $this->middleware(['permission:general-update'])->only(['edit', 'update']);
        $this->middleware(['permission:general-delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.general.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.general.create');
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:255',
            'password_confirm' => 'same:password',
            'photo' => 'required|file|max:2048|mimes:jpeg,jpg,png,webp'
        ]);

        $slug = Str::slug($request->input('name'));
        $rand = random_int(1, 100);
        $photoFile = $request->file('photo');
        $photoName = $slug . '-' . $rand . '.' . $photoFile->getClientOriginalExtension();
        Storage::putFileAs('public/user', $photoFile, $photoName);

        $general = User::create([
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'birthplace' => $request->input('birthplace'),
            'date_of_birth' => $request->input('date_of_birth'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'photo' => $photoName
        ]);

        $general->assignRole('general');

        return redirect()->route('general.create')->with('success', 'Pengguna ' . $request->input('name') . ' berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $general
     * @return \Illuminate\Http\Response
     */
    public function show(User $general, Request $request)
    {
        // Counter //
        $counter = [
            'blog' => Blog::select('id')->where('user_id', '=', $general->id)->count(),
            'thread' => Thread::select('id')->where('user_id', '=', $general->id)->count(),
            'comment' =>  Comment::select('id')->where('user_id', '=', $general->id)->count(),
            'participant' => Participant::select('id')->where('user_id', '=', $general->id)->count()
        ];

        // Tanggal Lahir //
        $date_of_birth = Carbon::parse($general->date_of_birth)->locale('id');
        $date_of_birth->settings(['formatFunction' => 'translatedFormat']);
        $date_of_birth->format('j F Y');

        return view('dashboard.general.show', compact('general', 'counter', 'date_of_birth'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $general
     * @return \Illuminate\Http\Response
     */
    public function edit(User $general)
    {
        // Tanggal Lahir //
        $date_of_birth = Carbon::parse($general->date_of_birth)->locale('id');
        $date_of_birth->settings(['formatFunction' => 'translatedFormat']);
        $date_of_birth->format('j F Y');

        return view('dashboard.general.edit', compact('general', 'date_of_birth'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $general
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $general)
    {
        $this->validate_request($request);
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $general->id,
            'password' => 'nullable|string|min:8|max:255',
            'password_confirm' => 'same:password',
        ]);

        if ($request->file() != null) {
            $request->validate([
                'photo' => 'required|file|max:2048|mimes:jpeg,jpg,png,webp'
            ]);

            if (Storage::exists('public/user/' . $general->photo)) {
                Storage::delete('public/user/' . $general->photo);
            }

            $slug = Str::slug($request->input('name'));
            $rand = random_int(1, 100);
            $photoFile = $request->file('photo');
            $photoName = $slug . '-' . $rand . '.' . $photoFile->getClientOriginalExtension();
            Storage::putFileAs('public/user', $photoFile, $photoName);

            $general->photo = $photoName;
        }

        if ($request->filled('password')) {
            $general->password = Hash::make($request->input('password'));
        }

        $general->name = $request->input('name');
        $general->gender = $request->input('gender');
        $general->birthplace = $request->input('birthplace');
        $general->date_of_birth = $request->input('date_of_birth');
        $general->address = $request->input('address');
        $general->phone_number = $request->input('phone_number');
        $general->email = $request->input('email');
        $general->save();

        return redirect()->route('general.edit', $general->id)->with('success', 'Informasi pengguna telah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $general
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $general)
    {
        Session::flash('success', 'Pengguna ' . $general->name . ' telah dihapus.');

        if (Storage::exists('public/user/' . $general->photo)) {
            Storage::delete('public/user/' . $general->photo);
        }

        $general->delete();
    }

    /**
     * Yajra datatable
     */
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $generals = User::select(
                'id',
                'name',
                'email'
            )->role(['general'])->get();

            return DataTables::of($generals)
                ->addColumn('action', function ($general) {
                    return view('dashboard.general.action', compact('general'))->render();
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
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birthplace' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255'
        ]);
    }
}
