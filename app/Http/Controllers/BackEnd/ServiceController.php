<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Level;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
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

        return view('dashboard.services', [
            'title_bar' => 'Data Layanan',
            'services'  => Service::withCount('clients')->latest()->paginate(100),
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
        $data = $request->validate([
            'name' => ['required', 'unique:services', 'min:4', 'max:255'],
            'service_code' => ['required'],
        ]);
        $data['iso_code'] = $request->iso_code;
        $data['user_id'] = auth()->user()->id;
        Service::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return response()->json($service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name'          => $request->name !== $service->name ? ['required', 'min:3', 'max:255', 'unique:services'] : ['required', 'min:3', 'max:255'],
            'service_code'  => 'required|min:3|max:4',
        ]);
        $data['iso_code'] = $request->iso_code;
        $data['user_id'] = auth()->user()->id;
        $coba = $service->clients;

        foreach ($coba as $item) {
            $idclient['idclient'] = $request->service_code . '-' . $item->nomor_client;
            Client::where('id', $item->id)->update($idclient);
        }

        Service::where('id', $service->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        Service::destroy($service->id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
    }
}
