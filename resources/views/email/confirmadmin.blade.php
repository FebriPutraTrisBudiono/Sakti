<!DOCTYPE html>
<html>

<head>
    <title>Konfirmasi Pembayaran</title>
</head>

<body>

    <p>Yth. <b>{{ $data['admin']->name }}</b>, <strong>{{ $data['user']->name }}</strong> telah melakukan pembayaran
        sejumlah Rp @currency($data['trx_amount']) ke
        {{ $data['bank']->bank_name }} {{ $data['bank']->number }} pada
        {{ date('d/m/Y H:i', strtotime($data['trx_date'])) }}.</p>
    <p>Terima kasih</p>
</body>

</html>
