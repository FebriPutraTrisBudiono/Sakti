<?php

namespace App\Http\Controllers;

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
use App\Models\Log1surveilance;
use App\Models\Log2surveilance;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Logresertifikasi;
use App\Models\Perjanjianclient;
use App\Models\Stage2checkaudit;
use App\Models\Stage2laporanaudit;
use App\Models\Stage2rencanaaudit;
use App\Models\Logawalcertification;
use Illuminate\Support\Facades\Mail;
use App\Models\permohonansertifikasi;
use App\Models\Stage2daftarhadiraudit;
use App\Models\Stage1penunjukantimaudit;
use App\Models\Stage2ketidaksesuaianpage;
use App\Models\Stage2surveikepuasancustomer;

class Stage2surveikepuasancustomerController extends Controller
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
        $auditor = implode('|', $request->auditor);
        $indikator1 = implode('|', $request->indikator1);
        $indikator2 = implode('|', $request->indikator2);
        $indikator3 = implode('|', $request->indikator3);
        $indikator4 = implode('|', $request->indikator4);
        $indikator5 = implode('|', $request->indikator5);
        $indikator6 = implode('|', $request->indikator6);

        $data = $request->validate([
            'client_id'                     => 'required',
            'listpermohonan_id'             => 'required',
            'tipe_audit'                    => 'required',
        ]);

        $data['auditor'] = $auditor;
        $data['indikator1'] = $indikator1;
        $data['indikator2'] = $indikator2;
        $data['indikator3'] = $indikator3;
        $data['indikator4'] = $indikator4;
        $data['indikator5'] = $indikator5;
        $data['indikator6'] = $indikator6;
        $data['keterangan'] = $request->keterangan;

        $data['tempat_ttd'] = $request->tempat_ttd;
        $data['tgl_ttd'] = $request->tgl_ttd;
        $data['nama_ttd'] = $request->nama_ttd;
        $data['nama_organisasi'] = $request->nama_organisasi;

        // save to database
        $data['status'] = 1;
        Stage2surveikepuasancustomer::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage II Survei Kepuasan Pelanggan',
            ];
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance1') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Audit - Survei Kepuasan Pelanggan',
            ];
            Log1surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance2') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Audit - Survei Kepuasan Pelanggan',
            ];
            Log2surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage II Survei Kepuasan Pelanggan',
            ];
            Logresertifikasi::create($log);
        }
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-10 - Survei Kepuasan Pelanggan.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $stage2surveikepuasancustomer = $client->stage2surveikepuasancustomer_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Stage2surveikepuasancustomer::where('id', $stage2surveikepuasancustomer->id)->update($data);

        // sent email client
        $log = 'Stage II Survei Kepuasan Pelanggan';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $stage2surveikepuasancustomer->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Stage II Survei Kepuasan Pelanggan';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $stage2surveikepuasancustomer->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($item->email)->send(new Statusvalidasi($admindata));
        }

        // sent email auditor
        $stage1penunjukantimaudit = $client->stage1penunjukantimaudit_data($listpermohonan)->first();
        $auditor1 = User::where('id', $stage1penunjukantimaudit->nama_auditor)->first();
        $auditor2 = User::where('id', $stage1penunjukantimaudit->nama_auditor2)->first();
        $auditor3 = User::where('id', $stage1penunjukantimaudit->nama_auditor3)->first();

        $auditor = [$auditor1, $auditor2, $auditor3];

        foreach ($auditor as $item) {
            if ($item != '') {
                $log = 'Stage II Survei Kepuasan Pelanggan';
                $auditordata = [
                    'user' => $item,
                    'client' => $client,
                    'permohonan' => $permohonan,
                    'log' => $log,
                    'status' => $request->status,
                    'keterangan' => '',
                    'dipending_keterangandata' => $stage2surveikepuasancustomer->dipending_keterangan ?? '',
                    'dipending_keterangan' => $request->dipending_keterangan ?? '',
                ];
                Mail::to($item->email)->send(new Statusvalidasi($auditordata));
            }
        }

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Status Berhasil Disimpan!</div>');
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
            $stage2surveikepuasancustomer = $client->stage2surveikepuasancustomer_data($listpermohonan)->first();

            $bagian = Level::where('id', auth()->user()->level_id)->first();
            $roles = explode(',', $bagian['access']);

            if ($listpermohonan_id->slug == 'sertifikasi_awal' || $listpermohonan_id->slug == 'resertifikasi') {
                if ($client->stage2ketidaksesuaianpage_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->stage2ketidaksesuaianpage_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                }
            } else if ($listpermohonan_id->slug == 'surveilance1' || $listpermohonan_id->slug == 'surveilance2') {
                if ($client->stage2ketidaksesuaianpage_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->stage2ketidaksesuaianpage_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                }
            }

            $auditor = $stage2surveikepuasancustomer ? explode('|', $stage2surveikepuasancustomer->auditor) : '';
            $indikator1 = $stage2surveikepuasancustomer ? explode('|', $stage2surveikepuasancustomer->indikator1) : '';
            $indikator2 = $stage2surveikepuasancustomer ? explode('|', $stage2surveikepuasancustomer->indikator2) : '';
            $indikator3 = $stage2surveikepuasancustomer ? explode('|', $stage2surveikepuasancustomer->indikator3) : '';
            $indikator4 = $stage2surveikepuasancustomer ? explode('|', $stage2surveikepuasancustomer->indikator4) : '';
            $indikator5 = $stage2surveikepuasancustomer ? explode('|', $stage2surveikepuasancustomer->indikator5) : '';
            $indikator6 = $stage2surveikepuasancustomer ? explode('|', $stage2surveikepuasancustomer->indikator6) : '';

            return view('dashboard.stage2surveikepuasancustomeredit', [
                'title_bar'                     => 'Survei Kepuasan Pelanggan',
                'client'                        => $client,
                'listpermohonan_id'             => $listpermohonan_id,
                'listpermohonan_slug'           => $listpermohonan_id->slug,
                'permohonansertifikasi'         => $client->permohonansertifikasi_data($listpermohonan)->first(),
                'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($listpermohonan)->first(),
                'stage2surveikepuasancustomer'  => $stage2surveikepuasancustomer,
                'stage2checkaudit'              => $client->stage2checkaudit_data($listpermohonan)->first(),
                'auditor'                       => $auditor,
                'indikator1'                    => $indikator1,
                'indikator2'                    => $indikator2,
                'indikator3'                    => $indikator3,
                'indikator4'                    => $indikator4,
                'indikator5'                    => $indikator5,
                'indikator6'                    => $indikator6,
                'roles'                         => $roles,
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
        $stage2surveikepuasancustomer = $client->stage2surveikepuasancustomer_data($listpermohonan)->first();

        $auditor = implode('|', $request->auditor);
        $indikator1 = implode('|', $request->indikator1);
        $indikator2 = implode('|', $request->indikator2);
        $indikator3 = implode('|', $request->indikator3);
        $indikator4 = implode('|', $request->indikator4);
        $indikator5 = implode('|', $request->indikator5);
        $indikator6 = implode('|', $request->indikator6);

        $data = $request->validate([
            'client_id'                     => 'required',
            'listpermohonan_id'             => 'required',
            'tipe_audit'                    => 'required',
        ]);

        $data['auditor'] = $auditor;
        $data['indikator1'] = $indikator1;
        $data['indikator2'] = $indikator2;
        $data['indikator3'] = $indikator3;
        $data['indikator4'] = $indikator4;
        $data['indikator5'] = $indikator5;
        $data['indikator6'] = $indikator6;
        $data['keterangan'] = $request->keterangan;

        $data['tempat_ttd'] = $request->tempat_ttd;
        $data['tgl_ttd'] = $request->tgl_ttd;
        $data['nama_ttd'] = $request->nama_ttd;
        $data['nama_organisasi'] = $request->nama_organisasi;

        Stage2surveikepuasancustomer::where('id', $stage2surveikepuasancustomer->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
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

    public function download(Stage2surveikepuasancustomer $stage2surveikepuasancustomer)
    {
        $clientdata = Client::where('id', $stage2surveikepuasancustomer->client_id)->first();

        $setting = Setting::firstWhere('id', 1);

        $listpermohonan_data = Listpermohonan::get();
        $idsertifikasi = '';
        for ($i = $stage2surveikepuasancustomer->listpermohonan_id; $i >= 1; $i--) {
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

        if ($stage2surveikepuasancustomer != '') {
            $auditor = explode('|', $stage2surveikepuasancustomer->auditor);
            $indikator1 = explode('|', $stage2surveikepuasancustomer->indikator1);
            $indikator2 = explode('|', $stage2surveikepuasancustomer->indikator2);
            $indikator3 = explode('|', $stage2surveikepuasancustomer->indikator3);
            $indikator4 = explode('|', $stage2surveikepuasancustomer->indikator4);
            $indikator5 = explode('|', $stage2surveikepuasancustomer->indikator5);
            $indikator6 = explode('|', $stage2surveikepuasancustomer->indikator6);

            $pdf = Pdf::setPaper('a4', 'potrait')
                ->loadView('dashboard.stage2surveikepuasancustomerDownload', [
                    'title_bar'                     => 'Download',
                    'stage2surveikepuasancustomer'  => $stage2surveikepuasancustomer,
                    'permohonansertifikasi'         => $clientdata->permohonansertifikasi_data($idsertifikasi)->first(),
                    'kajianclient'                  => $clientdata->kajianclient_data($idsertifikasi)->first(),
                    'perjanjianclient'              => $clientdata->perjanjianclient_data($idsertifikasi)->first(),
                    'rencanaclient'                 => $clientdata->rencanaclient_data($idsertifikasi)->first(),
                    'client'                        => $clientdata,
                    'stage1penunjukantimaudit'      => $clientdata->stage1penunjukantimaudit_data($stage2surveikepuasancustomer->listpermohonan_id)->first(),
                    'setting'                       => $setting,
                    'auditor'                       => $auditor,
                    'indikator1'                    => $indikator1,
                    'indikator2'                    => $indikator2,
                    'indikator3'                    => $indikator3,
                    'indikator4'                    => $indikator4,
                    'indikator5'                    => $indikator5,
                    'indikator6'                    => $indikator6,
                    'stage2checkaudit'              => $clientdata->stage2checkaudit_data($stage2surveikepuasancustomer->listpermohonan_id)->first(),
                ]);
            return $pdf->stream();
        } else {
            $pdf = Pdf::setPaper('a4', 'potrait')
                ->loadView('dashboard.stage2surveikepuasancustomerDownload', [
                    'title_bar'                     => 'Download',
                    'stage2surveikepuasancustomer'  => $stage2surveikepuasancustomer,
                    'permohonansertifikasi'         => $clientdata->permohonansertifikasi_data($idsertifikasi)->first(),
                    'kajianclient'                  => $clientdata->kajianclient_data($idsertifikasi)->first(),
                    'perjanjianclient'              => $clientdata->perjanjianclient_data($idsertifikasi)->first(),
                    'rencanaclient'                 => $clientdata->rencanaclient_data($idsertifikasi)->first(),
                    'client'                        => $clientdata,
                    'stage1penunjukantimaudit'      => $clientdata->stage1penunjukantimaudit_data($stage2surveikepuasancustomer->listpermohonan_id)->first(),
                    'setting'                       => $setting
                ]);
            return $pdf->stream();
        }
    }
}
