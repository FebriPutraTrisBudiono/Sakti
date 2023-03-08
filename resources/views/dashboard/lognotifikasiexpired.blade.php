@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        {{ $title_bar }}
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <div class="table-responsive mt-3">
                            <table id="customTable" class="table table-bordered small" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>TANGGAL</th>
                                        <th>ID CLIENT</th>
                                        <th>NAMA CLIENT</th>
                                        <th>JENIS LAYANAN</th>
                                        <th>JENIS SERTIFIKAT</th>
                                        <th>TANGGAL KADALUARSA</th>
                                        <th>KETERANGAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lognotifikasiexpired as $row)
                                        @if (in_array('Log Notifikasi Expired.index', $roles))
                                            <?php
                                            $datenow = $row->created_at ?? '';
                                            $dateexpired = $row->penerbitansertifikat->tgl_kadaluarsasertifikat ?? '';
                                            ?>
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ date_format(date_create($datenow), 'd/m/Y') }}
                                                </td>
                                                <td>{{ $row->penerbitansertifikat->client->service->service_code }}-{{ $row->penerbitansertifikat->client->nomor_client }}
                                                </td>
                                                <td>{{ $row->penerbitansertifikat->client->user->name }}</td>
                                                <td>{{ $row->penerbitansertifikat->listpermohonan->proses_sertifikasi }}
                                                </td>
                                                <td>
                                                    @if ($row->penerbitansertifikat->listpermohonan->slug == 'sertifikasi_awal')
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            <span class="badge bg-dark">Sertifikasi Awal</span>
                                                        @else
                                                            <span class="badge bg-warning">Sertifikasi Awal</span>
                                                        @endif
                                                    @elseif ($row->penerbitansertifikat->listpermohonan->slug == 'surveilance1')
                                                        <span class="badge bg-warning">Surveilance I</span>
                                                    @elseif ($row->penerbitansertifikat->listpermohonan->slug == 'surveilance2')
                                                        <span class="badge bg-warning">Surveilance II</span>
                                                    @elseif ($row->penerbitansertifikat->listpermohonan->slug == 'resertifikasi')
                                                        <span class="badge bg-warning">Re Sertifikasi</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ date_format(date_create($dateexpired), 'd/m/Y') }}
                                                </td>
                                                <td>{{ $row->keterangan }}</td>
                                            </tr>
                                        @else
                                            @if (auth()->user()->id == $row->client->user->id)
                                                <?php
                                                $datenow = $row->created_at ?? '';
                                                $dateexpired = $row->penerbitansertifikat->tgl_kadaluarsasertifikat ?? '';
                                                ?>
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ date_format(date_create($datenow), 'd/m/Y') }}
                                                    </td>
                                                    <td>{{ $row->penerbitansertifikat->client->service->service_code }}-{{ $row->penerbitansertifikat->client->nomor_client }}
                                                    </td>
                                                    <td>{{ $row->penerbitansertifikat->client->user->name }}</td>
                                                    <td>{{ $row->penerbitansertifikat->listpermohonan->proses_sertifikasi }}
                                                    </td>
                                                    <td>
                                                        @if ($row->penerbitansertifikat->listpermohonan->slug == 'sertifikasi_awal')
                                                            @if (strtotime($datenow) >= strtotime($dateexpired))
                                                                <span class="badge bg-dark">Sertifikasi Awal</span>
                                                            @else
                                                                <span class="badge bg-warning">Sertifikasi Awal</span>
                                                            @endif
                                                        @elseif ($row->penerbitansertifikat->listpermohonan->slug == 'surveilance1')
                                                            <span class="badge bg-warning">Surveilance I</span>
                                                        @elseif ($row->penerbitansertifikat->listpermohonan->slug == 'surveilance2')
                                                            <span class="badge bg-warning">Surveilance II</span>
                                                        @elseif ($row->penerbitansertifikat->listpermohonan->slug == 'resertifikasi')
                                                            <span class="badge bg-warning">Re Sertifikasi</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ date_format(date_create($dateexpired), 'd/m/Y') }}
                                                    </td>
                                                    <td>{{ $row->keterangan }}</td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-start mb-5">
                            {{ $lognotifikasiexpired->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
