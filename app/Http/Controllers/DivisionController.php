<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class DivisionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:division-view'])->only(['index', 'show', 'datatable']);
        $this->middleware(['permission:division-create'])->only(['create', 'store', 'position']);
        $this->middleware(['permission:division-update'])->only(['edit', 'update']);
        $this->middleware(['permission:division-delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.division.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.division.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:divisions,name',
        ]);

        Division::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('division.create')->with('success', 'Divisi ' . $request->input('name') . ' berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division, Request $request)
    {
        if ($request->ajax()) {
            $positions = Position::where('division_id', '=', $division->id)->get();

            return DataTables::of($positions)
                ->addColumn('action', function ($position) {
                    return view('dashboard.division.action_show', compact('position'))->render();
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('dashboard.division.show', compact('division'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(Division $division)
    {
        return view('dashboard.division.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Division $division)
    {
        $request->validate([
            'name' => 'required|string|unique:divisions,name,' . $division->id,
        ]);

        $division->name = $request->input('name');
        $division->save();

        return redirect()->route('division.edit', $division->id)->with('success', 'Divisi telah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Division $division)
    {
        Session::flash('success', 'Divisi ' . $division->name . ' telah dihapus.');

        $division->delete();
    }

    /**
     * Direct to position create with division id
     */
    public function position($division)
    {
        $divisionGet = Division::where('id', '=', $division)->first();

        return view('dashboard.division.position', compact('divisionGet'));
    }

    /**
     * Yajra datatable
     */
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $divisions = Division::all();

            return DataTables::of($divisions)
                ->addColumn('action', function ($division) {
                    return view('dashboard.division.action', compact('division'))->render();
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }
}
