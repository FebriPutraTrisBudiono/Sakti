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
use App\Models\Stage2laporanaudit;
use App\Models\Stage2rencanaaudit;
use App\Http\Controllers\Controller;
use App\Models\Logawalcertification;
use Illuminate\Support\Facades\Mail;
use App\Models\permohonansertifikasi;
use App\Models\Stage2daftarhadiraudit;
use App\Models\Stage1penunjukantimaudit;
use App\Models\Stage2ketidaksesuaianpage;

class Stage2ketidaksesuaianpageController extends Controller
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
        $data = [
            'client_id'  => $request->client_id,
            'listpermohonan_id'  => $request->listpermohonan_id,
            'kategori' => $request->kategori,
            'ketidaksesuaian' => $request->ketidaksesuaian,
            'analisa' => $request->analisa,
            'koreksi' => $request->koreksi,
            'korektif' => $request->korektif,
            'hasil_verifikasi' => $request->hasil_verifikasi,
            'keterangan' => $request->keterangan,
            'kategori2' => $request->kategori2,
            'ketidaksesuaian2' => $request->ketidaksesuaian2,
            'analisa2' => $request->analisa2,
            'koreksi2' => $request->koreksi2,
            'korektif2' => $request->korektif2,
            'hasil_verifikasi2' => $request->hasil_verifikasi2,
            'keterangan2' => $request->keterangan2,
            'kategori3' => $request->kategori3,
            'ketidaksesuaian3' => $request->ketidaksesuaian3,
            'analisa3' => $request->analisa3,
            'koreksi3' => $request->koreksi3,
            'korektif3' => $request->korektif3,
            'hasil_verifikasi3' => $request->hasil_verifikasi3,
            'keterangan3' => $request->keterangan3,
        ];
        if ($request->hasFile('uploadttd')) {
            $data['uploadttd'] = $request->uploadttd->store('uploads');
        }

        $data['tempat_ttd'] = $request->tempat_ttd;
        $data['tgl_ttd'] = $request->tgl_ttd;
        $data['nama_ttd'] = $request->nama_ttd;

        // save to database
        $data['status'] = 1;
        Stage2ketidaksesuaianpage::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage II Lembar Ketidaksesuaian',
            ];
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance1') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Audit - Lembar Ketidaksesuaian',
            ];
            Log1surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance2') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Audit - Lembar Ketidaksesuaian',
            ];
            Log2surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage II Lembar Ketidaksesuaian',
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
                if ($client->stage2laporanaudit_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->stage2laporanaudit_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                }
            } else if ($listpermohonan_id->slug == 'surveilance1' || $listpermohonan_id->slug == 'surveilance2') {
                if ($client->stage2laporanaudit_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->stage2laporanaudit_data($listpermohonan)->first()->status != '2') {
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

            $stage1penunjukantimaudit = $client->stage1penunjukantimaudit_data($listpermohonan)->first();
            $arraudit = explode('|', $stage1penunjukantimaudit->audit);

            return view('dashboard.stage2ketidaksesuaianpageedit', [
                'title_bar'                 => 'Lembar Ketidaksesuaian',
                'client'                    => $client,
                'listpermohonan_id'         => $listpermohonan_id,
                'listpermohonan_slug'       => $listpermohonan_id->slug,
                'permohonansertifikasi'     => $client->permohonansertifikasi_data($idsertifikasi)->first(),
                'kajianclient'              => $client->kajianclient_data($idsertifikasi)->first(),
                'perjanjianclient'          => $client->perjanjianclient_data($idsertifikasi)->first(),
                'rencanaclient'             => $client->rencanaclient_data($idsertifikasi)->first(),
                'stage1penunjukantimaudit'  => $stage1penunjukantimaudit,
                'stage2ketidaksesuaianpage' => $client->stage2ketidaksesuaianpage_data($listpermohonan)->first(),
                'roles'                     => $roles,
                'arraudit'                  => $arraudit ?? '',
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
        $stageketidaksesuaianpage = $client->stage2ketidaksesuaianpage_data($listpermohonan)->first();

        $data = [
            'client_id'  => $request->client_id,
            'listpermohonan_id'  => $request->listpermohonan_id,
            'kategori' => $request->kategori,
            'ketidaksesuaian' => $request->ketidaksesuaian,
            'analisa' => $request->analisa,
            'koreksi' => $request->koreksi,
            'korektif' => $request->korektif,
            'hasil_verifikasi' => $request->hasil_verifikasi,
            'keterangan' => $request->keterangan,
            'kategori2' => $request->kategori2,
            'ketidaksesuaian2' => $request->ketidaksesuaian2,
            'analisa2' => $request->analisa2,
            'koreksi2' => $request->koreksi2,
            'korektif2' => $request->korektif2,
            'hasil_verifikasi2' => $request->hasil_verifikasi2,
            'keterangan2' => $request->keterangan2,
            'kategori3' => $request->kategori3,
            'ketidaksesuaian3' => $request->ketidaksesuaian3,
            'analisa3' => $request->analisa3,
            'koreksi3' => $request->koreksi3,
            'korektif3' => $request->korektif3,
            'hasil_verifikasi3' => $request->hasil_verifikasi3,
            'keterangan3' => $request->keterangan3,
        ];
        if ($request->hasFile('uploadttd')) {
            $data['uploadttd'] = $request->uploadttd->store('uploads');
        }

        $data['tempat_ttd'] = $request->tempat_ttd;
        $data['tgl_ttd'] = $request->tgl_ttd;
        $data['nama_ttd'] = $request->nama_ttd;

        Stage2ketidaksesuaianpage::where('id', $stageketidaksesuaianpage->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-09 - Lembar Ketidaksesuaian.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $stage2ketidaksesuaianpage = $client->stage2ketidaksesuaianpage_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Stage2ketidaksesuaianpage::where('id', $stage2ketidaksesuaianpage->id)->update($data);

        // sent email client
        $log = 'Stage II Lembar Ketidaksesuaian';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $stage2ketidaksesuaianpage->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Stage II Lembar Ketidaksesuaian';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $stage2ketidaksesuaianpage->dipending_keterangan ?? '',
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
                $log = 'Stage II Lembar Ketidaksesuaian';
                $auditordata = [
                    'user' => $item,
                    'client' => $client,
                    'permohonan' => $permohonan,
                    'log' => $log,
                    'status' => $request->status,
                    'keterangan' => '',
                    'dipending_keterangandata' => $stage2ketidaksesuaianpage->dipending_keterangan ?? '',
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

    public function download(Stage2ketidaksesuaianpage $stage2ketidaksesuaianpage)
    {
        $clientdata = Client::where('id', $stage2ketidaksesuaianpage->client_id)->first();

        $stage1penunjukantimaudit = Stage1penunjukantimaudit::where('listpermohonan_id', $stage2ketidaksesuaianpage->listpermohonan_id)->first();
        $arraudit = explode('|', $stage1penunjukantimaudit['audit']);

        $setting = Setting::firstWhere('id', 1);

        $listpermohonan_data = Listpermohonan::get();
        $idsertifikasi = '';
        for ($i = $stage2ketidaksesuaianpage->listpermohonan_id; $i >= 1; $i--) {
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
            ->loadView('dashboard.stage2ketidaksesuaianpageDownload', [
                'title_bar'                     => 'Download',
                'permohonansertifikasi'         => $clientdata->permohonansertifikasi_data($idsertifikasi)->first(),
                'kajianclient'                  => $clientdata->kajianclient_data($idsertifikasi)->first(),
                'perjanjianclient'              => $clientdata->perjanjianclient_data($idsertifikasi)->first(),
                'rencanaclient'                 => $clientdata->rencanaclient_data($idsertifikasi)->first(),
                'stage1penunjukantimaudit'      => $clientdata->stage1penunjukantimaudit_data($stage2ketidaksesuaianpage->listpermohonan_id)->first(),
                'stage2ketidaksesuaianpage'     => $clientdata->stage2ketidaksesuaianpage_data($stage2ketidaksesuaianpage->listpermohonan_id)->first(),
                'setting'                       => $setting,
                'arraudit'                      => $arraudit,
            ]);
        return $pdf->stream();
    }
}
