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

<body>
    {{-- <table style="border: 1px;">
        <tbody>
            <tr>
                <th scope="row" style="border: 1px;">
                    <img src="{{ $setting->main_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->main_logo : '/assets/img/noimage.jpeg' }}"
                        style="border: none" class="img-thumbnail main_logoPreview" width="160px">
                </th>
                <td style="border: 1px; text-align: right;">
                    <img src="{{ $setting->sec_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}"
                        style="border: none" class="img-thumbnail main_logoPreview" width="160px">
                </td>
            </tr>
        </tbody>
    </table> --}}

    <!-- Buat Header Dan Footer -->
    <header>
        <!-- Our Code World -->
        <img src="{{ $setting->doc_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->doc_logo : '/assets/img/noimage.jpeg' }}"
            style="border: none" class="img-thumbnail main_logoPreview" width="160px">
    </header>

    <header2>
        <img src="{{ $setting->sec_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}"
            style="border: none" class="img-thumbnail main_logoPreview" width="160px">
    </header2>

    <footer>
        <p class="spacing">F-CER-02 Rev.04 Date:09.07.20</p>
    </footer>

    <!-- Penutup Buat Header Dan Footer -->

    <center>
        <h3>KAJIAN PERMOHONAN</h3>
    </center>

    <h4 class="mt-3">I. SISTEM MANAJEMEN YANG AKAN DISERTIFIKASI(salah satu atau keduanya)</h4>
    <div class="form-group col ms-3" style="display: block;">
        <div class="col" style="display: block;">
            <label text-align: center>
                <input type="checkbox"
                    {{ old('ISO 9001:2015', $permohonansertifikasi->iso) == 'ISO 9001:2015' ? 'checked' : '' }}>
                <label for="">ISO 9001:2015</label>
                </input>
            </label>
        </div>
        <div class="col" style="display: block; margin-top:-20%; margin-left:30%;">
            <label text-align: center><input type="checkbox"
                    {{ old('ISO 21001:2018', $permohonansertifikasi->iso) == 'ISO 21001:2018' ? 'checked' : '' }}>
                <label for="">ISO 21001:2018</label>
            </label>
        </div>
        <div class="col" style="display: block; margin-top:-20%; margin-left:55%;">
            <label text-align: center><input type="checkbox"
                    {{ old('ISO 45001:2018', $permohonansertifikasi->iso) == 'ISO 45001:2018' ? 'checked' : '' }}>
                <label for="">ISO 45001:2018</label>
            </label>
        </div>
        <div class="col" style="display: block; margin-top:-20%; margin-left:80%;">
            <label text-align: center><input type="checkbox"
                    {{ old('ISO 14001:2015', $permohonansertifikasi->iso) == 'ISO 14001:2015' ? 'checked' : '' }}>
                <label for="">ISO 14001:2015</label>
            </label>
        </div>
    </div>
    <div class="form-group col ms-3" style="display: block;">
        <div class="col" style="display: block;">
            @if ($permohonansertifikasi->iso == 'ISO 9001:2015' ||
                $permohonansertifikasi->iso == 'ISO 14001:2015' ||
                $permohonansertifikasi->iso == 'ISO 21001:2018' ||
                $permohonansertifikasi->iso == 'ISO 45001:2018')
                <input type="checkbox">
                <label>....</label>
            @else
                <label text-align: center>
                    <input type="checkbox" checked>
                    <label for="">{{ $permohonansertifikasi->iso }}</label>
                    </input>
                </label>
            @endif
        </div>
    </div>

    <h4 class="mt-3">II. INFORMASI UMUM TERKAIT PERMOHONAN SERTIFIKASI</h4>

    <h4 class="ms-3">A. INFORMASI UMUM:</h4>

    <div class="card">
        <div class="form-group">
            <table>
                <tbody>
                    <tr>
                        <td style="vertical-align: top" class="col-sm-6">Nama organisasi/perusahaan</td>
                        <td style="vertical-align: top" colspan="3">:
                            <b>{{ $permohonansertifikasi->nama_perusahaan }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">Alamat</td>
                        <td style="vertical-align: top" colspan="3">: <b>{{ $permohonansertifikasi->alamat }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">Telepon dan Fax</td>
                        <td style="vertical-align: top" colspan="3">: <b>{{ $permohonansertifikasi->no_phone }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">Website</td>
                        <td style="vertical-align: top" colspan="3">:
                            <b>{{ $permohonansertifikasi->nama_website }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">Sektor bisnis</td>
                        <td style="vertical-align: top" colspan="3">: <b>{{ $kajianclient->a5_sektor }}</b></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">Jumlah cabang/site</td>
                        <td style="vertical-align: top" colspan="3">: <b>{{ $kajianclient->a6_jcabang }}</b></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">Jumlah karyawan total</td>
                        <td style="vertical-align: top" colspan="3">:
                            <b>{{ $permohonansertifikasi->jml_karyawan }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">Nama pimpinan tertinggi organisasi/ <br> perusahaan dan jabatan:
                        </td>
                        <td style="vertical-align: top" colspan="3">:
                            <b>{{ $permohonansertifikasi->nama_pimpinan }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">Contact person</td>
                        <td style="vertical-align: top" colspan="3">:
                            <b>{{ $permohonansertifikasi->no_phone_pimpinan }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">Apakah organisasi/perusahaan merupakan bagian dari organisasi/
                            perusahaan lain
                            (grup) yang lebih besar?</td>
                        <td style="vertical-align: top" colspan="3">:
                            <b>{{ $kajianclient->a10_perusahaanbesar }}</b>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h4 class="ms-3 mt-3">B. RUANG LINGKUP SERTIFIKASI YANG DIAJUKAN</h4>

        <div class="card">
            <div class="form-group">
                <table>
                    <tbody>
                        <tr>
                            <td class="col-sm-6">Ruang lingkup</td>
                            <td colspan="3">: <b>{{ $kajianclient->b1_lingkup }}</b></td>
                        </tr>
                        <tr>
                            <td class="col-sm-6">EA Code</td>
                            <td colspan="3">: <b>{{ $kajianclient->b2_ea }}</b></td>
                        </tr>
                        <tr>
                            <td class="col-sm-6">Target pelaksanaan audit</td>
                            <td colspan="3">: <b>{{ $kajianclient->b3_target }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <h4 class="ms-3 mt-3">C. INFORMASI KEGIATAN ORGANISASI YANG MENJADI LINGKUP SERTIFIKASI</h4>

        <table>
            <tbody>
                <tr>
                    <td class="col-sm-9">Apakah organisasi/perusahaan terlibat dalam kegiatan desain
                        suatu produk</td>
                    <td colspan="2" style="text-align: center"><input type="checkbox"
                            {{ old('1', $kajianclient->c1_question) == '1' ? 'checked' : '' }}>
                        <label for="">YA</label>
                    </td>
                    <td colspan="2" style="text-align: center"><input type="checkbox"
                            {{ old('0', $kajianclient->c1_question) == '0' ? 'checked' : '' }}>
                        <label for="">TIDAK</label>
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-9">Apakah organisasi/perusahaan menyerahkan sebagian prosesnya kepada <br> pihak
                        lain (subkontraktor)</td>
                    <td colspan="2" style="text-align: center"><input type="checkbox"
                            {{ old('1', $kajianclient->c2_question) == '1' ? 'checked' : '' }}>
                        <label for="">YA</label>
                    </td>
                    <td colspan="2" style="text-align: center"><input type="checkbox"
                            {{ old('0', $kajianclient->c2_question) == '0' ? 'checked' : '' }}>
                        <label for="">TIDAK</label>
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-9">Apakah organisasi/perusahaan menggunakan barang milik pelanggan untuk <br>
                        digunakan atau digabungkan dalam produk?</td>
                    <td colspan="2" style="text-align: center"><input type="checkbox"
                            {{ old('1', $kajianclient->c3_question) == '1' ? 'checked' : '' }}>
                        <label for="">YA</label>
                    </td>
                    <td colspan="2" style="text-align: center"><input type="checkbox"
                            {{ old('0', $kajianclient->c3_question) == '0' ? 'checked' : '' }}>
                        <label for="">TIDAK</label>
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-9">Apakah ada peraturan nasional maupun internasional (misalnya: SNI, JIS, <br>
                        ASTM
                        dan sebagainya) yang terkait dengan produk/jasa organisasi/ <br> perusahaan?</td>
                    <td colspan="2" style="text-align: center"><input type="checkbox"
                            {{ old('1', $kajianclient->c4_question) == '1' ? 'checked' : '' }}>
                        <label for="">YA</label>
                    </td>
                    <td colspan="2" style="text-align: center"><input type="checkbox"
                            {{ old('0', $kajianclient->c4_question) == '0' ? 'checked' : '' }}>
                        <label for="">TIDAK</label>
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-9">Risiko terkait dengan produk (barang/jasa) yang yang timbul dari bisnis proses
                        klien</td>
                    <td colspan="2" style="text-align: center"><input type="checkbox"
                            {{ old('1', $kajianclient->c5_question) == '1' ? 'checked' : '' }}>
                        <label for="">YA</label>
                    </td>
                    <td colspan="2" style="text-align: center"><input type="checkbox"
                            {{ old('0', $kajianclient->c5_question) == '0' ? 'checked' : '' }}>
                        <label for="">TIDAK</label>
                    </td>
                </tr>
            </tbody>
        </table>

        <h4 class="ms-3 mt-3">D. INFORMASI SISTEM MANAJEMEN ORGANISASI</h4>

        <div class="card">
            <div class="form-group">
                <div class="col-md-12">
                    <table>
                        <tbody>
                            <tr>
                                <td class="col-sm-9" title="form-title">Apakah sistem manajemen (ISO
                                    9001:2015, ISO 21001:2018) pada organisasi yang akan disertifikasi merupakan
                                    transfer/pindahan dari lembaga sertifikasi lain ?</td>
                                <td colspan="2" style="text-align: center"><input type="checkbox"
                                        {{ old('1', $kajianclient->d1_question) == '1' ? 'checked' : '' }}>
                                    <label for="">YA</label>
                                </td>
                                <td colspan="2" style="text-align: center"><input type="checkbox"
                                        {{ old('0', $kajianclient->d1_question) == '0' ? 'checked' : '' }}>
                                    <label for="">TIDAK</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-9">Jika jawaban YA, sebutkan lembaga sertifikasi yang
                                    menerbitkan sertifikat sebelumnya?</td>
                                <td colspan="4" style="vertical-align: top"><b>{{ $kajianclient->d1_answer }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-9"> Berapa lama sistem manajemen (ISO 9001:2015, ISO 21001:2018)
                                    sudah
                                    diterapkan di organisasi?</td>
                                <td colspan="4" style="vertical-align: top">
                                    <b>{{ \App\Helpers\Bulan::get()->first(fn($value, $key) => $key == $kajianclient->d2_answerbln) }}
                                        /
                                        {{ $kajianclient->d2_answerthn }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-9">Apakah dalam awal penerapan sistem manajemen ISO 9001:2015, ISO
                                    21001:2018) organisasi menggunakan jasa konsultan?</td>
                                <td colspan="2" style="text-align: center"><input type="checkbox"
                                        {{ old('1', $kajianclient->d3_question) == '1' ? 'checked' : '' }}>
                                    <label for="">YA</label>
                                </td>
                                <td colspan="2" style="text-align: center"><input type="checkbox"
                                        {{ old('0', $kajianclient->d3_question) == '0' ? 'checked' : '' }}>
                                    <label for="">TIDAK</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-9">Jika jawaban YA, sebutkan lembaga konsultan yang digunakan?</td>
                                <td colspan="4" style="vertical-align: top"><b>{{ $kajianclient->d3_answer }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-9">Apakah dokumen manual dari sistem manajemen yang diajukan
                                    sertifikasi sudah lengkap dan diimplementasikan disemua proses?</td>
                                <td colspan="2" style="text-align: center"><input type="checkbox"
                                        {{ old('1', $kajianclient->d4_question) == '1' ? 'checked' : '' }}>
                                    <label for="">YA</label>
                                </td>
                                <td colspan="2" style="text-align: center"><input type="checkbox"
                                        {{ old('0', $kajianclient->d4_question) == '0' ? 'checked' : '' }}>
                                    <label for="">TIDAK</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <h4 class="ms-3 mt-3">E. TRANSFER SERTIFIKASI*)</h4>

            <div class="card">
                <div class="form-group">
                    <div class="col-sm-12">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="col-sm-9">1. Apakah masa berlaku sertifikat organisasi masih berlaku
                                    </td>
                                    <td colspan="2" style="text-align: center"><input type="checkbox"
                                            {{ old('1', $kajianclient->e1_question) == '1' ? 'checked' : '' }}>
                                        <label for="">YA</label>
                                    </td>
                                    <td colspan="2" style="text-align: center"><input type="checkbox"
                                            {{ old('0', $kajianclient->e1_question) == '0' ? 'checked' : '' }}>
                                        <label for="">TIDAK</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-9" colspan="5">Jika jawaban YA, sebutkan masa berlaku
                                        sertifikat dari
                                        organisasi? <br>
                                        <b>{{ $kajianclient->e1_answer }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-9">2. Apakah organisasi menyampaikan alasan dilakukan transfer
                                        kepada <br> PT Sakti Indonesia Sertifikasi?</td>
                                    <td colspan="2" style="text-align: center"><input type="checkbox"
                                            {{ old('1', $kajianclient->e2_question) == '1' ? 'checked' : '' }}>
                                        <label for="">YA</label>
                                    </td>
                                    <td colspan="2" style="text-align: center"><input type="checkbox"
                                            {{ old('0', $kajianclient->e2_question) == '0' ? 'checked' : '' }}>
                                        <label for="">TIDAK</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-9" colspan="5">Jika jawaban YA, jelaskan alasan transfer yang
                                        disampaikan? <br>
                                        <b>{{ $kajianclient->e2_answer }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-9">3. Apakah lembaga sertifikasi sebelumnya telah diakreditasi
                                        untuk <br> standar dan ruang lingkup yang diterbitkan?</td>
                                    <td colspan="2" style="text-align: center"><input type="checkbox"
                                            {{ old('1', $kajianclient->e3_question) == '1' ? 'checked' : '' }}>
                                        <label for="">YA</label>
                                    </td>
                                    <td colspan="2" style="text-align: center"><input type="checkbox"
                                            {{ old('0', $kajianclient->e3_question) == '0' ? 'checked' : '' }}>
                                        <label for="">TIDAK</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-9" colspan="5">Jika jawaban YA, sebutkan badan akreditasi dan
                                        ruang lingkup
                                        yang diakreditasi? <br>
                                        <b>{{ $kajianclient->e3_answer }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-9">4. Apakah organisasi menyampaikan laporan audit terakhir
                                        dari lembaga sertifikasi sebelumnya?</td>
                                    <td colspan="2" style="text-align: center"><input type="checkbox"
                                            {{ old('1', $kajianclient->e4_question) == '1' ? 'checked' : '' }}>
                                        <label for="">YA</label>
                                    </td>
                                    <td colspan="2" style="text-align: center"><input type="checkbox"
                                            {{ old('0', $kajianclient->e4_question) == '0' ? 'checked' : '' }}>
                                        <label for="">TIDAK</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-9">5. Apakah seluruh hasil audit dari lembaga sertifikasi
                                        sebelumnya telah <br> ditindaklanjuti oleh organisasi</td>
                                    <td colspan="2" style="text-align: center"><input type="checkbox"
                                            {{ old('1', $kajianclient->e5_question) == '1' ? 'checked' : '' }}>
                                        <label for="">YA</label>
                                    </td>
                                    <td colspan="2" style="text-align: center"><input type="checkbox"
                                            {{ old('0', $kajianclient->e5_question) == '0' ? 'checked' : '' }}>
                                        <label for="">TIDAK</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-9" colspan="5">Jika jawaban TIDAK, jelaskan temuan yang belum
                                        ditindaklanjuti? <br>
                                        <b>{{ $kajianclient->e5_answer }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-9">6. Apakah ada pengaduan/keluhan yang diterima terkait dengan
                                        kinerja <br> organisasi yang ditransfer sertifikasinya ?</td>
                                    <td colspan="2" style="text-align: center"><input type="checkbox"
                                            {{ old('1', $kajianclient->e6_question) == '1' ? 'checked' : '' }}>
                                        <label for="">YA</label>
                                    </td>
                                    <td colspan="2" style="text-align: center"><input type="checkbox"
                                            {{ old('0', $kajianclient->e6_question) == '0' ? 'checked' : '' }}>
                                        <label for="">TIDAK</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-9" colspan="5">Jika jawaban YA, jelaskan pengaduan/keluhan
                                        yang diterima? <br>
                                        <b>{{ $kajianclient->e6_answer }}</b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <h4 class="ms-3 mt-3">F. MULTISITE*)</h4>

            <div class="card">
                <div class="form-group">
                    <div class="col-sm-12">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="col-sm-3">Jumlah Site</td>
                                    <td>: <b>{{ $kajianclient->f1_answer }}</b></td>
                                </tr>
                                <tr>
                                    <td class="col-sm-3">Lokasi Site</td>
                                    <td>: <b>{{ $kajianclient->f2_answer }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <h4 class="ms-3 mt-3">G. INFORMASI UNTUK PENJADWALAN AUDIT</h4>

            <div class="card">
                <div class="form-group">
                    <div class="col-sm-12">
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="4">Apakah organisasi/perusahaan telah melaksanakan kegiatan
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-6">Audit Internal</td>
                                    <td colspan="3">: <b>{{ $kajianclient->g1_answer }}</b></td>
                                </tr>
                                <tr>
                                    <td class="col-sm-6">Tinjauan Manajemen</td>
                                    <td colspan="3">: <b>{{ $kajianclient->g2_answer }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <center class="mt-2" style="page-break-before: always;">
                <h3>HASIL KAJIAN PERMOHONAN SERTIFIKASI</h3>
            </center>

            <div class="card">
                <div class="form-group">
                    <div class="col-sm-12">
                        <table>
                            <tbody>
                                <tr>
                                    <td rowspan="2" style="vertical-align: top">Apakah permohonan sertifikasi
                                        diterima? :</td>
                                    <td rowspan="2" colspan="2"><input type="checkbox"
                                            {{ old('1', $kajianclient->hasil1_question) == '1' ? 'checked' : '' }}>
                                        <label for="">Ya</label>
                                    </td>
                                    <td colspan="11"><input type="checkbox"
                                            {{ old('0', $kajianclient->hasil1_question) == '0' ? 'checked' : '' }}>
                                        <label for="">Tidak</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="11"><b>{{ $kajianclient->hasil1_answer }}</b></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top">Kompetensi Tim Auditor yang diperlukan:</td>
                                    <td colspan="13"><b>{{ $kajianclient->hasil2_answer }}</b></td>
                                </tr>

                                <tr>
                                    <td rowspan="3" style="vertical-align: top">Usulan tim audit:</td>
                                    <td colspan="4"
                                        style="text-align: center; background-color:#d9d9d9; font-weight:bold;">Lead
                                        Auditor</td>
                                    <td colspan="5"
                                        style="text-align: center; background-color:#d9d9d9; font-weight:bold;">
                                        Auditor</td>
                                    <td colspan="4"
                                        style="text-align: center; background-color:#d9d9d9; font-weight:bold;">
                                        Tenaga ahli</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: center;"><b>{{ $hasil3_lead1 }}</b>
                                    </td>
                                    <td colspan="5" style="text-align: center;"><b>{{ $hasil3_auditor1 }}</b>
                                    </td>
                                    <td colspan="4" style="text-align: center;"><b>{{ $hasil3_tenaga1 }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: center;"><b>{{ $hasil3_lead2 }}</b>
                                    </td>
                                    <td colspan="5" style="text-align: center;"><b>{{ $hasil3_auditor2 }}</b>
                                    </td>
                                    <td colspan="4" style="text-align: center;"><b>{{ $hasil3_tenaga2 }}</b>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">Jumlah Mandays:</td>
                                    <td colspan="11"><b>{{ $kajianclient->hasil4_jumlah }} MD</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <br>

            <table>
                <tbody>
                    <tr>
                        <td colspan="8" style="text-align: center; background-color:#d9d9d9; font-weight:bold;">
                            FAKTOR PENAMBAH</td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpenambah_1) == '1' ? 'checked' : '' }}></td>
                        <td style="text-align: justify;">Kompleksitas lokasi audit penggunaan bahasa yang memerlukan
                            penterjemah</td>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpenambah_2) == '1' ? 'checked' : '' }}></td>
                        <td style="text-align: justify;">Lokasi lingkungan dengan sensitivitas yang tinggi dibandingkan
                            dengan lokasi lain
                            untuk sektor industri tertentu</td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpenambah_3) == '1' ? 'checked' : '' }}></td>
                        <td style="text-align: justify;">Jumlah personil yang sangat besar (lebih dari 100 orang)</td>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpenambah_4) == '1' ? 'checked' : '' }}></td>
                        <td style="text-align: justify;">Masukan dari para pihak yang berkepentingan</td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpenambah_5) == '1' ? 'checked' : '' }}></td>
                        <td style="text-align: justify;">Tingkat keharusan untuk memenuhi peraturan perundang-undagan
                            yang tinggi dan
                            kompleks (makanan, obat-obatan, tenaga nuklir dsb)</td>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpenambah_6) == '1' ? 'checked' : '' }}></td>
                        <td style="text-align: justify;">Aspek tidak langsung yang mengharuskan penambahan mandays
                            audit</td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpenambah_7) == '1' ? 'checked' : '' }}></td>
                        <td style="text-align: justify;">Tingkat kompleksitas proses yang tinggi</td>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpenambah_8) == '1' ? 'checked' : '' }}></td>
                        <td style="text-align: justify;">Aspek lingkungan tambahan atau kondisi yang tidak biasa yang
                            diatur untuk sektor
                            industri tertentu</td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpenambah_9) == '1' ? 'checked' : '' }}></td>
                        <td style="text-align: justify;">Audit memerlukan kunjungan ke lokasi proyek sementara, dmana
                            masuk dalam lingkup
                            sertifikasi</td>
                        <td colspan="3"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="8" style="text-align: center; background-color:#d9d9d9; font-weight:bold;">
                            FAKTOR PENGURANG</td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpengurang_1) == '1' ? 'checked' : '' }}></td>
                        <td colspan="5" style="text-align: justify;">Klien tidak menerapkan desain & pengembangan
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpengurang_2) == '1' ? 'checked' : '' }}></td>
                        <td colspan="5" style="text-align: justify;">Jumlah personil sedikit (kurang dari 15)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpengurang_3) == '1' ? 'checked' : '' }}></td>
                        <td colspan="5" style="text-align: justify;">Tingkat kematangan sistem manajemen
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpengurang_4) == '1' ? 'checked' : '' }}></td>
                        <td colspan="5" style="text-align: justify;">Klien pernah disertifikasi oleh lembaga
                            sertifikasi lain
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpengurang_5) == '1' ? 'checked' : '' }}></td>
                        <td colspan="5" style="text-align: justify;">Klien telah mengetahui tentang sistem
                            manajemen
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpengurang_6) == '1' ? 'checked' : '' }}></td>
                        <td colspan="5" style="text-align: justify;">Tingkat kompleksitas klien antara lain: <br> -
                            1 (satu)
                            aktivitas proses <br> - Beberapa aktivitas namun identik/sejenis <br> -
                            Sejumlah staf melakukan aktivitas yang identik/sejenis
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="checkbox" style="display: flex; text-align:center;"
                                {{ old('1', $kajianclient->fpengurang_7) == '1' ? 'checked' : '' }}></td>
                        <td colspan="5" style="text-align: justify;">Jumlah staf lapangan yang diluar jajaran
                            manajemen
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="card mt-3">
                <div class="form-group">
                    <div class="col-sm-12">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="col-sm-5" style="font-weight: bold; vertical-align:top">
                                        Justifikasi Penambahan/Pengurangan Mandays :
                                    </td>
                                    <td colspan="4">
                                        <b>{{ $kajianclient->j_nambahkurang }}</b> MD
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-5" rowspan="6"
                                        style="font-weight: bold; vertical-align:top">
                                        Actual Mandays :
                                    </td>
                                    <td colspan="2">
                                        <b>{{ $kajianclient->actual_mandays }}</b>
                                    </td>
                                    <td colspan="2">
                                        Mandays <b>{{ $kajianclient->mandays1 }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <b>Stage I : {{ $kajianclient->stage1 }}</b>
                                    </td>
                                    <td colspan="2">
                                        Mandays <b>{{ $kajianclient->mandays2 }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <b>Stage II : {{ $kajianclient->stage2 }}</b>
                                    </td>
                                    <td colspan="2">
                                        Mandays <b>{{ $kajianclient->mandays3 }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <b>SUR I : {{ $kajianclient->sur1 }}</b>
                                    </td>
                                    <td colspan="2">
                                        Mandays <b>{{ $kajianclient->mandays4 }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <b>SUR II :{{ $kajianclient->sur2 }}</b>
                                    </td>
                                    <td colspan="2">
                                        Mandays <b>{{ $kajianclient->mandays5 }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <b>RES : {{ $kajianclient->res }}</b>
                                    </td>
                                    <td colspan="2">
                                        Mandays <b>{{ $kajianclient->mandays6 }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <b>Transfer Sertifikat*)</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-5" style="font-weight: bold; vertical-align:top">
                                        Apakah pengajuan transfer sertifikat diterima
                                    </td>
                                    <td colspan="2" style="text-align: center">
                                        <input type="checkbox" style="text-align:center;"
                                            {{ old('1', $kajianclient->transfer_sertifikat) == '1' ? 'checked' : '' }}>
                                        <label for="">YA</label>
                                    </td>
                                    <td colspan="2" style="text-align: center">
                                        <input type="checkbox" style="text-align:center;"
                                            {{ old('0', $kajianclient->transfer_sertifikat) == '0' ? 'checked' : '' }}>
                                        <label for="">TIDAK</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="vertical-align: top">
                                        Jika TIDAK, jelaskan alasannya <br>
                                        <b>{{ $kajianclient->transfersertifikat_alasanditolak }}</b>
                                    </td>
                                    <td colspan="4" style="vertical-align: top">
                                        Jika YA, Jelaskan tahapan lanjutan transfer
                                        sertifikat
                                        <b>{{ $kajianclient->transfersertifikat_alasanditerima }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-sm-5" rowspan="4"
                                        style="font-weight: bold; vertical-align:top">
                                        Rencana Sampling Multisite*)
                                    </td>
                                    <td colspan="2" style="vertical-align:top">
                                        Sertifikasi awal : <b>{{ $kajianclient->sertifikasi_awal }}</b>
                                    </td>
                                    <td colspan="2" style="vertical-align:top">
                                        Site : <b>{{ $kajianclient->site1 }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="vertical-align:top">
                                        Survailen I : <b>{{ $kajianclient->survailen_1 }}</b>
                                    </td>
                                    <td colspan="2" style="vertical-align:top">
                                        Site : <b>{{ $kajianclient->site2 }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="vertical-align:top">
                                        Survailen II : <b>{{ $kajianclient->survailen_2 }}</b>
                                    </td>
                                    <td colspan="2">
                                        Site : <b>{{ $kajianclient->site3 }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="vertical-align:top">
                                        Resertifikasi : <b>{{ $kajianclient->resertifikasi }}</b>
                                    </td>
                                    <td colspan="2" style="vertical-align:top">
                                        Site : <b>{{ $kajianclient->site4 }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="vertical-align: top">
                                        <b>Tanggal Permohonan</b>
                                    </td>
                                    <td colspan="4" style="vertical-align: top">
                                        <b>{{ $kajianclient->tgl_permohonan }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="vertical-align: top">
                                        <b>Tanggal Kajian</b>
                                    </td>
                                    <td colspan="4" style="vertical-align: top">
                                        <b>{{ $kajianclient->tgl_kajian }}</b>
                                    </td>
                                </tr>
                            </tbody>
                    </div>
                </div>
            </div>

            <table class="mt-3">
                <tbody>
                    <tr>
                        <td colspan="2">Dikaji oleh/Ttd <br><br><br><br><br><br> (Manager Sertifikasi)</td>
                        <td colspan="2"> <br><br><br><br><br><br> Lead Auditor/Auditor/Tenaga Ahli*)</td>
                    </tr>
                </tbody>
            </table>

            <br>
            <h4>*) jika manager sertifikasi tidak memiliki kompetensi untuk lingkup klien</h4>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>
            <script src="<?= $_SERVER['DOCUMENT_ROOT'] . '/assets/bootstrap/js/bootstrap.min.js' ?>"></script>
</body>

</html>
