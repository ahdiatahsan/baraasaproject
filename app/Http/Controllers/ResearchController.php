<?php

namespace App\Http\Controllers;

use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class ResearchController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:research-view'])->only(['index', 'datatable']);
        $this->middleware(['permission:research-create'])->only(['create', 'store']);
        $this->middleware(['permission:research-update'])->only(['edit', 'update']);
        $this->middleware(['permission:research-delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.research.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.research.create');
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
            'file' => 'required|file|max:3048|mimes:pdf'
        ]);

        $slug = Str::slug($request->input('title'));
        $docFile = $request->file('file');
        $docName = $slug . '.' . $docFile->getClientOriginalExtension();
        Storage::putFileAs('public/research', $docFile, $docName);

        Research::create([
            'title' => $request->input('title'),
            'date_of_publish' => $request->input('date_of_publish'),
            'file' => $docName
        ]);

        return redirect()->route('research.create')->with('success', 'Jurnal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function show(Research $research)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function edit(Research $research)
    {
        return view('dashboard.research.edit', compact('research'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Research  $research)
    {
        $this->validate_request($request);

        if ($request->file() != null) {
            $request->validate([
                'file' => 'required|file|max:3048|mimes:pdf'
            ]);

            if (Storage::exists('public/research/' . $research->file)) {
                Storage::delete('public/research/' . $research->file);
            }

            $slug = Str::slug($request->input('title'));
            $docFile = $request->file('file');
            $docName = $slug . '.' . $docFile->getClientOriginalExtension();
            Storage::putFileAs('public/research', $docFile, $docName);

            $research->file = $docName;
        }

        $research->title = $request->input('title');
        $research->date_of_publish = $request->input('date_of_publish');
        $research->save();

        return redirect()->route('research.edit', $research->id)->with('success', 'Jurnal telah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function destroy(Research $research)
    {
        Session::flash('success', 'Jurnal ' . $research->title . ' telah dihapus.');

        if (Storage::exists('public/research/' . $research->file)) {
            Storage::delete('public/research/' . $research->file);
        }

        $research->delete();
    }


    /**
     * Yajra datatable
     */
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $researches = Research::all();

            return DataTables::of($researches)
                ->addColumn('action', function ($research) {
                    return view('dashboard.research.action', compact('research'))->render();
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
            'title' => 'required|string|max:255',
            'date_of_publish' => 'required|date'
        ]);
    }
}
