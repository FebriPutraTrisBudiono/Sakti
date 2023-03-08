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

        th,
        /* td {
            border: 2px solid green;
        } */

        tr.hide_bottom>td,
        td.hide_bottom {
            border-bottom-style: hidden;
        }

        tr.hide_all>td,
        td.hide_all {
            border-style: hidden;
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
    <p class="spacing">F-CER-06B Rev.02 Date:09.07.20</p>
</footer>

<!-- Penutup Buat Header Dan Footer -->

<center>
    <h3 class="mb-3">CHECKLIST AUDIT TAHAP 2</h3>
</center>


<p>Tanggal Audit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
    {{ date('d-m-Y', strtotime($stage1penunjukantimaudit->tanggal_bertugas)) }}</p>
<p>Auditi
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
    {{ $stage2checkaudit->auditi }}
</p>
<p>Auditor
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
    {{ $stage2checkaudit->auditor }}
</p>
<p>Standar
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
    <input type="checkbox" {{ $stage2checkaudit->standart_iso == 'ISO 9001:2015' ? 'checked' : '' }}><label>&nbsp;ISO
        9001:2015</label> &nbsp; &nbsp; &nbsp; <input type="checkbox"
        {{ $stage2checkaudit->standart_iso == 'ISO 14001:2015' ? 'checked' : '' }}><label>ISO
        14001:2015</label> &nbsp;&nbsp; &nbsp; <input type="checkbox"
        {{ $stage2checkaudit->standart_iso == 'ISO 21001:2018' ? 'checked' : '' }}><label>ISO
        21001:2018</label>&nbsp;&nbsp;&nbsp; <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="checkbox" {{ $stage2checkaudit->standart_iso == 'ISO 45001:2018' ? 'checked' : '' }}><label>ISO
        45001:2018</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    @if ($client->service->iso_code == 'ISO 9001:2015' ||
        $client->service->iso_code == 'ISO 14001:2015' ||
        $client->service->iso_code == 'ISO 21001:2018' ||
        $client->service->iso_code == 'ISO 45001:2018')
        <input type="checkbox">
        <label for="iso">....</label>
    @else
        <input type="checkbox" name="standart_iso" id="standart_iso" value="{{ $client->service->iso_code }}"
            {{ old('standart_iso', $stage2checkaudit->standart_iso ?? '') == $client->service->iso_code ? 'checked' : '' }}>
        <label for="standart_iso">{{ $client->service->iso_code }}</label>
    @endif
</p>


<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td rowspan="2" colspan="1" style="background-color:#f4f3f3;">
                        <center><b>NO</b></center>
                    </td>
                    <td rowspan="2" colspan="4" style="background-color:#f4f3f3;">
                        <center><b>DOKUMEN YANG DIUJI</b></center>
                    </td>
                    <td rowspan="2" colspan="3" style="background-color:#f4f3f3;">
                        <center><b>KLAUSUL</b></center>
                    </td>
                    <td colspan="6" style="background-color:#f4f3f3;">
                        <center><b>KETIDAKSESUAIAN</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="background-color:#f4f3f3;">
                        <center><b>MAJ</b></center>
                    </td>
                    <td colspan="2" style="background-color:#f4f3f3;">
                        <center><b>MIN</b></center>
                    </td>
                    <td colspan="2" style="background-color:#f4f3f3;">
                        <center><b>OBS</b></center>
                    </td>
                </tr>
                @for ($i = 0; $i < count($doc_diuji); $i++)
                    <?php $j = 1 + $i; ?>
                    <tr class="hide_bottom">
                        <td colspan="1" style="text-align: center">{{ $j }}</td>
                        <td colspan="4">{{ $doc_diuji[$i] }}</td>
                        <td colspan="3">{{ $klausul[$i] }}</td>
                        <td colspan="2">{{ $maj[$i] }}</td>
                        <td colspan="2">{{ $min[$i] }}</td>
                        <td colspan="2">{{ $obs[$i] }}</td>
                    </tr>
                @endfor
                <tr>
                    <td colspan="1"></td>
                    <td colspan="4"></td>
                    <td colspan="3"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
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
