<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super_administrator|administrator']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('dashboard.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'instagram' => 'required|string',
            'spotify' => 'required|string',
            'recruitment_status' => 'required|string',
        ]);

        if ($request->file() != null) {
            $request->validate([
                'recruitment_thumbnail' => 'required|file|max:2000|mimes:jpeg,jpg,png'
            ]);

            if (Storage::exists('public/setting/' . $setting->recruitment_thumbnail)) {
                Storage::delete('public/setting/' . $setting->recruitment_thumbnail);
            }

            $photoFile = $request->file('recruitment_thumbnail');
            $photoName = 'Thumbnail-Open-Recruitment' . '.' . $photoFile->getClientOriginalExtension();
            Storage::putFileAs('public/setting', $photoFile, $photoName);

            $setting->recruitment_thumbnail = $photoName;
        }

        $setting->email = $request->input('email');
        $setting->phone = $request->input('phone');
        $setting->address = $request->input('address');
        $setting->instagram = $request->input('instagram');
        $setting->spotify = $request->input('spotify');
        $setting->recruitment_status = $request->input('recruitment_status');
        $setting->save();

        return redirect()->route('setting.edit', '1')->with('success', 'Pengaturan telah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
