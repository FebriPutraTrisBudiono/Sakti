<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Ourservice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OurserviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.ourservices', [
            'title_bar' => 'Layanan Kami',
            'services'  => Ourservice::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.ourservicescreate', [
            'title_bar' => 'Layanan Baru'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required', 'min:4', 'max:255', 'unique:services'],
            'image'         => ['image', 'file', 'max:2048']
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('uploads');
        }
        $data['link'] = $request->link;
        $data['description'] = $request->description;
        Ourservice::create($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ourservice  $ourservice
     * @return \Illuminate\Http\Response
     */
    public function show(Ourservice $ourservice)
    {
        return response()->json($ourservice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ourservice  $ourservice
     * @return \Illuminate\Http\Response
     */
    public function edit(Ourservice $ourservice)
    {
        return view('dashboard.ourservicesedit', [
            'title_bar' => 'Perbarui Layanan',
            'service'   => $ourservice
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ourservice  $ourservice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ourservice $ourservice)
    {
        $data = $request->validate([
            'name'          => $request->name !== $ourservice->name ? ['required', 'min:4', 'max:255', 'unique:ourservices'] : ['required', 'min:4', 'max:255'],
            'image'         => ['image', 'file', 'max:2048']
        ]);
        if ($request->hasFile('image')) {
            if ($ourservice->image) {
                Storage::delete($ourservice->image);
            }
            $data['image'] = $request->image->store('uploads');
        }
        $data['link'] = $request->link;
        $data['description'] = $request->description;
        Ourservice::where('id', $ourservice->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ourservice  $ourservice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ourservice $ourservice)
    {
        Ourservice::destroy($ourservice->id);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}
