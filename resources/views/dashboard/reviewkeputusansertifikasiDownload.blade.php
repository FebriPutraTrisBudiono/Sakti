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
    <p class="spacing">F-CER-11 Rev.01 Date:02.05.19</p>
</footer>

<!-- Penutup Buat Header Dan Footer -->

<center>
    <h3>REVIEW KEPUTUSAN SERTIFIKASI</h3>
</center>

<div class="card border-0">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td class="col-sm-3" style="background-color:lightgray;"><b>Nama Pemohon</b></td>
                    <td colspan="11">
                        : {{ $permohonansertifikasi->nama_pimpinan }}
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-3" style="background-color:lightgray;"><b>Alamat</b></td>
                    <td colspan="11">
                        : {{ $permohonansertifikasi->alamat }}
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-3" style="background-color:lightgray;"><b>Ruang Lingkup</b></td>
                    <td colspan="11">
                        : {{ $permohonansertifikasi->ruang_lingkup_perusahaan }}
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-3" style="background-color:lightgray;"><b>Standar</b></td>
                    <td colspan="11">
                        : {{ $rencanaclient->standart }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card border-0">
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
                <tr>
                    <td colspan="18">
                        Deskripsi Singkat Pemohon: <br>
                        {{ $reviewkeputusansertifikasi->deskripsi_pemohon }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card border-0">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="7" style="background-color:lightgray;">
                        <center><b>Kriteria</b></center>
                    </td>
                    <td colspan="2" style="background-color:lightgray;">
                        <center><b>Ya</b></center>
                    </td>
                    <td colspan="3" style="background-color:lightgray;">
                        <center><b>Tidak</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <b>A. Kelengkapan Hasil Audit</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        1. Dokumen yang disampaikan oleh tim telah lengkap:
                    </td>
                    <td colspan="2">

                    </td>
                    <td colspan="3">

                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <ul>
                            <li>Laporan audit</li>
                        </ul>
                    </td>
                    @if ($reviewkeputusansertifikasi->kriteria_a1_1 == 1)
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                        <td colspan="3">
                        </td>
                    @elseif ($reviewkeputusansertifikasi->kriteria_a1_1 == 0)
                        <td colspan="2">
                        </td>
                        <td colspan="3" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="7">
                        <ul>
                            <li>Hasil verifikasi ketidaksesuaian</li>
                        </ul>
                    </td>
                    @if ($reviewkeputusansertifikasi->kriteria_a1_2 == 1)
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                        <td colspan="3">
                        </td>
                    @elseif ($reviewkeputusansertifikasi->kriteria_a1_2 == 0)
                        <td colspan="2">
                        </td>
                        <td colspan="3" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="7">
                        <ul>
                            <li>Rekomendasi tim audit</li>
                        </ul>
                    </td>
                    @if ($reviewkeputusansertifikasi->kriteria_a1_3 == 1)
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                        <td colspan="3">
                        </td>
                    @elseif ($reviewkeputusansertifikasi->kriteria_a1_3 == 0)
                        <td colspan="2">
                        </td>
                        <td colspan="3" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="7">
                        2. Ketidaksesuaian telah diperbaiki oleh pemohon
                    </td>
                    @if ($reviewkeputusansertifikasi->kriteria_a2 == 1)
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                        <td colspan="3">
                        </td>
                    @elseif ($reviewkeputusansertifikasi->kriteria_a2 == 0)
                        <td colspan="2">
                        </td>
                        <td colspan="3" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="7">
                        3. Ketidaksesuaian masih ada yang berstatus open
                    </td>
                    @if ($reviewkeputusansertifikasi->kriteria_a3 == 1)
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                        <td colspan="3">
                        </td>
                    @elseif ($reviewkeputusansertifikasi->kriteria_a3 == 0)
                        <td colspan="2">
                        </td>
                        <td colspan="3" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="7">
                        4. seluruh ketidaksesuaian telah diverifikasi oleh tim auditor, sebutkan
                    </td>
                    @if ($reviewkeputusansertifikasi->kriteria_a4 == 1)
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                        <td colspan="3">
                        </td>
                    @elseif ($reviewkeputusansertifikasi->kriteria_a4 == 0)
                        <td colspan="2">
                        </td>
                        <td colspan="3" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="12">
                        <ul>
                            <li>Sebutkan tanggal verifikasi (closing temuan) :
                                {{ $reviewkeputusansertifikasi->kriteria_a4_1 }}</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        5. Mandays audit sesuai dengan ketentuan
                    </td>
                    @if ($reviewkeputusansertifikasi->kriteria_a5 == 1)
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                        <td colspan="3">
                        </td>
                    @elseif ($reviewkeputusansertifikasi->kriteria_a5 == 0)
                        <td colspan="2">
                        </td>
                        <td colspan="3" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="12">
                        <ul>
                            <li>Jumlah mandays audit actual : {{ $reviewkeputusansertifikasi->kriteria_a5_1 }}
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <b>6. Apakah ruang lingkup permohonan sesuai dengan bisnis proses klien yang diaudit</b>
                    </td>
                    @if ($reviewkeputusansertifikasi->kriteria_a6 == 1)
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                        <td colspan="3">
                        </td>
                    @elseif ($reviewkeputusansertifikasi->kriteria_a6 == 0)
                        <td colspan="2">
                        </td>
                        <td colspan="3" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="12">
                        <ul>
                            <li>Sebutkan lingkup proses bisnis klien yang diaudit <br>
                                {{ $reviewkeputusansertifikasi->kriteria_a6_1 }}</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <b>7. Apakah tujuan pelaksanaan audit telah tercapai</b>
                    </td>
                    @if ($reviewkeputusansertifikasi->kriteria_a7 == 1)
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                        <td colspan="3">
                        </td>
                    @elseif ($reviewkeputusansertifikasi->kriteria_a7 == 0)
                        <td colspan="2">
                        </td>
                        <td colspan="3" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="12">
                        <b>Sebutkan tujuan audit:</b>
                        <br>
                        <input type="checkbox" id="tahapii" name="tahapii" value="tahapii" class="ms-3"
                            {{ $reviewkeputusansertifikasi->kriteria_a7_1 == 'Tahap II' ? 'checked' : '' }}>
                        <label for="tahapii">Tahap II</label>
                        <br>
                        <input type="checkbox" id="pemeliharaan" name="pemeliharaan" value="pemeliharaan"
                            class="ms-3"
                            {{ $reviewkeputusansertifikasi->kriteria_a7_1 == 'Pemeliharaan' ? 'checked' : '' }}>
                        <label for="pemeliharaan">Pemeliharaan</label>
                        <br>
                        <input type="checkbox" id="resertifikasi" name="resertifikasi" value="resertifikasi"
                            class="ms-3"
                            {{ $reviewkeputusansertifikasi->kriteria_a7_1 == 'Resertifikasi' ? 'checked' : '' }}>
                        <label for="resertifikasi">Resertifikasi</label>
                        <br>
                        <input type="checkbox" id="perluasan" name="perluasan" value="perluasan" class="ms-3"
                            {{ $reviewkeputusansertifikasi->kriteria_a7_1 == 'Perluasan' ? 'checked' : '' }}>
                        <label for="perluasan">Perluasan</label>
                        <br>
                        <input type="checkbox" id="short" name="short" value="short" class="ms-3"
                            {{ $reviewkeputusansertifikasi->kriteria_a7_1 == 'Short Notice Audit' ? 'checked' : '' }}>
                        <label for="short">Short Notice Audit</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <b>8. Khusus Resertifikasi</b>
                    </td>
                    <td colspan="2">

                    </td>
                    <td colspan="3">
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <ul>
                            <li>Apakah review kinerja satu siklus klien telah ditetapkan</li>
                        </ul>
                    </td>
                    @if ($reviewkeputusansertifikasi->kriteria_a8_1 == 1)
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                        <td colspan="3">
                        </td>
                    @elseif ($reviewkeputusansertifikasi->kriteria_a8_1 == 0)
                        <td colspan="2">
                        </td>
                        <td colspan="3" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="7">
                        <ul>
                            <li>Apakah ada improvement terhadap penerapan sistem manajemen klien</li>
                        </ul>
                    </td>
                    @if ($reviewkeputusansertifikasi->kriteria_a8_2 == 1)
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                        <td colspan="3">
                        </td>
                    @elseif ($reviewkeputusansertifikasi->kriteria_a8_2 == 0)
                        <td colspan="2">
                        </td>
                        <td colspan="3" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="7">
                        <ul>
                            <li>Apakah dilakukan audit tahap 1 dalam rangka resertifikasi</li>
                        </ul>
                    </td>
                    @if ($reviewkeputusansertifikasi->kriteria_a8_3 == 1)
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                        <td colspan="3">
                        </td>
                    @elseif ($reviewkeputusansertifikasi->kriteria_a8_3 == 0)
                        <td colspan="2">
                        </td>
                        <td colspan="3" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="7">
                        9. Rekomendasi tim audit terhadap hasil audit yang telah dilaksanakan
                    </td>
                    @if ($reviewkeputusansertifikasi->kriteria_a9 == 1)
                        <td colspan="2" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                        <td colspan="3">
                        </td>
                    @elseif ($reviewkeputusansertifikasi->kriteria_a9 == 0)
                        <td colspan="2">
                        </td>
                        <td colspan="3" style="text-align: center">
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="12">
                        Keputusan Sertifikasi: <br>
                        {{ $reviewkeputusansertifikasi->keputusan_sertifikasi }}
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        Catatan: <br>
                        {{ $reviewkeputusansertifikasi->catatan }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<br>

<div class="card border-0">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="6">
                        <label class="ms-3">
                            {{ date('d-m-Y', strtotime($reviewkeputusansertifikasi->tanggal_pengambilkeputusan)) }}
                        </label><br>
                        <label class="ms-3">
                            Pengambil Keputusan Sertifikasi
                        </label><br><br><br><br><br><br>
                        <label class="ms-3">
                            {{ $reviewkeputusansertifikasi->nama_pengambilkeputusan }}
                        </label>
                    </td>
                    <td colspan="6"><br>
                        <label class="ms-3">
                            Lead Auditor/Auditor/Tenaga Ahli*)
                        </label>
                        <br><br><br><br><br><br>
                        <label class="ms-3">
                            {{ $reviewkeputusansertifikasi->nama_ttd }}
                        </label>
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
