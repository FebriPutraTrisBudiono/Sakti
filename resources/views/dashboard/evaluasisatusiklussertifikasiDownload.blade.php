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

        tr.hide_all>td,
        td.hide_all {
            border-style: hidden;
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
        class="img-thumbnail main_logoPreview" style="border: none" width="160px">
</header>

<header2>
    <img src="{{ $setting->sec_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}"
        class="img-thumbnail main_logoPreview" style="border: none" width="160px">
</header2>

<footer>
    <p class="spacing">F-CER-13 Rev.02 Date:09.07.20</p>
</footer>

<!-- Penutup Buat Header Dan Footer -->

<center>
    <h3>EVALUASI SATU SIKLUS SERTIFIKASI</h3>
</center>

<div class="card border-0">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td class="col-sm-3" style="background-color:#f3f3f3;"><b>Nama Klien</b></td>
                    <td colspan="11">
                        : {{ $permohonansertifikasi->nama_pimpinan ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-3" style="background-color:#f3f3f3;"><b>Alamat</b></td>
                    <td colspan="11">
                        : {{ $permohonansertifikasi->alamat ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-3" style="background-color:#f3f3f3;"><b>Ruang Lingkup</b></td>
                    <td colspan="11">
                        : {{ $permohonansertifikasi->ruang_lingkup_perusahaan ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-3" style="background-color:#f3f3f3;"><b>Standar</b></td>
                    <td colspan="11">
                        : {{ $rencanaclient->standart ?? '' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>


<h5>I. INFORMASI PELAKSANAAN AUDIT</h5>


<div class="card border-0">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="2">
                        <center><b>NO</b>
                            <center>
                    </td>
                    <td colspan="3">
                        <center><b>TAHAPAN</b></center>
                    </td>
                    <td colspan="3">
                        <center><b>TANGGAL AUDIT</b></center>
                    </td>
                    <td colspan="3">
                        <center><b>HASIL</b></center>
                    </td>
                    <td colspan="3">
                        <center><b>TINDAKLANJUT</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="3">1</td>
                    <td colspan="3" rowspan="3">Stage I</td>
                    <td colspan="3" rowspan="3">{{ $evaluasisatusiklussertifikasi->stage1tanggalaudit ?? '' }}
                    </td>
                    <td colspan="1"><b>Major</b></td>
                    <td colspan="2">{{ $evaluasisatusiklussertifikasi->stage1hasilmajor ?? '' }}</td>
                    <td colspan="3" rowspan="3">{{ $evaluasisatusiklussertifikasi->stage1tindaklanjut ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1"><b>Minor</b></td>
                    <td colspan="2">{{ $evaluasisatusiklussertifikasi->stage1hasilminor ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="1"><b>Observasi</b></td>
                    <td colspan="2">{{ $evaluasisatusiklussertifikasi->stage1hasilobservasi ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="3">2</td>
                    <td colspan="3" rowspan="3">Stage II</td>
                    <td colspan="3" rowspan="3">{{ $evaluasisatusiklussertifikasi->stage2tanggalaudit ?? '' }}
                    </td>
                    <td colspan="1"><b>Major</b></td>
                    <td colspan="2">{{ $evaluasisatusiklussertifikasi->stage2hasilmajor ?? '' }}</td>
                    <td colspan="3" rowspan="3">{{ $evaluasisatusiklussertifikasi->stage2tindaklanjut ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1"><b>Minor</b></td>
                    <td colspan="2">{{ $evaluasisatusiklussertifikasi->stage2hasilminor ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="1"><b>Observasi/<b></td>
                    <td colspan="2">{{ $evaluasisatusiklussertifikasi->stage2hasilobservasi ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="3">3</td>
                    <td colspan="3" rowspan="3">Survailen I</td>
                    <td colspan="3" rowspan="3">
                        {{ $evaluasisatusiklussertifikasi->survailen1tanggalaudit ?? '' }}</td>
                    <td colspan="1"><b>Major</b></td>
                    <td colspan="2">{{ $evaluasisatusiklussertifikasi->survailen1hasilmajor ?? '' }}</td>
                    <td colspan="3" rowspan="3">
                        {{ $evaluasisatusiklussertifikasi->survailen1tindaklanjut ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="1"><b>Minor</b></td>
                    <td colspan="2">{{ $evaluasisatusiklussertifikasi->survailen1hasilminor ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="1"><b>Observasi</b></td>
                    <td colspan="2">{{ $evaluasisatusiklussertifikasi->survailen1hasilobservasi ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="3">4</td>
                    <td colspan="3" rowspan="3">Survailen II</td>
                    <td colspan="3" rowspan="3">
                        {{ $evaluasisatusiklussertifikasi->survailen2tanggalaudit ?? '' }}</td>
                    <td colspan="1"><b>Major</b></td>
                    <td colspan="2">{{ $evaluasisatusiklussertifikasi->survailen2hasilmajor ?? '' }}</td>
                    <td colspan="3" rowspan="3">
                        {{ $evaluasisatusiklussertifikasi->survailen2tindaklanjut ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="1"><b>Minor</b></td>
                    <td colspan="2">{{ $evaluasisatusiklussertifikasi->survailen2hasilminor ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="1"><b>Observasi</b></td>
                    <td colspan="2">{{ $evaluasisatusiklussertifikasi->survailen2hasilobservasi ?? '' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>

<h5>OVERVIEW</h5>

<div class="card border-0">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td style="background-color: #d9d9d9;" class="col-sm-9">
                        <center><b>KRITERIA</b></center>
                    </td>
                    <td style="background-color: #d9d9d9;" colspan="3">
                        <center><b>YA</b></center>
                    </td>
                    <td style="background-color: #d9d9d9;" colspan="3">
                        <center><b>TIDAK</b></center>
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-9">1. Apakah terdapat perubahan sistem dokumentasi klien</td>
                    <td colspan="3">
                        <center>
                            <input type="checkbox"
                                {{ ($evaluasisatusiklussertifikasi->overview_1 ?? '') == '1' ? 'checked' : '' }}>
                        </center>
                    </td>
                    <td colspan="3">
                        <center>
                            <input type="checkbox"
                                {{ ($evaluasisatusiklussertifikasi->overview_1 ?? '') == '0' ? 'checked' : '' }}>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-9">2. Apakah klien menerapkan persyaratan sertifikasi secara efektif</td>
                    <td colspan="3">
                        <center>
                            <input type="checkbox"
                                {{ ($evaluasisatusiklussertifikasi->overview_2 ?? '') == '1' ? 'checked' : '' }}>
                        </center>
                    </td>
                    <td colspan="3">
                        <center>
                            <input type="checkbox"
                                {{ ($evaluasisatusiklussertifikasi->overview_1 ?? '') == '0' ? 'checked' : '' }}>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-9">3. Apakah hasil pelaksanaan audit selama satu siklus sertifikasi terdapat
                        temuan yang siginifikan dan berdampak kepada status sertifikasi klien</td>
                    <td colspan="3">
                        <center>
                            <input type="checkbox"
                                {{ ($evaluasisatusiklussertifikasi->overview_3 ?? '') == '1' ? 'checked' : '' }}>
                        </center>
                    </td>
                    <td colspan="3">
                        <center>
                            <input type="checkbox"
                                {{ ($evaluasisatusiklussertifikasi->overview_3 ?? '') == '0' ? 'checked' : '' }}>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-9">4. Apakah dalam pelaksanaan resertifikasi diperlukan stage I kepada klien</td>
                    <td colspan="3">
                        <center>
                            <input type="checkbox"
                                {{ ($evaluasisatusiklussertifikasi->overview_4 ?? '') == '1' ? 'checked' : '' }}>
                        </center>
                    </td>
                    <td colspan="3">
                        <center>
                            <input type="checkbox"
                                {{ ($evaluasisatusiklussertifikasi->overview_4 ?? '') == '0' ? 'checked' : '' }}>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-9" colspan="7">5. Jika jawaban point 4 YA, sebutkan alasannya</td>
                </tr>
                <tr>
                    <td colspan="7">
                        {{ $evaluasisatusiklussertifikasi->overview_5 ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="7">6. Kesimpulan Kajian Satu Siklus Sertifikasi:</td>
                </tr>
                <tr>
                    <td colspan="7">
                        {{ $evaluasisatusiklussertifikasi->overview_6 ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="7">Catatan: <br>
                        {{ $evaluasisatusiklussertifikasi->catatan ?? '' }}
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
                <tr class="hide_all">
                    <td colspan="6">
                        {{ date('d-m-Y', strtotime($evaluasisatusiklussertifikasi->tgl_ttd ?? '')) }}<br>Manager
                        Sertifikasi<br><br><br><br><br><br>{{ $evaluasisatusiklussertifikasi->nama_ttd ?? '' }}</td>
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
