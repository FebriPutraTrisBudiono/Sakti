<!DOCTYPE html>
<html>

<head>
    {{-- <title>Pembayaran {{ $data->memopenerbitansertifikasi == 1 ? 'Menunggu' : 'Ditolak' }}</title> --}}
</head>

<body>
    {{-- <p>Sertifikat <strong>({{ $listpermohonan }})</strong> atas nama <strong>{{ $client }}</strong>
        {{ $jumlah_hari == 0 ? 'Expired' : 'Akan Expired pada ' . $jumlah_hari . ' hari mendatang' }}
    </p> --}}

    Halo bapak/ibu <strong>{{ $client }}</strong> tanggal <strong>{{ $tgl_expired }}</strong> adalah
    batas
    akhir mengirimkan laporan rutin.

    Pastikan bapak/ibu <strong>{{ $client }}</strong> selalu membuat laporan rutin 3 bulan tersebut, melalui
    format yang terlampir pada
    email berikut.

    Jika ada kendala atau pertanyaan segera hubungi kami melalui kontak admin.

    Terimakasih.
</body>

</html>
