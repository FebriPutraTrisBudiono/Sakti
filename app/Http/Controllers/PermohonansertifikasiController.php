<?php

namespace App\Http\Controllers;

use App\Mail\Status;
use App\Mail\Statusadmin;
use App\Mail\Statusupdate;
use App\Mail\Statusvalidasi;
use App\Models\User;
use App\Models\Level;
use App\Models\Client;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Listpermohonan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Logresertifikasi;
use App\Models\Logawalcertification;
use Illuminate\Support\Facades\Mail;
use App\Models\Permohonansertifikasi;
use Illuminate\Support\Facades\Storage;

class PermohonansertifikasiController extends Controller
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
            'client_id'                             => 'required',
            'listpermohonan_id'                     => 'required',
            'nama_perusahaan'                       => 'required',
            'alamat'                                => 'required',
            'no_siup'                               => 'required',
            'nama_website'                          => 'required',
            'no_phone'                              => 'required',
            'no_fax'                                => 'required',
            'type_industry'                         => 'required',
            'produk_akhir_perusahaan'               => 'required',
            'ruang_lingkup_perusahaan'              => 'required',
            'nama_pimpinan'                         => 'required',
            'no_phone_pimpinan'                     => 'required',
            'no_fax_pimpinan'                       => 'required',
            'email_pimpinan'                        => 'required',
            'no_hp_pimpinan'                        => 'required',
            'nama_wakil'                            => 'required',
            'no_phone_wakil'                        => 'required',
            'no_fax_wakil'                          => 'required',
            'email_wakil'                           => 'required',
            'no_hp_wakil'                           => 'required',
            'jml_karyawan'                          => 'required',
            'shift1'                                => 'required',
            'shift2'                                => 'required',
            'shift3'                                => 'required',
            'riset_dan_perkembangan'                => 'required',
            'jumlah_lokasi_audit'                   => 'required',
            'alamat_audit'                          => 'required',
            'sudah_sertifikasi'                     => 'required',
            'badan_sertifikasi'                     => 'required',
            'nama_badan_sertifikasi'                => 'required',
            'iso'                                   => 'required',
            'dibantu_konsultasi'                    => 'required',
            'nama_konsultasi'                       => 'required',
            'sertifikasi_bagian_grup_lain'          => 'required',
            'sertifikasi_bagian_grup_lain_jelaskan' => 'required',
            'diberlakukan_jam_kerja_shift'          => 'required',
            'diberlakukan_jam_kerja_shift_jelaskan' => 'required',
            'pekerjaan_disubkontrakkan'             => 'required',
            'pekerjaan_disubkontrakkan_jelaskan'    => 'required',
            'status_akreditasi'                     => 'required',
            'tanggal_internal_audit_terakhir'       => 'required',
            'tanggal_rapat_tinjauan_terakhir'       => 'required',
            'dokumen_manual_lengkap'                => 'required',
            'sistem_manajemen_sudah_audit'          => 'required',
            'rencana_bulan_sertifikasi'             => 'required',
            'rencana_tahun_sertifikasi'             => 'required',
            'input_akte'                            => 'max:2048',
            'input_struktur'                        => 'max:2048',
            'input_mutu'                            => 'max:2048',
            'input_denah'                           => 'max:2048',
            'pernyataan'                            => 'required',
        ]);
        if ($request->hasFile('input_akte')) {
            $data['input_akte'] = $request->input_akte->store('uploads');
        }
        if ($request->hasFile('input_struktur')) {
            $data['input_struktur'] = $request->input_struktur->store('uploads');
        }
        if ($request->hasFile('input_mutu')) {
            $data['input_mutu'] = $request->input_mutu->store('uploads');
        }
        if ($request->hasFile('input_denah')) {
            $data['input_denah'] = $request->input_denah->store('uploads');
        }

        // Save to database
        $data['status'] = 1;
        Permohonansertifikasi::create($data);

        if ($request->listpermohonan_slug == 'sertifikasi_awal') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Permohonan Sertifikasi',
            ];
            Logawalcertification::create($log);
        } elseif ($request->listpermohonan_slug == 'resertifikasi') {
            $log = [
                'client_id' => $request->client_id,
                'listpermohonan_id' => $request->listpermohonan_id,
                'tahapan_sertifikasi' => 'Permohonan Sertifikasi',
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

            return view('dashboard.permohonansertifikasiedit', [
                'title_bar' => 'Daftar Isian Permohonan Sertifikasi',
                'client' => $client,
                'roles' => $roles,
                'listpermohonan_id' => $listpermohonan_id,
                'listpermohonan_slug' => $listpermohonan_id->slug,
                'permohonansertifikasi' => $client->permohonansertifikasi_data($listpermohonan)->first() ?? '',
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
        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $permohonansertifikasi = $client->permohonansertifikasi_data($listpermohonan)->first();

        $data = $request->validate([
            'client_id'                             => 'required',
            'listpermohonan_id'                     => 'required',
            'nama_perusahaan'                       => 'required',
            'alamat'                                => 'required',
            'no_siup'                               => 'required',
            'nama_website'                          => 'required',
            'no_phone'                              => 'required',
            'no_fax'                                => 'required',
            'type_industry'                         => 'required',
            'produk_akhir_perusahaan'               => 'required',
            'ruang_lingkup_perusahaan'              => 'required',
            'nama_pimpinan'                         => 'required',
            'no_phone_pimpinan'                     => 'required',
            'no_fax_pimpinan'                       => 'required',
            'email_pimpinan'                        => 'required',
            'no_hp_pimpinan'                        => 'required',
            'nama_wakil'                            => 'required',
            'no_phone_wakil'                        => 'required',
            'no_fax_wakil'                          => 'required',
            'email_wakil'                           => 'required',
            'no_hp_wakil'                           => 'required',
            'jml_karyawan'                          => 'required',
            'shift1'                                => 'required',
            'shift2'                                => 'required',
            'shift3'                                => 'required',
            'riset_dan_perkembangan'                => 'required',
            'jumlah_lokasi_audit'                   => 'required',
            'alamat_audit'                          => 'required',
            'sudah_sertifikasi'                     => 'required',
            'badan_sertifikasi'                     => 'required',
            'nama_badan_sertifikasi'                => 'required',
            'iso'                                   => 'required',
            'dibantu_konsultasi'                    => 'required',
            'nama_konsultasi'                       => 'required',
            'sertifikasi_bagian_grup_lain'          => 'required',
            'sertifikasi_bagian_grup_lain_jelaskan' => 'required',
            'diberlakukan_jam_kerja_shift'          => 'required',
            'diberlakukan_jam_kerja_shift_jelaskan' => 'required',
            'pekerjaan_disubkontrakkan'             => 'required',
            'pekerjaan_disubkontrakkan_jelaskan'    => 'required',
            'status_akreditasi'                     => 'required',
            'tanggal_internal_audit_terakhir'       => 'required',
            'tanggal_rapat_tinjauan_terakhir'       => 'required',
            'dokumen_manual_lengkap'                => 'required',
            'sistem_manajemen_sudah_audit'          => 'required',
            'rencana_bulan_sertifikasi'             => 'required',
            'rencana_tahun_sertifikasi'             => 'required',
            'input_akte'                            => 'max:2048',
            'input_struktur'                        => 'max:2048',
            'input_mutu'                            => 'max:2048',
            'input_denah'                           => 'max:2048',
            'pernyataan'                            => 'required',
            'uploadttd'                             => 'max:2048',
        ]);

        if ($request->hasFile('input_akte')) {
            if ($request->input_akte) {
                Storage::delete($request->input_akte);
            }
            $data['input_akte'] = $request->input_akte->store('uploads');
        }
        if ($request->hasFile('input_struktur')) {
            if ($request->input_struktur) {
                Storage::delete($request->input_struktur);
            }
            $data['input_struktur'] = $request->input_struktur->store('uploads');
        }
        if ($request->hasFile('input_mutu')) {
            if ($request->input_mutu) {
                Storage::delete($request->input_mutu);
            }
            $data['input_mutu'] = $request->input_mutu->store('uploads');
        }
        if ($request->hasFile('input_denah')) {
            if ($request->input_denah) {
                Storage::delete($request->input_denah);
            }
            $data['input_denah'] = $request->input_denah->store('uploads');
        }
        if ($request->hasFile('uploadttd')) {
            if ($request->uploadttd) {
                Storage::delete($request->uploadttd);
            }
            $data['uploadttd'] = $request->uploadttd->store('uploads');
        }

        Permohonansertifikasi::where('id', $permohonansertifikasi->id)->update($data);

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Permohonan Sertifikasi';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $permohonansertifikasi->status,
                'keterangan' => '',
                'dipending_keterangandata' => $permohonansertifikasi->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($item->email)->send(new Statusvalidasi($admindata));
        }

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function updatevalidasi(Request $request, Client $client, $listpermohonan)
    {
        $level = Level::where('id', $client->user->level_id)->first();
        $roles = explode(',', $level['access']);

        if (!in_array('F-CER-01 - Daftar Isian Permohon.store', $roles)) {
            if ($request->status == 2) {
                $keterangan = 'Proses sertifikasi pada tahap sebelumnya telah selesai diproses oleh admin, Silahkan isi form-form pada tahap selanjutnya. Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.';
            } else {
                $keterangan = '';
            }
        } else {
            $keterangan = '';
        }

        $permohonan = Listpermohonan::where('id', $listpermohonan)->first();
        $permohonansertifikasi = $client->permohonansertifikasi_data($listpermohonan)->first();

        if ($request->status == 3) {
            $request->validate([
                'dipending_keterangan' => 'required',
            ]);
            $data['dipending_keterangan'] = $request->dipending_keterangan;
        } else {
            $data['dipending_keterangan'] = '';
        }
        $data['status'] = $request->status;

        Permohonansertifikasi::where('id', $permohonansertifikasi->id)->update($data);

        // sent email client
        $log = 'Permohonan Sertifikasi';
        $clientdata = [
            'user' => $client->user,
            'client' => $client,
            'permohonan' => $permohonan,
            'log' => $log,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'dipending_keterangandata' => $permohonansertifikasi->dipending_keterangan ?? '',
            'dipending_keterangan' => $request->dipending_keterangan ?? '',
        ];
        Mail::to($client->user->email)->send(new Statusvalidasi($clientdata));

        // sent email admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $item) {
            $log = 'Permohonan Sertifikasi';
            $admindata = [
                'user' => $item,
                'client' => $client,
                'permohonan' => $permohonan,
                'log' => $log,
                'status' => $request->status,
                'keterangan' => '',
                'dipending_keterangandata' => $permohonansertifikasi->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($item->email)->send(new Statusvalidasi($admindata));
        }

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Status Berhasil Disimpan!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }

    public function download(Permohonansertifikasi $permohonansertifikasi)
    {
        $setting = Setting::firstWhere('id', 1);

        $pdf = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.permohonansertifikasiDownload', [
                'title_bar'                 => 'Download',
                'permohonan_sertifikasi'    => $permohonansertifikasi,
                'setting'                   => $setting
            ]);
        return $pdf->stream();
    }
}
