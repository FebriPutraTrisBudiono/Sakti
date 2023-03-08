<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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

        tr.hide_all>td,
        td.hide_all {
            border-style: hidden;
        }

        .card {
            border: none;
        }
    </style>
    <title>Document</title>
</head>

<body>
    {{-- <table style="border: none">
        <tbody>
            <tr>
                <th scope="row" style="border: 1px;">
                    <img src="{{ $setting->main_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->main_logo : '/assets/img/noimage.jpeg' }}"
                        class="img-thumbnail main_logoPreview" style="border: none" width="160px">
                </th>
                <td style="border: 1px; text-align: right;">
                    <img src="{{ $setting->sec_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}"
                        class="img-thumbnail main_logoPreview" style="border: none" width="160px">
                </td>
            </tr>
        </tbody>
    </table> --}}

    <!-- Buat Header Dan Footer -->
    <header>
        <img src="{{ $setting->doc_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->doc_logo : '/assets/img/noimage.jpeg' }}"
            class="img-thumbnail main_logoPreview" style="border: none" width="160px">
    </header>

    <header2>
        <img src="{{ $setting->sec_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}"
            class="img-thumbnail main_logoPreview" style="border: none" width="160px">
    </header2>

    <footer>
        <p class="spacing">F-CER-01 Rev.02 Date:09.07.20</p>
    </footer>


    <center class="mt-4">
        <h3>DAFTAR ISIAN PERMOHONAN SERTIFIKASI</h3>
    </center>
    <div class="card mt-3" style="border: none">
        <div class="form-group">
            <div class="col-sm-12">
                <h4>1. Umum</h4>
                <table>
                    <tbody>
                        <tr>
                            <td class="col-sm-3">Nama Perusahaan</td>
                            <td colspan="3"><b><?= $permohonan_sertifikasi->nama_perusahaan ?></b></td>
                        </tr>
                        <tr>
                            <td class="col-sm-3">Alamat Lengkap</td>
                            <td colspan="3"><b><?= $permohonan_sertifikasi->alamat ?></b></td>
                        </tr>
                        <tr>
                            <td class="col-sm-3">No. SIUP/TDP</td>
                            <td colspan="3"><b><?= $permohonan_sertifikasi->no_siup ?></b></td>
                        </tr>
                        <tr>
                            <td class="col-sm-3">Nama web site resmi</td>
                            <td colspan="3"><b><?= $permohonan_sertifikasi->nama_website ?></b></td>
                        </tr>
                        <tr>
                            <td class="col-sm-3">No Telepon</td>
                            <td><b><?= $permohonan_sertifikasi->no_phone ?></b></td>
                            <td>No. Fax:</td>
                            <td><b><?= $permohonan_sertifikasi->no_phone ?></b></td>
                        </tr>
                        <tr>
                            <td class="col-sm-3">Tipe Industri</td>
                            <td text-align: center><input type="checkbox"
                                    {{ old('pabrikan', $permohonan_sertifikasi->type_industry) == 'pabrikan' ? 'checked' : '' }}>
                                <label>Pabrikan:</label>
                            </td>
                            <td text-align: center><input type="checkbox"
                                    {{ old('jasa', $permohonan_sertifikasi->type_industry) == 'jasa' ? 'checked' : '' }}>
                                <label>Jasa:</label>
                            </td>
                            <td text-align: center><input type="checkbox"
                                    {{ old('lainnya', $permohonan_sertifikasi->type_industry) == 'lainnya' ? 'checked' : '' }}>
                                <label>Lainnya:</label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <table class="mt-3">
        <thead>
            <tr>
                <td>Apa produk akhir perusahaan:</td>
                <td>Ruang lingkup sertifikasi:</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><b>
                        <?= $permohonan_sertifikasi->produk_akhir_perusahaan ?>
                    </b></td>
                <td><b>
                        <?= $permohonan_sertifikasi->ruang_lingkup_perusahaan ?>
                    </b></td>
            </tr>
        </tbody>
    </table>

    <div class="card mt-3" style="border: none">
        <div class="form-group">
            <div class="col-sm-12">

                <table>
                    <tbody>
                        <tr>
                            <th colspan="8">Pimpinan Organisasi</th>
                        </tr>
                        <tr>
                            <td class="col-sm-2">Nama:</td>
                            <td colspan="7"><b><?= $permohonan_sertifikasi->nama_pimpinan ?></b></td>
                        </tr>
                        <tr>
                            <td class="col-sm-2">No Telepon:</td>
                            <td colspan="3">
                                <b><?= $permohonan_sertifikasi->nama_pimpinan ?></b>
                            </td>
                            <td class="col-sm-2">Fax No:</td>
                            <td colspan="3">
                                <b><?= $permohonan_sertifikasi->nama_pimpinan ?></b>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-sm-2">Alamat Email:</td>
                            <td colspan="3">
                                <b><?= $permohonan_sertifikasi->email_pimpinan ?></b>
                            </td>
                            <td class="col-sm-2">No Handphone:</td>
                            <td colspan="3">
                                <b><?= $permohonan_sertifikasi->no_hp_pimpinan ?></b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-3" style="border: none">
        <div class="form-group">
            <div class="col-sm-12">
                <table>
                    <tbody>
                        <tr>
                            <th colspan="10">Wakil Manajemen</th>
                        </tr>
                        <tr>
                            <td class="col-sm-2">Nama:</td>
                            <td colspan="9"><b><?= $permohonan_sertifikasi->nama_wakil ?></b></td>
                        </tr>
                        <tr>
                            <td class="col-sm-2">No Telepon:</td>
                            <td colspan="4">
                                <b><?= $permohonan_sertifikasi->no_phone_wakil ?></b>
                            </td>
                            <td class="col-sm-2">No Fax:</td>
                            <td colspan="4">
                                <b><?= $permohonan_sertifikasi->no_fax_wakil ?></b>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-sm-2">Alamat Email:</td>
                            <td colspan="4">
                                <b><?= $permohonan_sertifikasi->email_wakil ?>s</b>
                            </td>
                            <td class="col-sm-2">No Handphone:</td>
                            <td colspan="4">
                                <b><?= $permohonan_sertifikasi->no_hp_wakil ?></b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <table class="mt-3">
        <tbody>
            <tr>
                <td colspan="3">Jumlah Karyawan:</td>
                <td colspan="3">± <b>{{ $permohonan_sertifikasi->jml_karyawan }}</b></td>
            </tr>
            <tr>
                <td>Jumlah Karyawan shift 1 <br> (Jika ada)</td>
                <td>± <b>{{ $permohonan_sertifikasi->shift1 }}</b></td>
                <td>Jumlah Karyawan shift 2 <br> (Jika ada)</td>
                <td>± <b>{{ $permohonan_sertifikasi->shift2 }}</b></td>
                <td>Jumlah Karyawan shift 3 <br> (Jika ada)</td>
                <td>± <b>{{ $permohonan_sertifikasi->shift3 }}</b></td>
            </tr>
            <tr>
                <td colspan="3">Apakah ada Riset & Pengembangan</td>
                <td colspan="3">
                    <input type="checkbox"
                        {{ old('riset_dan_perkembangan', $permohonan_sertifikasi->riset_dan_perkembangan) == '1' ? 'checked' : '' }}>
                    <label for="">Ya</label>
                    <input type="checkbox" class="ms-5"
                        {{ old('riset_dan_perkembangan', $permohonan_sertifikasi->riset_dan_perkembangan) == '0' ? 'checked' : '' }}>
                    <label for="">Tidak</label>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="mt-3">
        <tbody>
            <tr>
                <td>Jumlah Lokasi yang akan diaudit:</td>
                <td style="text-align: center">
                    <input type="checkbox"
                        {{ old('jumlah_lokasi_audit', $permohonan_sertifikasi->jumlah_lokasi_audit) == '1' ? 'checked' : '' }}>
                    <label for="">1</label>
                </td>
                <td style="text-align: center">
                    <input type="checkbox"
                        {{ old('jumlah_lokasi_audit', $permohonan_sertifikasi->jumlah_lokasi_audit) == '2' ? 'checked' : '' }}>
                    <label for="">2</label>
                </td>
                <td style="text-align: center">
                    <input type="checkbox"
                        {{ old('jumlah_lokasi_audit', $permohonan_sertifikasi->jumlah_lokasi_audit) == '3' ? 'checked' : '' }}>
                    <label for="">3</label>
                </td>
                <td style="text-align: center">
                    <input type="checkbox"
                        {{ old('jumlah_lokasi_audit', $permohonan_sertifikasi->jumlah_lokasi_audit) == '4' ? 'checked' : '' }}>
                    <label for="">4</label>
                </td>
                <td style="text-align: center">
                    <input type="checkbox"
                        {{ old('jumlah_lokasi_audit', $permohonan_sertifikasi->jumlah_lokasi_audit) == '5' ? 'checked' : '' }}>
                    <label for="">5</label>
                </td>
                <td style="text-align: center">
                    <input type="checkbox"
                        {{ old('jumlah_lokasi_audit', $permohonan_sertifikasi->jumlah_lokasi_audit) == '>5' ? 'checked' : '' }}
                        <label for=""> >5 </label>
                </td>
            </tr>
            <tr>
                <td>Alamat:</td>
                <td colspan="6"><b><?= $permohonan_sertifikasi->alamat_audit ?></b></td>
            </tr>
        </tbody>
    </table>

    <div class="card mt-3" style="border: none">
        <div class="form-group">
            <div class="col-sm-12">
                <table>
                    <tbody>
                        <tr>
                            <td colspan="4">Apakah perusahaan anda sudah sertifikasi saat ini?</td>
                            <td colspan="2">
                                <input type="checkbox"
                                    {{ old('sudah_sertifikasi', $permohonan_sertifikasi->sudah_sertifikasi) == '1' ? 'checked' : '' }}>
                                <label for="">Ya</label>
                                <input type="checkbox" class="ms-5"
                                    {{ old('sudah_sertifikasi', $permohonan_sertifikasi->sudah_sertifikasi) == '0' ? 'checked' : '' }}>
                                <label for="">Tidak</label>
                            </td>
                        </tr>
                        <tr>
                            <td>Jika ya, dengan Badan Sertifikasi apa? :</td>
                            <td colspan="2">
                                <b><?= $permohonan_sertifikasi->badan_sertifikasi ?></b>
                            </td>
                            <td class="col-sm-2">Nama Badan Sertifikasi:</td>
                            <td colspan="2">
                                <b><?= $permohonan_sertifikasi->nama_badan_sertifikasi ?></b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <table class="mt-3">
        <tbody>
            <tr>
                <td colspan="4">Skema Sertifikasi yang diajukan:</td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox"
                        {{ old('iso', $permohonan_sertifikasi->iso) == 'ISO 9001:2015' ? 'checked' : '' }}>
                    <label for="">ISO 9001:2015</label>
                </td>
                <td>
                    <input type="checkbox"
                        {{ old('iso', $permohonan_sertifikasi->iso) == 'ISO 21001:2018' ? 'checked' : '' }}>
                    <label for="">ISO 21001:2018</label>
                </td>
                <td>
                    <input type="checkbox"
                        {{ old('iso', $permohonan_sertifikasi->iso) == 'ISO 45001:2018' ? 'checked' : '' }}>
                    <label for="">ISO 45001:2018</label>
                </td>
                <td>
                    <input type="checkbox"
                        {{ old('iso', $permohonan_sertifikasi->iso) == 'ISO 14001:2015' ? 'checked' : '' }}>
                    <label for="">ISO 14001:2015</label>
                </td>
            </tr>
            <tr>
                <td>
                    @if ($permohonan_sertifikasi->iso == 'ISO 9001:2015' ||
                        $permohonan_sertifikasi->iso == 'ISO 14001:2015' ||
                        $permohonan_sertifikasi->iso == 'ISO 21001:2018' ||
                        $permohonan_sertifikasi->iso == 'ISO 45001:2018')
                        <input type="checkbox">
                        <label>....</label>
                    @else
                        <input type="checkbox" checked>
                        <label>{{ $permohonan_sertifikasi->iso }}</label>
                    @endif
                </td>
                <td>
                    <input type="checkbox">
                    <label for=""></label>
                </td>
                <td>
                    <input type="checkbox">
                    <label for=""></label>
                </td>
                <td>
                    <input type="checkbox">
                    <label for=""></label>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="mt-3">
        <tr>
            <td class="col-sm-5" style="vertical-align: top">Apakah dibantu Konsultan:</td>
            <td class="col-sm-2">
                <input type="checkbox" class="ms-2"
                    {{ old('dibantu_konsultasi', $permohonan_sertifikasi->dibantu_konsultasi) == '1' ? 'checked' : '' }}>
                <label for="">Ya</label> <br>
                <input type="checkbox" class="ms-2"
                    {{ old('dibantu_konsultasi', $permohonan_sertifikasi->sudah_sertifdibantu_konsultasiikasi) == '0' ? 'checked' : '' }}>
                <label for="">Tidak</label>
            </td>
            <td style="vertical-align: top">Nama Konsultan: <br>
                <b>{{ $permohonan_sertifikasi->nama_konsultasi }}</b>
            </td>
        </tr>
        <tr>
            <td class="col-sm-5" style="text-align: justify;">Apakah sistem manajemen yang akan disertifikasi
                merupakan bagian dari organisasi
                lain/grup ?</td>
            <td class="col-sm-2">
                <input type="checkbox" class="ms-2"
                    {{ old('sertifikasi_bagian_grup_lain', $permohonan_sertifikasi->sertifikasi_bagian_grup_lain) == '1' ? 'checked' : '' }}>
                <label for="">Ya</label> <br>
                <input type="checkbox" class="ms-2"
                    {{ old('sertifikasi_bagian_grup_lain', $permohonan_sertifikasi->sertifikasi_bagian_grup_lain) == '0' ? 'checked' : '' }}>
                <label for="">Tidak</label>
            </td>
            <td style="vertical-align: top">Jika YA, Jelaskan<br>
                <b>{{ $permohonan_sertifikasi->sertifikasi_bagian_grup_lain_jelaskan }}</b>
            </td>
        </tr>
        <tr>
            <td class="col-sm-5" style="vertical-align: top">Apakah diberlakukan jam kerja shift ?</td>
            <td class="col-sm-2">
                <input type="checkbox" class="ms-2"
                    {{ old('sudah_sertifikasi', $permohonan_sertifikasi->diberlakukan_jam_kerja_shift) == '1' ? 'checked' : '' }}>
                <label for="">Ya</label> <br>
                <input type="checkbox" class="ms-2"
                    {{ old('sudah_sertifikasi', $permohonan_sertifikasi->diberlakukan_jam_kerja_shift) == '0' ? 'checked' : '' }}>
                <label for="">Tidak</label>
            </td>
            <td style="vertical-align: top">Jika YA, Jelaskan<br>
                <b>{{ $permohonan_sertifikasi->diberlakukan_jam_kerja_shift_jelaskan }}</b>
            </td>
        </tr>
        <tr>
            <td class="col-sm-5" style="text-align: justify;">Apakah ada proses pekerjaan yang disubkontrakkan ?</td>
            <td class="col-sm-2">
                <input type="checkbox" class="ms-2"
                    {{ old('sudah_sertifikasi', $permohonan_sertifikasi->pekerjaan_disubkontrakkan) == '1' ? 'checked' : '' }}>
                <label for="">Ya</label> <br>
                <input type="checkbox" class="ms-2"
                    {{ old('sudah_sertifikasi', $permohonan_sertifikasi->pekerjaan_disubkontrakkan) == '0' ? 'checked' : '' }}>
                <label for="">Tidak</label>
            </td>
            <td style="vertical-align: top">Jika YA, Jelaskan<br>
                <b>{{ $permohonan_sertifikasi->pekerjaan_disubkontrakkan_jelaskan }}</b>
            </td>
        </tr>
        <tr>
            <td class="col-sm-5" style="text-align: justify;">Jelaskan status akreditasi organisasi pendidikan?(khusus
                SNI ISO 21001)</td>
            <td class="col-sm-2" colspan="2" style="vertical-align: top">
                <b>{{ $permohonan_sertifikasi->status_akreditasi }}</b>
            </td>
        </tr>
        <tr>
            <td class="col-sm-5" style="vertical-align: top">Tanggal Internal audit terakhir? <br>
                <b>{{ $permohonan_sertifikasi->tanggal_internal_audit_terakhir }}</b>
            </td>
            <td class="col-sm-2" colspan="2" style="vertical-align: top"> Tanggal Rapat Tinjauan Manajemen
                terakhir? <br>
                <b>{{ $permohonan_sertifikasi->tanggal_rapat_tinjauan_terakhir }}</b>
            </td>
        </tr>
        <tr>
            <td class="col-sm-5" style="vertical-align: top; text-align: justify;">Apakah dokumen manual dari sistem
                manajemen yang diajukan
                sertifikasi sudah lengkap dan diimplementasikan disemua proses?</td>
            <td class="col-sm-2" colspan="2" style="vertical-align: top">
                <input type="checkbox" class="ms-2"
                    {{ old('sudah_sertifikasi', $permohonan_sertifikasi->dokumen_manual_lengkap) == '1' ? 'checked' : '' }}>
                <label for="">Ya</label>
                <input type="checkbox" class="ms-4"
                    {{ old('sudah_sertifikasi', $permohonan_sertifikasi->dokumen_manual_lengkap) == '0' ? 'checked' : '' }}>
                <label for="">Tidak</label>
            </td>
        </tr>
        <tr>
            <td class="col-sm-5" style="vertical-align: top; text-align: justify;">Apakah sistem manajemen yang akan
                disertifikasi sudah melaksanakan
                internal audit dan
                tinjauan manajemen ?</td>
            <td class="col-sm-2" colspan="2" style="vertical-align: top">
                <input type="checkbox" class="ms-2"
                    {{ old('sudah_sertifikasi', $permohonan_sertifikasi->sistem_manajemen_sudah_audit) == '1' ? 'checked' : '' }}>
                <label for="">Ya</label>
                <input type="checkbox" class="ms-4"
                    {{ old('sudah_sertifikasi', $permohonan_sertifikasi->sistem_manajemen_sudah_audit) == '0' ? 'checked' : '' }}>
                <label for="">Tidak</label>
            </td>
        </tr>
        <tr>
            <td class="col-sm-5" style="vertical-align: top;">Rencana/Target Sertifikasi</td>
            <td class="col-sm-2" style="vertical-align: top">Bulan : <br>
                <b>{{ \App\Helpers\Bulan::get()->first(fn($value, $key) => $key == $permohonan_sertifikasi->rencana_bulan_sertifikasi) }}</b>
            </td>
            <td class="col-sm-2" style="vertical-align: top">Tahun: <br>
                <b>{{ $permohonan_sertifikasi->rencana_tahun_sertifikasi }}</b>
            </td>
        </tr>
        <tr>
            <td class="col-sm-5" colspan="3" style="vertical-align: top;">Pemohon harus menyertakan kelengkapan
                aplikasi
                sertifikasi berikut ini: <br>
                <ol type="a">
                    <li>
                        Akte notaris atau legalitas pemohon/organisasi </li>
                    <li>
                        Struktur organisasi
                    </li>
                    <li>
                        Manual dan prosedur mutu
                    </li>
                    <li>
                        Denah (Layout)
                    </li>
                </ol>
            </td>
        </tr>
    </table>

    <div class="form-group mb-5 mt-3">
        <label>Kami menyatakan bahwa semua data dan informasi yang diberikan adalah benar dan sesuai dengan
            kondisi
            kami.</label>
    </div>

    <div class="card border-0">
        <div class="form-group">
            <table>
                <tbody>
                    <tr class="hide_all">
                        <td class="col-sm-3">
                            <br><br><br><br>
                            <hr width="60%">Nama/tanda tangan Jabatan Tanggal Dan Cap
                            Perusahaan
                        </td>
                        <td class="col-sm-3">
                            <br><br><br>
                            <hr width="60%" style="display: block; margin-left:20%;">
                            <center>Jabatan</center>
                        </td>
                        <td class="col-sm-3">
                            <br><br><br>
                            <hr width="60%" style="display: block; margin-left:20%;">
                            <center>Tanggal</center>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="<?= $_SERVER['DOCUMENT_ROOT'] . '/assets/bootstrap/js/bootstrap.min.js' ?>"></script>
</body>

</html>
