<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Participant;
use App\Models\Thread;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:profile-view'])->only(['index', 'datatable']);
        $this->middleware(['permission:profile-update'])->only(['update', 'password']);
    }

    public function index(User $user)
    {
        // Check Active User //
        $activeUser = Auth::user();
        if ($user->id != $activeUser->id) {
            return redirect()->route('profile.index', $activeUser->id);
        }

        // Counter //
        $counter = [
            'blog' => Blog::select('id')->where('user_id', '=', $user->id)->count(),
            'thread' => Thread::select('id')->where('user_id', '=', $user->id)->count(),
            'comment' =>  Comment::select('id')->where('user_id', '=', $user->id)->count(),
            'participant' => Participant::select('id')->where('user_id', '=', $user->id)->count()
        ];

        // Tanggal Lahir //
        $date_of_birth = Carbon::parse($user->date_of_birth)->locale('id');
        $date_of_birth->settings(['formatFunction' => 'translatedFormat']);
        $date_of_birth->format('j F Y');

        return view('dashboard.profile.index', compact('user', 'counter', 'date_of_birth'));
    }

    /**
     * Update User Profile.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birthplace' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id
        ]);

        if ($request->file() != null) {
            $request->validate([
                'photo' => 'required|file|max:2048|mimes:jpeg,jpg,png,webp'
            ]);

            if (Storage::exists('public/user/' . $user->photo)) {
                Storage::delete('public/user/' . $user->photo);
            }

            $photoFile = $request->file('photo');
            $photoName = $request->name . '.' . $photoFile->getClientOriginalExtension();
            Storage::putFileAs('public/user', $photoFile, $photoName);

            $user->photo = $photoName;
        }

        $user->name = $request->input('name');
        $user->gender = $request->input('gender');
        $user->birthplace = $request->input('birthplace');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->address = $request->input('address');
        $user->phone_number = $request->input('phone_number');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('profile.index', $user->id)->with('success', 'Informasi akun telah diubah.');
    }

    /**
     * Update User Password.
     */
    public function password(Request $request, User $user)
    {
        $request->validate([
            'password' => ['nullable', 'string', 'min:8', 'max:255'],
            'password_confirm' => ['same:password'],
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('profile.index', $user->id)->with('success', 'Password berhasil diubah.');
    }

    /**
     * Yajra datatable
     */
    public function datatable(Request $request)
    {
        $user_id = Auth::User()->id;

        if ($request->ajax()) {
            $participants = Participant::with('event')->where([
                ['user_id', '=', $user_id],
                ['certificate', '!=', NULL]
            ])->get();

            return DataTables::of($participants)
            ->addColumn('action', function ($participant) {
                return view('dashboard.profile.action', compact('participant'))->render();
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
    }
}
