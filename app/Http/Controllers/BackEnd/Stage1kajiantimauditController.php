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
use App\Models\Log1survailence;
use App\Models\Log1surveilance;
use App\Models\Log2surveilance;
use App\Models\Logsurvailence1;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Logresertifikasi;
use App\Models\Perjanjianclient;
use App\Models\Permohonanclient;
use App\Http\Controllers\Controller;
use App\Models\Logawalcertification;
use App\Models\Stage1kajiantimaudit;
use Illuminate\Support\Facades\Mail;
use App\Models\Permohonansertifikasi;

class Stage1kajiantimauditController extends Controller
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
            'rencana_pelaksanaan'       => 'required',
            'kajian1_question'          => 'required',
            'kajian2_question'          => 'required',
            'kajian3_question'          => 'required',
            'kajian4_question'          => 'required',
            'kajian5_question'          => 'required',
            'tanggal_ttd'               => 'required',
            'nama_manager'              => 'required',
        ]);

        // save to database
        $data['status'] = 1;
        Stage1kajiantimaudit::create($data);

        if ($request['listpermohonan_slug'] == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage I Kajian Tim Audit',
            ];
            Logawalcertification::create($log);
        } elseif ($request['listpermohonan_slug'] == 'surveilance1') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Penugasan - Kajian Tim Audit',
            ];
            Log1surveilance::create($log);
        } elseif ($request['listpermohonan_slug'] == 'surveilance2') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Penugasan - Kajian Tim Audit',
            ];
            Log2surveilance::create($log);
        } elseif ($request['listpermohonan_slug'] == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage I Kajian Tim Audit',
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
                if ($client->rencanaclient_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->rencanaclient_data($listpermohonan)->first()->status != '2') {
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

            $kajianclient = Kajianclient::where('listpermohonan_id', $idsertifikasi)->first();

            return view('dashboard.stage1kajiantimauditedit', [
                'title_bar'             => 'Kajian Tim Audit',
                'client'                => $client,
                'listpermohonan_id'     => $listpermohonan_id,
                'listpermohonan_slug'   => $listpermohonan_id->slug,
                'permohonanclient'      => $client->permohonansertifikasi_data($idsertifikasi)->first(),
                'kajianclient'          => $client->kajianclient_data($idsertifikasi)->first(),
                'perjanjianclient'      => $client->perjanjianclient_data($idsertifikasi)->first(),
                'rencanaclient'         => $client->rencanaclient_data($idsertifikasi)->first(),
                'stage1kajiantimaudit'  => $client->stage1kajiantimaudit_data($listpermohonan)->first() ?? '',
                'hasil3_lead1'          => User::where('id', $kajianclient->hasil3_lead1 ?? '')->first() ?? '',
                'hasil3_auditor1'       => User::where('id', $kajianclient->hasil3_auditor1 ?? '')->first() ?? '',
                'hasil3_tenaga1'        => User::where('id', $kajianclient->hasil3_tenaga1 ?? '')->first() ?? '',
                'hasil3_lead2'          => User::where('id', $kajianclient->hasil3_lead2 ?? '')->first() ?? '',
                'hasil3_auditor2'       => User::where('id', $kajianclient->hasil3_auditor2 ?? '')->first() ?? '',
                'hasil3_tenaga2'        => User::where('id', $kajianclient->hasil3_tenaga2 ?? '')->first() ?? '',
                'hasil3_lead3'          => User::where('id', $kajianclient->hasil3_lead3 ?? '')->first() ?? '',
                'hasil3_auditor3'       => User::where('id', $kajianclient->hasil3_auditor3 ?? '')->first() ?? '',
                'hasil3_tenaga3'        => User::where('id', $kajianclient->hasil3_tenaga3 ?? '')->first() ?? '',
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
        $stage1kajiantimaudit = $client->stage1kajiantimaudit_data($listpermohonan)->first();

        $data = $request->validate([
            'client_id'                 => 'required',
            'listpermohonan_id'         => 'required',
            'rencana_pelaksanaan'       => 'required',
            'kajian1_question'          => 'required',
            'kajian2_question'          => 'required',
            'kajian3_question'          => 'required',
            'kajian4_question'          => 'required',
            'kajian5_question'          => 'required',
            'tanggal_ttd'               => 'required',
            'nama_manager'              => 'required',
        ]);

        Stage1kajiantimaudit::where('id', $stage1kajiantimaudit->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Perubahan disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-39 - Kajian Tim Audit.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $stage1kajiantimaudit = $client->stage1kajiantimaudit_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Stage1kajiantimaudit::where('id', $stage1kajiantimaudit->id)->update($data);

        // sent email client
        $log = 'Stage I Kajian Tim Audit';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $stage1kajiantimaudit->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Stage I Kajian Tim Audit';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $stage1kajiantimaudit->dipending_keterangan ?? '',
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

    public function download(Stage1kajiantimaudit $stage1kajiantimaudit)
    {
        $clientdata = Client::where('id', $stage1kajiantimaudit->client_id)->first();
        $setting = Setting::firstWhere('id', 1);

        $listpermohonan_data = Listpermohonan::get();
        $id = '';
        for ($i = $stage1kajiantimaudit->listpermohonan_id; $i >= 1; $i--) {
            if ($listpermohonan_data->where('id', $i)->first()->id ?? '' == $i) {
                if ($listpermohonan_data->where('id', $i)->first()->slug == 'sertifikasi_awal') {
                    $id = $listpermohonan_data->where('id', $i)->first()->id;
                    break;
                } else if ($listpermohonan_data->where('id', $i)->first()->slug == 'resertifikasi') {
                    $id = $listpermohonan_data->where('id', $i)->first()->id;
                    break;
                }
            }
        }

        $pdf = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.stage1kajiantimauditDownload', [
                'title_bar'                 => 'Download',
                'stage1kajiantimaudit'      => $stage1kajiantimaudit,
                'permohonansertifikasi'     => Permohonansertifikasi::where('listpermohonan_id', $id)->first(),
                'kajianclient'              => Kajianclient::where('listpermohonan_id', $id)->first(),
                'perjanjianclient'          => Perjanjianclient::where('listpermohonan_id', $id)->first(),
                'rencanaclient'             => Rencanaclient::where('listpermohonan_id', $id)->first(),
                'client'                    => $clientdata,
                'setting'                   => $setting,
                'stage1kajiantimaudit'      => $stage1kajiantimaudit,
                'hasil3_lead1'              => User::where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_lead1 ?? '')->first(),
                'hasil3_auditor1'           => User::where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_auditor1 ?? '')->first(),
                'hasil3_tenaga1'            => User::where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_tenaga1 ?? '')->first(),
                'hasil3_lead2'              => User::where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_lead2 ?? '')->first(),
                'hasil3_auditor2'           => User::where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_auditor2 ?? '')->first(),
                'hasil3_tenaga2'            => User::where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_tenaga2 ?? '')->first(),
                'hasil3_lead3'              => User::where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_lead3 ?? '')->first(),
                'hasil3_auditor3'           => User::where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_auditor3 ?? '')->first(),
                'hasil3_tenaga3'            => User::where('id', Kajianclient::where('listpermohonan_id', $id)->first()->hasil3_tenaga3 ?? '')->first(),
            ]);
        return $pdf->stream();
    }
}
