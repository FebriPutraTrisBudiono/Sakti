<?php

namespace App\Http\Controllers;

use App\Mail\NotifikasiExpired;
use App\Mail\Status;
use App\Models\User;
use App\Models\Level;
use App\Models\Client;
use App\Mail\Statusvalidasi;
use Illuminate\Http\Request;
use App\Models\Listpermohonan;
use App\Models\Log1surveilance;
use App\Models\Log2surveilance;
use App\Models\Logresertifikasi;
use App\Models\Logawalcertification;
use App\Models\Penerbitansertifikat;
use Illuminate\Support\Facades\Mail;

class PenerbitansertifikatController extends Controller
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
            'upload' => 'max:2048',
            'tgl_kadaluarsasertifikat' => 'required'
        ]);

        if ($request->hasFile('upload')) {
            $data['upload'] = $request->upload->store('uploads');
        }

        // save to database
        $data['status'] = 1;
        Penerbitansertifikat::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Penerbitan Sertifikat',
            ];
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance1') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Surat Keputusan Surveilance 1',
            ];
            Log1surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'surveilance2') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Surat Keputusan Surveilance 2',
            ];
            Log2surveilance::create($log);
        } elseif ($request->listpermohonan_slug == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Penerbitan Sertifikat',
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
                if ($client->memopenerbitansertifikasi_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->memopenerbitansertifikasi_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                }
            } else if ($listpermohonan_id->slug == 'surveilance1' || $listpermohonan_id->slug == 'surveilance2') {
                if ($client->stage2temuanverifcation_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->stage2temuanverifcation_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                }
            }

            $bagian = Level::where('id', auth()->user()->level_id)->first();
            $roles = explode(',', $bagian['access']);

            return view('dashboard.penerbitansertifikatedit', [
                'client' => $client,
                'listpermohonan_id' => $listpermohonan_id,
                'listpermohonan_slug'   => $listpermohonan_id->slug,
                'penerbitansertifikat' => $client->penerbitansertifikat_data($listpermohonan)->first() ?? '',
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
        $penerbitansertifikat = $client->penerbitansertifikat_data($listpermohonan)->first();

        $data = $request->validate([
            'client_id' => 'required',
            'listpermohonan_id' => 'required',
            'upload' => 'max:2048',
            'tgl_kadaluarsasertifikat' => 'required'
        ]);

        if ($request->hasFile('upload')) {
            $data['upload'] = $request->upload->store('uploads');
        }

        Penerbitansertifikat::where('id', $penerbitansertifikat->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('Penerbitan Sertifikasi.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $penerbitansertifikat = $client->penerbitansertifikat_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Penerbitansertifikat::where('id', $penerbitansertifikat->id)->update($data);

        // sent email client
        $log = 'Penerbitan Sertifikasi/Surveilance';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $penerbitansertifikat->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Penerbitan Sertifikasi/Surveilance';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $penerbitansertifikat->dipending_keterangan ?? '',
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
                $log = 'Penerbitan Sertifikasi/Surveilance';
                $auditordata = [
                    'user' => $item,
                    'client' => $client,
                    'permohonan' => $permohonan,
                    'log' => $log,
                    'status' => $request->status,
                    'keterangan' => '',
                    'dipending_keterangandata' => $penerbitansertifikat->dipending_keterangan ?? '',
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


    public function notifikasiexpired()
    {
        $penerbitansertifikat = Penerbitansertifikat::with('client')->where('tgl_kadaluarsasertifikat', '>=', date('Y-m-d'))->get();
        foreach ($penerbitansertifikat as $item) {
            $tgl_expired = $item->tgl_kadaluarsasertifikat;
            $date1 = date_create(date('Y-m-d', strtotime($tgl_expired))); //mis. tgl chekin
            $date2 = date_create(date('Y-m-d')); //mis. tgl chekout
            $diff = date_diff($date1, $date2); //menyimpan didalam fungsi date_diff
            $jumlah_hari = $diff->format("%d%"); //menampilkan jumlah hari

            // get email
            $email = $item->client->user->email;

            if ($jumlah_hari == 60) {
                Mail::to($email)->send(new NotifikasiExpired('60 Hari'));
            } else if ($jumlah_hari == 30) {
                Mail::to($email)->send(new NotifikasiExpired('30 Hari'));
            } else if ($jumlah_hari == 14) {
                Mail::to($email)->send(new NotifikasiExpired('14 Hari'));
            }
        }

        return true;
    }
}
