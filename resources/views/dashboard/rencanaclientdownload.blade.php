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

<!-- Buat Header Dan Foter  -->
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
    <p class="spacing">F-CER-03 Rev.01 Date:02.05.19</p>
</footer>

<!-- Penutup Buat Header Dan Footer -->

<center class="mt-3">
    <h3>RENCANA SIKLUS SERTIFIKASI</h3>
</center>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td class="col-sm-1">
                        <center>1</center>
                    </td>
                    <td class="col-sm-5">NAMA KLIEN :</td>
                    <td colspan="3"><b>{{ $client->user->name }}</b></td>
                </tr>
                <tr>
                    <td>
                        <center>2</center>
                    </td>
                    <td>ALAMAT PEMOHON :</td>
                    <td colspan="3"><b>{{ $client->user->address }}</b></td>
                </tr>
                <tr>
                    <td>
                        <center>3</center>
                    </td>
                    <td>RUANG LINGKUP SERTIFIKASI :</td>
                    <td colspan="3"><b>{{ $kajianclient->b1_lingkup }}</b></td>
                </tr>
                <tr>
                    <td>
                        <center>4</center>
                    </td>
                    <td>STANDAR :</td>
                    <td colspan="3"><b>{{ $rencanaclient->standart }}</b></td>
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
                    <td rowspan="2" class="col-sm-1">
                        <center><b>No</b></center>
                    </td>
                    <td rowspan="2" class="col-sm-3">
                        <center><b>Tahapan</b></center>
                    </td>
                    <td rowspan="2" class="col-sm-3">
                        <center><b>Rencana</b></center>
                    </td>
                    <td colspan="7">
                        <center><b>Klausul</b></center>
                    </td>
                </tr>
                <tr>

                    <td class="col-sm-1">
                        <center><b>4</b></center>
                    </td>
                    <td class="col-sm-1">
                        <center><b>5</b></center>
                    </td>
                    <td class="col-sm-1">
                        <center><b>6</b></center>
                    </td>
                    <td class="col-sm-1">
                        <center><b>7</b></center>
                    </td>
                    <td class="col-sm-1">
                        <center><b>8</b></center>
                    </td>
                    <td class="col-sm-1">
                        <center><b>9</b></center>
                    </td>
                    <td class="col-sm-1">
                        <center><b>10</b></center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>1</center>
                    </td>
                    <td>Audit Tahap I</td>
                    <td>
                        <center><b>{{ date('m-Y', strtotime($rencanaclient->rencana1)) }}</b></center>
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_audit1_4', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_audit1_5', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_audit1_6', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_audit1_7', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_audit1_8', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_audit1_9', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_audit1_10', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>2</center>
                    </td>
                    <td>Audit Tahap II</td>
                    <td>
                        <center><b>{{ date('m-Y', strtotime($rencanaclient->rencana2)) }}</b></center>
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_audit2_4', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_audit2_5', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_audit2_6', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_audit2_7', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_audit2_8', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_audit2_9', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_audit2_10', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>3</center>
                    </td>
                    <td>Survailen I</td>
                    <td>
                        <center><b>{{ date('m-Y', strtotime($rencanaclient->rencana3)) }}</b></center>
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_survailen1_4', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_survailen1_5', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_survailen1_6', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_survailen1_7', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_survailen1_8', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_survailen1_9', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_survailen1_10', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>4</center>
                    </td>
                    <td>Survailen II</td>
                    <td>
                        <center><b>{{ date('m-Y', strtotime($rencanaclient->rencana4)) }}</b></center>
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_survailen2_4', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_survailen2_5', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_survailen2_6', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_survailen2_7', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_survailen2_8', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_survailen2_9', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_survailen2_10', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>5</center>
                    </td>
                    <td>Resertifikasi</td>
                    <td>
                        <center><b>{{ date('m-Y', strtotime($rencanaclient->rencana5)) }}</b></center>
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_resertifikasi_4', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_resertifikasi_5', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_resertifikasi_6', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_resertifikasi_7', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_resertifikasi_8', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_resertifikasi_9', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td class="col-sm-1" style="text-align: center">
                        @if (in_array('klausul_resertifikasi_10', $klausul))
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>

<div class="col mb-2">
    <label>{{ $rencanaclient->tempat_ttd }}, {{ date('d-m-Y', strtotime($rencanaclient->tgl_ttd)) }}</label>

</div>
<div class="pp mb-5">
    <label>Disetujui Oleh</label>

    {{-- <hr style="width:100px; border-top:5px dotted; color:black; background: white; display:block">
                </hr> --}}
</div>

<br>
<br>

<div class="dd">
    <label>{{ $rencanaclient->nama_ttd }}</label>
</div>

<div class="dd">
    <label>Manager Sertifikasi</label>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="<?= $_SERVER['DOCUMENT_ROOT'] . '/assets/bootstrap/js/bootstrap.min.js' ?>"></script>
</body>

</html>
