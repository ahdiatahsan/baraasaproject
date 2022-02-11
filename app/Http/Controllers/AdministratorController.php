<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super_administrator']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $administrators = User::with('division', 'position')
                ->role(['member'])->get();

            return DataTables::of($administrators)
                ->addColumn('role', function ($administrator) {
                    return view('dashboard.user.role', compact('administrator'))->render();
                })
                ->addColumn('action', function ($administrator) {
                    return view('dashboard.user.action_create', compact('administrator'))->render();
                })
                ->rawColumns(['role', 'action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $administrator
     * @return \Illuminate\Http\Response
     */
    public function show(User $administrator, Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $administrator
     * @return \Illuminate\Http\Response
     */
    public function edit(User $administrator)
    {
        return view('dashboard.user.edit', compact('administrator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $administrator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $administrator)
    {
        $request->validate([
            'role' => 'required|in:super_administrator,administrator,member'
        ]);

        if ($request->input('role') == 'super_administrator') {
            $superadmin = User::with('division', 'position')->role(['super_administrator'])->get();
            $limit = $superadmin->count();
            if ($limit >= 5) {
                return redirect()->route('administrator.index')->with('warning', 'Jumlah super administrator tidak dapat melebihi batas (5).');
            } else {
                $administrator->syncRoles($request->input('role'));
                return redirect()->route('administrator.index')->with('success', 'Hak akses ' . $request->input('name') . ' telah diubah.');
            }
        } else {
            $administrator->syncRoles($request->input('role'));
            return redirect()->route('administrator.index')->with('success', 'Hak akses ' . $request->input('name') . ' telah diubah.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $administrator
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $administrator)
    {
        //
    }

    /**
     * Yajra datatable
     */
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $administrators = User::with('division', 'position')
                ->role([
                    'super_administrator',
                    'administrator'
                ])->get();

            return DataTables::of($administrators)
                ->addColumn('role', function ($administrator) {
                    return view('dashboard.user.role', compact('administrator'))->render();
                })
                ->addColumn('action', function ($administrator) {
                    return view('dashboard.user.action', compact('administrator'))->render();
                })
                ->rawColumns(['role', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
    }
}
