<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:position-view'])->only(['index', 'show', 'datatable']);
        $this->middleware(['permission:position-create'])->only(['create', 'store']);
        $this->middleware(['permission:position-update'])->only(['edit', 'update']);
        $this->middleware(['permission:position-delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.position.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.position.create');
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
            'division_id' => 'required|string',
            'name' => 'required|string|unique:positions,name',
        ]);

        Position::create([
            'division_id' => $request->input('division_id'),
            'name' => $request->input('name')
        ]);

        if (URL::previous() === URL::route('division.position', $request->input('division_id'))) {
            return redirect()->route('division.position', $request->input('division_id'))->with('success', 'Posisi ' . $request->input('name') . ' telah ditambahkan.');
        } else {
            return redirect()->route('position.create')->with('success', 'Posisi ' . $request->input('name') . ' berhasil ditambahkan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return view('dashboard.position.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $request->validate([
            'division_id' => 'required|string',
            'name' => 'required|string|unique:positions,name,' . $position->id,
        ]);

        $position->division_id = $request->input('division_id');
        $position->name = $request->input('name');
        $position->save();

        return redirect()->route('position.edit', $position->id)->with('success', 'Posisi telah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        Session::flash('success', 'Posisi ' . $position->name . ' telah dihapus.');

        $position->delete();
    }

    /**
     * Yajra datatable
     */
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $positions = Position::with('division')->get();

            return DataTables::of($positions)
                ->addColumn('action', function ($position) {
                    return view('dashboard.position.action', compact('position'))->render();
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

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
}
