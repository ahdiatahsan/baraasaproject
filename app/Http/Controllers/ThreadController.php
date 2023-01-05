<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Thread;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:thread-view'])->only(['index', 'show', 'datatable']);
        $this->middleware(['permission:thread-create'])->only(['create', 'store', 'comment']);
        $this->middleware(['permission:thread-update'])->only(['edit', 'update']);
        $this->middleware(['permission:thread-delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.thread.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.thread.create');
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

        Thread::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title') . '-' . time()),
            'body' => $request->input('body'),
            'publication_status' => $request->input('publication_status'),
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('thread.create')->with('success', 'Forum berhasil ditambah.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request)
    {
        $request->validate([
            'thread_id' => 'required|numeric',
            'body' => 'required|string',
        ]);

        Comment::create([
            'thread_id' => $request->input('thread_id'),
            'body' => $request->input('body'),
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('thread.show', $request->input('thread_id'))->with('success', 'Komentar berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        $comments = Comment::with('user')->where('thread_id', '=', $thread->id)->orderBy('created_at', 'desc')->paginate(5);
        $totalComments = Comment::with('user')->where('thread_id', '=', $thread->id)->count();

        // Tanggal Forum//
        $date_post = Carbon::parse($thread->created_at)->locale('id');
        $date_post->settings(['formatFunction' => 'translatedFormat']);
        $date_posted = $date_post->format('l, j F Y');

        return view('dashboard.thread.show', compact('thread', 'comments', 'totalComments', 'date_posted'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        return view('dashboard.thread.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        $this->validate_request($request);

        $thread->title = $request->input('title');
        $thread->slug = Str::slug($request->input('title') . '-' . time());
        $thread->body = $request->input('body');
        $thread->publication_status = $request->input('publication_status');
        $thread->user_id = Auth::user()->id;
        $thread->save();

        return redirect()->route('thread.edit', $thread->id)->with('success', 'Forum telah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        Session::flash('success', 'Forum telah dihapus.');

        $thread->delete();
    }

    /**
     * Yajra datatable
     */
    public function datatable(Request $request)
    {
        if (Auth::user()->hasAnyRole('super_administrator|administrator|member')) {
            if ($request->ajax()) {
                $threads = Thread::all();

                return DataTables::of($threads)
                    ->addColumn('status', function ($thread) {
                        return view('dashboard.thread.status', compact('thread'))->render();
                    })
                    ->addColumn('action', function ($thread) {
                        return view('dashboard.thread.action', compact('thread'))->render();
                    })
                    ->rawColumns(['status', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            }
        } else {
            if ($request->ajax()) {
                $threads = Thread::with('user')
                ->where('user_id', '=', Auth::user()->id)
                ->get();

                return DataTables::of($threads)
                    ->addColumn('status', function ($thread) {
                        return view('dashboard.thread.status', compact('thread'))->render();
                    })
                    ->addColumn('action', function ($thread) {
                        return view('dashboard.thread.action', compact('thread'))->render();
                    })
                    ->rawColumns(['status', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            }
        }
    }

    /**
     * Validate request
     */
    public function validate_request($request)
    {
        $request->validate([
            'title' => 'required|string|max:300',
            'body' => 'required|string',
            'publication_status' => 'required|boolean'
        ]);
    }
}
