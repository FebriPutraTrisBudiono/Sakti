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
use App\Models\Stage2checkaudit;
use App\Models\Stage2rencanaaudit;
use App\Http\Controllers\Controller;
use App\Models\Logawalcertification;
use App\Models\Stage1kajiantimaudit;
use Illuminate\Support\Facades\Mail;
use App\Models\permohonansertifikasi;
use App\Models\Stage1penunjukantimaudit;

class Stage2checkauditController extends Controller
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
        $arrdoc_diuji = implode('|', $request->doc_diuji);
        $arrklausul = implode('|', $request->klausul);
        $arrmaj = implode('|', $request->maj);
        $arrmin = implode('|', $request->min);
        $arrobs = implode('|', $request->obs);

        $data = $request->validate([
            'client_id'                     => 'required',
            'listpermohonan_id'             => 'required',
            'auditi'                        => 'required',
            'auditor'                       => 'required',
            'standart_iso'                  => 'required',
        ]);

        $data['doc_diuji'] = $arrdoc_diuji;
        $data['klausul'] = $arrklausul;
        $data['maj'] = $arrmaj;
        $data['min'] = $arrmin;
        $data['obs'] = $arrobs;

        // save to database
        $data['status'] = 1;
        Stage2checkaudit::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage II CheckList Audit',
            ];
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance1') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Penugasan - CheckList Audit Stage II',
            ];
            Log1surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance2') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Penugasan - CheckList Audit Stage II',
            ];
            Log2surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage II CheckList Audit',
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
                if ($client->stage2rencanaaudit_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->stage2rencanaaudit_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                }
            } else if ($listpermohonan_id->slug == 'surveilance1' || $listpermohonan_id->slug == 'surveilance2') {
                if ($client->stage2rencanaaudit_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->stage2rencanaaudit_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                }
            }

            $listpermohonan_data = Listpermohonan::get();
            $idsertifikasi = '';
            if ($listpermohonan == 1) {
                $idsertifikasi = $listpermohonan;
            } else {
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
            }

            if ($client->stage2checkaudit_data($listpermohonan)->first() != '') {
                $doc_diuji = explode('|', $client->stage2checkaudit_data($listpermohonan)->first()->doc_diuji);
                $klausul = explode('|', $client->stage2checkaudit_data($listpermohonan)->first()->klausul);
                $maj = explode('|', $client->stage2checkaudit_data($listpermohonan)->first()->maj);
                $min = explode('|', $client->stage2checkaudit_data($listpermohonan)->first()->min);
                $obs = explode('|', $client->stage2checkaudit_data($listpermohonan)->first()->obs);

                return view('dashboard.stage2checkauditedit', [
                    'title_bar'                 => 'Checklist Audit Stage II',
                    'client'                    => $client,
                    'listpermohonan_id'         => $listpermohonan_id,
                    'listpermohonan_slug'       => $listpermohonan_id->slug,
                    'permohonansertifikasi'     => $client->permohonansertifikasi_data($idsertifikasi)->first(),
                    'kajianclient'              => $client->kajianclient_data($idsertifikasi)->first(),
                    'perjanjianclient'          => $client->perjanjianclient_data($idsertifikasi)->first(),
                    'rencanaclient'             => $client->rencanaclient_data($idsertifikasi)->first(),
                    'stage2checkaudit'          => $client->stage2checkaudit_data($listpermohonan)->first(),
                    'stage1penunjukantimaudit'  => $client->stage1penunjukantimaudit_data($listpermohonan)->first(),
                    'doc_diuji'                 => $doc_diuji,
                    'klausul'                   => $klausul,
                    'maj'                       => $maj,
                    'min'                       => $min,
                    'obs'                       => $obs,
                    'roles'                     => $roles,
                ]);
            } else {
                return view('dashboard.stage2checkauditedit', [
                    'title_bar'                 => 'Checklist Audit Stage II',
                    'client'                    => $client,
                    'listpermohonan_id'         => $listpermohonan_id,
                    'listpermohonan_slug'       => $listpermohonan_id->slug,
                    'permohonansertifikasi'     => $client->permohonansertifikasi_data($idsertifikasi)->first(),
                    'kajianclient'              => $client->kajianclient_data($idsertifikasi)->first(),
                    'perjanjianclient'          => $client->perjanjianclient_data($idsertifikasi)->first(),
                    'rencanaclient'             => $client->rencanaclient_data($idsertifikasi)->first(),
                    'stage2checkaudit'          => $client->stage2checkaudit_data($listpermohonan)->first(),
                    'stage1penunjukantimaudit'  => $client->stage1penunjukantimaudit_data($listpermohonan)->first(),
                    'roles'                     => $roles,
                ]);
            }
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
        $stage2checkaudit = $client->stage2checkaudit_data($listpermohonan)->first();

        $arrdoc_diuji = implode('|', $request->doc_diuji);
        $arrklausul = implode('|', $request->klausul);
        $arrmaj = implode('|', $request->maj);
        $arrmin = implode('|', $request->min);
        $arrobs = implode('|', $request->obs);

        $data = $request->validate([
            'client_id'                     => 'required',
            'listpermohonan_id'             => 'required',
            'auditi'                        => 'required',
            'auditor'                       => 'required',
            'standart_iso'                  => 'required',
        ]);

        $data['doc_diuji'] = $arrdoc_diuji;
        $data['klausul'] = $arrklausul;
        $data['maj'] = $arrmaj;
        $data['min'] = $arrmin;
        $data['obs'] = $arrobs;

        Stage2checkaudit::where('id', $stage2checkaudit->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Perubahan disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-06B - Checklist Audit Stage II.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $stage2checkaudit = $client->stage2checkaudit_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Stage2checkaudit::where('id', $stage2checkaudit->id)->update($data);

        // sent email client
        $log = 'Stage II CheckList Audit';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $stage2checkaudit->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Stage II CheckList Audit';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $stage2checkaudit->dipending_keterangan ?? '',
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
                $log = 'Stage II CheckList Audit';
                $auditordata = [
                    'user' => $item,
                    'client' => $client,
                    'permohonan' => $permohonan,
                    'log' => $log,
                    'status' => $request->status,
                    'keterangan' => '',
                    'dipending_keterangandata' => $stage2checkaudit->dipending_keterangan ?? '',
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

    public function download(Stage2checkaudit $stage2checkaudit)
    {
        $clientdata = Client::where('id', $stage2checkaudit->client_id)->first();

        $setting = Setting::firstWhere('id', 1);

        $listpermohonan_data = Listpermohonan::get();
        $idsertifikasi = '';
        for ($i = $stage2checkaudit->listpermohonan_id; $i >= 1; $i--) {
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

        if ($stage2checkaudit != '') {
            $doc_diuji = explode('|', $stage2checkaudit->doc_diuji);
            $klausul = explode('|', $stage2checkaudit->klausul);
            $maj = explode('|', $stage2checkaudit->maj);
            $min = explode('|', $stage2checkaudit->min);
            $obs = explode('|', $stage2checkaudit->obs);

            $pdf = Pdf::setPaper('a4', 'potrait')
                ->loadView('dashboard.stage2checkauditDownload', [
                    'title_bar'                     => 'Download',
                    'stage2checkaudit'              => $stage2checkaudit,
                    'permohonansertifikasi'         => $clientdata->permohonansertifikasi_data($idsertifikasi)->first(),
                    'kajianclient'                  => $clientdata->kajianclient_data($idsertifikasi)->first(),
                    'perjanjianclient'              => $clientdata->perjanjianclient_data($idsertifikasi)->first(),
                    'rencanaclient'                 => $clientdata->rencanaclient_data($idsertifikasi)->first(),
                    'client'                        => $clientdata,
                    'stage1kajiantimaudit'          => $clientdata->stage1kajiantimaudit_data($stage2checkaudit->listpermohonan_id)->first(),
                    'stage1penunjukantimaudit'      => $clientdata->stage1penunjukantimaudit_data($stage2checkaudit->listpermohonan_id)->first(),
                    'setting'                       => $setting,
                    'doc_diuji'                     => $doc_diuji,
                    'maj'                           => $maj,
                    'klausul'                       => $klausul,
                    'min'                           => $min,
                    'obs'                           => $obs,
                ]);
            return $pdf->stream();
        } else {
            $pdf = Pdf::setPaper('a4', 'potrait')
                ->loadView('dashboard.stage2checkauditDownload', [
                    'title_bar'                     => 'Download',
                    'stage2rencanaaudit'            => $stage2checkaudit,
                    'permohonansertifikasi'         => $clientdata->permohonansertifikasi_data($idsertifikasi)->first(),
                    'kajianclient'                  => $clientdata->kajianclient_data($idsertifikasi)->first(),
                    'perjanjianclient'              => $clientdata->perjanjianclient_data($idsertifikasi)->first(),
                    'rencanaclient'                 => $clientdata->rencanaclient_data($idsertifikasi)->first(),
                    'client'                        => $clientdata,
                    'stage1kajiantimaudit'          => $clientdata->stage1kajiantimaudit_data($stage2checkaudit->listpermohonan_id)->first(),
                    'stage1penunjukantimaudit'      => $clientdata->stage1penunjukantimaudit_data($stage2checkaudit->listpermohonan_id)->first(),
                    'setting'                       => $setting
                ]);
            return $pdf->stream();
        }
    }
}
