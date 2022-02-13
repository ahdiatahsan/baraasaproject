<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:blog-view'])->only(['index', 'show', 'datatable']);
        $this->middleware(['permission:blog-create'])->only(['create', 'store']);
        $this->middleware(['permission:blog-update'])->only(['edit', 'update']);
        $this->middleware(['permission:blog-delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.blog.create');
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

        $slug = Str::slug($request->input('title') . '-' . time());
        $photoFile = $request->file('thumbnail');
        $photoName = $slug . '.' . $photoFile->getClientOriginalExtension();
        Storage::putFileAs('public/blog', $photoFile, $photoName);

        Blog::create([
            'title' => $request->input('title'),
            'slug' => $slug,
            'publication_status' => $request->input('publication_status'),
            'body' => $request->input('body'),
            'user_id' => Auth::user()->id,
            'thumbnail' => $photoName
        ]);

        return redirect()->route('blog.create')->with('success', 'Blog berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        // Tanggal Posting //
        $date_blog = Carbon::parse($blog->created_at)->locale('id');
        $date_blog->settings(['formatFunction' => 'translatedFormat']);
        $date_posted = $date_blog->format('l, j F Y');

        return view('dashboard.blog.show', compact('blog', 'date_posted'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('dashboard.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->validate_request($request);

        $slug = Str::slug($request->input('title') . '-' . time());

        if ($request->file() != null) {
            $request->validate([
                'thumbnail' => 'nullable|file|max:3048|mimes:jpeg,jpg,png,webp'
            ]);

            if (Storage::exists('public/blog/' . $blog->thumbnail)) {
                Storage::delete('public/blog/' . $blog->thumbnail);
            }

            $photoFile = $request->file('thumbnail');
            $photoName = $slug . '.' . $photoFile->getClientOriginalExtension();
            Storage::putFileAs('public/blog', $photoFile, $photoName);

            $blog->thumbnail = $photoName;
        }

        $blog->title = $request->input('title');
        $blog->slug  = $slug;
        $blog->body = $request->input('body');
        $blog->publication_status = $request->input('publication_status');
        $blog->save();

        return redirect()->route('blog.edit', $blog->id)->with('success', 'Blog telah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        Session::flash('success', 'Blog telah dihapus.');

        if (Storage::exists('public/blog/' . $blog->thumbnail)) {
            Storage::delete('public/blog/' . $blog->thumbnail);
        }

        $blog->delete();
    }

    /**
     * Yajra datatable
     */
    public function datatable(Request $request)
    {
        if (Auth::user()->hasAnyRole('super_administrator|administrator|member')) {
            if ($request->ajax()) {
                $blogs = Blog::all();
    
                return DataTables::of($blogs)
                    ->addColumn('status', function ($blog) {
                        return view('dashboard.blog.status', compact('blog'))->render();
                    })
                    ->addColumn('action', function ($blog) {
                        return view('dashboard.blog.action', compact('blog'))->render();
                    })
                    ->rawColumns(['status', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            }
        } else {
            if ($request->ajax()) {
                $blogs = Blog::with('user')
                ->where('user_id', '=', Auth::user()->id)
                ->get();
    
                return DataTables::of($blogs)
                    ->addColumn('status', function ($blog) {
                        return view('dashboard.blog.status', compact('blog'))->render();
                    })
                    ->addColumn('action', function ($blog) {
                        return view('dashboard.blog.action', compact('blog'))->render();
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
            'publication_status' => 'required|boolean',
            'body' => 'required|string'
        ]);
    }
}
