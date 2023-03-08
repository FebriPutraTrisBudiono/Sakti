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

<!-- Buat Header Dan Footer -->
<header>
    <!-- Our Code World -->
    <img src="{{ $setting->doc_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->doc_logo : '/assets/img/noimage.jpeg' }}"
        class="img-thumbnail main_logoPreview" width="160px" style="border: none">
</header>

<header2>
    <img src="{{ $setting->sec_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}"
        class="img-thumbnail main_logoPreview" width="160px" style="border: none">
</header2>

<footer>
    <p class="spacing">F-CER-06 Rev.03 Date:09.07.20</p>
</footer>

<!-- Penutup Buat Header Dan Footer -->

<center>
    <h3>CHECKLIST AUDIT TAHAP 1 (ISO 9001) / (ISO 21001)</h3>
</center>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td class="col-sm-3" style="background-color:lightgray"><b>NAMA KLIEN</b></td>
                    <td colspan="11">
                        : {{ $permohonansertifikasi->nama_pimpinan }}
                    </td>
                </tr>
                <tr>
                    <td style="background-color:lightgray"><b>RUANG LINGKUP</b></td>
                    <td colspan="11">
                        : {{ $permohonansertifikasi->ruang_lingkup_perusahaan }}
                    </td>
                </tr>
                <tr>
                    <td style="background-color:lightgray"><b>STANDAR</b></td>
                    <td colspan="11">
                        : {{ $rencanaclient->standart }}
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
                    <td colspan="18" style="background-color:lightgray">
                        <center><b>Audit</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><input
                            type="checkbox"{{ $arraudit[0] == 'pra_audit' ? 'checked' : '' }}><label>Pra
                            audit</label></td>
                    <td colspan="3"><input
                            type="checkbox"{{ $arraudit[1] == 'stage1' ? 'checked' : '' }}><label>Stage
                            I</label></td>
                    <td colspan="3"><input
                            type="checkbox"{{ $arraudit[2] == 'stage2' ? 'checked' : '' }}><label>Stage
                            II</label></td>
                    <td colspan="3"><input
                            type="checkbox"{{ $arraudit[3] == 'surveilan' ? 'checked' : '' }}><label>Surveilan</label>
                    </td>
                    <td colspan="3"><input
                            type="checkbox"{{ $arraudit[4] == 'tindaklanjut' ? 'checked' : '' }}><label>Tindaklanjut</label>
                    </td>
                    <td colspan="3"><input
                            type="checkbox"{{ $arraudit[5] == 'resertifikasi' ? 'checked' : '' }}><label>Re-Sertifikasi</label>
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
                        <center>1.</center>
                    </td>
                    <td colspan="5">
                        <?php
                        $user = new App\Models\User();
                        $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor)->first();
                        ?>
                        {{ $userid->name ?? '' }}
                    </td>
                    <td colspan="3">
                        {{ $stage1penunjukantimaudit->nama_inisial }}
                    </td>
                    <td colspan="3">
                        {{ $stage1penunjukantimaudit->jabatan }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>2.</center>
                    </td>
                    <td colspan="5">
                        <?php
                        $user = new App\Models\User();
                        $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor2)->first();
                        ?>
                        {{ $userid->name ?? '' }}
                    </td>
                    <td colspan="3">
                        {{ $stage1penunjukantimaudit->nama_inisial2 }}
                    </td>
                    <td colspan="3">
                        {{ $stage1penunjukantimaudit->jabatan2 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>3.</center>
                    </td>
                    <td colspan="5">
                        <?php
                        $user = new App\Models\User();
                        $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor3)->first();
                        ?>
                        {{ $userid->name ?? '' }}
                    </td>
                    <td colspan="3">
                        {{ $stage1penunjukantimaudit->nama_inisial3 }}
                    </td>
                    <td colspan="3">
                        {{ $stage1penunjukantimaudit->jabatan3 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="6" rowspan="1">
                        <center>Untuk bertugas tanggal</center>
                    </td>
                    <td colspan="2" rowspan="1">
                        <center>{{ $stage1penunjukantimaudit->tanggal_bertugas }}</center>
                    </td>
                    <td colspan="2" rowspan="1">
                        <center>Sampai dengan</center>
                    </td>
                    <td colspan="2" rowspan="1">
                        <center>{{ $stage1penunjukantimaudit->sampai_dengan }}</center>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<h3 class="mt-3" style="page-break-before: always;">Hasil Pengamatan Audit Tahap 1</h3>

<br>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="1">
                        <center><b>NO</b></center>
                    </td>
                    <td colspan="5">
                        <center><b>KRITERIA</b></center>
                    </td>
                    <td colspan="3">
                        <center><b>PEMENUHAN</b></center>
                    </td>
                    <td colspan="3">
                        <center><b>TINDAKLANJUT</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>1</center>
                    </td>
                    <td colspan="11"><b>Evaluasi Dokumentasi Sistem Manajemen Klien</b></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Apakah klien memiliki sistem yg meliputi perarutan, SOP dan ketentuan lainnya
                        terkait dengan persyaratan sertifikasi</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_1 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_1 }}</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>2</center>
                    </td>
                    <td colspan="11"><b>Evaluasi lokasi dan kondisi klien dan diskusi dengan klien untuk menentukan
                            kesiapan audit tahap II</b></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Lokasi audit apakah terjangkau</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_2_1 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_2_1 }}</td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Apakah lokasi klien dapat diakses dengan menggunakan transportasi pribadi atau
                        umum</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_2_2 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_2_2 }}</td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Jika sulit diakses dengan transportasi pribadi atau umum, apakah klien
                        menyiapkan
                        transportasi khusus yg menjamin tingkat keamanan tim audit</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_2_3 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_2_3 }}</td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Berapa jumlah karyawan yg dimiliki oleh klien</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_2_4 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_2_4 }}</td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Apakah klien telah siap untuk diaudit sesuai dgn jadwal yg telah ditentukan</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_2_5 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_2_5 }}</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>3</center>
                    </td>
                    <td colspan="11"><b>Evaluasi status dan pemahaman klien terkait dengan persyaratan standar,
                            khususnya identifikasi kinerja utama atau aspek yg signifikan, proses, sasaran dan operasi
                            sistem manajemen</b></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Sejak kapan sistem dokumentasi klien diterapkan</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_3_1 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_3_1 }}</td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Apakah klien telah menetapkan Key Performance Indicator untuk masing-² fungsi yg
                        dimiliki</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_3_2 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_3_2 }}</td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Apakah klien telah melaksanakan audit internal</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_3_3 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_3_3 }}</td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Apakah klien telah melaksanakan tinjauan manajemen</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_3_4 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_3_4 }}</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>4</center>
                    </td>
                    <td colspan="11"><b>Verifikasi informasi terkait dengan ling-kup sistem manajemen, proses &
                            lokasi klien serta peraturan perundang-² an yg digunakan oleh klien</b></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Apakah lingkup sertifikasi yang diajukan sesuai dengan bisnis proses yg dimiliki
                        oleh klien</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_4_1 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_4_1 }}</td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Apakah ada lingkup bisnis proses yg dikecualikan oleh klien dalam rangka
                        sertifikasi</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_4_2 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_4_2 }}</td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Apakah ada peraturan dan perundang-an yg diacu dalam menjalankan bisnis proses
                        klien</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_4_3 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_4_3 }}</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>5</center>
                    </td>
                    <td colspan="11"><b>Alokasi sumber daya untuk audit tahap II dan persetujuan klien terkait
                            rencana audit tahap II</b></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Apakah tim audit yg ditugaskan, telah memiliki kompetensi yg sesuai dengan
                        bisnis proses klien</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_5_1 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_5_1 }}</td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Apakah diperlukan penambahan mandays audit dalam pelaksanaan audit yg
                        direncanakan</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_5_2 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_5_2 }}</td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="5">Apakah diperlukan penambahan sumberdaya (penterjemah, guide) dalam pelaksanaan
                        audit</td>
                    <td colspan="3">{{ $stage1checkaudit->pemenuhan_5_3 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->tindaklanjut_5_3 }}</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>6</center>
                    </td>
                    <td colspan="11"><b>Hal-hal yg menjadi fokus pada pelaksanaan audit tahap II</b></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="11">
                        {{ $stage1checkaudit->fokus_pelaksanaan_tahap2 }}
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
                    <td colspan="12"><b>CATATAN:</b><br>{{ $stage1checkaudit->catatan }}</td>
                </tr>
                <tr>
                    <td colspan="12"><b>REKOMENDASI AUDIT TAHAP I</b><br><input type="checkbox"
                            {{ $stage1checkaudit->rekom_tahap_audit == 'lanjut' ? 'checked' : '' }}><label>Dilanjutkan
                            audit tahap II</label><br><input type="checkbox"
                            {{ $stage1checkaudit->rekom_tahap_audit == 'ditunda' ? 'checked' : '' }}><label>Ditunda
                            sampai organisasi
                            menyelesaikan tindakan perbaikan audit tahap I</label></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>

<div class="col mb-2">
    <label>{{ date('d-m-Y', strtotime($stage1checkaudit->tanggal_ttd)) }}</label>

</div>


<br>
<br>
<br>
<br>

<div class="dd">
    <label>({{ $stage1checkaudit->nama_auditor }})</label>
</div>

<div class="dd">
    <label>Auditor</label>
</div>

<div class="card" style="page-break-before: always;">
    <div class="form-group">
        <table>
            <tbody>
                <tr style="background-color:lightgray">
                    <td colspan="1">
                    </td>
                    <td colspan="5">
                        <center><b>PERSYARATAN</b></center>
                    </td>
                    <td colspan="3">
                        <center><b>ACUAN</b></center>
                    </td>
                    <td colspan="3">
                        <center><b>VERIFIKASI</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <center><b>Konteks organisasi</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">4.1</td>
                    <td colspan="5">Memahami organisasi dan konteksnya</td>
                    <td colspan="3">{{ $stage1checkaudit->acuan_4_1 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->verifikasi_4_1 }}</td>
                </tr>
                <tr>
                    <td colspan="1">4.2</td>
                    <td colspan="5">Memahami kebutuhan dan harapan pihak berkepentingan</td>
                    <td colspan="3">{{ $stage1checkaudit->acuan_4_2 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->verifikasi_4_2 }}</td>
                </tr>
                <tr>
                    <td colspan="1">4.3</td>
                    <td colspan="5">Menentukan lingkup sistem manajemen mutu</td>
                    <td colspan="3">{{ $stage1checkaudit->acuan_4_3 }}</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_4_3 }}</td>
                </tr>
                <tr>
                    <td colspan="1">4.4</td>
                    <td colspan="5">Sistem manajemen mutu dan prosesnya</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_4_4 }}</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_4_4 }}</td>
                </tr>
                <tr>
                    <td colspan="12">
                        <center><b>Kepemimpinan</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">5.1</td>
                    <td colspan="5">Kepemimpinan dan komitmen</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_5_1 }}</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_5_1 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1">5.2</td>
                    <td colspan="5">Kebijakan</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_5_2 }}
                    </td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_5_2 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1">5.3</td>
                    <td colspan="5">Peran, tanggungjawab dan wewenang organisasi</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_5_3 }}</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_5_3 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <center><b>Perencanaan</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">6.1</td>
                    <td colspan="5">Tindakan ditujukan pada peluang dan risiko</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_6_1 }}
                    </td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_6_1 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1">6.2</td>
                    <td colspan="5">Sasaran mutu dan perencanaan untuk mencapai sasaran</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_6_2 }}
                    </td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_6_2 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1">6.3</td>
                    <td colspan="5">Perubahan perencanaan</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_6_3 }}
                    </td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_6_3 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <center><b>Dukungan</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">7.1</td>
                    <td colspan="5">Sumberdaya</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_7_1 }}
                    </td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_7_1 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1">7.2</td>
                    <td colspan="5">Kompetensi</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_7_2 }}
                    </td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_7_2 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1">7.3</td>
                    <td colspan="5">Kepedulian</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_7_3 }}
                    </td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_7_3 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1">7.4</td>
                    <td colspan="5">Komunikasi</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_7_4 }}
                    </td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_7_4 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1">7.5</td>
                    <td colspan="5">Informasi terdokumentasi</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_7_5 }}
                    </td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_7_5 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <center><b>Operasi</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">8.1</td>
                    <td colspan="5">Perencanaan dan pengendalian operasi</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_8_1 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->verifikasi_8_1 }}</td>
                </tr>
                <tr>
                    <td colspan="1">8.2</td>
                    <td colspan="5">Persyaratan produk dan jasa</td>
                    <td colspan="3">{{ $stage1checkaudit->acuan_8_2 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->verifikasi_8_2 }}</td>
                </tr>
                <tr>
                    <td colspan="1">8.3</td>
                    <td colspan="5">Desain dan pengembangan produk dan jasa</td>
                    <td colspan="3">{{ $stage1checkaudit->acuan_8_3 }}</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_8_3 }}</td>
                </tr>
                <tr>
                    <td colspan="1">8.4</td>
                    <td colspan="5">Pengendalian proses, produk dan jasa yang disediakan eksternal</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_8_4 }}</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_8_4 }}</td>
                </tr>
                <tr>
                    <td colspan="1">8.5</td>
                    <td colspan="5">Produksi dan penyediaan jasa</td>
                    <td colspan="3">{{ $stage1checkaudit->acuan_8_5 }}
                    </td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_8_5 }}</td>
                </tr>
                <tr>
                    <td colspan="1">8.6</td>
                    <td colspan="5">Pelepasan produk dan jasa</td>
                    <td colspan="3">{{ $stage1checkaudit->acuan_8_6 }}</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_8_6 }}</td>
                </tr>
                <tr>
                    <td colspan="1">8.7</td>
                    <td colspan="5">Pengendalian ketidaksesuaian keluaran</td>
                    <td colspan="3">{{ $stage1checkaudit->acuan_8_7 }}</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_8_7 }}</td>
                </tr>
                <tr>
                    <td colspan="12">
                        <center><b>Evaluasi kinerja</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">9.1</td>
                    <td colspan="5">Pemantauan, pengukuran, analisis dan evaluasi</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_9_1 }}</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_9_1 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1">9.2</td>
                    <td colspan="5">Audit internal</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_9_2 }}
                    </td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_9_2 }}</td>
                </tr>
                <tr>
                    <td colspan="1">9.3</td>
                    <td colspan="5">Tinjauan manajemen</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_9_3 }}</td>
                    <td colspan="3">{{ $stage1checkaudit->verifikasi_9_3 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <center><b>Peningkatan</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">10.1</td>
                    <td colspan="5">Umum</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_10_1 }}</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_10_1 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1">10.2</td>
                    <td colspan="5">Ketidaksesuaian dan tindakan korektif</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_10_2 }}</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->verifikasi_10_2 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1">10.3</td>
                    <td colspan="5">Peningkatan berkelanjutan</td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_10_3 }}
                    </td>
                    <td colspan="3">
                        {{ $stage1checkaudit->acuan_10_3 }}
                    </td>
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
