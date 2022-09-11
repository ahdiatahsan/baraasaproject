<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.recruitment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.recruitment.create');
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

        $slug = Str::slug($user->name);
        $docFile = $request->file('file');
        $docName = $slug . '.' . $docFile->getClientOriginalExtension();
        Storage::putFileAs('public/recruitment', $docFile, $docName);

        Recruitment::create([
            'user_id' => $request->input('user_id'),
            'file' => $docName,
            'document_status' => $request->input('document_status'),
            'interview_status' => $request->input('interview_status')
        ]);

        return redirect()->route('recruitment.create')->with('success', 'Pendaftar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function show(Recruitment $recruitment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function edit(Recruitment $recruitment)
    {
        return view('dashboard.recruitment.edit', compact('recruitment'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recruitment $recruitment)
    {
        $this->validate_request($request);

        $user = User::where('id', '=', $request->input('user_id'))->first();

        $slugName = Str::slug($user->name);

        if ($request->input('file') != null) {
            $request->validate([
                'file' => 'recruitment|file|max:3048|mimes:pdf',
            ]);

            if (Storage::exists('public/recruitment/' . $recruitment->file)) {
                Storage::delete('public/recruitment/' . $recruitment->file);
            }

            $docFile = $request->file('file');
            $docName = $slugName . '.' . $docFile->getClientOriginalExtension();
            Storage::putFileAs('public/recruitment', $docFile, $docName);

            $recruitment->file = $docName;
        }

        $recruitment->user_id = $request->input('user_id');
        $recruitment->document_status = $request->input('document_status');
        $recruitment->interview_status = $request->input('interview_status');
        $recruitment->save();

        return redirect()->route('recruitment.edit', $recruitment->id)->with('success', 'Pendaftar telah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recruitment $recruitment)
    {
        Session::flash('success', 'Pendaftar ' . $recruitment->name . ' telah dihapus.');

        $recruitment->delete();
    }

    /**
     * Yajra datatable
     */
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $recruitments = Recruitment::with('user')->get();

            return DataTables::of($recruitments)
                ->addColumn('document', function ($recruitment) {
                    return view('dashboard.recruitment.document', compact('recruitment'))->render();
                })
                ->addColumn('interview', function ($recruitment) {
                    return view('dashboard.recruitment.interview', compact('recruitment'))->render();
                })
                ->addColumn('action', function ($recruitment) {
                    return view('dashboard.recruitment.action', compact('recruitment'))->render();
                })
                ->rawColumns(['document', 'interview', 'action'])
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
                ->role(['general'])
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
            'user_id' => 'required|numeric',
            'document_status' => 'required|boolean',
            'interview_status' => 'required|boolean'
        ]);
    }
}
