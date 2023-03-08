<!DOCTYPE html>
<html>

<head>
    {{-- <title>Pembayaran {{ $data->memopenerbitansertifikasi == 1 ? 'Menunggu' : 'Ditolak' }}</title> --}}
</head>

<body>
    <p>Yth. <b>{{ $data['client']->user->name }}</b>, Tahapan Sertifikasi <strong>{{ $data['log'] }}</strong> status
        anda
        <strong>{{ $data['status'] == 1 ? 'Sedang Menunggu' : ($data['status'] == 2 ? 'Sudah Diterima' : ($data['status'] == 3 ? 'Sedang Dipending' : '')) }}</strong>.
    </p>

    @if ($data['status'] == 3)
        @if ($data['dipending_keterangan'] != '')
            Keterangan dipending :
            <strong>{{ $data['dipending_keterangan'] ?? $data['dipending_keterangandata'] }}</strong>
        @endif
    @endif

    @if ($data['status'] == 2)
        @if ($data['keterangan'] == '')
            @if ($data['log'] == 'Rencana Siklus Sertifikasi' ||
                $data['log'] == 'Stage I Kajian Tim Audit' ||
                $data['log'] == 'Stage II Rencana Audit' ||
                $data['log'] == 'Stage II CheckList Audit' ||
                $data['log'] == 'Stage II Daftar Hadir Audit' ||
                $data['log'] == 'Stage II Lembar Ketidaksesuaian' ||
                $data['log'] == 'Review Keputusan Sertifikasi')
                <strong>Selanjutnya Admin akan meng-audit lebih lanjut. Silahkan tunggu email lebih lanjut.</strong>
            @endif
        @elseif ($data['keterangan'] != '')
            <strong>{{ $data['keterangan'] }}</strong>
        @endif
    @endif

    <p>Untuk melihat riwayat tahapan sertifikasi Anda dapat melakukan login ke aplikasi SAKTI Indonesia dengan
        Username dan password yang
        telah Anda masukkan pada proses pendaftaran. <strong>Untuk Lebih Detail Silahkan Melihat Tahapan
            Sertifikasi</strong></p>
    <p>Demikian informasi dari kami, jika ada yang kurang jelas silahkan menghubungi kami kembali.</p>
</body>

</html>
