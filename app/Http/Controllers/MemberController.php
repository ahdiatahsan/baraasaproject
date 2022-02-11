<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Division;
use App\Models\Participant;
use App\Models\Position;
use App\Models\Thread;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:member-view'])->only(['index', 'show', 'datatable']);
        $this->middleware(['permission:member-create'])->only(['create', 'store', 'general', 'getGeneral', 'generalAssign']);
        $this->middleware(['permission:member-update'])->only(['edit', 'update']);
        $this->middleware(['permission:member-delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.member.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.member.create');
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
            'role' => 'required|in:administrator,member',
            'photo' => 'required|file|max:2048|mimes:jpeg,jpg,png,webp'
        ]);

        $slug = Str::slug($request->input('name'));
        $rand = random_int(1, 100);
        $photoFile = $request->file('photo');
        $photoName = $slug . '-' . $rand . '.' . $photoFile->getClientOriginalExtension();
        Storage::putFileAs('public/user', $photoFile, $photoName);

        $member = User::create([
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'birthplace' => $request->input('birthplace'),
            'date_of_birth' => $request->input('date_of_birth'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'division_id' => $request->input('division_id'),
            'position_id' => $request->input('position_id'),
            'photo' => $photoName
        ]);

        $member->assignRole($request->input('role'));

        return redirect()->route('member.create')->with('success', 'Anggota ' . $request->input('name') . ' berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $member
     * @return \Illuminate\Http\Response
     */
    public function show(User $member, Request $request)
    {
        // Counter //
        $counter = [
            'blog' => Blog::select('id')->where('user_id', '=', $member->id)->count(),
            'thread' => Thread::select('id')->where('user_id', '=', $member->id)->count(),
            'comment' =>  Comment::select('id')->where('user_id', '=', $member->id)->count(),
            'participant' => Participant::select('id')->where('user_id', '=', $member->id)->count()
        ];

        // Tanggal Lahir //
        $date_of_birth = Carbon::parse($member->date_of_birth)->locale('id');
        $date_of_birth->settings(['formatFunction' => 'translatedFormat']);
        $date_of_birth->format('j F Y');

        return view('dashboard.member.show', compact('member', 'counter', 'date_of_birth'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(User $member)
    {
        // Tanggal Lahir //
        $date_of_birth = Carbon::parse($member->date_of_birth)->locale('id');
        $date_of_birth->settings(['formatFunction' => 'translatedFormat']);
        $date_of_birth->format('j F Y');

        if (Auth::user()->hasRole('administrator')) {
            if ($member->hasAnyRole('super_administrator|administrator')) {
                return redirect()->route('member.index')->with('warning', 'Anda tidak memiliki akses untuk mengubah anggota tersebut.');
            } else {
                return view('dashboard.member.edit', compact('member', 'date_of_birth'));
            }
        }

        if ($member->hasRole('super_administrator')) {
            return redirect()->route('member.index')->with('warning', 'Tidak dapat mengubah anggota dengan hak akses super administrator');
        } else {
            return view('dashboard.member.edit', compact('member', 'date_of_birth'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $member)
    {
        $this->validate_request($request);
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $member->id,
            'password' => 'nullable|string|min:8|max:255',
            'password_confirm' => 'same:password',
            'role' => 'required|in:administrator,member,general',
        ]);

        if ($request->file() != null) {
            $request->validate([
                'photo' => 'required|file|max:2048|mimes:jpeg,jpg,png,webp'
            ]);

            if (Storage::exists('public/user/' . $member->photo)) {
                Storage::delete('public/user/' . $member->photo);
            }

            $slug = Str::slug($request->input('name'));
            $rand = random_int(1, 100);
            $photoFile = $request->file('photo');
            $photoName = $slug . '-' . $rand . '.' . $photoFile->getClientOriginalExtension();
            Storage::putFileAs('public/user', $photoFile, $photoName);

            $member->photo = $photoName;
        }

        if ($request->filled('password')) {
            $member->password = Hash::make($request->input('password'));
        }

        if ($request->input('role') == 'general') {
            $member->division_id = null;
            $member->position_id = null;
        } else {
            $member->division_id = $request->input('division_id');
            $member->position_id = $request->input('position_id');
        }

        $member->name = $request->input('name');
        $member->gender = $request->input('gender');
        $member->birthplace = $request->input('birthplace');
        $member->date_of_birth = $request->input('date_of_birth');
        $member->address = $request->input('address');
        $member->phone_number = $request->input('phone_number');
        $member->email = $request->input('email');
        $member->save();

        $member->syncRoles($request->input('role'));

        if ($request->input('role') == 'general') {
            return redirect()->route('member.index')->with('warning', $request->input('name') . ' dihapus dari anggota.');
        } else {
            return redirect()->route('member.edit', $member->id)->with('success', 'Informasi anggota telah diubah.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function general()
    {
        return view('dashboard.member.general');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generalAssign(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'division_id' => 'required|numeric',
            'position_id' => 'required|numeric',
            'role' => 'required|in:administrator,member'
        ]);

        $member = User::where('id', '=', $request->input('user_id'))->first();

        $member->division_id = $request->input('division_id');
        $member->position_id = $request->input('position_id');
        $member->save();

        $member->syncRoles($request->input('role'));

        return redirect()->route('member.general')->with('success', $member->name . ' berhasil ditambahkan menjadi anggota.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $member)
    {
        if ($member->hasanyrole('administrator|member')) {
            Session::flash('success', 'Pengguna ' . $member->name . ' telah dihapus.');

            if (Storage::exists('public/user/' . $member->photo)) {
                Storage::delete('public/user/' . $member->photo);
            }

            $member->delete();
        } else {
            Session::flash('warning', 'Gagal menghapus pengguna ' . $member->name . ' (super administrator).');
        }
    }

    /**
     * Yajra datatable
     */
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $members = User::with('division', 'position')
                ->role([
                    'super_administrator',
                    'administrator',
                    'member'
                ])->get();

            return DataTables::of($members)
                ->addColumn('role', function ($member) {
                    return view('dashboard.member.role', compact('member'))->render();
                })
                ->addColumn('action', function ($member) {
                    return view('dashboard.member.action', compact('member'))->render();
                })
                ->rawColumns(['role', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    /**
     * Select2 User
     */
    public function select2_user(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->input('q');

            $assets = User::select('id', 'name')
                ->where('name', 'LIKE', '%' . $q . '%')
                ->role([
                    'general'
                ])->get();

            return response()->json($assets, 200);
        }
    }

    /**
     * Get User From Select2 (In Add Using General Data)
     */
    public function getGeneral($id = 0)
    {
        $general = User::where('id', $id)->first();

        // Jenis Kelamin //
        if ($general->gender == 'L') {
            $gender = 'Laki-Laki';
        } else {
            $gender = 'Perempuan';
        }

        // Tanggal Lahir //
        $date = Carbon::parse($general->date_of_birth);
        $date->settings(['formatFunction' => 'translatedFormat']);
        $date_of_birth =  Carbon::createFromFormat('Y-m-d H:i:s', $date)->locale('id')->isoFormat('LL');

        $data = [
            'gender' => $gender,
            'birthplace' => $general->birthplace,
            'date_of_birth' =>  $date_of_birth,
            'address' => $general->address,
            'phone_number' => $general->phone_number,
            'email' => $general->email
        ];

        return response()->json($data);
    }

    /**
     * Select2 Division
     */
    public function select2_division(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->input('q');

            $assets = Division::select('id', 'name')
                ->where('name', 'LIKE', '%' . $q . '%')
                ->get();

            return response()->json($assets, 200);
        }
    }

    /**
     * Select2 Position
     */
    public function select2_position(Request $request)
    {
        $divisionID = $request->divisionID;
        if ($request->ajax()) {
            $q = $request->input('q');

            $assets = Position::select('id', 'name')
                ->where('division_id', '=', $divisionID)
                ->where('name', 'LIKE', '%' . $q . '%')
                ->get();

            return response()->json($assets, 200);
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
            'phone_number' => 'required|string|max:255',
            'division_id' => 'required|numeric',
            'position_id' => 'required|numeric'
        ]);
    }
}
