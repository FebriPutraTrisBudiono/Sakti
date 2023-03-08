<!DOCTYPE html>
<html>

<head>
    <title>Pembayaran {{ $data->status == 2 ? 'Diterima' : 'Ditolak' }}</title>
</head>

<body>
    <p>Yth. <b>{{ $data['user']->name }}</b>, pembayaran Anda telah
        <strong>{{ $data->status == 2 ? 'berhasil dikonfirmasi ' : 'ditolak' }}</strong> oleh admin.
    </p>
    @if ($data->status == 2)
        <p>selanjutnya Anda telah dapat melakukan login ke aplikasi SAKTI Indonesia dengan Username dan password yang
            telah Anda masukkan pada proses pendaftaran.</p>
        <p><b>Berikut adalah detail akun anda :</b></p>
        <b>Nama : </b>{{ $data['user']->name }} <br>
        <b>Username : </b>{{ $data['user']->username }} <br>
        <b>Email : </b>{{ $data['user']->email }} <br>
        <b>No.Telepon : </b> {{ $data['user']->telp }} <br>
        <b>Password : </b> Masukkan password yang telah didaftarkan, Jika anda lupa silahkan menggunakan fitur lupa
        password pada menu Login. <br>


        <p>Demikian informasi dari kami, jika ada yang kurang jelas silahkan menghubungi kami kembali.</p>
    @endif
    <p>Terima Kasih atas kepercayaan Anda telah menggunakan jasa dan layanan Sakti Indonesia</p>
</body>

</html>
