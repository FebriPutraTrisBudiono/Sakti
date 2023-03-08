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
use App\Http\Controllers\Controller;
use App\Models\Logawalcertification;
use Illuminate\Support\Facades\Mail;
use App\Models\permohonansertifikasi;

class KajianclientController extends Controller
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
        $fpenambah_1 = $request->fpenambah_1 == '' ? '0' : '1';
        $fpenambah_2 = $request->fpenambah_2 == '' ? '0' : '1';
        $fpenambah_3 = $request->fpenambah_3 == '' ? '0' : '1';
        $fpenambah_4 = $request->fpenambah_4 == '' ? '0' : '1';
        $fpenambah_5 = $request->fpenambah_5 == '' ? '0' : '1';
        $fpenambah_6 = $request->fpenambah_6 == '' ? '0' : '1';
        $fpenambah_7 = $request->fpenambah_7 == '' ? '0' : '1';
        $fpenambah_8 = $request->fpenambah_8 == '' ? '0' : '1';
        $fpenambah_9 = $request->fpenambah_9 == '' ? '0' : '1';
        $fpengurang_1 = $request->fpengurang_1 == '' ? '0' : '1';
        $fpengurang_2 = $request->fpengurang_2 == '' ? '0' : '1';
        $fpengurang_3 = $request->fpengurang_3 == '' ? '0' : '1';
        $fpengurang_4 = $request->fpengurang_4 == '' ? '0' : '1';
        $fpengurang_5 = $request->fpengurang_5 == '' ? '0' : '1';
        $fpengurang_6 = $request->fpengurang_6 == '' ? '0' : '1';
        $fpengurang_7 = $request->fpengurang_7 == '' ? '0' : '1';

        $data = $request->validate([
            'client_id'                         => 'required',
            'listpermohonan_id'                 => 'required',
            'iso'                               => 'required',
            'a1_nama'                           => 'required',
            'a2_alamat'                         => 'required',
            'a3_phonefax'                       => 'required',
            'a4_website'                        => 'required',
            'a5_sektor'                         => 'required',
            'a6_jcabang'                        => 'required',
            'a7_jkaryawan'                      => 'required',
            'a8_nampim'                         => 'required',
            'a9_cp'                             => 'required',
            'a10_perusahaanbesar'               => 'required',
            'b1_lingkup'                        => 'required',
            'b2_ea'                             => 'required',
            'b3_target'                         => 'required',
            'c1_question'                       => 'required',
            'c2_question'                       => 'required',
            'c3_question'                       => 'required',
            'c4_question'                       => 'required',
            'c5_question'                       => 'required',
            'd1_question'                       => 'required',
            'd1_answer'                         => 'required',
            'd2_answerbln'                      => 'required',
            'd2_answerthn'                      => 'required',
            'd3_question'                       => 'required',
            'd3_answer'                         => 'required',
            'd4_question'                       => 'required',
            'e1_question'                       => 'required',
            'e1_answer'                         => 'required',
            'e2_question'                       => 'required',
            'e2_answer'                         => 'required',
            'e3_question'                       => 'required',
            'e3_answer'                         => 'required',
            'e4_question'                       => 'required',
            'e5_question'                       => 'required',
            'e5_answer'                         => 'required',
            'e6_question'                       => 'required',
            'e6_answer'                         => 'required',
            'f1_answer'                         => 'required',
            'f2_answer'                         => 'required',
            'g1_answer'                         => 'required',
            'g2_answer'                         => 'required',
            'hasil1_question'                   => 'required',
            'hasil1_answer'                     => 'required',
            'hasil2_answer'                     => 'required',
            'hasil4_jumlah'                     => 'required',
            'j_nambahkurang'                    => 'required',
            'actual_mandays'                    => 'required',
            'stage1'                            => 'required',
            'stage2'                            => 'required',
            'sur1'                              => 'required',
            'sur2'                              => 'required',
            'res'                               => 'required',
            'mandays1'                          => 'required',
            'mandays2'                          => 'required',
            'mandays3'                          => 'required',
            'mandays4'                          => 'required',
            'mandays5'                          => 'required',
            'mandays6'                          => 'required',
            'transfer_sertifikat'               => 'required',
            'transfersertifikat_alasanditolak'  => 'required',
            'transfersertifikat_alasanditerima' => 'required',
            'sertifikasi_awal'                  => 'required',
            'survailen_1'                       => 'required',
            'survailen_2'                       => 'required',
            'resertifikasi'                     => 'required',
            'site1'                             => 'required',
            'site2'                             => 'required',
            'site3'                             => 'required',
            'site4'                             => 'required',
            'tgl_permohonan'                    => 'required',
            'tgl_kajian'                        => 'required',
            'hasil3_lead1'                        => 'required',
            'hasil3_auditor1'                        => 'required',
            'hasil3_tenaga1'                        => 'required',
        ]);

        $data['fpenambah_1'] = $fpenambah_1;
        $data['fpenambah_2'] = $fpenambah_2;
        $data['fpenambah_3'] = $fpenambah_3;
        $data['fpenambah_4'] = $fpenambah_4;
        $data['fpenambah_5'] = $fpenambah_5;
        $data['fpenambah_6'] = $fpenambah_6;
        $data['fpenambah_7'] = $fpenambah_7;
        $data['fpenambah_8'] = $fpenambah_8;
        $data['fpenambah_9'] = $fpenambah_9;
        $data['fpengurang_1'] = $fpengurang_1;
        $data['fpengurang_2'] = $fpengurang_2;
        $data['fpengurang_3'] = $fpengurang_3;
        $data['fpengurang_4'] = $fpengurang_4;
        $data['fpengurang_5'] = $fpengurang_5;
        $data['fpengurang_6'] = $fpengurang_6;
        $data['fpengurang_7'] = $fpengurang_7;

        $data['hasil3_lead2'] = $request->hasil3_lead2;
        $data['hasil3_auditor2'] = $request->hasil3_auditor2;
        $data['hasil3_tenaga2'] = $request->hasil3_tenaga2;
        $data['hasil3_lead3'] = $request->hasil3_lead3;
        $data['hasil3_auditor3'] = $request->hasil3_auditor3;
        $data['hasil3_tenaga3'] = $request->hasil3_tenaga3;

        // Save to database
        $data['status'] = 1;
        Kajianclient::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Kajian Permohonan',
            ];
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Kajian Permohonan',
            ];
            Logresertifikasi::create($log);
        }
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kajianclient  $kajianclient
     * @return \Illuminate\Http\Response
     */
    public function show(Kajianclient $kajianclient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kajianclient  $kajianclient
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client, $listpermohonan)
    {
        if ($client->user_id == auth()->user()->id || auth()->user()->level_id == 1 || auth()->user()->level_id == 3 || auth()->user()->level_id == 4) {
            $listpermohonan_id = Listpermohonan::where('id', $listpermohonan)->first();

            $bagian = Level::where('id', auth()->user()->level_id)->first();
            $roles = explode(',', $bagian['access']);

            if ($listpermohonan_id->slug == 'sertifikasi_awal' || $listpermohonan_id->slug == 'resertifikasi') {
                if ($client->permohonansertifikasi_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                    if ($client->permohonansertifikasi_data($listpermohonan)->first()->status != '2') {
                        return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                    }
                }
            } else if ($listpermohonan_id->slug == 'surveilance1' || $listpermohonan_id->slug == 'surveilance2') {
                if ($client->permohonansertifikasi_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                    if ($client->permohonansertifikasi_data($listpermohonan)->first()->status != '2') {
                        return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                    }
                }
            }

            return view('dashboard.kajianclientsedit', [
                'title_bar'             => 'Daftar Isian Permohonan Sertifikasi',
                'client'                => $client,
                'listpermohonan_id'     => $listpermohonan_id,
                'listpermohonan_slug'   => $listpermohonan_id->slug,
                'permohonansertifikasi' => $client->permohonansertifikasi_data($listpermohonan)->first() ?? '',
                'kajianclient'          => $client->kajianclient_data($listpermohonan)->first() ?? '',
                'hasil3_lead1'          => $client->kajianclient_data($listpermohonan)->first()->hasil3_lead1 ?? '',
                'hasil3_auditor1'       => $client->kajianclient_data($listpermohonan)->first()->hasil3_auditor1 ?? '',
                'hasil3_tenaga1'        => $client->kajianclient_data($listpermohonan)->first()->hasil3_tenaga1 ?? '',
                'hasil3_lead2'          => $client->kajianclient_data($listpermohonan)->first()->hasil3_lead2 ?? '',
                'hasil3_auditor2'       => $client->kajianclient_data($listpermohonan)->first()->hasil3_auditor2 ?? '',
                'hasil3_tenaga2'        => $client->kajianclient_data($listpermohonan)->first()->hasil3_tenaga2 ?? '',
                'hasil3_lead3'          => $client->kajianclient_data($listpermohonan)->first()->hasil3_lead3 ?? '',
                'hasil3_auditor3'       => $client->kajianclient_data($listpermohonan)->first()->hasil3_auditor3 ?? '',
                'hasil3_tenaga3'        => $client->kajianclient_data($listpermohonan)->first()->hasil3_tenaga3 ?? '',
                'roles'                 => $roles,
                'user'                  => User::latest()->paginate(100),
            ]);
        } else {
            return redirect()->back()->with('alert', 'Anda tidak memiliki akses');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kajianclient  $kajianclient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client, $listpermohonan)
    {
        $kajianclient = $client->kajianclient_data($listpermohonan)->first();

        $fpenambah_1 = $request->fpenambah_1 == '' ? '0' : '1';
        $fpenambah_2 = $request->fpenambah_2 == '' ? '0' : '1';
        $fpenambah_3 = $request->fpenambah_3 == '' ? '0' : '1';
        $fpenambah_4 = $request->fpenambah_4 == '' ? '0' : '1';
        $fpenambah_5 = $request->fpenambah_5 == '' ? '0' : '1';
        $fpenambah_6 = $request->fpenambah_6 == '' ? '0' : '1';
        $fpenambah_7 = $request->fpenambah_7 == '' ? '0' : '1';
        $fpenambah_8 = $request->fpenambah_8 == '' ? '0' : '1';
        $fpenambah_9 = $request->fpenambah_9 == '' ? '0' : '1';
        $fpengurang_1 = $request->fpengurang_1 == '' ? '0' : '1';
        $fpengurang_2 = $request->fpengurang_2 == '' ? '0' : '1';
        $fpengurang_3 = $request->fpengurang_3 == '' ? '0' : '1';
        $fpengurang_4 = $request->fpengurang_4 == '' ? '0' : '1';
        $fpengurang_5 = $request->fpengurang_5 == '' ? '0' : '1';
        $fpengurang_6 = $request->fpengurang_6 == '' ? '0' : '1';
        $fpengurang_7 = $request->fpengurang_7 == '' ? '0' : '1';
        $data = $request->validate([
            'client_id'                         => 'required',
            'listpermohonan_id'                 => 'required',
            'iso'                               => 'required',
            'a1_nama'                           => 'required',
            'a2_alamat'                         => 'required',
            'a3_phonefax'                       => 'required',
            'a4_website'                        => 'required',
            'a5_sektor'                         => 'required',
            'a6_jcabang'                        => 'required',
            'a7_jkaryawan'                      => 'required',
            'a8_nampim'                         => 'required',
            'a9_cp'                             => 'required',
            'a10_perusahaanbesar'               => 'required',
            'b1_lingkup'                        => 'required',
            'b2_ea'                             => 'required',
            'b3_target'                         => 'required',
            'c1_question'                       => 'required',
            'c2_question'                       => 'required',
            'c3_question'                       => 'required',
            'c4_question'                       => 'required',
            'c5_question'                       => 'required',
            'd1_question'                       => 'required',
            'd1_answer'                         => 'required',
            'd2_answerbln'                      => 'required',
            'd2_answerthn'                      => 'required',
            'd3_question'                       => 'required',
            'd3_answer'                         => 'required',
            'd4_question'                       => 'required',
            'e1_question'                       => 'required',
            'e1_answer'                         => 'required',
            'e2_question'                       => 'required',
            'e2_answer'                         => 'required',
            'e3_question'                       => 'required',
            'e3_answer'                         => 'required',
            'e4_question'                       => 'required',
            'e5_question'                       => 'required',
            'e5_answer'                         => 'required',
            'e6_question'                       => 'required',
            'e6_answer'                         => 'required',
            'f1_answer'                         => 'required',
            'f2_answer'                         => 'required',
            'g1_answer'                         => 'required',
            'g2_answer'                         => 'required',
            'hasil1_question'                   => 'required',
            'hasil1_answer'                     => 'required',
            'hasil2_answer'                     => 'required',
            'hasil4_jumlah'                     => 'required',
            'j_nambahkurang'                    => 'required',
            'actual_mandays'                    => 'required',
            'stage1'                            => 'required',
            'stage2'                            => 'required',
            'sur1'                              => 'required',
            'sur2'                              => 'required',
            'res'                               => 'required',
            'mandays1'                          => 'required',
            'mandays2'                          => 'required',
            'mandays3'                          => 'required',
            'mandays4'                          => 'required',
            'mandays5'                          => 'required',
            'mandays6'                          => 'required',
            'transfer_sertifikat'               => 'required',
            'transfersertifikat_alasanditolak'  => 'required',
            'transfersertifikat_alasanditerima' => 'required',
            'sertifikasi_awal'                  => 'required',
            'survailen_1'                       => 'required',
            'survailen_2'                       => 'required',
            'resertifikasi'                     => 'required',
            'site1'                             => 'required',
            'site2'                             => 'required',
            'site3'                             => 'required',
            'site4'                             => 'required',
            'tgl_permohonan'                    => 'required',
            'tgl_kajian'                        => 'required',
            'hasil3_lead1'                        => 'required',
            'hasil3_auditor1'                        => 'required',
            'hasil3_tenaga1'                        => 'required',
        ]);

        $data['fpenambah_1'] = $fpenambah_1;
        $data['fpenambah_2'] = $fpenambah_2;
        $data['fpenambah_3'] = $fpenambah_3;
        $data['fpenambah_4'] = $fpenambah_4;
        $data['fpenambah_5'] = $fpenambah_5;
        $data['fpenambah_6'] = $fpenambah_6;
        $data['fpenambah_7'] = $fpenambah_7;
        $data['fpenambah_8'] = $fpenambah_8;
        $data['fpenambah_9'] = $fpenambah_9;
        $data['fpengurang_1'] = $fpengurang_1;
        $data['fpengurang_2'] = $fpengurang_2;
        $data['fpengurang_3'] = $fpengurang_3;
        $data['fpengurang_4'] = $fpengurang_4;
        $data['fpengurang_5'] = $fpengurang_5;
        $data['fpengurang_6'] = $fpengurang_6;
        $data['fpengurang_7'] = $fpengurang_7;

        $data['hasil3_lead2'] = $request->hasil3_lead2;
        $data['hasil3_auditor2'] = $request->hasil3_auditor2;
        $data['hasil3_tenaga2'] = $request->hasil3_tenaga2;
        $data['hasil3_lead3'] = $request->hasil3_lead3;
        $data['hasil3_auditor3'] = $request->hasil3_auditor3;
        $data['hasil3_tenaga3'] = $request->hasil3_tenaga3;

        Kajianclient::where('id', $kajianclient->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Perubahan disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-02 - Kajian Permohon.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $kajianclient = $client->kajianclient_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Kajianclient::where('id', $kajianclient->id)->update($data);

        // sent email client
        $log = 'Kajian Permohonan';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $kajianclient->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Kajian Permohonan';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $kajianclient->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($item->email)->send(new Statusvalidasi($admindata));
        }

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Status Berhasil Disimpan!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kajianclient  $kajianclient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kajianclient $kajianclient)
    {
        //
    }

    public function download(Kajianclient $kajianclient)
    {
        $clientdata = Client::where('id', $kajianclient->client_id)->first();
        $permohonansertifikasi = $clientdata->permohonansertifikasi_data($kajianclient->listpermohonan_id)->first();

        $data = $kajianclient;
        $setting = Setting::firstWhere('id', 1);


        $pdf = Pdf::setPaper('a4', 'potrait')
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
        return $pdf->stream();
    }
}
