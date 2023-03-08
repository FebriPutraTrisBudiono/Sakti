<?php

namespace App\Http\Controllers\BackEnd;

use App\Mail\Status;
use App\Models\User;
use App\Models\Level;
use App\Models\Client;
use App\Models\Setting;
use App\Mail\Statusvalidasi;
use App\Models\Kajianclient;
use Illuminate\Http\Request;
use App\Models\Listpermohonan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Logresertifikasi;
use App\Models\Perjanjianclient;
use App\Http\Controllers\Controller;
use App\Models\Logawalcertification;
use Illuminate\Support\Facades\Mail;
use App\Models\permohonansertifikasi;
use Illuminate\Support\Facades\Storage;

class PerjanjianclientController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id'             => 'required',
            'listpermohonan_id'     => 'required',
            'upload'                => 'max:2048',
        ]);
        if ($request->hasFile('upload')) {
            $data['upload'] = $request->upload->store('uploads');
        }

        // Save to database
        $data['status'] = 1;
        Perjanjianclient::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Perjanjian Sertifikasi',
            ];
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Perjanjian Sertifikasi',
            ];
            Logresertifikasi::create($log);
        }
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perjanjianclient  $perjanjianclient
     * @return \Illuminate\Http\Response
     */
    public function show(Perjanjianclient $perjanjianclient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perjanjianclient  $perjanjianclient
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client, $listpermohonan)
    {
        if ($client->user_id == auth()->user()->id || auth()->user()->level_id == 1 || auth()->user()->level_id == 3 || auth()->user()->level_id == 4) {
            $listpermohonan_id = Listpermohonan::where('id', $listpermohonan)->first();

            $bagian = Level::where('id', auth()->user()->level_id)->first();
            $roles = explode(',', $bagian['access']);

            if ($listpermohonan_id->slug == 'sertifikasi_awal' || $listpermohonan_id->slug == 'resertifikasi') {
                if ($listpermohonan_id->slug == 'sertifikasi_awal') {
                    if ($client->kajianclient_data($listpermohonan)->first() == '') {
                        return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                        if ($client->kajianclient_data($listpermohonan)->first()->status != '2') {
                            return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                        }
                    }
                } else {
                    if ($client->evaluasisatusiklussertifikasi_data($listpermohonan)->first() == '') {
                        return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                        if ($client->evaluasisatusiklussertifikasi_data($listpermohonan)->first()->status != '2') {
                            return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                        }
                    }
                }
            } else if ($listpermohonan_id->slug == 'surveilance1' || $listpermohonan_id->slug == 'surveilance2') {
                if ($client->kajianclient_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                    if ($client->kajianclient_data($listpermohonan)->first()->status != '2') {
                        return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                    }
                }
            }

            return view('dashboard.perjanjianclientsedit', [
                'title_bar'             => 'Perjanjian Sertifikasi',
                'client'                => $client,
                'listpermohonan_id'     => $listpermohonan_id,
                'listpermohonan_slug'   => $listpermohonan_id->slug,
                'kajianclient'          => $client->kajianclient_data($listpermohonan)->first(),
                'permohonansertifikasi' => $client->permohonansertifikasi_data($listpermohonan)->first(),
                'perjanjianclient'      => $client->perjanjianclient_data($listpermohonan)->first(),
                'roles'                 => $roles,
            ]);
        } else {
            return redirect()->back()->with('alert', 'Anda tidak memiliki akses');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perjanjianclient  $perjanjianclient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'client_id'             => 'required',
            'listpermohonan_id'     => 'required',
            'upload'                => 'max:2048',
        ]);
        if ($request->hasFile('upload')) {
            $data['upload'] = $request->upload->store('uploads');
        }

        Perjanjianclient::where('id', $client->perjanjianclient->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('DOC-CER-01 - Kontrak Sertifikasi.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $perjanjianclient = $client->perjanjianclient_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Perjanjianclient::where('id', $perjanjianclient->id)->update($data);

        // sent email client
        $log = 'Kontrak Sertifikasi';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $perjanjianclient->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Kontrak Sertifikasi';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $perjanjianclient->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($item->email)->send(new Statusvalidasi($admindata));
        }

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Status Berhasil Disimpan!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perjanjianclient  $perjanjianclient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perjanjianclient $perjanjianclient)
    {
        //
    }

    public function download(Kajianclient $kajianclient)
    {
        $setting = Setting::firstWhere('id', 1);

        $pdf = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.perjanjiansertifikasiDownload', [
                'title_bar'                 => 'Download',
                'kajianclient'              => $kajianclient,
                'setting'                   => $setting
            ]);
        return $pdf->stream();
    }
}
