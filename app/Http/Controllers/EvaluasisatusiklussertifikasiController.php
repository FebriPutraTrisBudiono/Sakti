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
use Illuminate\Support\Facades\Mail;
use App\Models\Evaluasisatusiklussertifikasi;

class EvaluasisatusiklussertifikasiController extends Controller
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
            'stage1tanggalaudit' => 'required',
            'stage1hasilmajor' => 'required',
            'stage1hasilminor' => 'required',
            'stage1hasilobservasi' => 'required',
            'stage1tindaklanjut' => 'required',
            'stage2tanggalaudit' => 'required',
            'stage2hasilmajor' => 'required',
            'stage2hasilminor' => 'required',
            'stage2hasilobservasi' => 'required',
            'stage2tindaklanjut' => 'required',
            'survailen1tanggalaudit' => 'required',
            'survailen1hasilmajor' => 'required',
            'survailen1hasilminor' => 'required',
            'survailen1hasilobservasi' => 'required',
            'survailen1tindaklanjut' => 'required',
            'survailen2tanggalaudit' => 'required',
            'survailen2hasilmajor' => 'required',
            'survailen2hasilminor' => 'required',
            'survailen2hasilobservasi' => 'required',
            'survailen2tindaklanjut' => 'required',
            'overview_1' => 'required',
            'overview_2' => 'required',
            'overview_3' => 'required',
            'overview_4' => 'required',
            'overview_5' => 'required',
            'overview_6' => 'required',
            'catatan' => 'required',
        ]);
        $data['tgl_ttd'] = $request->tgl_ttd;
        $data['nama_ttd'] = $request->nama_ttd;

        // save to database
        $data['status'] = 1;
        Evaluasisatusiklussertifikasi::create($data);

        $log = [
            'client_id' => $request->client_id,
            'listpermohonan_id' => $request->listpermohonan_id,
            'tahapan_sertifikasi' => 'Evaluasi Satu Siklus Sertifikasi',
        ];
        Logresertifikasi::create($log);

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
                if ($client->kajianclient_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->kajianclient_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } else if (!in_array('F-CER-13 - Evaluasi Satu Siklus Sertifikasi.view', $roles)) {
                    return redirect()->back()->with('alert', 'Maaf, Proses sebelumnya masih dalam proses audit.');
                }
            } else if ($listpermohonan_id->slug == 'surveilance1' || $listpermohonan_id->slug == 'surveilance2') {
                if ($client->kajianclient_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->kajianclient_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } else if (!in_array('F-CER-13 - Evaluasi Satu Siklus Sertifikasi.view', $roles)) {
                    return redirect()->back()->with('alert', 'Maaf, Proses sebelumnya masih dalam proses audit.');
                }
            }

            return view('dashboard.evaluasisatusiklussertifikasiedit', [
                'client'                        => $client,
                'listpermohonan_id'             => $listpermohonan_id,
                'listpermohonan_slug'           => $listpermohonan_id->slug,
                'evaluasisatusiklussertifikasi' => $client->evaluasisatusiklussertifikasi_data($listpermohonan)->first() ?? '',
                'permohonansertifikasi'         => $client->permohonansertifikasi_data($listpermohonan)->first() ?? '',
                'kajianclient'                  => $client->kajianclient_data($listpermohonan)->first() ?? '',
                'rencanaclient'                 => $client->rencanaclient_data($listpermohonan)->first() ?? '',
                'roles'                         => $roles,
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
        $evaluasisatusiklussertifikasi = $client->evaluasisatusiklussertifikasi_data($listpermohonan)->first();

        $data = $request->validate([
            'client_id' => 'required',
            'listpermohonan_id' => 'required',
            'stage1tanggalaudit' => 'required',
            'stage1hasilmajor' => 'required',
            'stage1hasilminor' => 'required',
            'stage1hasilobservasi' => 'required',
            'stage1tindaklanjut' => 'required',
            'stage2tanggalaudit' => 'required',
            'stage2hasilmajor' => 'required',
            'stage2hasilminor' => 'required',
            'stage2hasilobservasi' => 'required',
            'stage2tindaklanjut' => 'required',
            'survailen1tanggalaudit' => 'required',
            'survailen1hasilmajor' => 'required',
            'survailen1hasilminor' => 'required',
            'survailen1hasilobservasi' => 'required',
            'survailen1tindaklanjut' => 'required',
            'survailen2tanggalaudit' => 'required',
            'survailen2hasilmajor' => 'required',
            'survailen2hasilminor' => 'required',
            'survailen2hasilobservasi' => 'required',
            'survailen2tindaklanjut' => 'required',
            'overview_1' => 'required',
            'overview_2' => 'required',
            'overview_3' => 'required',
            'overview_4' => 'required',
            'overview_5' => 'required',
            'overview_6' => 'required',
            'catatan' => 'required',
        ]);

        $data['tgl_ttd'] = $request->tgl_ttd;
        $data['nama_ttd'] = $request->nama_ttd;

        Evaluasisatusiklussertifikasi::where('id', $evaluasisatusiklussertifikasi->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-13 - Evaluasi Satu Siklus Sertifikasi.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $evaluasisatusiklussertifikasi = $client->evaluasisatusiklussertifikasi_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Evaluasisatusiklussertifikasi::where('id', $evaluasisatusiklussertifikasi->id)->update($data);

        // sent email client
        $log = 'Evaluasi Satu Siklus Sertifikasi';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $evaluasisatusiklussertifikasi->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Evaluasi Satu Siklus Sertifikasi';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $evaluasisatusiklussertifikasi->dipending_keterangan ?? '',
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

    public function download(Evaluasisatusiklussertifikasi $evaluasisatusiklussertifikasi)
    {
        $client = Client::where('id', $evaluasisatusiklussertifikasi->client_id)->first();

        $setting = Setting::firstWhere('id', 1);

        $pdf = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.evaluasisatusiklussertifikasiDownload', [
                'title_bar' => 'Download',
                'client' => $client,
                'setting' => $setting,
                'permohonansertifikasi'         => $client->permohonansertifikasi_data($evaluasisatusiklussertifikasi->listpermohonan_id)->first(),
                'rencanaclient'                 => $client->rencanaclient_data($evaluasisatusiklussertifikasi->listpermohonan_id)->first(),
                'evaluasisatusiklussertifikasi' => $evaluasisatusiklussertifikasi,
            ]);
        return $pdf->stream();
    }
}
