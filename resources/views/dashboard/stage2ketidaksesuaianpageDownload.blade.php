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
        width="200px">
</header>

<header2>
    <img src="{{ $setting->sec_logo ? $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}"
        width="150px">
</header2>

<footer>
    <p class="spacing">F-CER-09 Rev.01 Date:02.05.19</p>
</footer>

<!-- Penutup Buat Header Dan Footer -->

<center>
    <h3>LEMBAR KETIDAKSESUAIAN</h3>
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
                    <td class="col-sm-3" style="background-color:#d9d9da;"><b>Standart</b></td>
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
                    <td colspan="18" style="background-color:#d9d9da;">
                        <center><b>Audit</b></center>
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
                            {{ $arraudit[3] == 'surveilan' ? 'checked' : '' }}><label>Surveilan</label>
                    </td>
                    <td colspan="3"><input type="checkbox"
                            {{ $arraudit[4] == 'tindaklanjut' ? 'checked' : '' }}><label>Tindaklanjut</label>
                    </td>
                    <td colspan="3"><input type="checkbox"
                            {{ $arraudit[5] == 'resertifikasi' ? 'checked' : '' }}><label>Re-Sertifikasi</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="9" rowspan="1">
                        <center>Tanggal Pelaksanaan</center>
                    </td>
                    <td colspan="3" rowspan="1">
                        <center>{{ $stage1penunjukantimaudit->tanggal_bertugas }}</center>
                    </td>
                    <td colspan="3" rowspan="1">
                        <center>Sampai dengan</center>
                    </td>
                    <td colspan="3" rowspan="1">
                        <center>{{ $stage1penunjukantimaudit->sampai_dengan }}</center>
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
                    <td colspan="1" style="background-color:#d9d9da;">
                        <center><b>NO</b></center>
                    </td>
                    <td colspan="2" style="background-color:#d9d9da;">
                        <center><b>KATEGORI & REFERENSI KLAUSUL</b></center>
                    </td>
                    <td colspan="3" style="background-color:#d9d9da;">
                        <center><b>KETIDAKSESUAIAN</b></center>
                    </td>
                    <td colspan="3" style="background-color:#d9d9da;">
                        <center><b>PERBAIKAN</b></center>
                    </td>
                    <td colspan="2" style="background-color:#d9d9da;">
                        <center><b>HASIL VERIFIKASI</b></center>
                    </td>
                    <td colspan="2" style="background-color:#d9d9da;">
                        <center><b>KETERANGAN</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="vertical-align: top">1.</td>
                    <td colspan="2" style="vertical-align: top">{{ $stage2ketidaksesuaianpage->kategori }}</td>
                    <td colspan="3" style="vertical-align: top">{{ $stage2ketidaksesuaianpage->ketidaksesuaian }}
                    </td>
                    <td colspan="3">
                        <b>Analisa Penyebab:</b>
                        <br>
                        {{ $stage2ketidaksesuaianpage->analisa }}
                        <br>
                        <b>Tindakan Koreksi:</b>
                        <br>
                        {{ $stage2ketidaksesuaianpage->koreksi }}
                        <br>
                        <b>Korektif:</b>
                        <br>
                        {{ $stage2ketidaksesuaianpage->korektif }}
                    </td>
                    <td colspan="2" style="vertical-align: top">{{ $stage2ketidaksesuaianpage->hasil_verifikasi }}
                    </td>
                    <td colspan="2" style="vertical-align: top">{{ $stage2ketidaksesuaianpage->keterangan }}</td>
                </tr>
                <tr>
                    <td colspan="1" style="vertical-align: top">2.</td>
                    <td colspan="2" style="vertical-align: top">{{ $stage2ketidaksesuaianpage->kategori2 }}</td>
                    <td colspan="3" style="vertical-align: top">{{ $stage2ketidaksesuaianpage->ketidaksesuaian2 }}
                    </td>
                    <td colspan="3">
                        <b>Analisa Penyebab:</b>
                        <br>
                        {{ $stage2ketidaksesuaianpage->analisa2 }}
                        <br>
                        <b>Tindakan Koreksi:</b>
                        <br>
                        {{ $stage2ketidaksesuaianpage->koreksi2 }}
                        <br>
                        <b>Korektif:</b>
                        <br>
                        {{ $stage2ketidaksesuaianpage->korektif2 }}
                    </td>
                    <td colspan="2" style="vertical-align: top">{{ $stage2ketidaksesuaianpage->hasil_verifikasi2 }}
                    </td>
                    <td colspan="2" style="vertical-align: top">{{ $stage2ketidaksesuaianpage->keterangan2 }}</td>
                </tr>
                <tr>
                    <td colspan="1" style="vertical-align: top">3.</td>
                    <td colspan="2" style="vertical-align: top">{{ $stage2ketidaksesuaianpage->kategori3 }}</td>
                    <td colspan="3" style="vertical-align: top">{{ $stage2ketidaksesuaianpage->ketidaksesuaian3 }}
                    </td>
                    <td colspan="3">
                        <b>Analisa Penyebab:</b>
                        <br>
                        {{ $stage2ketidaksesuaianpage->analisa3 }}
                        <br>
                        <b>Tindakan Koreksi:</b>
                        <br>
                        {{ $stage2ketidaksesuaianpage->koreksi3 }}
                        <br>
                        <b>Korektif:</b>
                        <br>
                        {{ $stage2ketidaksesuaianpage->korektif3 }}
                    </td>
                    <td colspan="2" style="vertical-align: top">
                        {{ $stage2ketidaksesuaianpage->hasil_verifikasi3 }}
                    </td>
                    <td colspan="2" style="vertical-align: top">{{ $stage2ketidaksesuaianpage->keterangan3 }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>

<div class="col mb-2">
    <label>{{ $stage2ketidaksesuaianpage->tempat_ttd }},
        {{ date('d-m-Y', strtotime($stage2ketidaksesuaianpage->tgl_ttd)) }}</label>

</div>
<div class="pp mb-5">


    {{-- <hr style="width:100px; border-top:5px dotted; color:black; background: white; display:block">
                </hr> --}}
</div>

<div class="dd">
    <label>({{ $stage2ketidaksesuaianpage->nama_ttd }})</label>
    <br>
    <label>Lead Auditor</label>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="<?= $_SERVER['DOCUMENT_ROOT'] . '/assets/bootstrap/js/bootstrap.min.js' ?>"></script>
</body>

</html>
