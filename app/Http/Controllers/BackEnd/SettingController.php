<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        $setting = Setting::firstWhere('id', 1);
        return view('dashboard.settings', [
            'title_bar' => 'Pengaturan',
            'setting'   => $setting,
            'roles'     => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        return response()->json($setting);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $rules = [
            'name'      => ['required', 'min:4', 'max:255'],
            'main_logo' => ['image', 'file', 'max:2048'],
            'doc_logo' => ['image', 'file', 'max:2048'],
            'sec_logo'  => ['image', 'file', 'max:2048'],
            'favicon'   => ['image', 'file', 'max:2048']
        ];
        if ($request->email) {
            $rules['email'] = ['email:dns'];
        }
        $data = $request->validate($rules);

        $data['description'] = $request->description;
        $data['address'] = $request->address;
        $data['telp'] = $request->telp;
        $data['facebook'] = $request->facebook;
        $data['twitter'] = $request->twitter;
        $data['instagram'] = $request->instagram;
        $data['whatsapp'] = $request->whatsapp;
        $data['telegram'] = $request->telegram;
        $data['youtube'] = $request->youtube;
        $data['map'] = $request->map;
        $data['latitude'] = $request->latitude;
        $data['longitude'] = $request->longitude;
        $data['code'] = $request->code;

        if ($request->hasFile('uploadberkas')) {
            if ($request->uploadberkas) {
                Storage::delete($request->uploadberkas);
            }
            $data['uploadberkas'] = $request->uploadberkas->store('uploads');
        }

        if ($request->hasFile('main_logo')) {
            if ($setting->main_logo) {
                Storage::delete($setting->main_logo);
            }
            $data['main_logo'] = $request->main_logo->store('uploads');
        }
        if ($request->hasFile('doc_logo')) {
            if ($setting->doc_logo) {
                Storage::delete($setting->doc_logo);
            }
            $data['doc_logo'] = $request->doc_logo->store('uploads');
        }
        if ($request->hasFile('sec_logo')) {
            if ($setting->sec_logo) {
                Storage::delete($setting->sec_logo);
            }
            $data['sec_logo'] = $request->sec_logo->store('uploads');
        }
        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Storage::delete($setting->favicon);
            }
            $data['favicon'] = $request->favicon->store('uploads');
        }

        Setting::where('id', $setting->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        abort(403);
    }
}
