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
use App\Models\Rencanaclient;
use App\Models\Listpermohonan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Logresertifikasi;
use App\Models\Perjanjianclient;
use App\Http\Controllers\Controller;
use App\Models\Logawalcertification;
use Illuminate\Support\Facades\Mail;
use App\Models\permohonansertifikasi;

class RencanaclientController extends Controller
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
        $klausul = array($request->klausul_audit1_4, $request->klausul_audit1_5, $request->klausul_audit1_6, $request->klausul_audit1_7, $request->klausul_audit1_8, $request->klausul_audit1_9, $request->klausul_audit1_10, $request->klausul_audit2_4, $request->klausul_audit2_5, $request->klausul_audit2_6, $request->klausul_audit2_7, $request->klausul_audit2_8, $request->klausul_audit2_9, $request->klausul_audit2_10, $request->klausul_survailen1_4, $request->klausul_survailen1_5, $request->klausul_survailen1_6, $request->klausul_survailen1_7, $request->klausul_survailen1_8, $request->klausul_survailen1_9, $request->klausul_survailen1_10, $request->klausul_survailen2_4, $request->klausul_survailen2_5, $request->klausul_survailen2_6, $request->klausul_survailen2_7, $request->klausul_survailen2_8, $request->klausul_survailen2_9, $request->klausul_survailen2_10, $request->klausul_resertifikasi_4, $request->klausul_resertifikasi_5, $request->klausul_resertifikasi_6, $request->klausul_resertifikasi_7, $request->klausul_resertifikasi_8, $request->klausul_resertifikasi_9, $request->klausul_resertifikasi_10);
        $arrklausul = implode(',', $klausul);

        $data = $request->validate([
            'client_id'                         => 'required',
            'listpermohonan_id'                 => 'required',
            'standart'                          => 'required',
            'rencana1'                          => 'required',
            'rencana2'                          => 'required',
            'rencana3'                          => 'required',
            'rencana4'                          => 'required',
            'rencana5'                          => 'required',
        ]);
        $data['klausul'] = $arrklausul;
        $data['tempat_ttd'] = $request->tempat_ttd;
        $data['tgl_ttd'] = $request->tgl_ttd;
        $data['nama_ttd'] = $request->nama_ttd;

        // Save to database
        $data['status'] = 1;
        Rencanaclient::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Rencana Siklus Sertifikasi',
            ];
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Rencana Siklus Sertifikasi',
            ];
            Logresertifikasi::create($log);
        }
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client, $listpermohonan)
    {
        if ($client->user_id == auth()->user()->id || auth()->user()->level_id == 1 || auth()->user()->level_id == 3 || auth()->user()->level_id == 4) {
            $listpermohonan_id = Listpermohonan::where('id', $listpermohonan)->first();

            $bagian = Level::where('id', auth()->user()->level_id)->first();
            $roles = explode(',', $bagian['access']);

            if ($listpermohonan_id->slug == 'sertifikasi_awal' || $listpermohonan_id->slug == 'resertifikasi') {
                if ($client->perjanjianclient_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->perjanjianclient_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                }
            } else if ($listpermohonan_id->slug == 'surveilance1' || $listpermohonan_id->slug == 'surveilance2') {
                if ($client->perjanjianclient_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->perjanjianclient_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                }
            }

            $klausul = $client->rencanaclient_data($listpermohonan)->first() ? explode(',', $client->rencanaclient_data($listpermohonan)->first()->klausul) : '';

            return view('dashboard.rencanaclientedit', [
                'title_bar'             => 'Rencana Siklus Sertifikasi',
                'client'                => $client,
                'listpermohonan_id'     => $listpermohonan_id,
                'listpermohonan_slug'   => $listpermohonan_id->slug,
                'kajianclient'          => $client->kajianclient_data($listpermohonan)->first(),
                'permohonansertifikasi' => $client->permohonansertifikasi_data($listpermohonan)->first(),
                'perjanjianclient'      => $client->perjanjianclient_data($listpermohonan)->first(),
                'rencanaclient'         => $client->rencanaclient_data($listpermohonan)->first(),
                'klausul'               => $klausul,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client, $listpermohonan)
    {
        $rencanaclient = $client->rencanaclient_data($listpermohonan)->first();

        $klausul = array($request->klausul_audit1_4, $request->klausul_audit1_5, $request->klausul_audit1_6, $request->klausul_audit1_7, $request->klausul_audit1_8, $request->klausul_audit1_9, $request->klausul_audit1_10, $request->klausul_audit2_4, $request->klausul_audit2_5, $request->klausul_audit2_6, $request->klausul_audit2_7, $request->klausul_audit2_8, $request->klausul_audit2_9, $request->klausul_audit2_10, $request->klausul_survailen1_4, $request->klausul_survailen1_5, $request->klausul_survailen1_6, $request->klausul_survailen1_7, $request->klausul_survailen1_8, $request->klausul_survailen1_9, $request->klausul_survailen1_10, $request->klausul_survailen2_4, $request->klausul_survailen2_5, $request->klausul_survailen2_6, $request->klausul_survailen2_7, $request->klausul_survailen2_8, $request->klausul_survailen2_9, $request->klausul_survailen2_10, $request->klausul_resertifikasi_4, $request->klausul_resertifikasi_5, $request->klausul_resertifikasi_6, $request->klausul_resertifikasi_7, $request->klausul_resertifikasi_8, $request->klausul_resertifikasi_9, $request->klausul_resertifikasi_10);

        $arrklausul = implode(',', $klausul);

        $data = $request->validate([
            'client_id'                         => 'required',
            'listpermohonan_id'                 => 'required',
            'standart'                          => 'required',
            'rencana1'                          => 'required',
            'rencana2'                          => 'required',
            'rencana3'                          => 'required',
            'rencana4'                          => 'required',
            'rencana5'                          => 'required',
        ]);

        $data['klausul'] = $arrklausul;
        $data['tempat_ttd'] = $request->tempat_ttd;
        $data['tgl_ttd'] = $request->tgl_ttd;
        $data['nama_ttd'] = $request->nama_ttd;

        Rencanaclient::where('id', $rencanaclient->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Perubahan disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-03 - Rencana Siklus Sertifikasi.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $rencanaclient = $client->rencanaclient_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Rencanaclient::where('id', $rencanaclient->id)->update($data);

        // sent email client
        $log = 'Rencana Siklus Sertifikasi';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $rencanaclient->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Rencana Siklus Sertifikasi';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $rencanaclient->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($item->email)->send(new Statusvalidasi($admindata));
        }

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Status Berhasil Disimpan!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function download(Rencanaclient $rencanaclient)
    {
        $clientdata = Client::where('id', $rencanaclient->client_id)->first();

        $setting = Setting::firstWhere('id', 1);

        $klausul = $rencanaclient ? explode(',', $rencanaclient->klausul) : '';

        $listpermohonan_data = Listpermohonan::get();
        $idsertifikasi = '';
        for ($i = $rencanaclient->listpermohonan_id; $i >= 1; $i--) {
            if ($listpermohonan_data->where('id', $i)->first()->id ?? '' == $i) {
                if ($listpermohonan_data->where('id', $i)->first()->slug == 'sertifikasi_awal') {
                    $idsertifikasi = $listpermohonan_data->where('id', $i)->first()->id;
                    break;
                } else if ($listpermohonan_data->where('id', $i)->first()->slug == 'resertifikasi') {
                    $idsertifikasi = $listpermohonan_data->where('id', $i)->first()->id;
                    break;
                }
            }
        }

        $pdf = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.rencanaclientdownload', [
                'title_bar'                 => 'Download',
                'rencanaclient'             => $rencanaclient,
                'permohonansertifikasi'     => $clientdata->permohonansertifikasi_data($idsertifikasi)->first(),
                'kajianclient'              => $clientdata->kajianclient_data($idsertifikasi)->first(),
                'perjanjianclient'          => $clientdata->perjanjianclient_data($idsertifikasi)->first(),
                'client'                    => $clientdata,
                'setting'                   => $setting,
                'klausul'                   => $klausul,
            ]);
        return $pdf->stream();
    }
}
