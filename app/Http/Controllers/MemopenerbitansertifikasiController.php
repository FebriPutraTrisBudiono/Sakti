<?php

namespace App\Http\Controllers;

use App\Mail\Status;
use App\Models\User;
use App\Models\Level;
use App\Models\Client;
use App\Models\Setting;
use App\Mail\Statusvalidasi;
use Illuminate\Http\Request;
use App\Models\Listpermohonan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Logresertifikasi;
use App\Models\Logawalcertification;
use Illuminate\Support\Facades\Mail;
use App\Models\Memopenerbitansertifikasi;

class MemopenerbitansertifikasiController extends Controller
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
            'listpermohonan_id' => 'required',
            'tanggal' => 'required',
            'no_ref' => 'required',
            'dari' => 'required',
            'no_sertifikat' => 'required',
            'tgl_sertifikat' => 'required',
            'tgl_survailen' => 'required',
            'renewal' => 'required',
            'manajer_sertifikasi' => 'required',
            'lingkup_1' => 'required',
            'lingkup_2' => 'required',
            'lingkup_3' => 'required',
            'lingkup_4' => 'required',
        ]);

        $data['nama_ttd'] = $request->nama_ttd;

        // save to database
        $data['status'] = 1;
        Memopenerbitansertifikasi::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Memo Penerbitan Sertifikasi',
            ];
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Memo Penerbitan Sertifikasi',
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

            if ($listpermohonan_id->slug == 'sertifikasi_awal' || $listpermohonan_id->slug == 'resertifikasi') {
                if ($client->reviewkeputusansertifikasi_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->reviewkeputusansertifikasi_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                }
            }

            $bagian = Level::where('id', auth()->user()->level_id)->first();
            $roles = explode(',', $bagian['access']);

            return view('dashboard.memopenerbitansertifikasi', [
                'title_bar' => 'Memo Penerbitan Sertifikasi',
                'client' => $client,
                'listpermohonan_slug'   => $listpermohonan_id->slug,
                'permohonansertifikasi' => $client->permohonansertifikasi_data($listpermohonan)->first() ?? '',
                'memopenerbitansertifikasi' => $client->memopenerbitansertifikasi_data($listpermohonan)->first() ?? '',
                'listpermohonan_id' => $listpermohonan_id,
                'roles' => $roles,
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
        $memopenerbitansertifikasi = $client->memopenerbitansertifikasi_data($listpermohonan)->first();

        $data = $request->validate([
            'client_id' => 'required',
            'listpermohonan_id' => 'required',
            'tanggal' => 'required',
            'no_ref' => 'required',
            'dari' => 'required',
            'no_sertifikat' => 'required',
            'tgl_sertifikat' => 'required',
            'tgl_survailen' => 'required',
            'renewal' => 'required',
            'manajer_sertifikasi' => 'required',
            'lingkup_1' => 'required',
            'lingkup_2' => 'required',
            'lingkup_3' => 'required',
            'lingkup_4' => 'required',
        ]);

        $data['nama_ttd'] = $request->nama_ttd;

        Memopenerbitansertifikasi::where('id', $memopenerbitansertifikasi->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-12 - Memo Penerbitan Sertifikat.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $memopenerbitansertifikasi = $client->memopenerbitansertifikasi_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Memopenerbitansertifikasi::where('id', $memopenerbitansertifikasi->id)->update($data);

        // sent email client
        $log = 'Memo Penerbitan Sertifikasi';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $memopenerbitansertifikasi->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Memo Penerbitan Sertifikasi';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $memopenerbitansertifikasi->dipending_keterangan ?? '',
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
                $log = 'Memo Penerbitan Sertifikasi';
                $auditordata = [
                    'user' => $item,
                    'client' => $client,
                    'permohonan' => $permohonan,
                    'log' => $log,
                    'status' => $request->status,
                    'keterangan' => '',
                    'dipending_keterangandata' => $memopenerbitansertifikasi->dipending_keterangan ?? '',
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

    public function download(Memopenerbitansertifikasi $memopenerbitansertifikasi)
    {
        $clientdata = Client::where('id', $memopenerbitansertifikasi->client_id)->first();
        $setting = Setting::firstWhere('id', 1);

        $listpermohonan_data = Listpermohonan::get();
        $idsertifikasi = '';
        for ($i = $memopenerbitansertifikasi->listpermohonan_id; $i >= 1; $i--) {
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
            ->loadView('dashboard.memopenerbitansertifikasiDownload', [
                'title_bar' => 'Download',
                'client' => $clientdata,
                'setting' => $setting,
                'permohonansertifikasi'     => $clientdata->permohonansertifikasi_data($idsertifikasi)->first(),
                'memopenerbitansertifikasi' => $clientdata->memopenerbitansertifikasi_data($memopenerbitansertifikasi->listpermohonan_id)->first(),
            ]);
        return $pdf->stream();
    }
}
