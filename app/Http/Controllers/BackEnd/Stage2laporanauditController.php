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
use App\Models\Stage1kajiantimaudit;
use Illuminate\Support\Facades\Mail;
use App\Models\permohonansertifikasi;
use App\Models\Stage2daftarhadiraudit;
use App\Models\Stage1penunjukantimaudit;

class Stage2laporanauditController extends Controller
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
        $data['konteks1'] = $request->konteks1 ? implode('|', $request->konteks1) : '';
        $data['konteks2'] = $request->konteks2 ? implode('|', $request->konteks2) : '';
        $data['konteks3'] = $request->konteks3 ? implode('|', $request->konteks3) : '';
        $data['konteks4'] = $request->konteks4 ? implode('|', $request->konteks4) : '';
        $data['kepemimpinan1'] = $request->kepemimpinan1 ? implode('|', $request->kepemimpinan1) : '';
        $data['kepemimpinan2'] = $request->kepemimpinan2 ? implode('|', $request->kepemimpinan2) : '';
        $data['kepemimpinan3'] = $request->kepemimpinan3 ? implode('|', $request->kepemimpinan3) : '';
        $data['perencanaan1'] = $request->perencanaan1 ? implode('|', $request->perencanaan1) : '';
        $data['perencanaan2'] = $request->perencanaan2 ? implode('|', $request->perencanaan2) : '';
        $data['perencanaan3'] = $request->perencanaan3 ? implode('|', $request->perencanaan3) : '';
        $data['dukungan1'] = $request->dukungan1 ? implode('|', $request->dukungan1) : '';
        $data['dukungan2'] = $request->dukungan2 ? implode('|', $request->dukungan2) : '';
        $data['dukungan3'] = $request->dukungan3 ? implode('|', $request->dukungan3) : '';
        $data['dukungan4'] = $request->dukungan4 ? implode('|', $request->dukungan4) : '';
        $data['dukungan5'] = $request->dukungan5 ? implode('|', $request->dukungan5) : '';
        $data['operasi1'] = $request->operasi1 ? implode('|', $request->operasi1) : '';
        $data['operasi2'] = $request->operasi2 ? implode('|', $request->operasi2) : '';
        $data['operasi3'] = $request->operasi3 ? implode('|', $request->operasi3) : '';
        $data['operasi4'] = $request->operasi4 ? implode('|', $request->operasi4) : '';
        $data['operasi5'] = $request->operasi5 ? implode('|', $request->operasi5) : '';
        $data['operasi6'] = $request->operasi6 ? implode('|', $request->operasi6) : '';
        $data['operasi7'] = $request->operasi7 ? implode('|', $request->operasi7) : '';
        $data['evaluasi1'] = $request->evaluasi1 ? implode('|', $request->evaluasi1) : '';
        $data['evaluasi2'] = $request->evaluasi2 ? implode('|', $request->evaluasi2) : '';
        $data['evaluasi3'] = $request->evaluasi3 ? implode('|', $request->evaluasi3) : '';
        $data['peningkatan1'] = $request->peningkatan1 ? implode('|', $request->peningkatan1) : '';
        $data['peningkatan2'] = $request->peningkatan2 ? implode('|', $request->peningkatan2) : '';
        $data['peningkatan3'] = $request->peningkatan3 ? implode('|', $request->peningkatan3) : '';

        $data['konteks1_1'] = $request->konteks1_1 ? implode('|', $request->konteks1_1) : '';
        $data['konteks1_2'] = $request->konteks1_2 ? implode('|', $request->konteks1_2) : '';
        $data['konteks1_3'] = $request->konteks1_3 ? implode('|', $request->konteks1_3) : '';
        $data['konteks1_4'] = $request->konteks1_4 ? implode('|', $request->konteks1_4) : '';
        $data['kepemimpinan1_1'] = $request->kepemimpinan1_1 ? implode('|', $request->kepemimpinan1_1) : '';
        $data['kepemimpinan1_2'] = $request->kepemimpinan1_2 ? implode('|', $request->kepemimpinan1_2) : '';
        $data['kepemimpinan1_3'] = $request->kepemimpinan1_3 ? implode('|', $request->kepemimpinan1_3) : '';
        $data['perencanaan1_1'] = $request->perencanaan1_1 ? implode('|', $request->perencanaan1_1) : '';
        $data['perencanaan1_2'] = $request->perencanaan1_2 ? implode('|', $request->perencanaan1_2) : '';
        $data['perencanaan1_3'] = $request->perencanaan1_3 ? implode('|', $request->perencanaan1_3) : '';
        $data['dukungan1_1'] = $request->dukungan1_1 ? implode('|', $request->dukungan1_1) : '';
        $data['dukungan1_2'] = $request->dukungan1_2 ? implode('|', $request->dukungan1_2) : '';
        $data['dukungan1_3'] = $request->dukungan1_3 ? implode('|', $request->dukungan1_3) : '';
        $data['dukungan1_4'] = $request->dukungan1_4 ? implode('|', $request->dukungan1_4) : '';
        $data['dukungan1_5'] = $request->dukungan1_5 ? implode('|', $request->dukungan1_5) : '';
        $data['operasi1_1'] = $request->operasi1_1 ? implode('|', $request->operasi1_1) : '';
        $data['operasi1_2'] = $request->operasi1_2 ? implode('|', $request->operasi1_2) : '';
        $data['operasi1_3'] = $request->operasi1_3 ? implode('|', $request->operasi1_3) : '';
        $data['operasi1_4'] = $request->operasi1_4 ? implode('|', $request->operasi1_4) : '';
        $data['operasi1_5'] = $request->operasi1_5 ? implode('|', $request->operasi1_5) : '';
        $data['operasi1_6'] = $request->operasi1_6 ? implode('|', $request->operasi1_6) : '';
        $data['operasi1_7'] = $request->operasi1_7 ? implode('|', $request->operasi1_7) : '';
        $data['evaluasi1_1'] = $request->evaluasi1_1 ? implode('|', $request->evaluasi1_1) : '';
        $data['evaluasi1_2'] = $request->evaluasi1_2 ? implode('|', $request->evaluasi1_2) : '';
        $data['evaluasi1_3'] = $request->evaluasi1_3 ? implode('|', $request->evaluasi1_3) : '';
        $data['peningkatan1_1'] = $request->peningkatan1_1 ? implode('|', $request->peningkatan1_1) : '';
        $data['peningkatan1_2'] = $request->peningkatan1_2 ? implode('|', $request->peningkatan1_2) : '';
        $data['peningkatan1_3'] = $request->peningkatan1_3 ? implode('|', $request->peningkatan1_3) : '';

        $data = $request->validate([
            'client_id'                     => 'required',
            'listpermohonan_id'                     => 'required',
            'jumlahtemuan_1'           => 'required',
            'major_2'           => 'required',
            'rencanakunjungan_3'           => 'required',
            'observasi_4'           => 'required',
            'rekomendasi'           => 'required',
            'rl_akreditasi1'           => 'required',
            'rl_jmlsertifikat1'           => 'required',
            'rl_bahasa1'           => 'required',
            'ra1_major'           => 'required',
            'ra1_minor'           => 'required',
            'ra2_major'           => 'required',
            'ra2_minor'           => 'required',
            'ra3_major'           => 'required',
            'ra3_minor'           => 'required',
            'ro_uraian1'           => 'required',
            'ro_uraian2'           => 'required',
            'ro_uraian3'           => 'required',
            'ro_uraian4'           => 'required',
            'kha_1'           => 'required',
            'pai_kapanpelaksanaan'           => 'required',
            'pai_jumlahtemuan'           => 'required',
            'pai_apakahtemuan'           => 'required',
            'pai_jumlahyangbelum'           => 'required',
            'pai_apakahaudit'           => 'required',
            'pai_apakahpelaksanaan'           => 'required',
            'kum_kapanpelaksanaan'           => 'required',
            'kum_apakahkaji'           => 'required',
            'kum_apakahinput'           => 'required',
            'kum_apakahpelaksanaan'           => 'required',
            'ls_sebutkanlingkup'           => 'required',
            'ls_apakahruang'           => 'required',
            'ls_jikatidak'           => 'required',
        ]);

        $data['rl_akreditasi2'] = $request->rl_akreditasi2;
        $data['rl_jmlsertifikat2'] = $request->rl_jmlsertifikat2;
        $data['rl_bahasa2'] = $request->rl_bahasa2;
        $data['rl_akreditasi3'] = $request->rl_akreditasi3;
        $data['rl_jmlsertifikat3'] = $request->rl_jmlsertifikat3;
        $data['rl_bahasa3'] = $request->rl_bahasa3;
        $data['tanggal_ttd'] = $request->tanggal_ttd;
        $data['nama_auditorttd'] = $request->nama_auditorttd;

        // save to database
        $data['status'] = 1;
        Stage2laporanaudit::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage II Laporan Audit',
            ];
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance1') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Audit - Laporan Audit',
            ];
            Log1surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance2') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Audit - Laporan Audit',
            ];
            Log2surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage II Laporan Audit',
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

            $stage2laporanaudit = $client->stage2laporanaudit_data($listpermohonan)->first();

            $bagian = Level::where('id', auth()->user()->level_id)->first();
            $roles = explode(',', $bagian['access']);

            if ($listpermohonan_id->slug == 'sertifikasi_awal' || $listpermohonan_id->slug == 'resertifikasi') {
                if ($client->stage2daftarhadiraudit_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->stage2daftarhadiraudit_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                }
            } else if ($listpermohonan_id->slug == 'surveilance1' || $listpermohonan_id->slug == 'surveilance2') {
                if ($client->stage2daftarhadiraudit_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->stage2daftarhadiraudit_data($listpermohonan)->first()->status != '2') {
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

            if ($stage2laporanaudit != '') {
                $konteks1 = explode('|', $stage2laporanaudit->konteks1);
                $konteks2 = explode('|', $stage2laporanaudit->konteks2);
                $konteks3 = explode('|', $stage2laporanaudit->konteks3);
                $konteks4 = explode('|', $stage2laporanaudit->konteks4);
                $kepemimpinan1 = explode('|', $stage2laporanaudit->kepemimpinan1);
                $kepemimpinan2 = explode('|', $stage2laporanaudit->kepemimpinan2);
                $kepemimpinan3 = explode('|', $stage2laporanaudit->kepemimpinan3);
                $perencanaan1 = explode('|', $stage2laporanaudit->perencanaan1);
                $perencanaan2 = explode('|', $stage2laporanaudit->perencanaan2);
                $perencanaan3 = explode('|', $stage2laporanaudit->perencanaan3);
                $dukungan1 = explode('|', $stage2laporanaudit->dukungan1);
                $dukungan2 = explode('|', $stage2laporanaudit->dukungan2);
                $dukungan3 = explode('|', $stage2laporanaudit->dukungan3);
                $dukungan4 = explode('|', $stage2laporanaudit->dukungan4);
                $dukungan5 = explode('|', $stage2laporanaudit->dukungan5);
                $operasi1 = explode('|', $stage2laporanaudit->operasi1);
                $operasi2 = explode('|', $stage2laporanaudit->operasi2);
                $operasi3 = explode('|', $stage2laporanaudit->operasi3);
                $operasi4 = explode('|', $stage2laporanaudit->operasi4);
                $operasi5 = explode('|', $stage2laporanaudit->operasi5);
                $operasi6 = explode('|', $stage2laporanaudit->operasi6);
                $operasi7 = explode('|', $stage2laporanaudit->operasi7);
                $evaluasi1 = explode('|', $stage2laporanaudit->evaluasi1);
                $evaluasi2 = explode('|', $stage2laporanaudit->evaluasi2);
                $evaluasi3 = explode('|', $stage2laporanaudit->evaluasi3);
                $peningkatan1 = explode('|', $stage2laporanaudit->peningkatan1);
                $peningkatan2 = explode('|', $stage2laporanaudit->peningkatan2);
                $peningkatan3 = explode('|', $stage2laporanaudit->peningkatan3);

                $konteks1_1 = explode('|', $stage2laporanaudit->konteks1_1);
                $konteks1_2 = explode('|', $stage2laporanaudit->konteks1_2);
                $konteks1_3 = explode('|', $stage2laporanaudit->konteks1_3);
                $konteks1_4 = explode('|', $stage2laporanaudit->konteks1_4);
                $kepemimpinan1_1 = explode('|', $stage2laporanaudit->kepemimpinan1_1);
                $kepemimpinan1_2 = explode('|', $stage2laporanaudit->kepemimpinan1_2);
                $kepemimpinan1_3 = explode('|', $stage2laporanaudit->kepemimpinan1_3);
                $perencanaan1_1 = explode('|', $stage2laporanaudit->perencanaan1_1);
                $perencanaan1_2 = explode('|', $stage2laporanaudit->perencanaan1_2);
                $perencanaan1_3 = explode('|', $stage2laporanaudit->perencanaan1_3);
                $dukungan1_1 = explode('|', $stage2laporanaudit->dukungan1_1);
                $dukungan1_2 = explode('|', $stage2laporanaudit->dukungan1_2);
                $dukungan1_3 = explode('|', $stage2laporanaudit->dukungan1_3);
                $dukungan1_4 = explode('|', $stage2laporanaudit->dukungan1_4);
                $dukungan1_5 = explode('|', $stage2laporanaudit->dukungan1_5);
                $operasi1_1 = explode('|', $stage2laporanaudit->operasi1_1);
                $operasi1_2 = explode('|', $stage2laporanaudit->operasi1_2);
                $operasi1_3 = explode('|', $stage2laporanaudit->operasi1_3);
                $operasi1_4 = explode('|', $stage2laporanaudit->operasi1_4);
                $operasi1_5 = explode('|', $stage2laporanaudit->operasi1_5);
                $operasi1_6 = explode('|', $stage2laporanaudit->operasi1_6);
                $operasi1_7 = explode('|', $stage2laporanaudit->operasi1_7);
                $evaluasi1_1 = explode('|', $stage2laporanaudit->evaluasi1_1);
                $evaluasi1_2 = explode('|', $stage2laporanaudit->evaluasi1_2);
                $evaluasi1_3 = explode('|', $stage2laporanaudit->evaluasi1_3);
                $peningkatan1_1 = explode('|', $stage2laporanaudit->peningkatan1_1);
                $peningkatan1_2 = explode('|', $stage2laporanaudit->peningkatan1_2);
                $peningkatan1_3 = explode('|', $stage2laporanaudit->peningkatan1_3);

                return view('dashboard.stage2laporanauditedit', [
                    'title_bar'                 => 'Laporan Audit',
                    'client'                    => $client,
                    'listpermohonan_id'         => $listpermohonan_id,
                    'permohonansertifikasi'     => $client->permohonansertifikasi_data($idsertifikasi)->first(),
                    'kajianclient'              => $client->kajianclient_data($idsertifikasi)->first(),
                    'perjanjianclient'          => $client->perjanjianclient_data($idsertifikasi)->first(),
                    'rencanaclient'             => $client->rencanaclient_data($idsertifikasi)->first(),
                    'stage1penunjukantimaudit'  => $client->stage1penunjukantimaudit_data($listpermohonan)->first(),
                    'stage2rencanaaudit'        => $client->stage2rencanaaudit_data($listpermohonan)->first(),
                    'stage2checkaudit'          => $client->stage2checkaudit_data($listpermohonan)->first(),
                    'stage2daftarhadiraudit'    => $client->stage2daftarhadiraudit_data($listpermohonan)->first(),
                    'stage2laporanaudit'        => $client->stage2laporanaudit_data($listpermohonan)->first(),
                    'konteks1'                  => $konteks1,
                    'konteks2'                  => $konteks2,
                    'konteks3'                  => $konteks3,
                    'konteks4'                  => $konteks4,
                    'kepemimpinan1'             => $kepemimpinan1,
                    'kepemimpinan2'             => $kepemimpinan2,
                    'kepemimpinan3'             => $kepemimpinan3,
                    'kepemimpinan3'             => $kepemimpinan3,
                    'perencanaan1'              => $perencanaan1,
                    'perencanaan2'              => $perencanaan2,
                    'perencanaan3'              => $perencanaan3,
                    'dukungan1'                 => $dukungan1,
                    'dukungan2'                 => $dukungan2,
                    'dukungan3'                 => $dukungan3,
                    'dukungan4'                 => $dukungan4,
                    'dukungan5'                 => $dukungan5,
                    'operasi1'                  => $operasi1,
                    'operasi2'                  => $operasi2,
                    'operasi3'                  => $operasi3,
                    'operasi4'                  => $operasi4,
                    'operasi5'                  => $operasi5,
                    'operasi6'                  => $operasi6,
                    'operasi7'                  => $operasi7,
                    'evaluasi1'                 => $evaluasi1,
                    'evaluasi2'                 => $evaluasi2,
                    'evaluasi3'                 => $evaluasi3,
                    'peningkatan1'              => $peningkatan1,
                    'peningkatan2'              => $peningkatan2,
                    'peningkatan3'              => $peningkatan3,
                    'roles'                     => $roles,
                    'konteks1_1'                => $konteks1_1,
                    'konteks1_2'                => $konteks1_2,
                    'konteks1_3'                => $konteks1_3,
                    'konteks1_4'                => $konteks1_4,
                    'kepemimpinan1_1'           => $kepemimpinan1_1,
                    'kepemimpinan1_2'           => $kepemimpinan1_2,
                    'kepemimpinan1_3'           => $kepemimpinan1_3,
                    'perencanaan1_1'            => $perencanaan1_1,
                    'perencanaan1_2'            => $perencanaan1_2,
                    'perencanaan1_3'            => $perencanaan1_3,
                    'dukungan1_1'               => $dukungan1_1,
                    'dukungan1_2'               => $dukungan1_2,
                    'dukungan1_3'               => $dukungan1_3,
                    'dukungan1_4'               => $dukungan1_4,
                    'dukungan1_5'               => $dukungan1_5,
                    'operasi1_1'                => $operasi1_1,
                    'operasi1_2'                => $operasi1_2,
                    'operasi1_3'                => $operasi1_3,
                    'operasi1_4'                => $operasi1_4,
                    'operasi1_5'                => $operasi1_5,
                    'operasi1_6'                => $operasi1_6,
                    'operasi1_7'                => $operasi1_7,
                    'evaluasi1_1'               => $evaluasi1_1,
                    'evaluasi1_2'               => $evaluasi1_2,
                    'evaluasi1_3'               => $evaluasi1_3,
                    'peningkatan1_1'            => $peningkatan1_1,
                    'peningkatan1_2'            => $peningkatan1_2,
                    'peningkatan1_3'            => $peningkatan1_3,
                    'roles'                     => $roles,
                    'arraudit'                  => $arraudit ?? '',
                ]);
            } else {
                return view('dashboard.stage2laporanauditedit', [
                    'title_bar'                 => 'Laporan Audit',
                    'client'                    => $client,
                    'listpermohonan_id'         => $listpermohonan_id,
                    'permohonansertifikasi'     => $client->permohonansertifikasi_data($idsertifikasi)->first(),
                    'kajianclient'              => $client->kajianclient_data($idsertifikasi)->first(),
                    'perjanjianclient'          => $client->perjanjianclient_data($idsertifikasi)->first(),
                    'rencanaclient'             => $client->rencanaclient_data($idsertifikasi)->first(),
                    'stage1penunjukantimaudit'  => $client->stage1penunjukantimaudit_data($listpermohonan)->first(),
                    'stage2rencanaaudit'        => $client->stage2rencanaaudit_data($listpermohonan)->first(),
                    'stage2checkaudit'          => $client->stage2checkaudit_data($listpermohonan)->first(),
                    'stage2daftarhadiraudit'    => $client->stage2daftarhadiraudit_data($listpermohonan)->first(),
                    'stage2laporanaudit'        => $client->stage2laporanaudit_data($listpermohonan)->first(),
                    'roles'                     => $roles,
                    'arraudit'                  => $arraudit ?? '',
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
        $stage2laporanaudit = $client->stage2laporanaudit_data($listpermohonan)->first();

        $data = $request->validate([
            'client_id'                     => 'required',
            'listpermohonan_id'             => 'required',
            'jumlahtemuan_1'           => 'required',
            'major_2'           => 'required',
            'rencanakunjungan_3'           => 'required',
            'observasi_4'           => 'required',
            'rekomendasi'           => 'required',
            'rl_akreditasi1'           => 'required',
            'rl_jmlsertifikat1'           => 'required',
            'rl_bahasa1'           => 'required',
            'ra1_major'           => 'required',
            'ra1_minor'           => 'required',
            'ra2_major'           => 'required',
            'ra2_minor'           => 'required',
            'ra3_major'           => 'required',
            'ra3_minor'           => 'required',
            'ro_uraian1'           => 'required',
            'ro_uraian2'           => 'required',
            'ro_uraian3'           => 'required',
            'ro_uraian4'           => 'required',
            'kha_1'           => 'required',
            'pai_kapanpelaksanaan'           => 'required',
            'pai_jumlahtemuan'           => 'required',
            'pai_apakahtemuan'           => 'required',
            'pai_jumlahyangbelum'           => 'required',
            'pai_apakahaudit'           => 'required',
            'pai_apakahpelaksanaan'           => 'required',
            'kum_kapanpelaksanaan'           => 'required',
            'kum_apakahkaji'           => 'required',
            'kum_apakahinput'           => 'required',
            'kum_apakahpelaksanaan'           => 'required',
            'ls_sebutkanlingkup'           => 'required',
            'ls_apakahruang'           => 'required',
            'ls_jikatidak'           => 'required',
        ]);

        $data['rl_akreditasi2'] = $request->rl_akreditasi2;
        $data['rl_jmlsertifikat2'] = $request->rl_jmlsertifikat2;
        $data['rl_bahasa2'] = $request->rl_bahasa2;
        $data['rl_akreditasi3'] = $request->rl_akreditasi3;
        $data['rl_jmlsertifikat3'] = $request->rl_jmlsertifikat3;
        $data['rl_bahasa3'] = $request->rl_bahasa3;
        $data['tanggal_ttd'] = $request->tanggal_ttd;
        $data['nama_auditorttd'] = $request->nama_auditorttd;

        $data['konteks1'] = $request->konteks1 ? implode('|', $request->konteks1) : '';
        $data['konteks2'] = $request->konteks2 ? implode('|', $request->konteks2) : '';
        $data['konteks3'] = $request->konteks3 ? implode('|', $request->konteks3) : '';
        $data['konteks4'] = $request->konteks4 ? implode('|', $request->konteks4) : '';
        $data['kepemimpinan1'] = $request->kepemimpinan1 ? implode('|', $request->kepemimpinan1) : '';
        $data['kepemimpinan2'] = $request->kepemimpinan2 ? implode('|', $request->kepemimpinan2) : '';
        $data['kepemimpinan3'] = $request->kepemimpinan3 ? implode('|', $request->kepemimpinan3) : '';
        $data['perencanaan1'] = $request->perencanaan1 ? implode('|', $request->perencanaan1) : '';
        $data['perencanaan2'] = $request->perencanaan2 ? implode('|', $request->perencanaan2) : '';
        $data['perencanaan3'] = $request->perencanaan3 ? implode('|', $request->perencanaan3) : '';
        $data['dukungan1'] = $request->dukungan1 ? implode('|', $request->dukungan1) : '';
        $data['dukungan2'] = $request->dukungan2 ? implode('|', $request->dukungan2) : '';
        $data['dukungan3'] = $request->dukungan3 ? implode('|', $request->dukungan3) : '';
        $data['dukungan4'] = $request->dukungan4 ? implode('|', $request->dukungan4) : '';
        $data['dukungan5'] = $request->dukungan5 ? implode('|', $request->dukungan5) : '';
        $data['operasi1'] = $request->operasi1 ? implode('|', $request->operasi1) : '';
        $data['operasi2'] = $request->operasi2 ? implode('|', $request->operasi2) : '';
        $data['operasi3'] = $request->operasi3 ? implode('|', $request->operasi3) : '';
        $data['operasi4'] = $request->operasi4 ? implode('|', $request->operasi4) : '';
        $data['operasi5'] = $request->operasi5 ? implode('|', $request->operasi5) : '';
        $data['operasi6'] = $request->operasi6 ? implode('|', $request->operasi6) : '';
        $data['operasi7'] = $request->operasi7 ? implode('|', $request->operasi7) : '';
        $data['evaluasi1'] = $request->evaluasi1 ? implode('|', $request->evaluasi1) : '';
        $data['evaluasi2'] = $request->evaluasi2 ? implode('|', $request->evaluasi2) : '';
        $data['evaluasi3'] = $request->evaluasi3 ? implode('|', $request->evaluasi3) : '';
        $data['peningkatan1'] = $request->peningkatan1 ? implode('|', $request->peningkatan1) : '';
        $data['peningkatan2'] = $request->peningkatan2 ? implode('|', $request->peningkatan2) : '';
        $data['peningkatan3'] = $request->peningkatan3 ? implode('|', $request->peningkatan3) : '';

        $data['konteks1_1'] = $request->konteks1_1 ? implode('|', $request->konteks1_1) : '';
        $data['konteks1_2'] = $request->konteks1_2 ? implode('|', $request->konteks1_2) : '';
        $data['konteks1_3'] = $request->konteks1_3 ? implode('|', $request->konteks1_3) : '';
        $data['konteks1_4'] = $request->konteks1_4 ? implode('|', $request->konteks1_4) : '';
        $data['kepemimpinan1_1'] = $request->kepemimpinan1_1 ? implode('|', $request->kepemimpinan1_1) : '';
        $data['kepemimpinan1_2'] = $request->kepemimpinan1_2 ? implode('|', $request->kepemimpinan1_2) : '';
        $data['kepemimpinan1_3'] = $request->kepemimpinan1_3 ? implode('|', $request->kepemimpinan1_3) : '';
        $data['perencanaan1_1'] = $request->perencanaan1_1 ? implode('|', $request->perencanaan1_1) : '';
        $data['perencanaan1_2'] = $request->perencanaan1_2 ? implode('|', $request->perencanaan1_2) : '';
        $data['perencanaan1_3'] = $request->perencanaan1_3 ? implode('|', $request->perencanaan1_3) : '';
        $data['dukungan1_1'] = $request->dukungan1_1 ? implode('|', $request->dukungan1_1) : '';
        $data['dukungan1_2'] = $request->dukungan1_2 ? implode('|', $request->dukungan1_2) : '';
        $data['dukungan1_3'] = $request->dukungan1_3 ? implode('|', $request->dukungan1_3) : '';
        $data['dukungan1_4'] = $request->dukungan1_4 ? implode('|', $request->dukungan1_4) : '';
        $data['dukungan1_5'] = $request->dukungan1_5 ? implode('|', $request->dukungan1_5) : '';
        $data['operasi1_1'] = $request->operasi1_1 ? implode('|', $request->operasi1_1) : '';
        $data['operasi1_2'] = $request->operasi1_2 ? implode('|', $request->operasi1_2) : '';
        $data['operasi1_3'] = $request->operasi1_3 ? implode('|', $request->operasi1_3) : '';
        $data['operasi1_4'] = $request->operasi1_4 ? implode('|', $request->operasi1_4) : '';
        $data['operasi1_5'] = $request->operasi1_5 ? implode('|', $request->operasi1_5) : '';
        $data['operasi1_6'] = $request->operasi1_6 ? implode('|', $request->operasi1_6) : '';
        $data['operasi1_7'] = $request->operasi1_7 ? implode('|', $request->operasi1_7) : '';
        $data['evaluasi1_1'] = $request->evaluasi1_1 ? implode('|', $request->evaluasi1_1) : '';
        $data['evaluasi1_2'] = $request->evaluasi1_2 ? implode('|', $request->evaluasi1_2) : '';
        $data['evaluasi1_3'] = $request->evaluasi1_3 ? implode('|', $request->evaluasi1_3) : '';
        $data['peningkatan1_1'] = $request->peningkatan1_1 ? implode('|', $request->peningkatan1_1) : '';
        $data['peningkatan1_2'] = $request->peningkatan1_2 ? implode('|', $request->peningkatan1_2) : '';
        $data['peningkatan1_3'] = $request->peningkatan1_3 ? implode('|', $request->peningkatan1_3) : '';

        Stage2laporanaudit::where('id', $stage2laporanaudit->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-08 - Laporan Audit.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $stage2laporanaudit = $client->stage2laporanaudit_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Stage2laporanaudit::where('id', $stage2laporanaudit->id)->update($data);

        // sent email client
        $log = 'Stage II Laporan Audit';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $stage2laporanaudit->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Stage II Laporan Audit';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $stage2laporanaudit->dipending_keterangan ?? '',
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
                $log = 'Stage II Laporan Audit';
                $auditordata = [
                    'user' => $item,
                    'client' => $client,
                    'permohonan' => $permohonan,
                    'log' => $log,
                    'status' => $request->status,
                    'keterangan' => '',
                    'dipending_keterangandata' => $stage2laporanaudit->dipending_keterangan ?? '',
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

    public function download(Stage2laporanaudit $stage2laporanaudit)
    {
        $clientdata = Client::where('id', $stage2laporanaudit->client_id)->first();

        $setting = Setting::firstWhere('id', 1);

        $listpermohonan_data = Listpermohonan::get();
        $idsertifikasi = '';
        for ($i = $stage2laporanaudit->listpermohonan_id; $i >= 1; $i--) {
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

        $stage1penunjukantimaudit = $clientdata->stage1penunjukantimaudit_data($stage2laporanaudit->listpermohonan_id)->first();
        $arraudit = explode('|', $stage1penunjukantimaudit->audit);

        if ($stage2laporanaudit != '') {
            $konteks1 = explode('|', $stage2laporanaudit->konteks1);
            $konteks2 = explode('|', $stage2laporanaudit->konteks2);
            $konteks3 = explode('|', $stage2laporanaudit->konteks3);
            $konteks4 = explode('|', $stage2laporanaudit->konteks4);
            $kepemimpinan1 = explode('|', $stage2laporanaudit->kepemimpinan1);
            $kepemimpinan2 = explode('|', $stage2laporanaudit->kepemimpinan2);
            $kepemimpinan3 = explode('|', $stage2laporanaudit->kepemimpinan3);
            $perencanaan1 = explode('|', $stage2laporanaudit->perencanaan1);
            $perencanaan2 = explode('|', $stage2laporanaudit->perencanaan2);
            $perencanaan3 = explode('|', $stage2laporanaudit->perencanaan3);
            $dukungan1 = explode('|', $stage2laporanaudit->dukungan1);
            $dukungan2 = explode('|', $stage2laporanaudit->dukungan2);
            $dukungan3 = explode('|', $stage2laporanaudit->dukungan3);
            $dukungan4 = explode('|', $stage2laporanaudit->dukungan4);
            $dukungan5 = explode('|', $stage2laporanaudit->dukungan5);
            $operasi1 = explode('|', $stage2laporanaudit->operasi1);
            $operasi2 = explode('|', $stage2laporanaudit->operasi2);
            $operasi3 = explode('|', $stage2laporanaudit->operasi3);
            $operasi4 = explode('|', $stage2laporanaudit->operasi4);
            $operasi5 = explode('|', $stage2laporanaudit->operasi5);
            $operasi6 = explode('|', $stage2laporanaudit->operasi6);
            $operasi7 = explode('|', $stage2laporanaudit->operasi7);
            $evaluasi1 = explode('|', $stage2laporanaudit->evaluasi1);
            $evaluasi2 = explode('|', $stage2laporanaudit->evaluasi2);
            $evaluasi3 = explode('|', $stage2laporanaudit->evaluasi3);
            $peningkatan1 = explode('|', $stage2laporanaudit->peningkatan1);
            $peningkatan2 = explode('|', $stage2laporanaudit->peningkatan2);
            $peningkatan3 = explode('|', $stage2laporanaudit->peningkatan3);

            $konteks1_1 = explode('|', $stage2laporanaudit->konteks1_1);
            $konteks1_2 = explode('|', $stage2laporanaudit->konteks1_2);
            $konteks1_3 = explode('|', $stage2laporanaudit->konteks1_3);
            $konteks1_4 = explode('|', $stage2laporanaudit->konteks1_4);
            $kepemimpinan1_1 = explode('|', $stage2laporanaudit->kepemimpinan1_1);
            $kepemimpinan1_2 = explode('|', $stage2laporanaudit->kepemimpinan1_2);
            $kepemimpinan1_3 = explode('|', $stage2laporanaudit->kepemimpinan1_3);
            $perencanaan1_1 = explode('|', $stage2laporanaudit->perencanaan1_1);
            $perencanaan1_2 = explode('|', $stage2laporanaudit->perencanaan1_2);
            $perencanaan1_3 = explode('|', $stage2laporanaudit->perencanaan1_3);
            $dukungan1_1 = explode('|', $stage2laporanaudit->dukungan1_1);
            $dukungan1_2 = explode('|', $stage2laporanaudit->dukungan1_2);
            $dukungan1_3 = explode('|', $stage2laporanaudit->dukungan1_3);
            $dukungan1_4 = explode('|', $stage2laporanaudit->dukungan1_4);
            $dukungan1_5 = explode('|', $stage2laporanaudit->dukungan1_5);
            $operasi1_1 = explode('|', $stage2laporanaudit->operasi1_1);
            $operasi1_2 = explode('|', $stage2laporanaudit->operasi1_2);
            $operasi1_3 = explode('|', $stage2laporanaudit->operasi1_3);
            $operasi1_4 = explode('|', $stage2laporanaudit->operasi1_4);
            $operasi1_5 = explode('|', $stage2laporanaudit->operasi1_5);
            $operasi1_6 = explode('|', $stage2laporanaudit->operasi1_6);
            $operasi1_7 = explode('|', $stage2laporanaudit->operasi1_7);
            $evaluasi1_1 = explode('|', $stage2laporanaudit->evaluasi1_1);
            $evaluasi1_2 = explode('|', $stage2laporanaudit->evaluasi1_2);
            $evaluasi1_3 = explode('|', $stage2laporanaudit->evaluasi1_3);
            $peningkatan1_1 = explode('|', $stage2laporanaudit->peningkatan1_1);
            $peningkatan1_2 = explode('|', $stage2laporanaudit->peningkatan1_2);
            $peningkatan1_3 = explode('|', $stage2laporanaudit->peningkatan1_3);
        }

        $pdf = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.stage2laporanauditDownload', [
                'title_bar'                     => 'Download',
                'stage2laporanaudit'            => $stage2laporanaudit,
                'client'                        => $clientdata,
                'permohonansertifikasi'         => $clientdata->permohonansertifikasi_data($idsertifikasi)->first(),
                'kajianclient'                  => $clientdata->kajianclient_data($idsertifikasi)->first(),
                'perjanjianclient'              => $clientdata->perjanjianclient_data($idsertifikasi)->first(),
                'rencanaclient'                 => $clientdata->rencanaclient_data($idsertifikasi)->first(),
                'stage1kajiantimaudit'          => $clientdata->stage1kajiantimaudit_data($stage2laporanaudit->listpermohonan_id)->first(),
                'stage1penunjukantimaudit'      => $clientdata->stage1penunjukantimaudit_data($stage2laporanaudit->listpermohonan_id)->first(),
                'setting'                       => $setting,
                'arraudit'                      => $arraudit,
                'konteks1'                      => $konteks1,
                'konteks2'                      => $konteks2,
                'konteks3'                      => $konteks3,
                'konteks4'                      => $konteks4,
                'kepemimpinan1'                 => $kepemimpinan1,
                'kepemimpinan2'                 => $kepemimpinan2,
                'kepemimpinan3'                 => $kepemimpinan3,
                'kepemimpinan3'                 => $kepemimpinan3,
                'perencanaan1'                  => $perencanaan1,
                'perencanaan2'                  => $perencanaan2,
                'perencanaan3'                  => $perencanaan3,
                'dukungan1'                     => $dukungan1,
                'dukungan2'                     => $dukungan2,
                'dukungan3'                     => $dukungan3,
                'dukungan4'                     => $dukungan4,
                'dukungan5'                     => $dukungan5,
                'operasi1'                      => $operasi1,
                'operasi2'                      => $operasi2,
                'operasi3'                      => $operasi3,
                'operasi4'                      => $operasi4,
                'operasi5'                      => $operasi5,
                'operasi6'                      => $operasi6,
                'operasi7'                      => $operasi7,
                'evaluasi1'                     => $evaluasi1,
                'evaluasi2'                     => $evaluasi2,
                'evaluasi3'                     => $evaluasi3,
                'peningkatan1'                  => $peningkatan1,
                'peningkatan2'                  => $peningkatan2,
                'peningkatan3'                  => $peningkatan3,
                'konteks1_1'                    => $konteks1_1,
                'konteks1_2'                    => $konteks1_2,
                'konteks1_3'                    => $konteks1_3,
                'konteks1_4'                    => $konteks1_4,
                'kepemimpinan1_1'               => $kepemimpinan1_1,
                'kepemimpinan1_2'               => $kepemimpinan1_2,
                'kepemimpinan1_3'               => $kepemimpinan1_3,
                'perencanaan1_1'                => $perencanaan1_1,
                'perencanaan1_2'                => $perencanaan1_2,
                'perencanaan1_3'                => $perencanaan1_3,
                'dukungan1_1'                   => $dukungan1_1,
                'dukungan1_2'                   => $dukungan1_2,
                'dukungan1_3'                   => $dukungan1_3,
                'dukungan1_4'                   => $dukungan1_4,
                'dukungan1_5'                   => $dukungan1_5,
                'operasi1_1'                    => $operasi1_1,
                'operasi1_2'                    => $operasi1_2,
                'operasi1_3'                    => $operasi1_3,
                'operasi1_4'                    => $operasi1_4,
                'operasi1_5'                    => $operasi1_5,
                'operasi1_6'                    => $operasi1_6,
                'operasi1_7'                    => $operasi1_7,
                'evaluasi1_1'                   => $evaluasi1_1,
                'evaluasi1_2'                   => $evaluasi1_2,
                'evaluasi1_3'                   => $evaluasi1_3,
                'peningkatan1_1'                => $peningkatan1_1,
                'peningkatan1_2'                => $peningkatan1_2,
                'peningkatan1_3'                => $peningkatan1_3,
            ]);
        return $pdf->stream();
    }
}
