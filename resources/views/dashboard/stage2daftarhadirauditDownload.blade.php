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
    <p class="spacing">F-CER-07 Rev.01 Date:02.05.19</p>
</footer>

<!-- Penutup Buat Header Dan Footer -->

<center>
    <h3>DAFTAR HADIR AUDIT</h3>
</center>


<p>RAPAT
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
    {{ $stage2daftarhadiraudit->rapat }}
</p>
<p>TANGGAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
    {{ date('d-m-Y', strtotime($stage2daftarhadiraudit->tanggal)) }}</p>
<p>TEMPAT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
    {{ $stage2daftarhadiraudit->tempat }}</p>

<div class="card">
    <div class="form-group">
        <table>
            <tbody>
                <tr>
                    <td rowspan="2" colspan="1" style="background-color:#d9d9da;">
                        <center><b>NO</b></center>
                    </td>
                    <td rowspan="2" colspan="3" style="background-color:#d9d9da;">
                        <center><b>Nama</b></center>
                    </td>
                    <td rowspan="2" colspan="3" style="background-color:#d9d9da;">
                        <center><b>Jabatan</b></center>
                    </td>
                    <td colspan="6" style="background-color:#d9d9da;">
                        <center><b>Tanda Tangan</b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="background-color:#d9d9da;">
                        <center><b>Opening</b></center>
                    </td>
                    <td colspan="3" style="background-color:#d9d9da;">
                        <center><b>Closing</b></center>
                    </td>
                </tr>
                @foreach ($daftarhadiritem as $item)
                    <tr>
                        <td colspan="1"style="text-align: center">{{ $loop->iteration }}</td>
                        <td colspan="3">{{ $item->nama }}</td>
                        <td colspan="3">{{ $item->jabatan }}</td>
                        <td colspan="3" style="text-align: center">{{ $item->opening }}</td>
                        <td colspan="3" style="text-align: center">{{ $item->closing }}</td>
                    </tr>
                @endforeach
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
