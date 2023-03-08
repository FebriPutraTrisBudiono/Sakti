<?php

namespace App\Http\Controllers\BackEnd;

use App\Mail\Status;
use App\Models\User;
use App\Models\Level;
use App\Models\Client;
use App\Models\Setting;
use App\Mail\Statusadmin;
use App\Models\Kajianclient;
use Illuminate\Http\Request;
use App\Models\Rencanaclient;
use App\Models\Listpermohonan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Logresertifikasi;
use App\Models\Perjanjianclient;
use App\Models\Stage1checkaudit;
use App\Http\Controllers\Controller;
use App\Mail\Statusauditor;
use App\Mail\Statusvalidasi;
use App\Models\Logawalcertification;
use App\Models\Stage1kajiantimaudit;
use Illuminate\Support\Facades\Mail;
use App\Models\permohonansertifikasi;
use App\Models\Stage1penunjukantimaudit;

class Stage1checkauditController extends Controller
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
            'client_id'                     => 'required',
            'listpermohonan_id'             => 'required',
            'pemenuhan_1'                   => 'required',
            'tindaklanjut_1'                => 'required',
            'pemenuhan_2_1'                 => 'required',
            'tindaklanjut_2_1'              => 'required',
            'pemenuhan_2_2'                 => 'required',
            'tindaklanjut_2_2'              => 'required',
            'pemenuhan_2_3'                 => 'required',
            'tindaklanjut_2_3'              => 'required',
            'pemenuhan_2_4'                 => 'required',
            'tindaklanjut_2_4'              => 'required',
            'pemenuhan_2_5'                 => 'required',
            'tindaklanjut_2_5'              => 'required',
            'pemenuhan_3_1'                 => 'required',
            'tindaklanjut_3_1'              => 'required',
            'pemenuhan_3_2'                 => 'required',
            'tindaklanjut_3_2'              => 'required',
            'pemenuhan_3_3'                 => 'required',
            'tindaklanjut_3_3'              => 'required',
            'pemenuhan_3_4'                 => 'required',
            'tindaklanjut_3_4'              => 'required',
            'pemenuhan_4_1'                 => 'required',
            'tindaklanjut_4_1'              => 'required',
            'pemenuhan_4_2'                 => 'required',
            'tindaklanjut_4_2'              => 'required',
            'pemenuhan_4_3'                 => 'required',
            'tindaklanjut_4_3'              => 'required',
            'pemenuhan_5_1'                 => 'required',
            'tindaklanjut_5_1'              => 'required',
            'pemenuhan_5_2'                 => 'required',
            'tindaklanjut_5_2'              => 'required',
            'pemenuhan_5_3'                 => 'required',
            'tindaklanjut_5_3'              => 'required',
            'fokus_pelaksanaan_tahap2'      => 'required',
            'catatan'                       => 'required',
            'rekom_tahap_audit'             => 'required',
            'acuan_4_1'                     => 'required',
            'verifikasi_4_1'                => 'required',
            'acuan_4_2'                     => 'required',
            'verifikasi_4_2'                => 'required',
            'acuan_4_3'                     => 'required',
            'verifikasi_4_3'                => 'required',
            'acuan_4_4'                     => 'required',
            'verifikasi_4_4'                => 'required',
            'acuan_5_1'                     => 'required',
            'verifikasi_5_1'                => 'required',
            'acuan_5_2'                     => 'required',
            'verifikasi_5_2'                => 'required',
            'acuan_5_3'                     => 'required',
            'verifikasi_5_3'                => 'required',
            'acuan_6_1'                     => 'required',
            'verifikasi_6_1'                => 'required',
            'acuan_6_2'                     => 'required',
            'verifikasi_6_2'                => 'required',
            'acuan_6_3'                     => 'required',
            'verifikasi_6_3'                => 'required',
            'acuan_7_1'                     => 'required',
            'verifikasi_7_1'                => 'required',
            'acuan_7_2'                     => 'required',
            'verifikasi_7_2'                => 'required',
            'acuan_7_3'                     => 'required',
            'verifikasi_7_3'                => 'required',
            'acuan_7_4'                     => 'required',
            'verifikasi_7_4'                => 'required',
            'acuan_7_5'                     => 'required',
            'verifikasi_7_5'                => 'required',
            'acuan_8_1'                     => 'required',
            'verifikasi_8_1'                => 'required',
            'acuan_8_2'                     => 'required',
            'verifikasi_8_2'                => 'required',
            'acuan_8_3'                     => 'required',
            'verifikasi_8_3'                => 'required',
            'acuan_8_4'                     => 'required',
            'verifikasi_8_4'                => 'required',
            'acuan_8_5'                     => 'required',
            'verifikasi_8_5'                => 'required',
            'acuan_8_6'                     => 'required',
            'verifikasi_8_6'                => 'required',
            'acuan_8_7'                     => 'required',
            'verifikasi_8_7'                => 'required',
            'acuan_9_1'                     => 'required',
            'verifikasi_9_1'                => 'required',
            'acuan_9_2'                     => 'required',
            'verifikasi_9_2'                => 'required',
            'acuan_9_3'                     => 'required',
            'verifikasi_9_3'                => 'required',
            'acuan_10_1'                    => 'required',
            'verifikasi_10_1'               => 'required',
            'acuan_10_2'                    => 'required',
            'verifikasi_10_2'               => 'required',
            'acuan_10_3'                    => 'required',
            'verifikasi_10_3'               => 'required',
            'tanggal_ttd'                   => 'required',
            'nama_auditor'                  => 'required',
        ]);

        // save to database
        $data['status'] = 1;
        Stage1checkaudit::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage I Check List Audit Stage I',
            ];
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage I Check List Audit Stage I',
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
                if (auth()->user()->level_id == 2) {
                    if ($client->stage1penunjukantimaudit_data($listpermohonan)->first() == '') {
                        return redirect()->back()->with('alert', 'Maaf, Proses sebelumnya masih dalam proses audit.');
                    } elseif ($client->stage1penunjukantimaudit_data($listpermohonan)->first()->status != '2') {
                        return redirect()->back()->with('alert', 'Maaf, Proses sebelumnya masih dalam proses audit.');
                    }
                } else {
                    if ($client->stage1penunjukantimaudit_data($listpermohonan)->first() == '') {
                        return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                    } elseif ($client->stage1penunjukantimaudit_data($listpermohonan)->first()->status != '2') {
                        return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                    }
                }
            }

            $item = $client->stage1penunjukantimaudit_data($listpermohonan)->first();
            $arraudit = explode('|', $item['audit']);

            return view('dashboard.stage1checkauditedit', [
                'title_bar'                 => 'Check List Audit Stage I',
                'client'                    => $client,
                'listpermohonan_id'         => $listpermohonan_id,
                'listpermohonan_slug'       => $listpermohonan_id->slug,
                'permohonansertifikasi'     => $client->permohonansertifikasi_data($listpermohonan)->first() ?? '',
                'kajianclient'              => $client->kajianclient_data($listpermohonan)->first() ?? '',
                'perjanjianclient'          => $client->perjanjianclient_data($listpermohonan)->first() ?? '',
                'rencanaclient'             => $client->rencanaclient_data($listpermohonan)->first() ?? '',
                'stage1kajiantimaudit'      => $client->stage1kajiantimaudit_data($listpermohonan)->first() ?? '',
                'stage1penunjukantimaudit'  => $client->stage1penunjukantimaudit_data($listpermohonan)->first() ?? '',
                'stage1checkaudit'          => $client->stage1checkaudit_data($listpermohonan)->first() ?? '',
                'roles'                     => $roles,
                'arraudit'                  => $arraudit,
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
        $stage1checkaudit = $client->stage1checkaudit_data($listpermohonan)->first();

        $data = $request->validate([
            'client_id'                     => 'required',
            'listpermohonan_id'             => 'required',
            'pemenuhan_1'                   => 'required',
            'tindaklanjut_1'                => 'required',
            'pemenuhan_2_1'                 => 'required',
            'tindaklanjut_2_1'              => 'required',
            'pemenuhan_2_2'                 => 'required',
            'tindaklanjut_2_2'              => 'required',
            'pemenuhan_2_3'                 => 'required',
            'tindaklanjut_2_3'              => 'required',
            'pemenuhan_2_4'                 => 'required',
            'tindaklanjut_2_4'              => 'required',
            'pemenuhan_2_5'                 => 'required',
            'tindaklanjut_2_5'              => 'required',
            'pemenuhan_3_1'                 => 'required',
            'tindaklanjut_3_1'              => 'required',
            'pemenuhan_3_2'                 => 'required',
            'tindaklanjut_3_2'              => 'required',
            'pemenuhan_3_3'                 => 'required',
            'tindaklanjut_3_3'              => 'required',
            'pemenuhan_3_4'                 => 'required',
            'tindaklanjut_3_4'              => 'required',
            'pemenuhan_4_1'                 => 'required',
            'tindaklanjut_4_1'              => 'required',
            'pemenuhan_4_2'                 => 'required',
            'tindaklanjut_4_2'              => 'required',
            'pemenuhan_4_3'                 => 'required',
            'tindaklanjut_4_3'              => 'required',
            'pemenuhan_5_1'                 => 'required',
            'tindaklanjut_5_1'              => 'required',
            'pemenuhan_5_2'                 => 'required',
            'tindaklanjut_5_2'              => 'required',
            'pemenuhan_5_3'                 => 'required',
            'tindaklanjut_5_3'              => 'required',
            'fokus_pelaksanaan_tahap2'      => 'required',
            'catatan'                       => 'required',
            'rekom_tahap_audit'             => 'required',
            'acuan_4_1'                     => 'required',
            'verifikasi_4_1'                => 'required',
            'acuan_4_2'                     => 'required',
            'verifikasi_4_2'                => 'required',
            'acuan_4_3'                     => 'required',
            'verifikasi_4_3'                => 'required',
            'acuan_4_4'                     => 'required',
            'verifikasi_4_4'                => 'required',
            'acuan_5_1'                     => 'required',
            'verifikasi_5_1'                => 'required',
            'acuan_5_2'                     => 'required',
            'verifikasi_5_2'                => 'required',
            'acuan_5_3'                     => 'required',
            'verifikasi_5_3'                => 'required',
            'acuan_6_1'                     => 'required',
            'verifikasi_6_1'                => 'required',
            'acuan_6_2'                     => 'required',
            'verifikasi_6_2'                => 'required',
            'acuan_6_3'                     => 'required',
            'verifikasi_6_3'                => 'required',
            'acuan_7_1'                     => 'required',
            'verifikasi_7_1'                => 'required',
            'acuan_7_2'                     => 'required',
            'verifikasi_7_2'                => 'required',
            'acuan_7_3'                     => 'required',
            'verifikasi_7_3'                => 'required',
            'acuan_7_4'                     => 'required',
            'verifikasi_7_4'                => 'required',
            'acuan_7_5'                     => 'required',
            'verifikasi_7_5'                => 'required',
            'acuan_8_1'                     => 'required',
            'verifikasi_8_1'                => 'required',
            'acuan_8_2'                     => 'required',
            'verifikasi_8_2'                => 'required',
            'acuan_8_3'                     => 'required',
            'verifikasi_8_3'                => 'required',
            'acuan_8_4'                     => 'required',
            'verifikasi_8_4'                => 'required',
            'acuan_8_5'                     => 'required',
            'verifikasi_8_5'                => 'required',
            'acuan_8_6'                     => 'required',
            'verifikasi_8_6'                => 'required',
            'acuan_8_7'                     => 'required',
            'verifikasi_8_7'                => 'required',
            'acuan_9_1'                     => 'required',
            'verifikasi_9_1'                => 'required',
            'acuan_9_2'                     => 'required',
            'verifikasi_9_2'                => 'required',
            'acuan_9_3'                     => 'required',
            'verifikasi_9_3'                => 'required',
            'acuan_10_1'                    => 'required',
            'verifikasi_10_1'               => 'required',
            'acuan_10_2'                    => 'required',
            'verifikasi_10_2'               => 'required',
            'acuan_10_3'                    => 'required',
            'verifikasi_10_3'               => 'required',
            'tanggal_ttd'                   => 'required',
            'nama_auditor'                  => 'required',
        ]);

        Stage1checkaudit::where('id', $stage1checkaudit->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Perubahan disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-06 - Check List Audit Stage I.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $stage1checkaudit = $client->stage1checkaudit_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Stage1checkaudit::where('id', $stage1checkaudit->id)->update($data);

        // sent email client
        $log = 'Stage I Check List Audit Stage I';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $stage1checkaudit->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Stage I Check List Audit Stage I';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $stage1checkaudit->dipending_keterangan ?? '',
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
                $log = 'Stage I Check List Audit Stage I';
                $auditordata = [
                    'user' => $item,
                    'client' => $client,
                    'permohonan' => $permohonan,
                    'log' => $log,
                    'status' => $request->status,
                    'keterangan' => '',
                    'dipending_keterangandata' => $stage1checkaudit->dipending_keterangan ?? '',
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

    public function download(Stage1checkaudit $stage1checkaudit)
    {
        $clientdata = Client::where('id', $stage1checkaudit->client_id)->first();

        $setting = Setting::firstWhere('id', 1);

        $listpermohonan_data = Listpermohonan::get();
        $idsertifikasi = '';
        for ($i = $stage1checkaudit->listpermohonan_id; $i >= 1; $i--) {
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

        $item = $clientdata->stage1penunjukantimaudit_data($stage1checkaudit->listpermohonan_id)->first();
        $arraudit = explode('|', $item['audit']);

        $pdf = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.stage1checkauditDownload', [
                'title_bar'                     => 'Download',
                'stage1checkaudit'              => $stage1checkaudit,
                'permohonansertifikasi'         => $clientdata->permohonansertifikasi_data($idsertifikasi)->first(),
                'kajianclient'                  => $clientdata->kajianclient_data($idsertifikasi)->first(),
                'perjanjianclient'              => $clientdata->perjanjianclient_data($idsertifikasi)->first(),
                'rencanaclient'                 => $clientdata->rencanaclient_data($idsertifikasi)->first(),
                'client'                        => $clientdata,
                'stage1kajiantimaudit'          => $clientdata->stage1kajiantimaudit_data($stage1checkaudit->listpermohonan_id)->first(),
                'stage1penunjukantimaudit'      => $clientdata->stage1penunjukantimaudit_data($stage1checkaudit->listpermohonan_id)->first(),
                'arraudit'                      => $arraudit,
                'setting'                       => $setting
            ]);
        return $pdf->stream();
    }
}
