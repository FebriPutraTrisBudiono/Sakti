<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= $_SERVER['DOCUMENT_ROOT'] . '/assets/bootstrap/css/bootstrap.min.css' ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= $_SERVER['DOCUMENT_ROOT'] . '/assets/bootstrap/css/bootstrap.min.css' ?>">
    <style>
        /* Style Buat Header Dan Footer */
        @page {
            margin: 150px 50px 100px 50px;
        }

        header {
            position: fixed;
            top: -100px;
            left: 0px;
            right: 0px;
        }

        header2 {
            position: fixed;
            top: -100px;
            left: 550px;
            right: 0px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            word-spacing: 60px;

            /** Extra personal styles **/
            text-align: center;
            line-height: 35px;
        }

        .spacing {

            word-spacing: 200px;

        }

        /* Penutup Style Buat Header Dan Footer */

        table,
        th,
        td {
            border: 1px solid;
            padding-left: 2px;
            padding-right: 2px;
            padding-bottom: 3px;
            padding-top: 3px;
        }

        td {
            -ms-text-size-adjust: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .card {
            border: none;
        }
    </style>
    <title>Document</title>
</head>

<!-- <body>
     <table style="border: 1px;">
        <tbody>
            <tr>
                <th scope="row" style="border: 1px;">
                    <img src="{{ $setting->main_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->main_logo : '/assets/img/noimage.jpeg' }}"
    style="border: none" class="img-thumbnail main_logoPreview" width="160px">
    </th>
    <td style="border: 1px; text-align: right;">
        <img src="{{ $setting->sec_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}" style="border: none" class="img-thumbnail main_logoPreview" width="160px">
    </td>
    </tr>
    </tbody>
    </table>  -->

<!-- Buat Header Dan Footer -->
<header>
    <!-- Our Code World -->
    <img src="{{ $setting->doc_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->doc_logo : '/assets/img/noimage.jpeg' }}"
        width="200px">
</header>

<header2>
    <img src="{{ $setting->sec_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}"
        width="150px">
</header2>

<footer>
    <p class="spacing">F-CER-08 Rev.03 Date:09.07.20</p>
</footer>

<!-- Penutup Buat Header Dan Footer -->

<center>
    <h3>LAPORAN AUDIT</h3>
</center>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td class="col-sm-3" style="background-color:#d9d9da;"><b>Nama Pemohon</b></td>
                    <td colspan="11">: {{ $permohonansertifikasi->nama_pimpinan }}</td>
                </tr>
                <tr>
                    <td class="col-sm-3" style="background-color:#d9d9da;"><b>Alamat</b></td>
                    <td colspan="11">: {{ $permohonansertifikasi->alamat }}</td>
                </tr>
                <tr>
                    <td class="col-sm-3" style="background-color:#d9d9da;"><b>Wakil Manajemen</b></td>
                    <td colspan="11">: {{ $permohonansertifikasi->nama_wakil }}</td>
                </tr>
                <tr>
                    <td class="col-sm-3" style="background-color:#d9d9da;"><b>Ruang Lingkup</b></td>
                    <td colspan="11">: {{ $permohonansertifikasi->ruang_lingkup_perusahaan }}</td>
                </tr>
                <tr>
                    <td class="col-sm-3" style="background-color:#d9d9da;"><b>Standar</b></td>
                    <td colspan="11">: {{ $rencanaclient->standart }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="18" style="background-color:lightgray;">
                        <center><b>Audit</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><input type="checkbox"
                            {{ ($arraudit[0] ?? '') == 'pra_audit' ? 'checked' : '' }}><label>Pra
                            audit</label></td>
                    <td colspan="3"><input type="checkbox"
                            {{ ($arraudit[1] ?? '') == 'stage1' ? 'checked' : '' }}><label>Stage
                            I</label></td>
                    <td colspan="3"><input
                            type="checkbox"{{ ($arraudit[2] ?? '') == 'stage2' ? 'checked' : '' }}><label>Stage
                            II</label></td>
                    <td colspan="3"><input
                            type="checkbox"{{ ($arraudit[3] ?? '') == 'surveilen' ? 'checked' : '' }}><label>Surveilan</label>
                    </td>
                    <td colspan="3"><input
                            type="checkbox"{{ ($arraudit[4] ?? '') == 'tindaklanjut' ? 'checked' : '' }}><label>Tindaklanjut</label>
                    </td>
                    <td colspan="3"><input
                            type="checkbox"{{ ($arraudit[5] ?? '') == 'resertifikasi' ? 'checked' : '' }}><label>Re-Sertifikasi</label>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr style="background-color:lightgray">
                    <td colspan="1">
                        <center><b>No</b></center>
                    </td>
                    <td colspan="5">
                        <center><b>Nama Auditor</b></center>
                    </td>
                    <td colspan="3">
                        <center><b>Inisial</b></center>
                    </td>
                    <td colspan="3">
                        <center><b>Jabatan</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>1</center>
                    </td>
                    <?php
                    $user = new App\Models\User();
                    $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor)->first();
                    ?>
                    <td colspan="5">{{ $stage1penunjukantimaudit->nama_auditor ? $userid->name : '' }}</td>
                    <td colspan="3">{{ $stage1penunjukantimaudit->nama_inisial }}</td>
                    <td colspan="3">{{ $stage1penunjukantimaudit->jabatan }}</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>2</center>
                    </td>
                    <?php
                    $user = new App\Models\User();
                    $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor2)->first();
                    ?>
                    <td colspan="5">{{ $stage1penunjukantimaudit->nama_auditor2 ? $userid->name : '' }}</td>
                    <td colspan="3">{{ $stage1penunjukantimaudit->nama_inisial2 }}</td>
                    <td colspan="3">{{ $stage1penunjukantimaudit->jabatan2 }}</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>3</center>
                    </td>
                    <?php
                    $user = new App\Models\User();
                    $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor3)->first();
                    ?>
                    <td colspan="5">{{ $stage1penunjukantimaudit->nama_auditor3 ? $userid->name : '' }}</td>
                    <td colspan="3">{{ $stage1penunjukantimaudit->nama_inisial3 }}</td>
                    <td colspan="3">{{ $stage1penunjukantimaudit->jabatan3 }}</td>
                </tr>
                <tr>
                    <td colspan="6" rowspan="1">Untuk bertugas tanggal</td>
                    <td colspan="2" rowspan="1">{{ $stage1penunjukantimaudit->tanggal_bertugas }}</td>
                    <td colspan="2" rowspan="1">Sampai dengan</td>
                    <td colspan="2" rowspan="1">{{ $stage1penunjukantimaudit->sampai_dengan }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="12" style="background-color:lightgray;">
                        <center><b>Ringkasan Temuan Audit</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Jumlah Temuan</b>
                    </td>
                    <td colspan="3">
                        <b>Major:</b>
                    </td>
                    <td colspan="3">
                        <b>Minor:</b>
                    </td>
                    <td colspan="3">
                        <b>Obsevasi:</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Apakah perlu kunjungan tambahan :</b>
                    </td>
                    <td colspan="3">
                        {{ $stage2laporanaudit->major_2 == 1 ? 'YA' : 'TIDAK' }}
                    </td>
                    <td colspan="3">
                        <b>Rencana Kunjungan :</b>
                    </td>
                    <td colspan="3">
                        {{ $stage2laporanaudit->observasi_4 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <b>Alasan Kunjungan Tambahan:</b><br>
                        {{ $stage2laporanaudit->rencanakunjungan_3 }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="12" style="background-color:lightgray;">
                        <center><b>Rekomendasi</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <b>Rekomendasi Lead Auditor:</b>
                        <br>
                        <input type="checkbox" {{ $stage2laporanaudit->rekomendasi == 1 ? 'checked' : '' }}>
                        &nbsp; <label>Direkomendasikan</label>
                        <br>
                        <input type="checkbox" {{ $stage2laporanaudit->rekomendasi == 2 ? 'checked' : '' }}>
                        &nbsp; <label>Diproses setelah rencana tindakan perbaikan dinilai
                            memuaskan</label>
                        <br>
                        <input type="checkbox" {{ $stage2laporanaudit->rekomendasi == 3 ? 'checked' : '' }}>
                        &nbsp; <label>Dilanjutkan setelah rencana tindakan perbaikan dinilai
                            memuaskan</label>
                        <br>
                        <input type="checkbox" {{ $stage2laporanaudit->rekomendasi == 4 ? 'checked' : '' }}>
                        &nbsp; <label>Dipertahankan</label>
                        <br>
                        <input type="checkbox" {{ $stage2laporanaudit->rekomendasi == 5 ? 'checked' : '' }}>
                        &nbsp; <label>Dibekukan sampai melengkapi rencana tindakan perbaikan
                            yang memadai</label>
                        <br>
                        <input type="checkbox" {{ $stage2laporanaudit->rekomendasi == 6 ? 'checked' : '' }}>
                        &nbsp; <label>Dicabut</label>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="12" style="background-color:#f4f3f3;">
                        <center><b>Ruang Lingkup</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        {{ $permohonansertifikasi->ruang_lingkup_perusahaan }}
                    </td>
                </tr>
                <tr>
                    <td colspan="6"><b>Akreditasi</b></td>
                    <td colspan="2" style="text-align: center">
                        {{ $stage2laporanaudit->rl_akreditasi1 ?? '-' }}</td>
                    <td colspan="2" style="text-align: center">
                        {{ $stage2laporanaudit->rl_akreditasi2 ?? '-' }}</td>
                    <td colspan="2" style="text-align: center">
                        {{ $stage2laporanaudit->rl_akreditasi3 ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="6"><b>Jumlah Sertifikat</b></td>
                    <td colspan="2" style="text-align: center">
                        {{ $stage2laporanaudit->rl_jmlsertifikat1 ?? '-' }}</td>
                    <td colspan="2" style="text-align: center">
                        {{ $stage2laporanaudit->rl_jmlsertifikat2 ?? '-' }}</td>
                    <td colspan="2" style="text-align: center">
                        {{ $stage2laporanaudit->rl_jmlsertifikat3 ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="6"><b>Bahasa</b></td>
                    <td colspan="2" style="text-align: center">
                        {{ $stage2laporanaudit->rl_bahasa1 ?? '-' }}</td>
                    <td colspan="2" style="text-align: center">
                        {{ $stage2laporanaudit->rl_bahasa2 ?? '-' }}</td>
                    <td colspan="2" style="text-align: center">
                        {{ $stage2laporanaudit->rl_bahasa3 ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="12" style="background-color:#f4f3f3;">
                        <center><b>Ringkasan Audit</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <center><b>Hasil Audit Sebelumnya</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="6"></td>
                    <td colspan="3" style="background-color:#d9d9da;">
                        <center><b>Major</b></center>
                    </td>
                    <td colspan="3" style="background-color:#d9d9da;">
                        <center><b>Minor</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">Jumlah ketidaksesuaian audit sebelumnya</td>
                    <td colspan="3">{{ $stage2laporanaudit->ra1_major ?? '-' }}</td>
                    <td colspan="3">{{ $stage2laporanaudit->ra1_minor ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="6">Jumlah ketidaksesuaian yang di “closed”</td>
                    <td colspan="3">{{ $stage2laporanaudit->ra2_major ?? '-' }}</td>
                    <td colspan="3">{{ $stage2laporanaudit->ra2_minor ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="6">Jumlah ketidaksesuaian berulang</td>
                    <td colspan="3">{{ $stage2laporanaudit->ra3_major ?? '-' }}</td>
                    <td colspan="3">{{ $stage2laporanaudit->ra3_minor ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="12">
                        <h4>Sampling Audit</h4>
                        Metode audit yang digunakan adalah metode sampling dengan melakukan tinjauan dokumentasi dan
                        rekaman, wawancara, serta observasi lapangan.
                        <br>
                        <br>
                        Oleh karena itu, jika terdapat ketidaksesuaian pada suatu dokumen, rekaman, kegiatan, atau
                        proses yang dijadikan sample maka bisa jadi hal tersebut terjadi pada dokumen, rekaman,
                        kegiatan, atau proses yang lain, dan demikian juga sebaliknya.
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <h4>Ketidaksesuaian / Nonconformity</h4>
                        Ketidaksesuaian yang dijelaskan dalam laporan ini ditujukan agar dilakukan tindakan perbaikan
                        yang sesuai dengan persyaratan standar audit dan ditujukan untuk mencegah terulang kembali,
                        serta rekaman yang terkait dipelihara. Ketidaksesuaian dibagi menjadi 2 (dua) kategori, yaitu:
                        <br>
                        <br>
                        <h4>Ketidaksesuaian Major</h4>
                        Pemohon/Klien harus menyampaikan <b> bukti tindakan perbaikan (analisa penyebab, koreksi dan
                            tindakan korektif) </b> paling lambat 1 bulan dari hari terakhir pelaksanaan audit.
                        <br>
                        <br>
                        <h4>Ketidaksesuaian Minor</h4>
                        Pemohon/Klien harus menyampaikan <b> rencana bukti tindakan perbaikan </b> (koreksi dan tindakan
                        korektif) paling lambat 2 bulan dari hari terakhir pelaksanaan audit.
                        <br>
                        Bukti tindakan perbaikan dapat disampaikan kepada PT SAKTI Indonesia Sertifikasi baik dalam
                        bentuk hard copy maupun dalam bentuk soft copy dengan menggunakan form ketidakesuaian.
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <h4>Observasi (Weakness)</h4>
                        Pemohon/Klien tidak berkewajiban untuk mengirimkan respon tindakan atas temuan observasi. Dan
                        Tim Audit tidak berkewajiban untuk memverifikasi efektivitas tindakan pencegahan atas observasi
                        yang dilaporkan.
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <h4>Penggunaan Logo</h4>
                        Penggunaan logo akan direview apabila sudah melalui tahapan stage 2 audit sertifikasi, sehingga
                        hal ini bisa di lihat kembali penggunaan logo pada organisasi akan dilakukan pada tahap
                        survailen, Pengaturan logo sertifikasi, ISO 9001/ISO 21001 akan diatur dalam sistem penggunaan
                        logo terpisah dalam laporan audit ini.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card mt-3" style="page-break-before: always;">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="12" style="background-color:lightgray;">
                        <center><b>Rincian Observasi</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="background-color:lightgray;">
                        <center><b>No</b></center>
                    </td>
                    <td colspan="11" style="background-color:lightgray;">
                        <center><b>Uraian</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">1</td>
                    <td colspan="11">{{ $stage2laporanaudit->ro_uraian1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">{{ $stage2laporanaudit->ro_uraian2 ? '2' : '' }}
                    </td>
                    <td colspan="11">{{ $stage2laporanaudit->ro_uraian2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">{{ $stage2laporanaudit->ro_uraian2 ? '3' : '' }}
                    </td>
                    <td colspan="11">{{ $stage2laporanaudit->ro_uraian3 ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="1" style="text-align: center">{{ $stage2laporanaudit->ro_uraian2 ? '4' : '' }}
                    </td>
                    <td colspan="11">{{ $stage2laporanaudit->ro_uraian4 ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="12" style="background-color:lightgray;"><b>Kesimpulan Hasil Audit</b></td>
                </tr>
                <tr>
                    <td colspan="12">Kesesuaian dan efektifitas dari sistem manajemen</td>
                </tr>
                <tr>
                    <td colspan="12">
                        Apakah kemampuan sistem manajemen untuk memenuhi persyaratan dan keluaran yang diharapkan
                        <br>
                        <input type="checkbox" class="ms-3"
                            {{ $stage2laporanaudit->kha_1 == 'Memenuhi' ? 'checked' : '' }}>
                        <label>Memenuhi</label>
                        <br>
                        <input type="checkbox" class="ms-3"
                            {{ $stage2laporanaudit->kha_1 == 'Belum Memenuhi' ? 'checked' : '' }}>
                        <label>Belum Memenuhi</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        Proses audit internal
                        <br>
                        &nbsp;&nbsp;-&nbsp;&nbsp; Kapan Pelaksanaan Audit
                        Internal? {{ $stage2laporanaudit->pai_kapanpelaksanaan }}
                        <br>
                        &nbsp;&nbsp;-&nbsp;&nbsp; Jumlah temuan audit
                        internal {{ $stage2laporanaudit->pai_jumlahtemuan }}
                        <br>
                        &nbsp;&nbsp;-&nbsp;&nbsp; Apakah temuan audit internal telah ditindaklanjuti (diverifikasi dan
                        closed out)
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox"
                            {{ ($stage2laporanaudit->pai_apakahtemuan ?? '') == 1 ? 'checked' : '' }}>
                        &nbsp; <label>Ya</label> &nbsp;&nbsp;
                        <input type="checkbox"
                            {{ ($stage2laporanaudit->pai_apakahtemuan ?? '') == 0 ? 'checked' : '' }}> &nbsp;
                        <label>Tidak, jumlah yang belum ditindaklanjuti
                            {{ $stage2laporanaudit->pai_jumlahyangbelum ?? '' }}</label>
                        <br>
                        &nbsp;&nbsp;-&nbsp;&nbsp; Apakah Audit Internal dilakukan oleh personil kompeten
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox"
                            {{ ($stage2laporanaudit->pai_apakahaudit ?? '') == 1 ? 'checked' : '' }}> &nbsp;
                        <label>Ya</label> &nbsp;&nbsp;
                        <input type="checkbox"
                            {{ ($stage2laporanaudit->pai_apakahaudit ?? '') == 0 ? 'checked' : '' }}> &nbsp;
                        <label>Tidak</label>
                        <br>
                        &nbsp;&nbsp;-&nbsp;&nbsp; Apakah pelaksanaan internal audit efektif dilakukan
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox"
                            {{ ($stage2laporanaudit->pai_apakahpelaksanaan ?? '') == 1 ? 'checked' : '' }}> &nbsp;
                        <label>Ya</label> &nbsp;&nbsp;
                        <input type="checkbox"
                            {{ ($stage2laporanaudit->pai_apakahpelaksanaan ?? '') == 0 ? 'checked' : '' }}> &nbsp;
                        <label>Tidak</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        Kaji ulang manajemen
                        <br>
                        &nbsp;&nbsp;-&nbsp;&nbsp; Kapan Pelaksanaan kaji ulang
                        manajemen? {{ $stage2laporanaudit->kum_kapanpelaksanaan ?? '' }}
                        <br>
                        &nbsp;&nbsp;-&nbsp;&nbsp; Apakah kaji ulang manajemen dihadiri top manajemen
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox"
                            {{ ($stage2laporanaudit->kum_apakahkaji ?? '') == 1 ? 'checked' : '' }}> &nbsp;
                        <label>Ya</label> &nbsp;&nbsp;
                        <input type="checkbox"
                            {{ ($stage2laporanaudit->kum_apakahkaji ?? '') == 0 ? 'checked' : '' }}> &nbsp;
                        <label>Tidak</label>
                        <br>
                        &nbsp;&nbsp;-&nbsp;&nbsp; Apakah input dan output kaji ulang manajemen telah sesuai persyaratan
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox"
                            {{ ($stage2laporanaudit->kum_apakahinput ?? '') == 1 ? 'checked' : '' }}> &nbsp;
                        <label>Ya</label> &nbsp;&nbsp;
                        <input type="checkbox"
                            {{ ($stage2laporanaudit->kum_apakahinput ?? '') == 0 ? 'checked' : '' }}> &nbsp;
                        <label>Tidak</label>
                        <br>
                        &nbsp;&nbsp;-&nbsp;&nbsp; Apakah pelaksanaan kaji ulang manajemen efektif dilakukan
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox"
                            {{ ($stage2laporanaudit->kum_apakahpelaksanaan ?? '') == 1 ? 'checked' : '' }}> &nbsp;
                        <label>Ya</label> &nbsp;&nbsp;
                        <input type="checkbox"
                            {{ ($stage2laporanaudit->kum_apakahpelaksanaan ?? '') == 0 ? 'checked' : '' }}> &nbsp;
                        <label>Tidak</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        Lingkup Sertifikasi
                        <br>
                        &nbsp;&nbsp;-&nbsp;&nbsp; Sebutkan lingkup sertifikasi yang diajukan
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $stage2laporanaudit->ls_sebutkanlingkup ?? '' }}
                        <br>
                        &nbsp;&nbsp;-&nbsp;&nbsp; Apakah ruang lingkup sertifikasi yang diajukan sesuai dengan bisnis
                        proses organisasi di onsite
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox"
                            {{ ($stage2laporanaudit->ls_apakahruang ?? '') == 1 ? 'checked' : '' }}> &nbsp;
                        <label>Ya</label> &nbsp;&nbsp;
                        <input type="checkbox"
                            {{ ($stage2laporanaudit->ls_apakahruang ?? '') == 0 ? 'checked' : '' }}> &nbsp;
                        <label>Tidak</label>
                        <br>
                        &nbsp;&nbsp;-&nbsp;&nbsp; Jika jawaban diatas tidak, jelaskan lingkup sertifikasinya
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $stage2laporanaudit->ls_jikatidak ?? '' }}
                        <br>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>

<div class="col mb-2">
    <label>{{ date('d-m-Y', strtotime($stage2laporanaudit->tanggal_ttd)) }}</label>

</div>
<div class="pp mb-5">


    {{-- <hr style="width:100px; border-top:5px dotted; color:black; background: white; display:block">
                </hr> --}}
</div>

<div class="dd">
    <label>({{ $stage2laporanaudit->nama_auditorttd }})</label>
    <br>
    <label>Auditor</label>

</div>

<div class="card mt-3" style="page-break-before: always;">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="16" style="background-color:lightgray;">
                        <center><b>Ringkasan Audit</b></center>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" colspan="6" style="background-color:lightgray;">
                        <center><b>Persyaratan ISO 9001</b></center>
                    </td>
                    <td colspan="10" style="background-color:lightgray;">
                        <center><b>Tipe Audit</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="background-color:lightgray;">
                        <center><b>Stage I</b></center>
                    </td>
                    <td colspan="2" style="background-color:lightgray;">
                        <center><b>Stage II</b></center>
                    </td>
                    <td colspan="2" style="background-color:lightgray;">
                        <center><b>Sur I</b></center>
                    </td>
                    <td colspan="2" style="background-color:lightgray;">
                        <center><b>Sur II</b></center>
                    </td>
                    <td colspan="2" style="background-color:lightgray;">
                        <center><b>Res</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="6"><b>Konteks organisasi</b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="6">4.1 Memahami organisasi dan konteksnya</td>
                    @if (in_array('9001_4_1_stage1', $konteks1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_1_stage2', $konteks1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_1_sur1', $konteks1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_1_sur2', $konteks1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_1_res', $konteks1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">4.2 Memahami kebutuhan dan harapan pihak berkepentingan</td>
                    @if (in_array('9001_4_2_stage1', $konteks2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_2_stage2', $konteks2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_2_sur1', $konteks2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_2_sur2', $konteks2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_2_res', $konteks2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">4.3 Menentukan lingkup sistem manajemen mutu</td>
                    @if (in_array('9001_4_3_stage1', $konteks3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_3_stage2', $konteks3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_3_sur1', $konteks3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_3_sur2', $konteks3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_3_res', $konteks3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">4.4 Sistem manajemen mutu dan prosesnya</td>
                    @if (in_array('9001_4_4_stage1', $konteks4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_4_stage2', $konteks4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_4_sur1', $konteks4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_4_sur2', $konteks4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_4_4_res', $konteks4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6"><b>Kepemimpinan</b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="6">5.1 Kepemimpinan dan komitmen</td>
                    @if (in_array('9001_5_1_stage1', $kepemimpinan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_5_1_stage2', $kepemimpinan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_5_1_sur1', $kepemimpinan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_5_1_sur2', $kepemimpinan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_5_1_res', $kepemimpinan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">5.2 Kebijakan</td>
                    @if (in_array('9001_5_2_stage1', $kepemimpinan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_5_2_stage2', $kepemimpinan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_5_2_sur1', $kepemimpinan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_5_2_sur2', $kepemimpinan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_5_2_res', $kepemimpinan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">5.3 Peran, tanggungjawab dan wewenang organisasi</td>
                    @if (in_array('9001_5_3_stage1', $kepemimpinan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_5_3_stage2', $kepemimpinan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_5_3_sur1', $kepemimpinan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_5_3_sur2', $kepemimpinan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_5_3_res', $kepemimpinan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6"><b>Perencanaan</b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="6">6.1 Tindakan ditujukan pada peluang dan risiko</td>
                    @if (in_array('9001_6_1_stage1', $perencanaan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_6_1_stage2', $perencanaan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_6_1_sur1', $perencanaan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_6_1_sur2', $perencanaan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_6_1_res', $perencanaan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">6.2 Sasaran mutu dan perencanaan untuk mencapai sasaran</td>
                    @if (in_array('9001_6_2_stage1', $perencanaan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_6_2_stage2', $perencanaan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_6_2_sur1', $perencanaan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_6_2_sur2', $perencanaan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_6_2_res', $perencanaan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">6.3 Perubahan perencanaan</td>
                    @if (in_array('9001_6_3_stage1', $perencanaan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_6_3_stage2', $perencanaan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_6_3_sur1', $perencanaan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_6_3_sur2', $perencanaan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_6_3_res', $perencanaan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6"><b>Dukungan</b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="6">7.1 Sumberdaya</td>
                    @if (in_array('9001_7_1_stage1', $dukungan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_1_stage2', $dukungan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_1_sur1', $dukungan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_1_sur2', $dukungan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_1_res', $dukungan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">7.2 Kompetensi</td>
                    @if (in_array('9001_7_2_stage1', $dukungan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_2_stage2', $dukungan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_2_sur1', $dukungan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_2_sur2', $dukungan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_2_res', $dukungan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">7.3 Kepedulian</td>
                    @if (in_array('9001_7_3_stage1', $dukungan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_3_stage2', $dukungan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_3_sur1', $dukungan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_3_sur2', $dukungan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_3_res', $dukungan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">7.4 Komunikasi</td>
                    @if (in_array('9001_7_4_stage1', $dukungan4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_4_stage2', $dukungan4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_4_sur1', $dukungan4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_4_sur2', $dukungan4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_4_res', $dukungan4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">7.5 Informasi terdokumentasi</td>
                    @if (in_array('9001_7_5_stage1', $dukungan5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_5_stage2', $dukungan5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_5_sur1', $dukungan5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_5_sur2', $dukungan5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_7_5_res', $dukungan5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6"><b>Operasi</b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="6">8.1 Perencanaan dan pengendalian operasi</td>
                    @if (in_array('9001_8_1_stage1', $operasi1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_1_stage2', $operasi1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_1_sur1', $operasi1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_1_sur2', $operasi1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_1_res', $operasi1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">8.2 Persyaratan produk dan jasa</td>
                    @if (in_array('9001_8_2_stage1', $operasi2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_2_stage2', $operasi2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_2_sur1', $operasi2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_2_sur2', $operasi2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_2_res', $operasi2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">8.3 Desain dan pengembangan produk dan jasa</td>
                    @if (in_array('9001_8_3_stage1', $operasi3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_3_stage2', $operasi3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_3_sur1', $operasi3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_3_sur2', $operasi3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_3_res', $operasi3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">8.4 Pengendalian proses, produk dan jasa yang disediakan eksternal</td>
                    @if (in_array('9001_8_4_stage1', $operasi4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_4_stage2', $operasi4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_4_sur1', $operasi4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_4_sur2', $operasi4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_4_res', $operasi4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">8.5 Produksi dan penyediaan jasa</td>
                    @if (in_array('9001_8_5_stage1', $operasi5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_5_stage2', $operasi5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_5_sur1', $operasi5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_5_sur2', $operasi5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_5_res', $operasi5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">8.6 Pelepasan produk dan jasa</td>
                    @if (in_array('9001_8_6_stage1', $operasi6))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_6_stage2', $operasi6))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_6_sur1', $operasi6))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_6_sur2', $operasi6))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_6_res', $operasi6))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">8.7 Pengendalian ketidaksesuaian keluaran</td>
                    @if (in_array('9001_8_7_stage1', $operasi7))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_7_stage2', $operasi7))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_7_sur1', $operasi7))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_7_sur2', $operasi7))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_8_7_res', $operasi7))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6"><b>Evaluasi kinerja</b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="6">9.1 Pemantauan, pengukuran, analisis dan evaluasi</td>
                    @if (in_array('9001_9_1_stage1', $evaluasi1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_9_1_stage2', $evaluasi1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_9_1_sur1', $evaluasi1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_9_1_sur2', $evaluasi1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_9_1_res', $evaluasi1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">9.2 Audit internal</td>
                    @if (in_array('9001_9_2_stage1', $evaluasi2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_9_2_stage2', $evaluasi2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_9_2_sur1', $evaluasi2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_9_2_sur2', $evaluasi2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_9_2_res', $evaluasi2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">9.3 Tinjauan manajemen</td>
                    @if (in_array('9001_9_3_stage1', $evaluasi3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_9_3_stage2', $evaluasi3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_9_3_sur1', $evaluasi3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_9_3_sur2', $evaluasi3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_9_3_res', $evaluasi3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6"><b>Peningkatan</b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="6">10.1 Umum</td>
                    @if (in_array('9001_10_1_stage1', $peningkatan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_10_1_stage2', $peningkatan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_10_1_sur1', $peningkatan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_10_1_sur2', $peningkatan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_10_1_res', $peningkatan1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">10.2 Ketidaksesuaian dan tindakan korektif</td>
                    @if (in_array('9001_10_2_stage1', $peningkatan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_10_2_stage2', $peningkatan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_10_2_sur1', $peningkatan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_10_2_sur2', $peningkatan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_10_2_res', $peningkatan2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">10.3 Peningkatan berkelanjutan</td>
                    @if (in_array('9001_10_3_stage1', $peningkatan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_10_3_stage2', $peningkatan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_10_3_sur1', $peningkatan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_10_3_sur2', $peningkatan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('9001_10_3_res', $peningkatan3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="16" style="background-color:#f4f3f3;">
                        <center><b>Ringkasan Audit</b></center>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" colspan="6" style="background-color:#f4f3f3;">
                        <center><b>Persyaratan ISO 21001</b></center>
                    </td>
                    <td colspan="10" style="background-color:#f4f3f3;">
                        <center><b>Tipe Audit</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="background-color:#f4f3f3;">
                        <center><b>Stage I</b></center>
                    </td>
                    <td colspan="2" style="background-color:#f4f3f3;">
                        <center><b>Stage II</b></center>
                    </td>
                    <td colspan="2" style="background-color:#f4f3f3;">
                        <center><b>Sur I</b></center>
                    </td>
                    <td colspan="2" style="background-color:#f4f3f3;">
                        <center><b>Sur II</b></center>
                    </td>
                    <td colspan="2" style="background-color:#f4f3f3;">
                        <center><b>Res</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="6"><b>Konteks organisasi</b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="6">4.1 Memahami organisasi dan konteksnya</td>
                    @if (in_array('21001_4_1_stage1', $konteks1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_1_stage2', $konteks1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_1_sur1', $konteks1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_1_sur2', $konteks1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_1_res', $konteks1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">4.2 Memahami kebutuhan dan harapan pihak berkepentingan</td>
                    @if (in_array('21001_4_2_stage1', $konteks1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_2_stage2', $konteks1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_2_sur1', $konteks1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_2_sur2', $konteks1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_2_res', $konteks1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">4.3 Menentukan lingkup sistem manajemen mutu</td>
                    @if (in_array('21001_4_3_stage1', $konteks1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_3_stage2', $konteks1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_3_sur1', $konteks1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_3_sur2', $konteks1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_3_res', $konteks1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">4.4 Sistem manajemen mutu dan prosesnya</td>
                    @if (in_array('21001_4_4_stage1', $konteks1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_4_stage2', $konteks1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_4_sur1', $konteks1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_4_sur2', $konteks1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_4_4_res', $konteks1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6"><b>Kepemimpinan</b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="6">5.1 Kepemimpinan dan komitmen</td>
                    @if (in_array('21001_5_1_stage1', $kepemimpinan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_5_1_stage2', $kepemimpinan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_5_1_sur1', $kepemimpinan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_5_1_sur2', $kepemimpinan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_5_1_res', $kepemimpinan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">5.2 Kebijakan</td>
                    @if (in_array('21001_5_2_stage1', $kepemimpinan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_5_2_stage2', $kepemimpinan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_5_2_sur1', $kepemimpinan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_5_2_sur2', $kepemimpinan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_5_2_res', $kepemimpinan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">5.3 Peran, tanggungjawab dan wewenang organisasi</td>
                    @if (in_array('21001_5_3_stage1', $kepemimpinan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_5_3_stage2', $kepemimpinan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_5_3_sur1', $kepemimpinan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_5_3_sur2', $kepemimpinan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_5_3_res', $kepemimpinan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6"><b>Perencanaan</b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="6">6.1 Tindakan ditujukan pada peluang dan risiko</td>
                    @if (in_array('21001_6_1_stage1', $perencanaan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_6_1_stage2', $perencanaan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_6_1_sur1', $perencanaan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_6_1_sur2', $perencanaan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_6_1_res', $perencanaan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">6.2 Sasaran mutu dan perencanaan untuk mencapai sasaran</td>
                    @if (in_array('21001_6_2_stage1', $perencanaan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_6_2_stage2', $perencanaan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_6_2_sur1', $perencanaan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_6_2_sur2', $perencanaan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_6_2_res', $perencanaan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">6.3 Perubahan perencanaan</td>
                    @if (in_array('21001_6_3_stage1', $perencanaan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_6_3_stage2', $perencanaan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_6_3_sur1', $perencanaan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_6_3_sur2', $perencanaan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_6_3_res', $perencanaan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6"><b>Dukungan</b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="6">7.1 Sumberdaya</td>
                    @if (in_array('21001_7_1_stage1', $dukungan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_1_stage2', $dukungan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_1_sur1', $dukungan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_1_sur2', $dukungan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_1_res', $dukungan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">7.2 Kompetensi</td>
                    @if (in_array('21001_7_2_stage1', $dukungan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_2_stage2', $dukungan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_2_sur1', $dukungan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_2_sur2', $dukungan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_2_res', $dukungan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">7.3 Kepedulian</td>
                    @if (in_array('21001_7_3_stage1', $dukungan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_3_stage2', $dukungan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_3_sur1', $dukungan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_3_sur2', $dukungan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_3_res', $dukungan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">7.4 Komunikasi</td>
                    @if (in_array('21001_7_4_stage1', $dukungan1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_4_stage2', $dukungan1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_4_sur1', $dukungan1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_4_sur2', $dukungan1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_4_res', $dukungan1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">7.5 Informasi terdokumentasi</td>
                    @if (in_array('21001_7_5_stage1', $dukungan1_5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_5_stage2', $dukungan1_5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_5_sur1', $dukungan1_5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_5_sur2', $dukungan1_5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_7_5_res', $dukungan1_5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6"><b>Operasi</b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="6">8.1 Perencanaan dan pengendalian operasi</td>
                    @if (in_array('21001_8_1_stage1', $operasi1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_1_stage2', $operasi1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_1_sur1', $operasi1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_1_sur2', $operasi1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_1_res', $operasi1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">8.2 Persyaratan produk dan jasa</td>
                    @if (in_array('21001_8_2_stage1', $operasi1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_2_stage2', $operasi1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_2_sur1', $operasi1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_2_sur2', $operasi1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_2_res', $operasi1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">8.3 Desain dan pengembangan produk dan jasa</td>
                    @if (in_array('21001_8_3_stage1', $operasi1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_3_stage2', $operasi1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_3_sur1', $operasi1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_3_sur2', $operasi1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_3_res', $operasi1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">8.4 Pengendalian proses, produk dan jasa yang disediakan eksternal</td>
                    @if (in_array('21001_8_4_stage1', $operasi1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_4_stage2', $operasi1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_4_sur1', $operasi1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_4_sur2', $operasi1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_4_res', $operasi1_4))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">8.5 Produksi dan penyediaan jasa</td>
                    @if (in_array('21001_8_5_stage1', $operasi1_5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_5_stage2', $operasi1_5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_5_sur1', $operasi1_5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_5_sur2', $operasi1_5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_5_res', $operasi1_5))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">8.6 Pelepasan produk dan jasa</td>
                    @if (in_array('21001_8_6_stage1', $operasi1_6))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_6_stage2', $operasi1_6))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_6_sur1', $operasi1_6))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_6_sur2', $operasi1_6))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_6_res', $operasi1_6))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">8.7 Pengendalian ketidaksesuaian keluaran</td>
                    @if (in_array('21001_8_7_stage1', $operasi1_7))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_7_stage2', $operasi1_7))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_7_sur1', $operasi1_7))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_7_sur2', $operasi1_7))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_8_7_res', $operasi1_7))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6"><b>Evaluasi kinerja</b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="6">9.1 Pemantauan, pengukuran, analisis dan evaluasi</td>
                    @if (in_array('21001_9_1_stage1', $evaluasi1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_9_1_stage2', $evaluasi1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_9_1_sur1', $evaluasi1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_9_1_sur2', $evaluasi1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_9_1_res', $evaluasi1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">9.2 Audit internal</td>
                    @if (in_array('21001_9_2_stage1', $evaluasi1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_9_2_stage2', $evaluasi1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_9_2_sur1', $evaluasi1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_9_2_sur2', $evaluasi1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_9_2_res', $evaluasi1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">9.3 Tinjauan manajemen</td>
                    @if (in_array('21001_9_3_stage1', $evaluasi1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_9_3_stage2', $evaluasi1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_9_3_sur1', $evaluasi1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_9_3_sur2', $evaluasi1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_9_3_res', $evaluasi1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6"><b>Peningkatan</b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="6">10.1 Umum</td>
                    @if (in_array('21001_10_1_stage1', $peningkatan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_10_1_stage2', $peningkatan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_10_1_sur1', $peningkatan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_10_1_sur2', $peningkatan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_10_1_res', $peningkatan1_1))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">10.2 Ketidaksesuaian dan tindakan korektif</td>
                    @if (in_array('21001_10_2_stage1', $peningkatan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_10_2_stage2', $peningkatan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_10_2_sur1', $peningkatan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_10_2_sur2', $peningkatan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_10_2_res', $peningkatan1_2))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6">10.3 Peningkatan berkelanjutan</td>
                    @if (in_array('21001_10_3_stage1', $peningkatan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_10_3_stage2', $peningkatan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_10_3_sur1', $peningkatan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_10_3_sur2', $peningkatan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                    @if (in_array('21001_10_3_res', $peningkatan1_3))
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @else
                        <td colspan="2">
                        </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="<?= $_SERVER['DOCUMENT_ROOT'] . '/assets/bootstrap/js/bootstrap.min.js' ?>"></script>
</body>

</html>
