<!DOCTYPE html>
<html>

<head>
    <title>Pendaftaran Berhasil</title>
</head>

<body>

    <p>Yth. <b>{{ $data['name'] }}</b>, registrasi berhasil.</p>
    <p>Pendaftaran telah berhasil dilakukan, namun saat ini akun anda belum aktif.</p>
    <p>Untuk aktivasi akun Anda, silahkan lakukan pembayaran senilai Rp @currency($data['fee']->fee) ke salah satu rekening bank di
        bawah ini:</p>
    <ul>
        @foreach ($data['banks'] as $item)
            <li>{{ $item->bank_name }} {{ $item->number }} A/n. {{ $item->name }}</li>
        @endforeach
    </ul>
    <p>Jika telah melakukan pembayaran, segera lakukan konfirmasi pembayaran melalui link berikut ini:</p>
    <em>
        <a
            href="{{ env('APP_URL') }}/payment/confirmation/{{ $data['id'] }}">{{ env('APP_URL') }}/payment/confirmation/{{ $data['id'] }}</a>
    </em>
    <p>Demikian informasi dari kami, jika ada yang kurang jelas silahkan menghubungi kami kembali.</p>
    <p>Terima Kasih atas kepercayaan Anda telah menggunakan jasa dan layanan Sakti Indonesia</p>
</body>

</html>
