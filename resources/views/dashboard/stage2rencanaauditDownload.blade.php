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
        width="200px">
</header>

<header2>
    <img src="{{ $setting->sec_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}"
        width="150px">
</header2>

<footer>
    <p class="spacing">F-CER-05 Rev.01 Date.02.05.19</p>
</footer>

<!-- Penutup Buat Header Dan Footer -->

<center>
    <h3>RENCANA AUDIT</h3>
</center>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td class="col-sm-3" style="background-color:#d9d9da;"><b>Nama Organisasi</b></td>
                    <td colspan="9">
                        : {{ $permohonansertifikasi->nama_perusahaan }}
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-3" style="background-color:#d9d9da;"><b>Alamat</b></td>
                    <td colspan="9">
                        : {{ $permohonansertifikasi->alamat }}
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-3" style="background-color:#d9d9da;"><b>Ruang Lingkup</b></td>
                    <td colspan="9">
                        : {{ $permohonansertifikasi->ruang_lingkup_perusahaan }}
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-3" style="background-color:#d9d9da;"><b>Standar Acuan</b></td>
                    <td colspan="9">
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
                    <td colspan="18" style="background-color:#d9d9da;">
                        <center><b>Sasaran</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><input type="checkbox"
                            {{ $arraudit[0] == 'pra_audit' ? 'checked' : '' }}><label>Pra
                            audit</label></td>
                    <td colspan="3"><input type="checkbox"
                            {{ $arraudit[1] == 'stage1' ? 'checked' : '' }}><label>Stage I</label>
                    </td>
                    <td colspan="3"><input type="checkbox"
                            {{ $arraudit[2] == 'stage2' ? 'checked' : '' }}><label>Stage II</label>
                    </td>
                    <td colspan="3"><input type="checkbox"
                            {{ $arraudit[3] == 'surveilen' ? 'checked' : '' }}><label>Surveilan</label>
                    </td>
                    <td colspan="3"><input type="checkbox"
                            {{ $arraudit[4] == 'tindaklanjut' ? 'checked' : '' }}><label>Tindaklanjut</label>
                    </td>
                    <td colspan="3"><input type="checkbox"
                            {{ $arraudit[5] == 'resertifikasi' ? 'checked' : '' }}><label>Re-Sertifikasi</label>
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
                    <td colspan="5">
                        <?php
                        $user = new App\Models\User();
                        $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor)->first();
                        ?>
                        {{ $userid->name }}
                    </td>
                    <td colspan="3">{{ $stage1penunjukantimaudit->nama_inisial }}</td>
                    <td colspan="3">{{ $stage1penunjukantimaudit->jabatan }}</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>2</center>
                    </td>
                    <td colspan="5">
                        <?php
                        $user = new App\Models\User();
                        $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor2)->first();
                        ?>
                        {{ $userid->name ?? '' }}
                    </td>
                    <td colspan="3">{{ $stage1penunjukantimaudit->nama_inisial2 }}</td>
                    <td colspan="3">{{ $stage1penunjukantimaudit->jabatan2 }}</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <center>3</center>
                    </td>
                    <td colspan="5">
                        <?php
                        $user = new App\Models\User();
                        $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor3)->first();
                        ?>
                        {{ $userid->name ?? '' }}
                    </td>
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

<div class="card mt-3" style="page-break-before: always;">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td rowspan="2" colspan="3" style="background-color:#d9d9da;">
                        <center><b>Waktu</b></center>
                    </td>
                    <td colspan="6" style="background-color:#d9d9da;">
                        <center><b>Fungsi yang diaudit</b></center>
                    </td>
                    <td rowspan="2" colspan="3" style="background-color:#d9d9da;">
                        <center><b>Keterangan</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="background-color:#d9d9da;">
                        <center><b>Bagian</b></center>
                    </td>
                    <td colspan="2" style="background-color:#d9d9da;">
                        <center><b>Klausul</b></center>
                    </td>
                    <td colspan="2" style="background-color:#d9d9da;">
                        <center><b>Auditor</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="12">DDMMYY</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center">{{ $stage2rencanaaudit->waktu_rapat }}</td>
                    <td colspan="9">Rapat Pembukaan</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center">{{ $stage2rencanaaudit->waktu_verifikasi }}</td>
                    <td colspan="9">Verifikasi Tindakan Perbaikan (khusus Survailen)</td>
                </tr>
                @foreach ($stage2rencanaaudit_items as $item)
                    <tr>
                        <td colspan="3" style="text-align: center">{{ $item->waktu }}</td>
                        <td colspan="2" style="text-align: center">{{ $item->bagian }}</td>
                        <td colspan="2" style="text-align: center">{{ $item->klausul }}</td>
                        <td colspan="2" style="text-align: center">{{ $item->auditor }}</td>
                        <td colspan="3" style="text-align: center">{{ $item->keterangan }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3">HH-MM-SS</td>
                    <td colspan="9"><b>Rapat Tim Audit</b></td>
                </tr>
                <tr>
                    <td colspan="3">HH-MM-SS</td>
                    <td colspan="9"><b>Rapat Penutupan</b></td>
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
                    <td class="col-sm-5">{{ date('d-m-Y', strtotime($stage2rencanaaudit->tanggal_ttd)) }}<br>Dibuat
                        oleh<br><br><br><br>{{ $stage2rencanaaudit->nama_auditor }}<br>Auditor</td>
                    <td class="col-sm-3">Disetujui
                        oleh<br><br><br><br><br>{{ $stage2rencanaaudit->nama_manajer }}<br>Manajer Sertifikasi</td>
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
