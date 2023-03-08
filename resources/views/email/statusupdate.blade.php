<!DOCTYPE html>
<html>

<head>
    {{-- <title>Pembayaran {{ $data->memopenerbitansertifikasi == 1 ? 'Menunggu' : 'Ditolak' }}</title> --}}
</head>

<body>
    {{-- admin --}}
    @if ($data['user']->level_id == 1)
        <p>Yth. <b>{{ $data['user']->name }}</b>, Tahapan Sertifikasi
            <strong>{{ $data['permohonan']->proses_sertifikasi }} - {{ $data['log'] }}</strong> dari
            <strong>{{ $data['client']->user->name }}</strong> dengan nomor pendaftaran
            <strong>{{ $data['client']->user->number }}</strong>
            status
            <strong>{{ $data['status'] == 1 ? 'Sedang Menunggu' : ($data['status'] == 2 ? 'Sudah Diterima' : ($data['status'] == 3 ? 'Sedang Dipending' : '')) }}</strong>.
        </p>

        @if ($data['status'] == 3)
            @if ($data['dipending_keterangan'] != '')
                Keterangan dipending :
                <strong>{{ $data['dipending_keterangan'] ?? $data['dipending_keterangandata'] }}</strong>
            @endif
        @endif

        <p>Untuk melihat riwayat tahapan sertifikasi Client anda dapat melakukan login ke aplikasi SAKTI Indonesia
            dengan
            Username dan password Administrator. <strong>Untuk Lebih Detail Silahkan Melihat Tahapan
                Sertifikasi</strong>
        </p>
    @endif

    {{-- Auditor --}}
    @if ($data['user']->level_id == 3)
        <p>Yth. <b>{{ $data['user']->name }}</b>, Tahapan Sertifikasi <strong>{{ $data['log'] }}</strong> dari
            <strong>{{ $data['client']->user->name }}</strong> dengan nomor pendaftaran
            <strong>{{ $data['client']->user->number }}</strong>
            status
            <strong>{{ $data['status'] == 1 ? 'Sedang Menunggu' : ($data['status'] == 2 ? 'Sudah Diterima' : ($data['status'] == 3 ? 'Sedang Dipending' : '')) }}</strong>.
        </p>

        @if ($data['status'] == 3)
            @if ($data['dipending_keterangan'] != '')
                Keterangan dipending :
                <strong>{{ $data['dipending_keterangan'] ?? $data['dipending_keterangandata'] }}</strong>
            @endif
        @endif

        <p>Silahkan lakukan proses audit.</p>
        <p>Untuk melihat riwayat tahapan sertifikasi Client anda dapat melakukan login ke aplikasi SAKTI Indonesia
            dengan
            Username dan password Auditor anda. <strong>Untuk Lebih Detail Silahkan Melihat Tahapan
                Sertifikasi</strong>
        </p>
    @endif
</body>

</html>
