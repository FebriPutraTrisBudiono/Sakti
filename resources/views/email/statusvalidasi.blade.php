<!DOCTYPE html>
<html>

<head>
    {{-- <title>Pembayaran {{ $data->memopenerbitansertifikasi == 1 ? 'Menunggu' : 'Ditolak' }}</title> --}}
</head>

<body>
    {{-- Admin --}}
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

    {{-- Client --}}
    @if ($data['user']->level_id == 2)
        <p>Yth. <b>{{ $data['client']->user->name }}</b>, Tahapan Sertifikasi
            <strong>{{ $data['permohonan']->proses_sertifikasi }} - {{ $data['log'] }}</strong>
            status
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
                <strong>Silahkan lakukan pengisian form-form pada tahap selanjutnya.
                    Jika belum dapat di akses, silahkan tunggu pemberitahuan email selanjutnya.</strong>
            @elseif ($data['keterangan'] != '')
                <strong>{{ $data['keterangan'] }}</strong>
            @endif
        @endif

        <p>Untuk melihat riwayat tahapan sertifikasi Anda dapat melakukan login ke aplikasi SAKTI Indonesia dengan
            Username dan password yang
            telah Anda masukkan pada proses pendaftaran. <strong>Untuk Lebih Detail Silahkan Melihat Tahapan
                Sertifikasi</strong></p>
        <p>Demikian informasi dari kami, jika ada yang kurang jelas silahkan menghubungi kami kembali.</p>
    @endif

    {{-- Auditor --}}
    @if ($data['user']->level_id == 3)
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

        @if ($data['status'] == 2)
            @if ($data['log'] == 'Stage I Penunjukan Tim Audit')
                Anda telah ditunjuk sebagai Auditor pada client <strong> {{ $data['client']->user->name }}</strong>
                dengan
                nomor pendaftaran
                <strong>{{ $data['client']->user->number }}</strong>
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
