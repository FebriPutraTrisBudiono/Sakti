@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="table-responsive">
                    <table id="customTable" class="table table-bordered small" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID Client</th>
                                {{-- <th>ID Permohonan</th> --}}
                                <th>Nama Client</th>
                                <th>Jenis Layanan</th>
                                <th>Status Sertifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($clients as $row)
                                @if ($row->status_sertifikasi != 0)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        @if ($row->status_sertifikasi > 0)
                                            <a href="/dashboard/kajianclients/{{ $row->id }}/edit">
                                                {{ $row->user->number }}
                                            </a>
                                        @else
                                            {{ $row->user->number }}
                                        @endif
                                    </td>
                                    {{-- <td>{{ $row->id }}</td> --}}
                                    <td>{{ $row->user->name }}</td>
                                    <td>
                                        <?php
                                            $service_id = $row->user->service_id;
                                            foreach ($services as $k) {
                                                if ($service_id == $k['id']) {
                                                    echo $k['name'];
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['status_sertifikasi'] == 0) {
                                            echo 'Belum Sertifikasi';
                                        } elseif ($row['status_sertifikasi'] == 1) {
                                            echo "Permohonan telah dikirim";
                                            echo "<a href='/dashboard/clients/$row->id' target='_blank'><br><em>Lihat Permohonan</em></a>";
                                        } elseif ($row['status_sertifikasi'] == 2) {
                                            echo 'Permohonan disetujui';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                @endif   
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-5">
                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
