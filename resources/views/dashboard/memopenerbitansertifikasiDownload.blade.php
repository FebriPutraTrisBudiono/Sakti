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
            border: 1px none;
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
    <p class="spacing">F-CER-12 Rev.03 Date:15.10.21</p>
</footer>

<!-- Penutup Buat Header Dan Footer -->

<table>
    <tbody>
        <tr>
            <td class="col-sm-3">Tanggal</td>
            <td colspan="11">: {{ $memopenerbitansertifikasi->tanggal }}</td>
        </tr>
        <tr>
            <td class="col-sm-3">No. Ref</td>
            <td colspan="11">: {{ $memopenerbitansertifikasi->no_ref }}</td>
        </tr>
        <tr>
            <td class="col-sm-3">Dari</td>
            <td colspan="11">: {{ $memopenerbitansertifikasi->dari }}</td>
        </tr>
        <tr>
            <td class="col-sm-3">Perihal</td>
            <td colspan="11">: Penerbitan <b>Sertifikasi</b></td>
        </tr>
    </tbody>
</table>

<div class="mt-3" style="border-bottom: 1pt solid black"></div>

<label class="mt-4">Kepada Yth,</label><br>
<label class="mt-1">Direktur Operasional</label><br>
<label class="mt-3" style="text-align: justify">Sehubungan dengan telah diterbitkannya <b>Sertifikat
        Baru/Perubahan/Pembaharuan/Pembekuan/ Pengaktivan
        Kembali/Pencabutan</b>, Dengan ini kami beritahukan untuk segera meng-update data pada web PT. SAKTI Indonesia
    Sertifikasi, berikut adalah data sertifikat yang telah diterbitkan:</label><br>

<table>
    <tbody>
        <tr>
            <td class="col-sm-1" style="text-align: center"><b>-</b></td>
            <td class="col-sm-4"><b>No. Sertifikat</b></td>
            <td colspan="11">: {{ $memopenerbitansertifikasi->no_sertifikat }}</td>
        </tr>
        <tr>
            <td class="col-sm-1" style="text-align: center"><b>-</b></td>
            <td class="col-sm-4"><b>Tgl. Sertifikat</b></td>
            <td colspan="11">: {{ $memopenerbitansertifikasi->tgl_sertifikat }}</td>
        </tr>
        <tr>
            <td class="col-sm-1" style="text-align: center"><b>-</b></td>
            <td class="col-sm-4"><b>Tgl. Surveilan selanjutnya</b></td>
            <td colspan="11">: {{ $memopenerbitansertifikasi->tgl_survailen }}</td>
        </tr>
        <tr>
            <td class="col-sm-1" style="text-align: center"><b>-</b></td>
            <td class="col-sm-4"><b>Renewal</b></td>
            <td colspan="11">: {{ $memopenerbitansertifikasi->renewal }}</td>
        </tr>
        <tr>
            <td class="col-sm-1" style="text-align: center"><b>-</b></td>
            <td class="col-sm-4"><b>Nama Perusahaan</b></td>
            <td colspan="11">: {{ $permohonansertifikasi->nama_perusahaan }}</td>
        </tr>
        <tr>
            <td class="col-sm-1" style="text-align: center"><b>-</b></td>
            <td class="col-sm-4"><b>Alamat</b></td>
            <td colspan="11">: {{ $permohonansertifikasi->alamat }}</td>
        </tr>
        <tr>
            <td class="col-sm-1" style="text-align: center"><b>-</b></td>
            <td class="col-sm-4"><b>Scope</b></td>
            <td colspan="11">: {{ $permohonansertifikasi->ruang_lingkup_perusahaan }}</td>
        </tr>
        <tr>
            <td class="col-sm-1" style="text-align: center"><b>-</b></td>
            <td class="col-sm-4"><b>Email</b></td>
            <td colspan="11">: {{ $client->user->email }}</td>
        </tr>
    </tbody>
</table>

<label class="mt-3" style="text-align: justify">Demikian internal memo ini kami sampaikan untuk
    ditindaklanjuti. Terimakasih atas perhatian dan kerjasamanya.</label><br>


<p class="mt-4">Hormat Kami,</p>


<label class="mt-5" style="border-bottom: 1pt solid black">{{ $memopenerbitansertifikasi->nama_ttd }}</label><br>
<label for="">Manager Sertifikasi</label>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="<?= $_SERVER['DOCUMENT_ROOT'] . '/assets/bootstrap/js/bootstrap.min.js' ?>"></script>
</body>

</html>
