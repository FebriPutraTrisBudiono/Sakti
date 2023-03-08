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
    <p class="spacing">F-CER-10 Rev.02 Date:02.05.19</p>
</footer>

<!-- Penutup Buat Header Dan Footer -->

<center>
    <h3 class="mb-3">SURVAI KEPUASAN PELANGGAN</h3>
</center>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td class="col-sm-3"><b>NAMA KLIEN</b></td>
                    <td colspan="12">: {{ $permohonansertifikasi->nama_pimpinan }}</td>
                </tr>
                <tr>
                    <td class="col-sm-3"><b>ALAMAT</b></td>
                    <td colspan="12">: {{ $permohonansertifikasi->alamat }}</td>
                </tr>
                <tr>
                    <td class="col-sm-3"><b>TANGGAL AUDIT</b></td>
                    <td colspan="12">: {{ $stage1penunjukantimaudit->tanggal_bertugas }}</td>
                </tr>
                <tr>
                    <td class="col-sm-3"><b>STANDAR</b></td>
                    <td colspan="6"><input type="checkbox"
                            {{ $stage2checkaudit->standart_iso == 'ISO 9001:2015' ? 'checked' : '' }}> &nbsp; <label>ISO
                            9001</label></td>
                    <td colspan="6"><input type="checkbox"
                            {{ $stage2checkaudit->standart_iso == 'ISO 14001:2015' ? 'checked' : '' }}> &nbsp;
                        <label>ISO
                            14001</label>
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-3"></td>
                    <td colspan="6"><input type="checkbox"
                            {{ $stage2checkaudit->standart_iso == 'ISO 45001:2018' ? 'checked' : '' }}> &nbsp;
                        <label>ISO
                            45001</label>
                    </td>
                    <td colspan="6">
                        @if ($stage2checkaudit->standart_iso == 'ISO 21001:2018')
                            <input type="checkbox"
                                {{ $stage2checkaudit->standart_iso == 'ISO 21001:2018' ? 'checked' : '' }}> &nbsp;
                            <label>ISO
                                21001</label>
                        @elseif($stage2checkaudit->standart_iso == 'ISO 9001:2015' ||
                            $stage2checkaudit->standart_iso == 'ISO 14001:2015' ||
                            $stage2checkaudit->standart_iso == 'ISO 45001:2018')
                            <input type="checkbox"> &nbsp; <label>……..</label>
                        @else
                            <input type="checkbox" name="standart_iso" id="standart_iso"
                                value="{{ $client->service->iso_code }}"
                                {{ old('standart_iso', $stage2checkaudit->standart_iso ?? '') == $client->service->iso_code ? 'checked' : '' }}>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-3"><b>TIPE AUDIT</b></td>
                    <td colspan="6"><input type="checkbox"
                            {{ $stage2surveikepuasancustomer->tipe_audit == 'stage2' ? 'checked' : '' }}> &nbsp;
                        <label>STAGE
                            II</label>
                    </td>
                    <td colspan="6"><input type="checkbox"
                            {{ $stage2surveikepuasancustomer->tipe_audit == 'perluasan_lingkup' ? 'checked' : '' }}>
                        &nbsp;
                        <label>PERLUASAN
                            LINGKUP</label>
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-3"></td>
                    <td colspan="6"><input type="checkbox"
                            {{ $stage2surveikepuasancustomer->tipe_audit == 'survailen' ? 'checked' : '' }}> &nbsp;
                        <label>SURVAILEN</label>
                    </td>
                    <td colspan="6"><input type="checkbox"
                            {{ $stage2surveikepuasancustomer->tipe_audit == 'shortnotice' ? 'checked' : '' }}> &nbsp;
                        <label>SHORT NOTICE AUDIT</label>
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-3"></td>
                    <td colspan="6"><input type="checkbox"
                            {{ $stage2surveikepuasancustomer->tipe_audit == 'resertifikasi' ? 'checked' : '' }}> &nbsp;
                        <label>RESERTIFIKASI</label>
                    </td>
                    <td colspan="6"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br>

<p>
    Mohon gunakan skala dibawah ini, terkait dengan pelayanan yang PT SAKTI Indonesia Sertifikasi berikan:
    1 = Buruk Sekali &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2
    = Buruk &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3 = Cukup
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 4 = Baik
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 5 = Baik Sekali
    <br>
    Nama Auditor:
    <br>
    1. {{ $auditor[0] }}
    <br>
    2. {{ $auditor[1] }}
    <br>
    3. {{ $auditor[2] }}
    <br>
    4. {{ $auditor[3] }}
    <br>
    Mohon Masukan terkait dengan Auditor 1, Auditor 2, Auditor 3 or Auditor 4:
</p>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td colspan="7"></td>
                    <td colspan="2" style="background-color:#d9d9da;"><b>Auditor 1</b></td>
                    <td colspan="2" style="background-color:#d9d9da;"><b>Auditor 2</b></td>
                    <td colspan="2" style="background-color:#d9d9da;"><b>Auditor 3</b></td>
                    <td colspan="2" style="background-color:#d9d9da;"><b>Auditor 4</b></td>
                </tr>
                <tr>
                    <td colspan="7">Kompetensi</td>
                    <td colspan="2" style="text-align: center">{{ $indikator1[0] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator1[1] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator1[2] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator1[3] }}</td>
                </tr>
                <tr>
                    <td colspan="7">Pengetahuan tentang bisnis sektor klien yang diaudit</td>
                    <td colspan="2" style="text-align: center">{{ $indikator2[0] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator2[1] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator2[2] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator2[3] }}</td>
                </tr>
                <tr>
                    <td colspan="7">Program audit</td>
                    <td colspan="2" style="text-align: center">{{ $indikator3[0] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator3[1] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator3[2] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator3[3] }}</td>
                </tr>
                <tr>
                    <td colspan="7">Kesesuaian pelaksanan program audit</td>
                    <td colspan="2" style="text-align: center">{{ $indikator4[0] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator4[1] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator4[2] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator4[3] }}</td>
                </tr>
                <tr>
                    <td colspan="7">Respon terhadap pertanyaan</td>
                    <td colspan="2" style="text-align: center">{{ $indikator5[0] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator5[1] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator5[2] }}</td>
                    <td colspan="2" style="text-align: center">{{ $indikator5[3] }}</td>
                </tr>
                <tr>
                    <td colspan="7">Penilaian secara keseluruhan untuk auditor yang ditugaskan</td>
                    <td colspan="2"style="text-align: center"></td>
                    <td colspan="2"style="text-align: center"></td>
                    <td colspan="2"style="text-align: center"></td>
                    <td colspan="2"style="text-align: center"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br><br><br>
<p>
    Mohon beri keterangan apabila penilaian auditor <b>dibawah skala 3:</b>
    <br>
<div class="card mb-4">
    @if ($stage2surveikepuasancustomer->keterangan)
        <b style="text-decoration: underline">{{ $stage2surveikepuasancustomer->keterangan }}</b>
    @else
        <b>______________________________________________________________________________________</b> <br>
        <b>______________________________________________________________________________________</b> <br>
        <b>______________________________________________________________________________________</b>
    @endif
</div>
</p>

<div class="col mb-2">
    <label>{{ $stage2surveikepuasancustomer->tempat_ttd }},
        {{ date('d-m-Y', strtotime($stage2surveikepuasancustomer->tgl_ttd)) }}</label>

</div>

<br>
<br>
<br>
<br>

<div class="dd">
    <label>{{ $stage2surveikepuasancustomer->nama_ttd }}</label>
</div>

<div class="dd">
    <label>{{ $stage2surveikepuasancustomer->nama_organisasi }}</label>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="<?= $_SERVER['DOCUMENT_ROOT'] . '/assets/bootstrap/js/bootstrap.min.js' ?>"></script>
</body>

</html>
