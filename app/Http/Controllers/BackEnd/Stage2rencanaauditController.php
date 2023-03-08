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
use App\Models\Stage1checkaudit;
use App\Models\Stage2rencanaaudit;
use App\Http\Controllers\Controller;
use App\Models\Logawalcertification;
use App\Models\Stage1kajiantimaudit;
use Illuminate\Support\Facades\Mail;
use App\Models\permohonansertifikasi;
use App\Models\Stage2rencanaaudititem;
use App\Models\Stage1penunjukantimaudit;

class Stage2rencanaauditController extends Controller
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
            'waktu_rapat'                   => 'required',
            'waktu_verifikasi'              => 'required',
            'tanggal_ttd'                   => 'required',
            'nama_auditor'                  => 'required',
            'nama_manajer'                  => 'required',
        ]);

        // save to database
        $data['status'] = 1;
        $stage2rencanaaudititem = Stage2rencanaaudit::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage II Rencana Audit',
            ];

            if ($stage2rencanaaudititem) {
                // insert item hadir
                foreach ($request->data as $row) {
                    $stage2rencanaaudit_items = [
                        'stage2rencanaaudit_id'  => $stage2rencanaaudititem->id,
                        'waktu'      => $row['waktu'],
                        'bagian'   => $row['bagian'],
                        'klausul'   => $row['klausul'],
                        'auditor'   => $row['auditor'],
                        'keterangan'   => $row['keterangan'],
                    ];
                    Stage2rencanaaudititem::create($stage2rencanaaudit_items);
                }
            }
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance1') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Audit - Rencana Audit',
            ];

            if ($stage2rencanaaudititem) {
                // insert item hadir
                foreach ($request->data as $row) {
                    $stage2rencanaaudit_items = [
                        'stage2rencanaaudit_id'  => $stage2rencanaaudititem->id,
                        'waktu'      => $row['waktu'],
                        'bagian'   => $row['bagian'],
                        'klausul'   => $row['klausul'],
                        'auditor'   => $row['auditor'],
                        'keterangan'   => $row['keterangan'],
                    ];
                    Stage2rencanaaudititem::create($stage2rencanaaudit_items);
                }
            }
            Log1surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance2') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Audit - Rencana Audit',
            ];

            if ($stage2rencanaaudititem) {
                // insert item hadir
                foreach ($request->data as $row) {
                    $stage2rencanaaudit_items = [
                        'stage2rencanaaudit_id'  => $stage2rencanaaudititem->id,
                        'waktu'      => $row['waktu'],
                        'bagian'   => $row['bagian'],
                        'klausul'   => $row['klausul'],
                        'auditor'   => $row['auditor'],
                        'keterangan'   => $row['keterangan'],
                    ];
                    Stage2rencanaaudititem::create($stage2rencanaaudit_items);
                }
            }
            Log2surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage II Rencana Audit',
            ];

            if ($stage2rencanaaudititem) {
                // insert item hadir
                foreach ($request->data as $row) {
                    $stage2rencanaaudit_items = [
                        'stage2rencanaaudit_id'  => $stage2rencanaaudititem->id,
                        'waktu'      => $row['waktu'],
                        'bagian'   => $row['bagian'],
                        'klausul'   => $row['klausul'],
                        'auditor'   => $row['auditor'],
                        'keterangan'   => $row['keterangan'],
                    ];
                    Stage2rencanaaudititem::create($stage2rencanaaudit_items);
                }
            }

            Logresertifikasi::create($log);
        }
        return response()->json(['status' => true, 'msg' => 'Berhasil disimpan!']);
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

            if ($client->stage2rencanaaudit_data($listpermohonan)->first() != '') {
                $stage2rencanaaudit_items = Stage2rencanaaudititem::where('stage2rencanaaudit_id', $client->stage2rencanaaudit_data($listpermohonan)->first()->id)->get();
            }

            $bagian = Level::where('id', auth()->user()->level_id)->first();
            $roles = explode(',', $bagian['access']);

            if ($listpermohonan_id->slug == 'sertifikasi_awal' || $listpermohonan_id->slug == 'resertifikasi') {
                if ($client->stage1checkaudit_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                    if ($client->stage1checkaudit_data($listpermohonan)->first()->status != '2') {
                        return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                    }
                }
            } else if ($listpermohonan_id->slug == 'surveilance1' || $listpermohonan_id->slug == 'surveilance2') {
                if ($client->stage1penunjukantimaudit_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                    if ($client->stage1penunjukantimaudit_data($listpermohonan)->first()->status != '2') {
                        return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                    }
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

            return view('dashboard.stage2rencanaauditedit', [
                'title_bar'                 => 'Rencana Audit',
                'client'                    => $client,
                'listpermohonan_id'         => $listpermohonan_id,
                'listpermohonan_slug'       => $listpermohonan_id->slug,
                'permohonansertifikasi'     => $client->permohonansertifikasi_data($idsertifikasi)->first(),
                'kajianclient'              => $client->kajianclient_data($idsertifikasi)->first(),
                'perjanjianclient'          => $client->perjanjianclient_data($idsertifikasi)->first(),
                'rencanaclient'             => $client->rencanaclient_data($idsertifikasi)->first(),
                'stage1kajiantimaudit'      => $client->stage1kajiantimaudit_data($listpermohonan)->first(),
                'stage1penunjukantimaudit'  => $client->stage1penunjukantimaudit_data($listpermohonan)->first(),
                'stage1checkaudit'          => $client->stage1checkaudit_data($listpermohonan)->first(),
                'stage2rencanaaudit'        => $client->stage2rencanaaudit_data($listpermohonan)->first(),
                'roles'                     => $roles,
                'stage2rencanaaudit_items'  => $stage2rencanaaudit_items ?? '',
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
        $stage2rencanaaudit = $client->stage2rencanaaudit_data($listpermohonan)->first();

        $data = $request->validate([
            'client_id'                     => 'required',
            'listpermohonan_id'             => 'required',
            'waktu_rapat'                   => 'required',
            'waktu_verifikasi'              => 'required',
            'tanggal_ttd'                   => 'required',
            'nama_auditor'                  => 'required',
            'nama_manajer'                  => 'required',
        ]);
        if ($request->data) {
            if ($stage2rencanaaudit) {
                // insert item hadir
                foreach ($request->data as $row) {
                    $stage2rencanaaudit_items = [
                        'stage2rencanaaudit_id'  => $stage2rencanaaudit->id,
                        'waktu'      => $row['waktu'],
                        'bagian'   => $row['bagian'],
                        'klausul'   => $row['klausul'],
                        'auditor'   => $row['auditor'],
                        'keterangan'   => $row['keterangan'],
                    ];
                    Stage2rencanaaudititem::create($stage2rencanaaudit_items);
                }
            }
        }

        Stage2rencanaaudit::where('id', $stage2rencanaaudit->id)->update($data);
        return response()->json(['status' => true, 'msg' => 'Berhasil disimpan!']);
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-05 - Rencana Audit.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $stage2rencanaaudit = $client->stage2rencanaaudit_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Stage2rencanaaudit::where('id', $stage2rencanaaudit->id)->update($data);

        // sent email client
        $log = 'Stage II Rencana Audit';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $stage2rencanaaudit->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Stage II Rencana Audit';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $stage2rencanaaudit->dipending_keterangan ?? '',
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
                $log = 'Stage II Rencana Audit';
                $auditordata = [
                    'user' => $item,
                    'client' => $client,
                    'permohonan' => $permohonan,
                    'log' => $log,
                    'status' => $request->status,
                    'keterangan' => '',
                    'dipending_keterangandata' => $stage2rencanaaudit->dipending_keterangan ?? '',
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
        Stage2rencanaaudititem::destroy($id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!.</div>');
    }

    public function download(Stage2rencanaaudit $stage2rencanaaudit)
    {
        $clientdata = Client::where('id', $stage2rencanaaudit->client_id)->first();

        $setting = Setting::firstWhere('id', 1);

        $stage2rencanaaudit_items = Stage2rencanaaudititem::where('stage2rencanaaudit_id', $stage2rencanaaudit->id)->get();

        $listpermohonan_data = Listpermohonan::get();
        $idsertifikasi = '';
        for ($i = $stage2rencanaaudit->listpermohonan_id; $i >= 1; $i--) {
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

        $stage1penunjukantimaudit = Stage1penunjukantimaudit::where('listpermohonan_id', $stage2rencanaaudit->listpermohonan_id)->first();

        $arraudit = explode('|', $stage1penunjukantimaudit['audit']);

        $pdf = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.stage2rencanaauditDownload', [
                'title_bar'                     => 'Download',
                'stage2rencanaaudit'            => $stage2rencanaaudit,
                'permohonansertifikasi'         => $clientdata->permohonansertifikasi_data($idsertifikasi)->first(),
                'kajianclient'                  => $clientdata->kajianclient_data($idsertifikasi)->first(),
                'perjanjianclient'              => $clientdata->perjanjianclient_data($idsertifikasi)->first(),
                'rencanaclient'                 => $clientdata->rencanaclient_data($idsertifikasi)->first(),
                'client'                        => $clientdata,
                'stage1kajiantimaudit'          => $clientdata->stage1kajiantimaudit_data($stage2rencanaaudit->listpermohonan_id)->first(),
                'stage1penunjukantimaudit'      => $clientdata->stage1penunjukantimaudit_data($stage2rencanaaudit->listpermohonan_id)->first(),
                'setting'                       => $setting,
                'arraudit'                      => $arraudit,
                'stage2rencanaaudit_items'      => $stage2rencanaaudit_items ?? '',
            ]);
        return $pdf->stream();
    }
}
