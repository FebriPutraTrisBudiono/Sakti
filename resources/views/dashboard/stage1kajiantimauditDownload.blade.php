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
            border: none
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
    <p class="spacing">F-CER-39 Rev.01 Date:02.05.19</p>
</footer>

<!-- Penutup Buat Header Dan Footer -->

<center>
    <h3>KAJIAN TIM AUDIT</h3>
</center>

<div class="card mt-5">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td class="col-sm-5"><b>KLIEN</b></td>
                    <td colspan="9">: {{ $permohonansertifikasi->nama_pimpinan }}</td>
                </tr>
                <tr>
                    <td class="col-sm-5"><b>LINGKUP SERTIFIKASI</b></td>
                    <td colspan="9">: {{ $permohonansertifikasi->ruang_lingkup_perusahaan }}</td>
                </tr>
                <tr>
                    <td class="col-sm-5"><b>STANDAR</b></td>
                    <td colspan="9">: {{ $rencanaclient->standart }}</td>
                </tr>
                <tr>
                    <td class="col-sm-5"><b>KOMPETENSI</b></td>
                    <td colspan="9">: {{ $kajianclient->hasil2_answer }}</td>
                </tr>
                <tr>
                    <td rowspan="4" class="col-sm-5"><b>USULAN TIM AUDIT</b></td>
                    <td colspan="3">
                        <center><b>LEAD AUDITOR</b></center>
                    </td>
                    <td colspan="3">
                        <center><b>AUDITOR</b></center>
                    </td>
                    <td colspan="3">
                        <center><b>TENAGA AHLI</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center">{{ $hasil3_lead1['name'] }}</td>
                    <td colspan="3" style="text-align: center">{{ $hasil3_auditor1['name'] }}</td>
                    <td colspan="3" style="text-align: center">{{ $hasil3_tenaga1['name'] }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center">{{ $hasil3_lead2['name'] ?? '-' }}</td>
                    <td colspan="3" style="text-align: center">{{ $hasil3_auditor2['name'] ?? '-' }}</td>
                    <td colspan="3" style="text-align: center">{{ $hasil3_tenaga2['name'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center">{{ $hasil3_lead3['name'] ?? '-' }}</td>
                    <td colspan="3" style="text-align: center">{{ $hasil3_auditor3['name'] ?? '-' }}</td>
                    <td colspan="3" style="text-align: center">{{ $hasil3_tenaga3['name'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="col-sm-5"><b>RENCANA PELAKSANAAN</b></td>
                    <td colspan="9">: {{ $stage1kajiantimaudit->rencana_pelaksanaan }}</td>
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
                    <td colspan="12"><b>KAJIAN</b></td>
                </tr>
                <tr>
                    <td colspan="10">
                        <center><b>KRITERIA</b></center>
                    </td>
                    <td colspan="1"><b>YA</b></td>
                    <td colspan="1"><b>TIDAK</b></td>
                </tr>
                <tr>
                    <td colspan="10">Apakah tim audit yang diusulkan memiliki kompetensi terhadap permohonan yang
                        diajukan</td>
                    <td colspan="1" style="text-align: center">
                        @if ($stage1kajiantimaudit->kajian1_question == 1)
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td colspan="1" style="text-align: center">
                        @if ($stage1kajiantimaudit->kajian1_question == 0)
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="10">Apakah tim audit membutuhkan tenaga ahli dalam pelaksanaan audit</td>
                    <td colspan="1" style="text-align: center">
                        @if ($stage1kajiantimaudit->kajian2_question == 1)
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td colspan="1" style="text-align: center">
                        @if ($stage1kajiantimaudit->kajian2_question == 0)
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="10">Apakah tim audit yang ditugaskan memiliki hubungan dengan klien yang akan diaudit
                    </td>
                    <td colspan="1" style="text-align: center">
                        @if ($stage1kajiantimaudit->kajian3_question == 1)
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td colspan="1" style="text-align: center">
                        @if ($stage1kajiantimaudit->kajian3_question == 0)
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="10">Apakah tim audit pernah melakukan internal audit kepada klien dalam 2 tahun
                        terakhir</td>
                    <td colspan="1" style="text-align: center">
                        @if ($stage1kajiantimaudit->kajian4_question == 1)
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
                    </td>
                    <td colspan="1" style="text-align: center">
                        @if ($stage1kajiantimaudit->kajian4_question == 0)
                            <img src="{{ $_SERVER['DOCUMENT_ROOT'] . '/assets/img/check.png' }}" width="20px">
                        @endif
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
                    <td colspan="12"><b>USULAN TIM AUDIT</b></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center"><b>LEAD AUDITOR</b></td>
                    <td colspan="6" style="text-align: center"><b>AUDITOR</b></td>
                    <td colspan="3" style="text-align: center"><b>TENAGA AHLI</b></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center">{{ $hasil3_lead1['name'] ?? '-' }}</td>
                    <td colspan="6" style="text-align: center">{{ $hasil3_auditor1['name'] ?? '-' }}</td>
                    <td colspan="3" style="text-align: center">{{ $hasil3_tenaga1['name'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center">{{ $hasil3_lead2['name'] ?? '-' }}</td>
                    <td colspan="6" style="text-align: center">{{ $hasil3_auditor2['name'] ?? '-' }}</td>
                    <td colspan="3" style="text-align: center">{{ $hasil3_tenaga2['name'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center">{{ $hasil3_lead3['name'] ?? '-' }}</td>
                    <td colspan="6" style="text-align: center">{{ $hasil3_auditor3['name'] ?? '-' }}</td>
                    <td colspan="3" style="text-align: center">{{ $hasil3_tenaga3['name'] ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br><br><br><br><br>

<div class="col mb-2">
    <label>{{ date('d-m-Y', strtotime($stage1kajiantimaudit->tanggal_ttd)) }}</label>

</div>
<div class="pp mb-5">
    <label>Dikaji Oleh</label>

    {{-- <hr style="width:100px; border-top:5px dotted; color:black; background: white; display:block">
                </hr> --}}
</div>

<br>
<br>

<div class="dd">
    <label>{{ $stage1kajiantimaudit->nama_manager }}</label>
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
