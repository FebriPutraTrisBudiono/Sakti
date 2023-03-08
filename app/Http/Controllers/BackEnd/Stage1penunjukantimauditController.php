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
use App\Models\Log1surveilance;
use App\Models\Log2surveilance;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Logresertifikasi;
use App\Models\Perjanjianclient;
use App\Http\Controllers\Controller;
use App\Models\Logawalcertification;
use App\Models\Stage1kajiantimaudit;
use Illuminate\Support\Facades\Mail;
use App\Models\permohonansertifikasi;
use App\Models\Stage1penunjukantimaudit;

class Stage1penunjukantimauditController extends Controller
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
            'client_id'                 => 'required',
            'listpermohonan_id'         => 'required',
            'nama_auditor'              => 'required',
            'nama_inisial'              => 'required',
            'jabatan'                   => 'required',
            'tanggal_bertugas'          => 'required',
            'sampai_dengan'             => 'required',
        ]);

        $arraudit = [$request->pra_audit, $request->stage1, $request->stage2, $request->surveilen, $request->tindaklanjut, $request->resertifikasi];
        $audit = implode('|', $arraudit);
        $data['audit'] = $audit;

        $data['nama_auditor2'] = $request->nama_auditor2;
        $data['nama_inisial2'] = $request->nama_inisial2;
        $data['jabatan2'] = $request->jabatan2;
        $data['nama_auditor3'] = $request->nama_auditor3;
        $data['nama_inisial3'] = $request->nama_inisial3;
        $data['jabatan3'] = $request->jabatan3;
        $data['tempat_ttd'] = $request->tempat_ttd;
        $data['tgl_ttd'] = $request->tgl_ttd;
        $data['nama_ttd'] = $request->nama_ttd;

        // save to database
        $data['status'] = 1;
        Stage1penunjukantimaudit::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage I Penunjukan Tim Audit',
            ];
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance1') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Penugasan - Penunjukan Tim Audit',
            ];
            Log1surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance2') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Penugasan - Penunjukan Tim Audit',
            ];
            Log2surveilance::create($log);
        } elseif ($data['listpermohonan_id'] == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage I Penunjukan Tim Audit',
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
                if ($client->stage1kajiantimaudit_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->stage1kajiantimaudit_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                }
            } else if ($listpermohonan_id->slug == 'surveilance1' || $listpermohonan_id->slug == 'surveilance2') {
                if ($client->stage1kajiantimaudit_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->stage1kajiantimaudit_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                }
            }

            $stage1penunjukantimaudit = $client->stage1penunjukantimaudit_data($listpermohonan)->first();
            if ($stage1penunjukantimaudit) {
                $arraudit = explode('|', $stage1penunjukantimaudit->audit);
            }

            $listpermohonan_data = Listpermohonan::get();
            $idsertifikasi = '';
            if ($listpermohonan_id->slug == 'sertifikasi_awal' || $listpermohonan_id->slug == 'surveilance1' || $listpermohonan_id->slug == 'surveilance2' || $listpermohonan_id->slug == 'resertifikasi') {
                for ($i = $listpermohonan; $i >= 1; $i--) {
                    if ($listpermohonan_data->where('id', $i)->first()->id ?? '' == $i) {
                        if ($listpermohonan_data->where('id', $i)->first()->slug == 'sertifikasi_awal' && $listpermohonan_data->where('id', $i)->first()->client_id == $client->id) {
                            $idsertifikasi = $listpermohonan_data->where('id', $i)->first()->id;
                            break;
                        } else if ($listpermohonan_data->where('id', $i)->first()->slug == 'resertifikasi' && $listpermohonan_data->where('id', $i)->first()->client_id == $client->id) {
                            $idsertifikasi = $listpermohonan_data->where('id', $i)->first()->id;
                            break;
                        }
                    }
                }
            }

            $kajianclient = $client->kajianclient_data($idsertifikasi)->first();

            $hasil3_lead = [$kajianclient->hasil3_lead1, $kajianclient->hasil3_lead2, $kajianclient->hasil3_lead3];
            $hasil3_auditor = [$kajianclient->hasil3_auditor1, $kajianclient->hasil3_auditor2, $kajianclient->hasil3_auditor3];
            $hasil3_tenaga = [$kajianclient->hasil3_tenaga1, $kajianclient->hasil3_tenaga2, $kajianclient->hasil3_tenaga3];

            return view('dashboard.stage1penunjukantimauditedit', [
                'title_bar'                 => 'Penunjukan Tim Audit',
                'client'                    => $client,
                'listpermohonan_id'         => $listpermohonan_id,
                'listpermohonan_slug'       => $listpermohonan_id->slug,
                'permohonanclient'          => $client->permohonansertifikasi_data($idsertifikasi)->first(),
                'kajianclient'              => $client->kajianclient_data($idsertifikasi)->first(),
                'rencanaclient'             => $client->rencanaclient_data($idsertifikasi)->first(),
                'stage1penunjukantimaudit'  => $stage1penunjukantimaudit ?? '',
                'roles'                     => $roles,
                'hasil3_lead'               => $hasil3_lead,
                'hasil3_auditor'            => $hasil3_auditor,
                'hasil3_tenaga'             => $hasil3_tenaga,
                'audit'                     => $arraudit ?? '',
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
        $stage1penunjukantimaudit = $client->stage1penunjukantimaudit_data($listpermohonan)->first();

        $arraudit = [$request->pra_audit, $request->stage1, $request->stage2, $request->surveilen, $request->tindaklanjut, $request->resertifikasi];

        $data = $request->validate([
            'client_id'                 => 'required',
            'listpermohonan_id'         => 'required',
            'nama_auditor'              => 'required',
            'nama_inisial'              => 'required',
            'jabatan'                   => 'required',
            'tanggal_bertugas'          => 'required',
            'sampai_dengan'             => 'required',
        ]);

        $audit = implode('|', $arraudit);

        $data['nama_auditor2'] = $request->nama_auditor2;
        $data['nama_inisial2'] = $request->nama_inisial2;
        $data['jabatan2'] = $request->jabatan2;
        $data['nama_auditor3'] = $request->nama_auditor3;
        $data['nama_inisial3'] = $request->nama_inisial3;
        $data['jabatan3'] = $request->jabatan3;
        $data['audit'] = $audit;
        $data['tempat_ttd'] = $request->tempat_ttd;
        $data['tgl_ttd'] = $request->tgl_ttd;
        $data['nama_ttd'] = $request->nama_ttd;

        Stage1penunjukantimaudit::where('id', $stage1penunjukantimaudit->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Perubahan disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-04 - Penunjukan Tim Audit.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $stage1penunjukantimaudit = $client->stage1penunjukantimaudit_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Stage1penunjukantimaudit::where('id', $stage1penunjukantimaudit->id)->update($data);

        // sent email client
        $log = 'Stage I Penunjukan Tim Audit';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $stage1penunjukantimaudit->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Stage I Penunjukan Tim Audit';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $stage1penunjukantimaudit->dipending_keterangan ?? '',
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
                $log = 'Stage I Penunjukan Tim Audit';
                $auditordata = [
                    'user' => $item,
                    'client' => $client,
                    'permohonan' => $permohonan,
                    'log' => $log,
                    'status' => $request->status,
                    'keterangan' => '',
                    'dipending_keterangandata' => $stage1penunjukantimaudit->dipending_keterangan ?? '',
                    'dipending_keterangan' => $request->dipending_keterangan ?? '',
                ];
                Mail::to($item->email)->send(new Statusvalidasi($auditordata));
            }
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

    public function download(Stage1penunjukantimaudit $stage1penunjukantimaudit)
    {
        $clientdata = Client::where('id', $stage1penunjukantimaudit->client_id)->first();
        $setting = Setting::firstWhere('id', 1);
        $arraudit = explode('|', $stage1penunjukantimaudit['audit']);

        $listpermohonan_data = Listpermohonan::get();
        $idsertifikasi = '';
        for ($i = $stage1penunjukantimaudit->listpermohonan_id; $i >= 1; $i--) {
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
            ->loadView('dashboard.stage1penunjukantimauditDownload', [
                'title_bar'                     => 'Download',
                'stage1penunjukantimaudit'      => $stage1penunjukantimaudit,
                'permohonanclient'              => $clientdata->permohonansertifikasi_data($idsertifikasi)->first(),
                'kajianclient'                  => $clientdata->kajianclient_data($idsertifikasi)->first(),
                'perjanjianclient'              => $clientdata->perjanjianclient_data($idsertifikasi)->first(),
                'rencanaclient'                 => $clientdata->rencanaclient_data($idsertifikasi)->first(),
                'client'                        => $clientdata,
                'stage1kajiantimaudit'          => $clientdata->stage1kajiantimaudit_data($idsertifikasi)->first(),
                'setting'                       => $setting,
                'audit'                         => $arraudit
            ]);
        return $pdf->stream();
    }
}
