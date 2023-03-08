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
        class="img-thumbnail main_logoPreview" width="160px" style="border: none">
</header>

<header2>
    <img src="{{ $setting->sec_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}"
        class="img-thumbnail main_logoPreview" width="160px" style="border: none">
</header2>

<footer>
    <p class="spacing">F-CER-04 Rev.01 Date:02.05.19</p>
</footer>

<!-- Penutup Buat Header Dan Footer -->

<center>
    <h3>PENUNJUKAN TIM AUDIT</h3>
</center>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="3" style="background-color:lightgray"><b>Nama Pemohon</b></td>
                    <td colspan="9">: {{ $permohonanclient->nama_pimpinan }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="background-color:lightgray"><b>Ruang Lingkup</b></td>
                    <td colspan="9">: {{ $permohonanclient->ruang_lingkup_perusahaan }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="background-color:lightgray"><b>Standar</b></td>
                    <td colspan="9">: {{ $rencanaclient->standart }}</td>
                </tr>
                <tr>
                    <td colspan="12" style="text-align: center; background-color:lightgray">
                        <b>Audit</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="checkbox" {{ $audit[0] == 'pra_audit' ? 'checked' : '' }}><label>Pra
                            audit</label></td>
                    <td colspan="2"><input type="checkbox"{{ $audit[1] == 'stage1' ? 'checked' : '' }}><label>Stage
                            I</label></td>
                    <td colspan="2"><input type="checkbox"{{ $audit[2] == 'stage2' ? 'checked' : '' }}><label>Stage
                            II</label></td>
                    <td colspan="2"><input
                            type="checkbox"{{ $audit[3] == 'surveilan' ? 'checked' : '' }}><label>Surveilan</label>
                    </td>
                    <td colspan="2"><input
                            type="checkbox"{{ $audit[4] == 'tindaklanjut' ? 'checked' : '' }}><label>Tindaklanjut</label>
                    </td>
                    <td colspan="2"><input
                            type="checkbox"{{ $audit[5] == 'resertifikasi' ? 'checked' : '' }}><label>Re-Sertifikasi</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <br>
                    </td>
                </tr>
                <tr style="background-color:lightgray">
                    <td colspan="1">
                        <center><b>No</b></center>
                    </td>
                    <td colspan="4">
                        <center><b>Nama Auditor</b></center>
                    </td>
                    <td colspan="4">
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
                    <td colspan="4"><?php
                    $user = new App\Models\User();
                    $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor)->first();
                    ?>{{ $userid->name ?? '' }}</td>
                    <td colspan="4">{{ $stage1penunjukantimaudit->nama_inisial }}</td>
                    <td colspan="3">{{ $stage1penunjukantimaudit->jabatan }}</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>2</center>
                    </td>
                    <td colspan="4"><?php
                    $user = new App\Models\User();
                    $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor2)->first();
                    ?>{{ $userid->name ?? '' }}</td>
                    <td colspan="4">{{ $stage1penunjukantimaudit->nama_inisial2 }}</td>
                    <td colspan="3">{{ $stage1penunjukantimaudit->jabatan2 }}</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>3</center>
                    </td>
                    <td colspan="4"><?php
                    $user = new App\Models\User();
                    $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor3)->first();
                    ?>{{ $userid->name ?? '' }}</td>
                    <td colspan="4">{{ $stage1penunjukantimaudit->nama_inisial3 }}</td>
                    <td colspan="3">{{ $stage1penunjukantimaudit->jabatan3 }}</td>
                </tr>
                <tr>
                    <td colspan="3" rowspan="1">Untuk bertugas tanggal</td>
                    <td colspan="3" rowspan="1">
                        {{ date('d-m-Y', strtotime($stage1penunjukantimaudit->tanggal_bertugas)) }}</td>
                    <td colspan="3" rowspan="1">Sampai dengan</td>
                    <td colspan="3" rowspan="1">
                        {{ date('d-m-Y', strtotime($stage1penunjukantimaudit->sampai_dengan)) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>

<div class="col mb-2">
    <label>{{ $stage1penunjukantimaudit->tempat_ttd }},
        {{ date('d-m-Y', strtotime($stage1penunjukantimaudit->tgl_ttd)) }}</label>

</div>
<div class="pp mb-5">
    <label>Disetujui Oleh</label>

    {{-- <hr style="width:100px; border-top:5px dotted; color:black; background: white; display:block">
                </hr> --}}
</div>

<br>
<br>

<div class="dd">
    <label>{{ $stage1penunjukantimaudit->nama_ttd }}</label>
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
