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
use Illuminate\Support\Facades\Mail;
use App\Models\Permohonansertifikasi;
use App\Models\Stage2daftarhadiraudit;
use App\Models\Stage2daftarhadiraudititem;

class Stage2daftarhadirauditController extends Controller
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
        $request->validate([
            'client_id'                     => 'required',
            'listpermohonan_id'             => 'required',
            'rapat'                         => 'required',
            'tanggal'                       => 'required',
            'tempat'                        => 'required',
            'data'                          => 'required',
        ]);

        $data['client_id'] = $request->client_id;
        $data['listpermohonan_id'] = $request->listpermohonan_id;
        $data['rapat'] = $request->rapat;
        $data['tanggal'] = $request->tanggal;
        $data['tempat'] = $request->tempat;
        $data['status'] = 1;

        // save to database
        $daftarhadir = Stage2daftarhadiraudit::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            if ($daftarhadir) {
                // insert item hadir
                foreach ($request->data as $row) {
                    $stage2daftarhadiraudit_items = [
                        'stage2daftarhadiraudit_id'  => $daftarhadir->id,
                        'nama'      => $row['name'],
                        'jabatan'   => $row['jabatan'],
                        'opening'   => $row['opening'],
                        'closing'   => $row['closing'],
                    ];
                    Stage2daftarhadiraudititem::create($stage2daftarhadiraudit_items);
                }
            }
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage II Daftar Hadir Audit',
            ];
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance1') {
            if ($daftarhadir) {
                // insert item hadir
                foreach ($request->data as $row) {
                    $stage2daftarhadiraudit_items = [
                        'stage2daftarhadiraudit_id'  => $daftarhadir->id,
                        'nama'      => $row['name'],
                        'jabatan'   => $row['jabatan'],
                        'opening'   => $row['opening'],
                        'closing'   => $row['closing'],
                    ];
                    Stage2daftarhadiraudititem::create($stage2daftarhadiraudit_items);
                }
            }
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Penugasan - Daftar Hadir Audit',
            ];

            Log1surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance2') {
            if ($daftarhadir) {
                // insert item hadir
                foreach ($request->data as $row) {
                    $stage2daftarhadiraudit_items = [
                        'stage2daftarhadiraudit_id'  => $daftarhadir->id,
                        'nama'      => $row['name'],
                        'jabatan'   => $row['jabatan'],
                        'opening'   => $row['opening'],
                        'closing'   => $row['closing'],
                    ];
                    Stage2daftarhadiraudititem::create($stage2daftarhadiraudit_items);
                }
            }
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Penugasan - Daftar Hadir Audit',
            ];

            Log2surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'resertifikasi') {
            if ($daftarhadir) {
                // insert item hadir
                foreach ($request->data as $row) {
                    $stage2daftarhadiraudit_items = [
                        'stage2daftarhadiraudit_id'  => $daftarhadir->id,
                        'nama'      => $row['name'],
                        'jabatan'   => $row['jabatan'],
                        'opening'   => $row['opening'],
                        'closing'   => $row['closing'],
                    ];
                    Stage2daftarhadiraudititem::create($stage2daftarhadiraudit_items);
                }
            }
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Stage II Daftar Hadir Audit',
            ];

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
            $stage2daftarhadiraudit = $client->stage2daftarhadiraudit_data($listpermohonan)->first();

            if ($stage2daftarhadiraudit != '') {
                $daftarhadir_items = Stage2daftarhadiraudititem::where('stage2daftarhadiraudit_id', $stage2daftarhadiraudit->id)->get();
            }

            $bagian = Level::where('id', auth()->user()->level_id)->first();
            $roles = explode(',', $bagian['access']);

            if ($listpermohonan_id->slug == 'sertifikasi_awal' || $listpermohonan_id->slug == 'resertifikasi') {
                if ($client->stage2checkaudit_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->stage2checkaudit_data($listpermohonan)->first()->status != '2') {
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

            return view('dashboard.stage2daftarhadirauditedit', [
                'title_bar'                 => 'Daftar Hadir Audit',
                'client'                    => $client,
                'listpermohonan_id'         => $listpermohonan_id,
                'listpermohonan_slug'       => $listpermohonan_id->slug,
                'permohonansertifikasi'     => $client->permohonansertifikasi_data($idsertifikasi)->first(),
                'kajianclient'              => $client->kajianclient_data($idsertifikasi)->first(),
                'perjanjianclient'          => $client->perjanjianclient_data($idsertifikasi)->first(),
                'rencanaclient'             => $client->rencanaclient_data($idsertifikasi)->first(),
                'stage2daftarhadiraudit'    => $client->stage2daftarhadiraudit_data($listpermohonan)->first(),
                'daftarhadir_items'         => $stage2daftarhadiraudit != '' ? $daftarhadir_items : '',
                'roles'                     => $roles
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
        $stage2daftarhadiraudit = $client->stage2daftarhadiraudit_data($listpermohonan)->first();

        $request->validate([
            'client_id'                     => 'required',
            'listpermohonan_id'             => 'required',
            'rapat'                         => 'required',
            'tanggal'                       => 'required',
            'tempat'                        => 'required',
            'status'                        => 'required',
        ]);

        $data['client_id'] = $request->client_id;
        $data['listpermohonan_id'] = $request->listpermohonan_id;
        $data['rapat'] = $request->rapat;
        $data['tanggal'] = $request->tanggal;
        $data['status'] = $request->status;
        $data['tempat'] = $request->tempat;


        Stage2daftarhadiraudit::where('id', $stage2daftarhadiraudit->id)->update($data);
        if ($request->data) {
            if ($stage2daftarhadiraudit) {
                // insert item hadir
                foreach ($request->data as $row) {
                    $stage2daftarhadiraudit_items = [
                        'stage2daftarhadiraudit_id'  => $stage2daftarhadiraudit->id,
                        'nama'      => $row['name'],
                        'jabatan'   => $row['jabatan'],
                        'opening'   => $row['opening'],
                        'closing'   => $row['closing'],
                    ];
                    Stage2daftarhadiraudititem::create($stage2daftarhadiraudit_items);
                }
            }
        }
        return response()->json(['status' => true, 'msg' => 'Berhasil disimpan!']);
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-07 - Daftar Hadir Audit.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $stage2daftarhadiraudit = $client->stage2daftarhadiraudit_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Stage2daftarhadiraudit::where('id', $stage2daftarhadiraudit->id)->update($data);

        // sent email client
        $log = 'Stage II Daftar Hadir Audit';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $stage2daftarhadiraudit->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Stage II Daftar Hadir Audit';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $stage2daftarhadiraudit->dipending_keterangan ?? '',
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
                $log = 'Stage II Daftar Hadir Audit';
                $auditordata = [
                    'user' => $item,
                    'client' => $client,
                    'permohonan' => $permohonan,
                    'log' => $log,
                    'status' => $request->status,
                    'keterangan' => '',
                    'dipending_keterangandata' => $stage2daftarhadiraudit->dipending_keterangan ?? '',
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

        Stage2daftarhadiraudititem::destroy($id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!.</div>');
    }

    public function download(Stage2daftarhadiraudit $stage2daftarhadiraudit)
    {
        $clientdata = Client::where('id', $stage2daftarhadiraudit->client_id)->first();

        $daftarhadiritem = Stage2daftarhadiraudititem::where('stage2daftarhadiraudit_id', $stage2daftarhadiraudit->id)->get();

        $setting = Setting::firstWhere('id', 1);

        $listpermohonan_data = Listpermohonan::get();
        $idsertifikasi = '';
        for ($i = $stage2daftarhadiraudit->listpermohonan_id; $i >= 1; $i--) {
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
            ->loadView('dashboard.stage2daftarhadirauditDownload', [
                'title_bar'                 => 'Daftar Hadir Audit',
                'permohonansertifikasi'     => $clientdata->permohonansertifikasi_data($idsertifikasi)->first(),
                'kajianclient'              => $clientdata->kajianclient_data($idsertifikasi)->first(),
                'perjanjianclient'          => $clientdata->perjanjianclient_data($idsertifikasi)->first(),
                'rencanaclient'             => $clientdata->rencanaclient_data($idsertifikasi)->first(),
                'stage2daftarhadiraudit'    => $stage2daftarhadiraudit,
                'daftarhadiritem'           => $daftarhadiritem ?? '',
                'setting'                   => $setting
            ]);
        return $pdf->stream();
    }
}
