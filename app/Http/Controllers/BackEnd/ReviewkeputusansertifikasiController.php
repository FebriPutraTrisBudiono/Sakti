<?php

namespace App\Http\Controllers\BackEnd;

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
use App\Http\Controllers\Controller;
use App\Models\Logawalcertification;
use Illuminate\Support\Facades\Mail;
use App\Models\Reviewkeputusansertifikasi;

class ReviewkeputusansertifikasiController extends Controller
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
            'listpermohonan_id'                     => 'required',
            'deskripsi_pemohon'           => 'required',
            'kriteria_a1_1'           => 'required',
            'kriteria_a1_2'           => 'required',
            'kriteria_a1_3'           => 'required',
            'kriteria_a2'           => 'required',
            'kriteria_a3'           => 'required',
            'kriteria_a4'           => 'required',
            'kriteria_a4_1'           => 'required',
            'kriteria_a5'           => 'required',
            'kriteria_a5_1'           => 'required',
            'kriteria_a6'           => 'required',
            'kriteria_a6_1'           => 'required',
            'kriteria_a7'           => 'required',
            'kriteria_a7_1'           => 'required',
            'kriteria_a8_1'           => 'required',
            'kriteria_a8_2'           => 'required',
            'kriteria_a8_3'           => 'required',
            'kriteria_a9'           => 'required',
            'keputusan_sertifikasi'           => 'required',
            'catatan'           => 'required',
            'tanggal_pengambilkeputusan'           => 'required',
            'nama_pengambilkeputusan'           => 'required',
        ]);

        $data['nama_ttd'] = $request->nama_ttd;

        // save to database
        $data['status'] = 1;
        Reviewkeputusansertifikasi::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Review Keputusan Sertifikasi',
            ];
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Review Keputusan Sertifikasi',
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
                if ($client->stage2temuanverifcation_data($listpermohonan)->first() == '') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                } elseif ($client->stage2temuanverifcation_data($listpermohonan)->first()->status != '2') {
                    return redirect()->back()->with('alert', 'Maaf, Anda belum bisa mengakses halamanan ini.');
                }
            }

            $item = $client->stage1penunjukantimaudit_data($listpermohonan)->first();
            $arraudit = explode('|', $item['audit']);

            return view('dashboard.reviewkeputusansertifikasiedit', [
                'title_bar'                     => 'Review Keputusan Sertifikasi',
                'client'                        => $client,
                'listpermohonan_id'             => $listpermohonan_id,
                'listpermohonan_slug'           => $listpermohonan_id->slug,
                'permohonansertifikasi'         => $client->permohonansertifikasi_data($listpermohonan)->first(),
                'kajianclient'                  => $client->kajianclient_data($listpermohonan)->first(),
                'rencanaclient'                 => $client->rencanaclient_data($listpermohonan)->first(),
                'reviewkeputusansertifikasi'    => $client->reviewkeputusansertifikasi_data($listpermohonan)->first(),
                'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($listpermohonan)->first(),
                'stage2rencanaaudit'            => $client->stage2rencanaaudit_data($listpermohonan)->first(),
                'stage2checkaudit'              => $client->stage2checkaudit_data($listpermohonan)->first(),
                'stage2daftarhadiraudit'        => $client->stage2daftarhadiraudit_data($listpermohonan)->first(),
                'stage2laporanaudit'            => $client->stage2laporanaudit_data($listpermohonan)->first(),
                'roles'                         => $roles,
                'arraudit'                      => $arraudit,
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
        $reviewkeputusansertifikasi = $client->reviewkeputusansertifikasi_data($listpermohonan)->first();

        $data = $request->validate([
            'client_id'                     => 'required',
            'listpermohonan_id'                     => 'required',
            'deskripsi_pemohon'           => 'required',
            'kriteria_a1_1'           => 'required',
            'kriteria_a1_2'           => 'required',
            'kriteria_a1_3'           => 'required',
            'kriteria_a2'           => 'required',
            'kriteria_a3'           => 'required',
            'kriteria_a4'           => 'required',
            'kriteria_a4_1'           => 'required',
            'kriteria_a5'           => 'required',
            'kriteria_a5_1'           => 'required',
            'kriteria_a6'           => 'required',
            'kriteria_a6_1'           => 'required',
            'kriteria_a7'           => 'required',
            'kriteria_a7_1'           => 'required',
            'kriteria_a8_1'           => 'required',
            'kriteria_a8_2'           => 'required',
            'kriteria_a8_3'           => 'required',
            'kriteria_a9'           => 'required',
            'keputusan_sertifikasi'           => 'required',
            'catatan'           => 'required',
            'tanggal_pengambilkeputusan'           => 'required',
            'nama_pengambilkeputusan'           => 'required',
        ]);

        $data['nama_ttd'] = $request->nama_ttd;

        Reviewkeputusansertifikasi::where('id', $reviewkeputusansertifikasi->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Perubahan disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-11 - Review Keputusan Sertifikasi.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $reviewkeputusansertifikasi = $client->reviewkeputusansertifikasi_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Reviewkeputusansertifikasi::where('id', $reviewkeputusansertifikasi->id)->update($data);

        // sent email client
        $log = 'Review Keputusan Sertifikasi';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $reviewkeputusansertifikasi->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Review Keputusan Sertifikasi';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $reviewkeputusansertifikasi->dipending_keterangan ?? '',
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
                $log = 'Review Keputusan Sertifikasi';
                $auditordata = [
                    'user' => $item,
                    'client' => $client,
                    'permohonan' => $permohonan,
                    'log' => $log,
                    'status' => $request->status,
                    'keterangan' => '',
                    'dipending_keterangandata' => $reviewkeputusansertifikasi->dipending_keterangan ?? '',
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

    public function download(Reviewkeputusansertifikasi $reviewkeputusansertifikasi)
    {
        $client = Client::where('id', $reviewkeputusansertifikasi->client_id)->first();

        $setting = Setting::firstWhere('id', 1);

        $item = $client->stage1penunjukantimaudit_data($reviewkeputusansertifikasi->listpermohonan_id)->first();
        $arraudit = explode('|', $item['audit']);

        $pdf = Pdf::setPaper('a4', 'potrait')
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
        return $pdf->stream();
    }
}
