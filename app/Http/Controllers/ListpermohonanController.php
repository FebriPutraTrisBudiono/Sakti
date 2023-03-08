<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Evaluasisatusiklussertifikasi;
use App\Models\Setting;
use App\Models\Permohonan;
use App\Models\Kajianclient;
use Illuminate\Http\Request;
use App\Models\Rencanaclient;
use ZanySoft\Zip\Facades\Zip;
use App\Models\Listpermohonan;
use App\Models\Memopenerbitansertifikasi;
use App\Models\Reviewkeputusansertifikasi;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Stage1checkaudit;
use App\Models\Stage2checkaudit;
use App\Models\Stage2rencanaaudit;
use App\Models\Stage1kajiantimaudit;
use Illuminate\Support\Facades\File;
use App\Models\Stage2daftarhadiraudit;
use App\Models\Stage2rencanaaudititem;
use App\Models\Stage1penunjukantimaudit;
use App\Models\Stage2daftarhadiraudititem;
use App\Models\Stage2ketidaksesuaianpage;
use App\Models\Stage2laporanaudit;
use App\Models\Stage2surveikepuasancustomer;

class ListpermohonanController extends Controller
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
            'client_id' => 'required',
            'proses_sertifikasi' => 'required',
        ]);

        if ($request->proses_sertifikasi == 'Sertifikasi Awal ISO 9001/21001') {
            $data['slug'] = 'sertifikasi_awal';
        } else if ($request->proses_sertifikasi == 'Surveilance I') {
            $data['slug'] = 'surveilance1';
        } else if ($request->proses_sertifikasi == 'Surveilance II') {
            $data['slug'] = 'surveilance2';
        } else if ($request->proses_sertifikasi == 'Re Sertifikasi') {
            $data['slug'] = 'resertifikasi';
        }

        Listpermohonan::create($data);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function document(Client $client, $id)
    {
        set_time_limit(240);

        $listpermohonan = Listpermohonan::firstWhere('id', $id);
        $zip_filename = $client->user->name .  '-' . $client->idclient . '-' . str_replace(' ', '_', $listpermohonan->proses_sertifikasi) . '.zip';
        File::deleteDirectory('pdf');
        File::makeDirectory('pdf');
        $this->download_permohonansertifikasi($client, $id);
        $this->download_kajianpermohonan($client, $id);
        $this->download_perjanjiansertifikasi($client, $id);
        $this->download_rencanaclient($client, $id);
        $this->download_stage1kajiantimaudit($client, $id);
        $this->download_stage1penunjukantimaudit($client, $id);
        $this->download_stage1checkaudit($client, $id);
        $this->download_stage2rencanaaudit($client, $id);
        $this->download_stage2checkaudit($client, $id);
        $this->download_stage2daftarhadiraudit($client, $id);
        $this->download_stage2laporanaudit($client, $id);
        $this->download_stage2ketidaksesuaianpage($client, $id);
        $this->download_stage2surveikepuasancustomer($client, $id);
        $this->download_reviewkeputusansertifikasi($client, $id);
        $this->download_memopenerbitansertifikasi($client, $id);
        $this->download_evaluasisatusiklussertifikasi($client, $id);
        $zip = Zip::create('pdf/' . $zip_filename);
        if ($listpermohonan->slug == 'sertifikasi_awal') {
            $zip->setPath('pdf')->add([
                'F-CER-01 Permohonan Sertifikasi.pdf',
                'F-CER-02 Kajian Permohonan.pdf',
                'DOC-CER-01 Kontrak Sertifikasi.pdf',
                'F-CER-03 Rencana Siklus Sertifikasi.pdf',
                'F-CER-39 Kajian Tim Audit.pdf',
                'F-CER-04 Penunjukan Tim Audit.pdf',
                'F-CER-06 Check List Audit Stage 1.pdf',
                'F-CER-05 Rencana Audit.pdf',
                'F-CER-06B Check List Audit Stage II.pdf',
                'F-CER-07 Daftar Hadir Tim Audit.pdf',
                'F-CER-08 Laporan Audit.pdf',
                'F-CER-09 Lembar Ketidaksesuaian.pdf',
                'F-CER-10 Survei Kepuasan Pelanggan.pdf',
                'F-CER-11 Review Keputusan Sertifikasi.pdf',
                'F-CER-12 Memo Penerbitan Sertifikasi.pdf',
            ]);
        } else if ($listpermohonan->slug == 'surveilance1' || $listpermohonan->slug == 'surveilance2') {
            $zip->setPath('pdf')->add([
                'F-CER-39 Kajian Tim Audit.pdf',
                'F-CER-04 Penunjukan Tim Audit.pdf',
                'F-CER-05 Rencana Audit.pdf',
                'F-CER-06B Check List Audit Stage II.pdf',
                'F-CER-07 Daftar Hadir Tim Audit.pdf',
                'F-CER-08 Laporan Audit.pdf',
                'F-CER-09 Lembar Ketidaksesuaian.pdf',
                'F-CER-10 Survei Kepuasan Pelanggan.pdf',
            ]);
        } else if ($listpermohonan->slug == 'resertifikasi') {
            $zip->setPath('pdf')->add([
                'F-CER-01 Permohonan Sertifikasi.pdf',
                'F-CER-02 Kajian Permohonan.pdf',
                'DOC-CER-01 Kontrak Sertifikasi.pdf',
                'F-CER-03 Rencana Siklus Sertifikasi.pdf',
                'F-CER-39 Kajian Tim Audit.pdf',
                'F-CER-04 Penunjukan Tim Audit.pdf',
                'F-CER-06 Check List Audit Stage 1.pdf',
                'F-CER-05 Rencana Audit.pdf',
                'F-CER-06B Check List Audit Stage II.pdf',
                'F-CER-07 Daftar Hadir Tim Audit.pdf',
                'F-CER-08 Laporan Audit.pdf',
                'F-CER-09 Lembar Ketidaksesuaian.pdf',
                'F-CER-10 Survei Kepuasan Pelanggan.pdf',
                'F-CER-11 Review Keputusan Sertifikasi.pdf',
                'F-CER-12 Memo Penerbitan Sertifikasi.pdf',
                'F-CER-13 Evaluasi Satu Siklus Sertifikasi.pdf'
            ]);
        }
        return redirect()->to(url('pdf/' . $zip_filename));
    }

    public function download_permohonansertifikasi($client, $id)
    {
        // Permohonan sertifikasi
        $setting = Setting::firstWhere('id', 1);
        $permohonansertifikasi = $client->permohonansertifikasi_data($id)->first();
        $pdf_permohonansertifikasi = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.permohonansertifikasiDownload', [
                'title_bar'                 => 'Download',
                'permohonan_sertifikasi'    => $permohonansertifikasi,
                'setting'                   => $setting
            ]);
        return $pdf_permohonansertifikasi->save('pdf/F-CER-01 Permohonan Sertifikasi.pdf');
    }

    public function download_kajianpermohonan($client, $id)
    {
        $kajianclient = Kajianclient::where('id', $client->id)->first();
        $permohonansertifikasi = $client->permohonansertifikasi_data($id)->first();

        $data = $kajianclient;
        $setting = Setting::firstWhere('id', 1);

        $pdf_kajianpermohonan = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.kajianpermohonanDownload', [
                'title_bar'                 => 'Download',
                'kajianclient'              => $data,
                'permohonansertifikasi'     => $permohonansertifikasi,
                'setting'                   => $setting,
                'hasil3_lead1'              => $kajianclient->hasil3_lead1,
                'hasil3_auditor1'           => $kajianclient->hasil3_auditor1,
                'hasil3_tenaga1'            => $kajianclient->hasil3_tenaga1,
                'hasil3_lead2'              => $kajianclient->hasil3_lead2,
                'hasil3_auditor2'           => $kajianclient->hasil3_auditor2,
                'hasil3_tenaga2'            => $kajianclient->hasil3_tenaga2,
                'hasil3_lead3'              => $kajianclient->hasil3_lead3,
                'hasil3_auditor3'           => $kajianclient->hasil3_auditor3,
                'hasil3_tenaga3'            => $kajianclient->hasil3_tenaga3,
            ]);
        return $pdf_kajianpermohonan->save('pdf/F-CER-02 Kajian Permohonan.pdf');
    }

    public function download_perjanjiansertifikasi($client, $id)
    {
        $kajianclient = Kajianclient::firstWhere('listpermohonan_id', $id);
        $setting = Setting::firstWhere('id', 1);

        $pdf_perjanjiansertifikasi = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.perjanjiansertifikasiDownload', [
                'title_bar'                 => 'Download',
                'kajianclient'              => $kajianclient,
                'setting'                   => $setting
            ]);
        return $pdf_perjanjiansertifikasi->save('pdf/DOC-CER-01 Kontrak Sertifikasi.pdf');
    }

    public function download_rencanaclient($client, $id)
    {
        $rencanaclient = Rencanaclient::firstWhere('listpermohonan_id', $id);
        $setting = Setting::firstWhere('id', 1);

        $klausul = $rencanaclient ? explode(',', $rencanaclient->klausul) : '';

        $pdf_rencanaclient = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.rencanaclientdownload', [
                'title_bar'                 => 'Download',
                'rencanaclient'             => $rencanaclient,
                'permohonansertifikasi'     => $client->permohonansertifikasi_data($id)->first(),
                'kajianclient'              => $client->kajianclient_data($id)->first(),
                'perjanjianclient'          => $client->perjanjianclient_data($id)->first(),
                'client'                    => $client,
                'setting'                   => $setting,
                'klausul'                   => $klausul,
            ]);
        return $pdf_rencanaclient->save('pdf/F-CER-03 Rencana Siklus Sertifikasi.pdf');
    }

    public function download_stage1kajiantimaudit($client, $id)
    {
        $stage1kajiantimaudit = Stage1kajiantimaudit::firstWhere('listpermohonan_id', $id);
        $setting = Setting::firstWhere('id', 1);

        $pdf_stage1kajiantimaudit = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.stage1kajiantimauditDownload', [
                'title_bar'                 => 'Download',
                'stage1kajiantimaudit'      => $stage1kajiantimaudit,
                'permohonansertifikasi'     => $client->permohonansertifikasi->where('listpermohonan_id', $id)->first(),
                'kajianclient'              => $client->kajianclient->where('listpermohonan_id', $id)->first(),
                'perjanjianclient'          => $client->perjanjianclient->where('listpermohonan_id', $id)->first(),
                'rencanaclient'             => $client->rencanaclient->where('listpermohonan_id', $id)->first(),
                'client'                    => $client,
                'setting'                   => $setting,
                'stage1kajiantimaudit'      => $stage1kajiantimaudit,
                'hasil3_lead1'              => $client->user->where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_lead1 ?? '')->first(),
                'hasil3_auditor1'           => $client->user->where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_auditor1 ?? '')->first(),
                'hasil3_tenaga1'            => $client->user->where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_tenaga1 ?? '')->first(),
                'hasil3_lead2'              => $client->user->where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_lead2 ?? '')->first(),
                'hasil3_auditor2'           => $client->user->where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_auditor2 ?? '')->first(),
                'hasil3_tenaga2'            => $client->user->where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_tenaga2 ?? '')->first(),
                'hasil3_lead3'              => $client->user->where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_lead3 ?? '')->first(),
                'hasil3_auditor3'           => $client->user->where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_auditor3 ?? '')->first(),
                'hasil3_tenaga3'            => $client->user->where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_tenaga3 ?? '')->first(),
            ]);
        return $pdf_stage1kajiantimaudit->save('pdf/F-CER-39 Kajian Tim Audit.pdf');
    }

    public function download_stage1penunjukantimaudit($client, $id)
    {
        $stage1penunjukantimaudit = Stage1penunjukantimaudit::firstWhere('listpermohonan_id', $id);
        $setting = Setting::firstWhere('id', 1);
        $arraudit = explode('|', $stage1penunjukantimaudit['audit']);

        $pdf_stage1penunjukantimaudit = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.stage1penunjukantimauditDownload', [
                'title_bar'                     => 'Download',
                'stage1penunjukantimaudit'      => $stage1penunjukantimaudit,
                'permohonanclient'              => $client->permohonansertifikasi_data($id)->first(),
                'kajianclient'                  => $client->kajianclient_data($id)->first(),
                'perjanjianclient'              => $client->perjanjianclient_data($id)->first(),
                'rencanaclient'                 => $client->rencanaclient_data($id)->first(),
                'client'                        => $client,
                'stage1kajiantimaudit'          => $client->stage1kajiantimaudit_data($id)->first(),
                'setting'                       => $setting,
                'audit'                         => $arraudit
            ]);
        return $pdf_stage1penunjukantimaudit->save('pdf/F-CER-04 Penunjukan Tim Audit.pdf');
    }

    public function download_stage1checkaudit($client, $id)
    {
        $stage1checkaudit = Stage1checkaudit::firstWhere('listpermohonan_id', $id);
        $setting = Setting::firstWhere('id', 1);

        $item = $client->stage1penunjukantimaudit_data($stage1checkaudit->listpermohonan_id)->first();
        $arraudit = explode('|', $item['audit']);

        $pdf_stage1checkaudit = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.stage1checkauditDownload', [
                'title_bar'                     => 'Download',
                'stage1checkaudit'              => $stage1checkaudit,
                'permohonansertifikasi'         => $client->permohonansertifikasi_data($id)->first(),
                'kajianclient'                  => $client->kajianclient_data($id)->first(),
                'perjanjianclient'              => $client->perjanjianclient_data($id)->first(),
                'rencanaclient'                 => $client->rencanaclient_data($id)->first(),
                'client'                        => $client,
                'stage1kajiantimaudit'          => $client->stage1kajiantimaudit_data($stage1checkaudit->listpermohonan_id)->first(),
                'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($stage1checkaudit->listpermohonan_id)->first(),
                'arraudit'                      => $arraudit,
                'setting'                       => $setting
            ]);
        return $pdf_stage1checkaudit->save('pdf/F-CER-06 Check List Audit Stage 1.pdf');
    }

    public function download_stage2rencanaaudit($client, $id)
    {
        $stage2rencanaaudit = Stage2rencanaaudit::firstWhere('listpermohonan_id', $id);
        $setting = Setting::firstWhere('id', 1);

        $stage2rencanaaudit_items = Stage2rencanaaudititem::where('stage2rencanaaudit_id', $stage2rencanaaudit->id)->get();

        $stage1penunjukantimaudit = Stage1penunjukantimaudit::where('listpermohonan_id', $stage2rencanaaudit->listpermohonan_id)->first();

        $arraudit = explode('|', $stage1penunjukantimaudit['audit']);

        $pdf_stage2rencanaaudit = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.stage2rencanaauditDownload', [
                'title_bar'                     => 'Download',
                'stage2rencanaaudit'            => $stage2rencanaaudit,
                'permohonansertifikasi'         => $client->permohonansertifikasi_data($id)->first(),
                'kajianclient'                  => $client->kajianclient_data($id)->first(),
                'perjanjianclient'              => $client->perjanjianclient_data($id)->first(),
                'rencanaclient'                 => $client->rencanaclient_data($id)->first(),
                'client'                        => $client,
                'stage1kajiantimaudit'          => $client->stage1kajiantimaudit_data($stage2rencanaaudit->listpermohonan_id)->first(),
                'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($stage2rencanaaudit->listpermohonan_id)->first(),
                'setting'                       => $setting,
                'arraudit'                      => $arraudit,
                'stage2rencanaaudit_items'      => $stage2rencanaaudit_items ?? '',
            ]);
        return $pdf_stage2rencanaaudit->save('pdf/F-CER-05 Rencana Audit.pdf');
    }

    public function download_stage2checkaudit($client, $id)
    {
        $stage2checkaudit = Stage2checkaudit::firstWhere('listpermohonan_id', $id);
        $setting = Setting::firstWhere('id', 1);

        if ($stage2checkaudit != '') {
            $doc_diuji = explode('|', $stage2checkaudit->doc_diuji);
            $klausul = explode('|', $stage2checkaudit->klausul);
            $maj = explode('|', $stage2checkaudit->maj);
            $min = explode('|', $stage2checkaudit->min);
            $obs = explode('|', $stage2checkaudit->obs);

            $pdf_stage2checkaudit = Pdf::setPaper('a4', 'potrait')
                ->loadView('dashboard.stage2checkauditDownload', [
                    'title_bar'                     => 'Download',
                    'stage2checkaudit'              => $stage2checkaudit,
                    'permohonansertifikasi'         => $client->permohonansertifikasi_data($id)->first(),
                    'kajianclient'                  => $client->kajianclient_data($id)->first(),
                    'perjanjianclient'              => $client->perjanjianclient_data($id)->first(),
                    'rencanaclient'                 => $client->rencanaclient_data($id)->first(),
                    'client'                        => $client,
                    'stage1kajiantimaudit'          => $client->stage1kajiantimaudit_data($stage2checkaudit->listpermohonan_id)->first(),
                    'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($stage2checkaudit->listpermohonan_id)->first(),
                    'setting'                       => $setting,
                    'doc_diuji'                     => $doc_diuji,
                    'maj'                           => $maj,
                    'klausul'                       => $klausul,
                    'min'                           => $min,
                    'obs'                           => $obs,
                ]);
            return $pdf_stage2checkaudit->save('pdf/F-CER-06B Check List Audit Stage II.pdf');
        } else {
            $pdf_stage2checkaudit = Pdf::setPaper('a4', 'potrait')
                ->loadView('dashboard.stage2checkauditDownload', [
                    'title_bar'                     => 'Download',
                    'stage2rencanaaudit'            => $stage2checkaudit,
                    'permohonansertifikasi'         => $client->permohonansertifikasi_data($id)->first(),
                    'kajianclient'                  => $client->kajianclient_data($id)->first(),
                    'perjanjianclient'              => $client->perjanjianclient_data($id)->first(),
                    'rencanaclient'                 => $client->rencanaclient_data($id)->first(),
                    'client'                        => $client,
                    'stage1kajiantimaudit'          => $client->stage1kajiantimaudit_data($stage2checkaudit->listpermohonan_id)->first(),
                    'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($stage2checkaudit->listpermohonan_id)->first(),
                    'setting'                       => $setting
                ]);
            return $pdf_stage2checkaudit->save('pdf/F-CER-06B Check List Audit Stage II.pdf');
        }
    }

    public function download_stage2daftarhadiraudit($client, $id)
    {
        $stage2daftarhadiraudit = Stage2daftarhadiraudit::firstWhere('listpermohonan_id', $id);
        $daftarhadiritem = Stage2daftarhadiraudititem::where('stage2daftarhadiraudit_id', $stage2daftarhadiraudit->id)->get();

        $setting = Setting::firstWhere('id', 1);

        $pdf_stage2daftarhadirtimaudit = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.stage2daftarhadirauditDownload', [
                'title_bar'                 => 'Daftar Hadir Audit',
                'permohonansertifikasi'     => $client->permohonansertifikasi_data($id)->first(),
                'kajianclient'              => $client->kajianclient_data($id)->first(),
                'perjanjianclient'          => $client->perjanjianclient_data($id)->first(),
                'rencanaclient'             => $client->rencanaclient_data($id)->first(),
                'stage2daftarhadiraudit'    => $stage2daftarhadiraudit,
                'daftarhadiritem'           => $daftarhadiritem ?? '',
                'setting'                   => $setting
            ]);
        return $pdf_stage2daftarhadirtimaudit->save('pdf/F-CER-07 Daftar Hadir Tim Audit.pdf');
    }

    public function download_stage2laporanaudit($client, $id)
    {
        $stage2laporanaudit = Stage2laporanaudit::firstWhere('listpermohonan_id', $id);
        $setting = Setting::firstWhere('id', 1);

        $stage1penunjukantimaudit = $client->stage1penunjukantimaudit_data($stage2laporanaudit->listpermohonan_id)->first();
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

        $pdf_stage2laporanaudit = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.stage2laporanauditDownload', [
                'title_bar'                     => 'Download',
                'stage2laporanaudit'            => $stage2laporanaudit,
                'client'                        => $client,
                'permohonansertifikasi'         => $client->permohonansertifikasi_data($id)->first(),
                'kajianclient'                  => $client->kajianclient_data($id)->first(),
                'perjanjianclient'              => $client->perjanjianclient_data($id)->first(),
                'rencanaclient'                 => $client->rencanaclient_data($id)->first(),
                'stage1kajiantimaudit'          => $client->stage1kajiantimaudit_data($stage2laporanaudit->listpermohonan_id)->first(),
                'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($stage2laporanaudit->listpermohonan_id)->first(),
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
        return $pdf_stage2laporanaudit->save('pdf/F-CER-08 Laporan Audit.pdf');
    }

    public function download_stage2ketidaksesuaianpage($client, $id)
    {
        $stage2ketidaksesuaianpage = Stage2ketidaksesuaianpage::firstWhere('listpermohonan_id', $id);
        $stage1penunjukantimaudit = Stage1penunjukantimaudit::where('listpermohonan_id', $stage2ketidaksesuaianpage->listpermohonan_id)->first();
        $arraudit = explode('|', $stage1penunjukantimaudit['audit']);

        $setting = Setting::firstWhere('id', 1);

        $pdf_stage2ketidaksesuaianpage = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.stage2ketidaksesuaianpageDownload', [
                'title_bar'                     => 'Download',
                'permohonansertifikasi'         => $client->permohonansertifikasi_data($id)->first(),
                'kajianclient'                  => $client->kajianclient_data($id)->first(),
                'perjanjianclient'              => $client->perjanjianclient_data($id)->first(),
                'rencanaclient'                 => $client->rencanaclient_data($id)->first(),
                'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($stage2ketidaksesuaianpage->listpermohonan_id)->first(),
                'stage2ketidaksesuaianpage'     => $client->stage2ketidaksesuaianpage_data($stage2ketidaksesuaianpage->listpermohonan_id)->first(),
                'setting'                       => $setting,
                'arraudit'                      => $arraudit,
            ]);
        return $pdf_stage2ketidaksesuaianpage->save('pdf/F-CER-09 Lembar Ketidaksesuaian.pdf');
    }

    public function download_stage2surveikepuasancustomer($client, $id)
    {
        $stage2surveikepuasancustomer = Stage2surveikepuasancustomer::firstWhere('listpermohonan_id', $id);
        $setting = Setting::firstWhere('id', 1);

        if ($stage2surveikepuasancustomer != '') {
            $auditor = explode('|', $stage2surveikepuasancustomer->auditor);
            $indikator1 = explode('|', $stage2surveikepuasancustomer->indikator1);
            $indikator2 = explode('|', $stage2surveikepuasancustomer->indikator2);
            $indikator3 = explode('|', $stage2surveikepuasancustomer->indikator3);
            $indikator4 = explode('|', $stage2surveikepuasancustomer->indikator4);
            $indikator5 = explode('|', $stage2surveikepuasancustomer->indikator5);
            $indikator6 = explode('|', $stage2surveikepuasancustomer->indikator6);

            $pdf_stage2surveikepuasancustomer = Pdf::setPaper('a4', 'potrait')
                ->loadView('dashboard.stage2surveikepuasancustomerDownload', [
                    'title_bar'                     => 'Download',
                    'stage2surveikepuasancustomer'  => $stage2surveikepuasancustomer,
                    'permohonansertifikasi'         => $client->permohonansertifikasi_data($id)->first(),
                    'kajianclient'                  => $client->kajianclient_data($id)->first(),
                    'perjanjianclient'              => $client->perjanjianclient_data($id)->first(),
                    'rencanaclient'                 => $client->rencanaclient_data($id)->first(),
                    'client'                        => $client,
                    'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($stage2surveikepuasancustomer->listpermohonan_id)->first(),
                    'setting'                       => $setting,
                    'auditor'                       => $auditor,
                    'indikator1'                    => $indikator1,
                    'indikator2'                    => $indikator2,
                    'indikator3'                    => $indikator3,
                    'indikator4'                    => $indikator4,
                    'indikator5'                    => $indikator5,
                    'indikator6'                    => $indikator6,
                    'stage2checkaudit'              => $client->stage2checkaudit_data($stage2surveikepuasancustomer->listpermohonan_id)->first(),
                ]);
            return $pdf_stage2surveikepuasancustomer->save('pdf/F-CER-10 Survei Kepuasan Pelanggan.pdf');
        } else {
            $pdf_stage2surveikepuasancustomer = Pdf::setPaper('a4', 'potrait')
                ->loadView('dashboard.stage2surveikepuasancustomerDownload', [
                    'title_bar'                     => 'Download',
                    'stage2surveikepuasancustomer'  => $stage2surveikepuasancustomer,
                    'permohonansertifikasi'         => $client->permohonansertifikasi_data($id)->first(),
                    'kajianclient'                  => $client->kajianclient_data($id)->first(),
                    'perjanjianclient'              => $client->perjanjianclient_data($id)->first(),
                    'rencanaclient'                 => $client->rencanaclient_data($id)->first(),
                    'client'                        => $client,
                    'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($stage2surveikepuasancustomer->listpermohonan_id)->first(),
                    'setting'                       => $setting
                ]);
            return $pdf_stage2surveikepuasancustomer->save('pdf/F-CER-10 Survei Kepuasan Pelanggan.pdf');
        }
    }

    public function download_reviewkeputusansertifikasi($client, $id)
    {
        $reviewkeputusansertifikasi = Reviewkeputusansertifikasi::firstWhere('listpermohonan_id', $id);
        $setting = Setting::firstWhere('id', 1);

        $item = $client->stage1penunjukantimaudit_data($reviewkeputusansertifikasi->listpermohonan_id)->first();
        $arraudit = explode('|', $item['audit']);

        $pdf_reviewkeputusansertifikasi = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.reviewkeputusansertifikasiDownload', [
                'title_bar'                     => 'Download',
                'reviewkeputusansertifikasi'    => $reviewkeputusansertifikasi,
                'permohonansertifikasi'         => $client->permohonansertifikasi_data($reviewkeputusansertifikasi->listpermohonan_id)->first(),
                'kajianclient'                  => $client->kajianclient_data($reviewkeputusansertifikasi->listpermohonan_id)->first(),
                'perjanjianclient'              => $client->perjanjianclient_data($reviewkeputusansertifikasi->listpermohonan_id)->first(),
                'rencanaclient'                 => $client->rencanaclient_data($reviewkeputusansertifikasi->listpermohonan_id)->first(),
                'client'                        => $client,
                'arraudit'                      => $arraudit,
                'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($reviewkeputusansertifikasi->listpermohonan_id)->first(),
                'setting'                       => $setting
            ]);
        return $pdf_reviewkeputusansertifikasi->save('pdf/F-CER-11 Review Keputusan Sertifikasi.pdf');
    }

    public function download_memopenerbitansertifikasi($client, $id)
    {
        $memopenerbitansertifikasi = Memopenerbitansertifikasi::firstWhere('listpermohonan_id', $id);
        $setting = Setting::firstWhere('id', 1);

        $pdf_memopenerbitansertifikasi = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.memopenerbitansertifikasiDownload', [
                'title_bar' => 'Download',
                'client' => $client,
                'setting' => $setting,
                'permohonansertifikasi'     => $client->permohonansertifikasi_data($id)->first(),
                'memopenerbitansertifikasi' => $client->memopenerbitansertifikasi_data($memopenerbitansertifikasi->listpermohonan_id)->first(),
            ]);
        return $pdf_memopenerbitansertifikasi->save('pdf/F-CER-12 Memo Penerbitan Sertifikasi.pdf');
    }

    public function download_evaluasisatusiklussertifikasi($client, $id)
    {
        $evaluasisatusiklussertifikasi = Evaluasisatusiklussertifikasi::firstWhere('listpermohonan_id', $id);

        $setting = Setting::firstWhere('id', 1);

        $pdf_evaluasisatusiklussertifikasi = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.evaluasisatusiklussertifikasiDownload', [
                'title_bar' => 'Download',
                'client' => $client,
                'setting' => $setting,
                'permohonansertifikasi'         => $evaluasisatusiklussertifikasi != '' ? $client->permohonansertifikasi_data($evaluasisatusiklussertifikasi->listpermohonan_id)->first() : '',
                'rencanaclient'                 => $evaluasisatusiklussertifikasi != '' ? $client->rencanaclient_data($evaluasisatusiklussertifikasi->listpermohonan_id)->first() : '',
                'evaluasisatusiklussertifikasi' => $evaluasisatusiklussertifikasi,
            ]);
        return $pdf_evaluasisatusiklussertifikasi->save('pdf/F-CER-13 Evaluasi Satu Siklus Sertifikasi.pdf');
    }
}
