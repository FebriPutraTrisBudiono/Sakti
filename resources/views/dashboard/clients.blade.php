@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                @if (auth()->user()->level_id == 2)
                    <a href="javascript:void(0)" class="addPermohonan" data-bs-toggle="modal"
                        data-bs-target="#permohonanModal"><i class='fas fa-plus-circle fa-lg'></i>
                    </a>
                @endif
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                @if (in_array('clients.index', $roles))
                    <form action="/dashboard/clients" method="get" class="bg-light p-3 rounded">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="clientid" class="small">ID Client</label>
                                    <input type="text" name="clientid" id="clientid"
                                        class="form-control form-control-sm mt-1" value="{{ request('clientid') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="user" class="small">Nama Client</label>
                                    <select name="user" id="user" class="form-control form-control-sm mt-1">
                                        <option value="">:: Semua ::</option>
                                        @foreach ($users as $item)
                                            <option value="{{ $item->id }}"
                                                {{ request('user') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="service" class="small">Jenis Layanan</label>
                                    <select name="service" id="service" class="form-control form-control-sm mt-1">
                                        <option value="">:: Semua ::</option>
                                        @foreach ($services as $item)
                                            <option value="{{ $item->id }}"
                                                {{ request('service') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="status" class="small">Status</label>
                                    <select name="status" id="status" class="form-control form-control-sm mt-1">
                                        <option value="">:: Semua ::</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Expired
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="startdate" class="small">Mulai Tanggal</label>
                                    <input type="date" name="startdate" id="startdate"
                                        class="form-control form-control-sm mt-1" value="{{ request('startdate') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="enddate" class="small">Sampai Tanggal</label>
                                    <input type="date" name="enddate" id="enddate"
                                        class="form-control form-control-sm mt-1" value="{{ request('enddate') }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                        {{-- <button type="button" class="btn btn-sm btnReset btn-outline-dark">Reset</button> --}}
                    </form>
                @endif

                <div class="table-responsive mt-4">
                    <table id="customTable" class="table table-bordered small" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>TANGGAL</th>
                                <th>ID CLIENT</th>
                                <th>NAMA CLIENT</th>
                                <th>JENIS LAYANAN</th>
                                <th>TELPON</th>
                                <th>JENIS SERTIFIKAT</th>
                                @if (auth()->user()->level_id == 2)
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (in_array('clients.index', $roles))
                                @if ($bagian->name == 'Administrator')
                                    @foreach ($clients as $row)
                                        <?php
                                        $penerbitansertifikat_data = new App\Models\Penerbitansertifikat();
                                        $penerbitansertifikat = $penerbitansertifikat_data
                                            ::where('client_id', $row->id)
                                            ->orderBy('id', 'DESC')
                                            ->first();
                                        $listpermohonan_data = new App\Models\Listpermohonan();
                                        $listpermohonan = $listpermohonan_data::where('id', $penerbitansertifikat ? $penerbitansertifikat->listpermohonan_id : '')->first();
                                        $data = $row->penerbitansertifikat_data($listpermohonan->id ?? '')->first();
                                        $datenow = date('Y-m-d');
                                        $dateexpired = $data->tgl_kadaluarsasertifikat ?? '';
                                        ?>
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date_format($row->created_at, 'd/m/Y') }}</td>
                                            <td>
                                                <a href="/dashboard/client/{{ $row->id }}">
                                                    {{ $row->service->service_code }}-{{ $row->nomor_client }}
                                                </a>
                                            </td>
                                            <td>{{ $row->user->name }}</td>
                                            <td>{{ $row->service->name }}</td>
                                            <td>{{ $row->user->telp }}</td>
                                            <td>
                                                @if ($listpermohonan != '')
                                                    @if ($listpermohonan->slug == 'sertifikasi_awal')
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            <span class="badge bg-success">Sertifikasi Awal</span>
                                                        @endif
                                                    @elseif ($listpermohonan->slug == 'surveilance1')
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            <span class="badge bg-success">Surveilance I</span>
                                                        @endif
                                                    @elseif ($listpermohonan->slug == 'surveilance2')
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            <span class="badge bg-success">Surveilance II</span>
                                                        @endif
                                                    @elseif ($listpermohonan->slug == 'resertifikasi')
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            <span class="badge bg-success">Re Sertifikasi</span>
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @elseif($bagian->name == 'Auditor')
                                    @foreach ($clients as $row)
                                        @foreach ($auditor as $item)
                                            @if ($row->id == $item->client_id)
                                                @if (auth()->user()->id == $item->nama_auditor || auth()->user()->id == $item->nama_auditor2)
                                                    <?php
                                                    $penerbitansertifikat_data = new App\Models\Penerbitansertifikat();
                                                    $penerbitansertifikat = $penerbitansertifikat_data
                                                        ::where('client_id', $row->id)
                                                        ->orderBy('id', 'DESC')
                                                        ->first();
                                                    $listpermohonan_data = new App\Models\Listpermohonan();
                                                    $listpermohonan = $listpermohonan_data::where('id', $penerbitansertifikat ? $penerbitansertifikat->listpermohonan_id : '')->first();
                                                    $data = $row->penerbitansertifikat_data($listpermohonan->id ?? '')->first();
                                                    $datenow = date('Y-m-d');
                                                    $dateexpired = $data->tgl_kadaluarsasertifikat ?? '';
                                                    ?>
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ date_format($row->created_at, 'd/m/Y') }}</td>
                                                        <td>
                                                            <a href="/dashboard/client/{{ $row->id }}">
                                                                {{ $row->service->service_code }}-{{ $row->nomor_client }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $row->user->name }}</td>
                                                        <td>{{ $row->service->name }}</td>
                                                        <td>{{ $row->user->telp }}</td>
                                                        <td>
                                                            @if ($listpermohonan != '')
                                                                @if ($listpermohonan->slug == 'sertifikasi_awal')
                                                                    @if (strtotime($datenow) >= strtotime($dateexpired))
                                                                        Expired
                                                                    @else
                                                                        <span class="badge bg-success">Sertifikasi
                                                                            Awal</span>
                                                                    @endif
                                                                @elseif ($listpermohonan->slug == 'surveilance1')
                                                                    @if (strtotime($datenow) >= strtotime($dateexpired))
                                                                        Expired
                                                                    @else
                                                                        <span class="badge bg-success">Surveilance I</span>
                                                                    @endif
                                                                @elseif ($listpermohonan->slug == 'surveilance2')
                                                                    @if (strtotime($datenow) >= strtotime($dateexpired))
                                                                        Expired
                                                                    @else
                                                                        <span class="badge bg-success">Surveilance II</span>
                                                                    @endif
                                                                @elseif ($listpermohonan->slug == 'resertifikasi')
                                                                    @if (strtotime($datenow) >= strtotime($dateexpired))
                                                                        Expired
                                                                    @else
                                                                        <span class="badge bg-success">Re Sertifikasi</span>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif
                            @else
                                @foreach ($clients as $row)
                                    @if ($row->user_id == auth()->user()->id)
                                        <?php
                                        $penerbitansertifikat_data = new App\Models\Penerbitansertifikat();
                                        $penerbitansertifikat = $penerbitansertifikat_data
                                            ::where('client_id', $row->id)
                                            ->orderBy('id', 'DESC')
                                            ->first();
                                        $listpermohonan_data = new App\Models\Listpermohonan();
                                        $listpermohonan = $listpermohonan_data::where('id', $penerbitansertifikat ? $penerbitansertifikat->listpermohonan_id : '')->first();
                                        $data = $row->penerbitansertifikat_data($listpermohonan->id ?? '')->first();
                                        $datenow = date('Y-m-d');
                                        $dateexpired = $data->tgl_kadaluarsasertifikat ?? '';
                                        ?>
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date_format($row->created_at, 'd/m/Y') }}</td>
                                            <td>
                                                <?php
                                                $service_data = new App\Models\Service();
                                                $service = $service_data::find($row->service_id);
                                                ?>
                                                <a href="/dashboard/client/{{ $row->id }}">
                                                    {{ $service->service_code ?? '' }}-{{ $row->nomor_client }}
                                                </a>
                                            </td>
                                            <td>{{ $row->user->name }}</td>
                                            <td>{{ $service->name ?? '' }}</td>
                                            <td>{{ $row->user->telp }}</td>
                                            <td>
                                                @if ($listpermohonan != '')
                                                    @if ($listpermohonan->slug == 'sertifikasi_awal')
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            <span class="badge bg-success">Sertifikasi Awal</span>
                                                        @endif
                                                    @elseif ($listpermohonan->slug == 'surveilance1')
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            <span class="badge bg-success">Surveilance I</span>
                                                        @endif
                                                    @elseif ($listpermohonan->slug == 'surveilance2')
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            <span class="badge bg-success">Surveilance II</span>
                                                        @endif
                                                    @elseif ($listpermohonan->slug == 'resertifikasi')
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            <span class="badge bg-success">Re Sertifikasi</span>
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <?php
                                                $listpermohonan_data = new App\Models\Listpermohonan();
                                                $logawalsertifikasi_data = new App\Models\Logawalcertification();
                                                $listpermohonan = $listpermohonan_data::where('client_id', $row->id)->first();
                                                $logawalsertifikasi = $logawalsertifikasi_data::where('listpermohonan_id', $listpermohonan->id)->first();
                                                ?>
                                                @if ($logawalsertifikasi == '')
                                                    <form action="/dashboard/clients/{{ $row->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-datatable btn-icon btn-transparent-dark"
                                                            onclick="return confirm('Yakin ingin melanjutkan?')"><i
                                                                data-feather="trash-2"></i></button>
                                                    </form>
                                                @else
                                                    <button type="submit"
                                                        class="btn btn-datatable btn-icon btn-transparent-dark"
                                                        onclick="return confirm('Yakin ingin melanjutkan?')" disabled><i
                                                            data-feather="trash-2"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-5">
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="validasiModal" tabindex="-1" aria-labelledby="validasiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="_method" value="PUT">
                    <div class="modal-header">
                        <h5 class="modal-title" id="validasiModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="number">ID CLient</label>
                                    <input readonly type="text" name="number" id="number"
                                        class="form-control mt-1 @error('number') is-invalid @enderror">
                                    @error('number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">Nama</label>
                                    <input readonly type="text" name="name" id="name"
                                        class="form-control mt-1 @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status"
                                class="form-control mt-1 @error('status') is-invalid @enderror">
                                <option value="">:: Pilih ::</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Diterima
                                </option>
                                <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Dipending
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="mt-3">Keterangan</label>
                            <div id="dipending_keterangan">
                                {{-- <textarea class="form-control" name="dipending_keterangan" id="dipending_keterangan" cols="30" rows="10"></textarea> --}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="permohonanModal" tabindex="-1" aria-labelledby="permohonanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="permohonanModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="card card-header-actions h-100 mb-3">
                                <div class="card-header">
                                    Permohonan
                                </div>
                                <div class="card-body">
                                    <select name="service_id" id="service_id" class="form-control">
                                        <option value="">:: Pilih Permohonan Baru ::</option>
                                        @foreach ($services as $item)
                                            <option value='{{ $item->id }}'>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id"
                                        id="user_id">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="logModal" tabindex="-1" aria-labelledby="logModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="_method" value="PUT">
                    <input type="hidden" name="id1" id="id1">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="number">ID CLient</label>
                                    <input readonly type="text" name="number" id="number1"
                                        class="form-control mt-1 @error('number1') is-invalid @enderror">
                                    @error('number1')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">Nama</label>
                                    <input readonly type="text" name="name" id="name1"
                                        class="form-control mt-1 @error('name1') is-invalid @enderror">
                                    @error('name1')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <select class="form-control" name="pilih_log" id="pilih_log">
                                <option value="pilih">::Pilih Log Tahapan Sertifikasi::</option>
                                <option id="sertifikasiawal">Sertifikasi Awal</option>
                                <option id="surveilance1">Surveilance I</option>
                                <option id="surveilance2">Surveilance II</option>
                                <option id="resertifikasi">Re Sertifikasi</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <div class="card card-header-actions h-100">
                                <div class="card-header">
                                    Tahapan Sertifikasi
                                </div>
                                <div class="card-body" style="display: flex; justify-content: center;">
                                    <div class="timeline timeline-xs" id="tahapanSertifikasi">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.addPermohonan').on('click', function() {
            $('#permohonanModalLabel').html('Permohonan Sertifikasi Baru');
            $('input[name=_method]').val('POST');
            $('.modal form').prop('action', '/dashboard/client');
            $('.modal-footer button[type=submit]').html('Simpan');
            $('#permohonan').val('');
        });
    </script>
    <script>
        $('.log').on('click ', function() {
            const id = $(this).data('id');
            $('#logModalLabel').html('Tahapan Sertifikasi');
            $.ajax({
                url: '/dashboard/clientsapi/' + id,
                method: 'get',
                dataType: 'json',
                success: function(res) {
                    $('#id1').val(id);
                    $('#number1').val(res.client.user.number);
                    $('#name1').val(res.client.user.name);

                    if (res.name_sertifikasiawal == 'Sertifikasi Awal ISO 9001/21001') {
                        $('#sertifikasiawal').val('sertifikasi_awal');
                    }
                    if (res.name_surveilance1 == 'Surveilance I') {
                        $('#surveilance1').val('surveilance1');
                    }
                    if (res.name_surveilance2 == 'Surveilance II') {
                        $('#surveilance2').val('surveilance2');
                    }
                    if (res.name_resertifikasi == 'Re Sertifikasi') {
                        $('#resertifikasi').val('resertifikasi');
                    }
                }
            });
            $('#pilih_log').val('pilih');
            $('#tahapanSertifikasi').html('');
        });

        $(document).on('change', '#pilih_log', function() {
            $('#tahapanSertifikasi').html('');
            let log = $(this).val();
            $.ajax({
                url: '/dashboard/logsapi/' + $('#id1').val() + '/' + log,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    if (log == 'sertifikasi_awal') {
                        $('#tahapanSertifikasi').html('');
                        if (response.logsertifikasiawal.length == 0) {
                            $('#tahapanSertifikasi').append(`
                                <div class='timeline-item'>
                                    Log Belum Tersedia
                                </div>
                            `);
                        }

                        for (var i = 0; i < response.logsertifikasiawal.length; i++) {

                            let status = '';
                            let marker = '';
                            let link = '';
                            if (response.logsertifikasiawal[i].tahapan_sertifikasi ==
                                'Permohonan Sertifikasi') {
                                status = response.permohonansertifikasi.status == 1 ?
                                    'Menunggu' : (
                                        response
                                        .permohonansertifikasi
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.permohonansertifikasi.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.permohonansertifikasi.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'permohonansertifikasis';
                                date = response.permohonansertifikasi.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logsertifikasiawal[i].tahapan_sertifikasi ==
                                'Kajian Permohonan') {
                                status = response.kajianclient.status == 1 ?
                                    'Menunggu' : (
                                        response
                                        .kajianclient
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.kajianclient.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.kajianclient.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'kajianclients';
                                date = response.kajianclient.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logsertifikasiawal[i].tahapan_sertifikasi ==
                                'Perjanjian Sertifikasi') {
                                status = response.perjanjianclient.status == 1 ?
                                    'Menunggu' : (
                                        response
                                        .perjanjianclient
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.perjanjianclient.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.perjanjianclient.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'perjanjianclients';
                                date = response.perjanjianclient.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logsertifikasiawal[i].tahapan_sertifikasi ==
                                'Stage I Check List Audit Stage I') {
                                status = response.stage1checkaudit.status == 1 ?
                                    'Menunggu' : (
                                        response.stage1checkaudit.status == 2 ? 'Diterima' :
                                        'Dipending'
                                    );
                                marker = response.stage1checkaudit.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage1checkaudit.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage1checkaudits';
                                date = response.stage1checkaudit.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logsertifikasiawal[i].tahapan_sertifikasi ==
                                'Stage II Rencana Audit') {
                                status = response.stage2rencanaaudit.status == 1 ?
                                    'Menunggu' : (
                                        response.stage2rencanaaudit.status == 2 ?
                                        'Diterima' :
                                        'Dipending');
                                marker = response.stage2rencanaaudit.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2rencanaaudit.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2rencanaaudits';
                                date = response.stage2rencanaaudit.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logsertifikasiawal[i].tahapan_sertifikasi ==
                                'Stage II Laporan Audit') {
                                status = response.stage2laporanaudit.status == 1 ?
                                    'Menunggu' : (
                                        response.stage2laporanaudit.status == 2 ?
                                        'Diterima' :
                                        'Dipending');
                                marker = response.stage2laporanaudit.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2laporanaudit.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2laporanaudits';
                                date = response.stage2laporanaudit.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logsertifikasiawal[i].tahapan_sertifikasi ==
                                'Stage II Lembar Ketidaksesuaian') {
                                status = response.stage2ketidaksesuaianpage.status ==
                                    1 ?
                                    'Menunggu' :
                                    (
                                        response.stage2ketidaksesuaianpage
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.stage2ketidaksesuaianpage.status ==
                                    1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2ketidaksesuaianpage.status ==
                                        2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2ketidaksesuaianpages';
                                date = response.stage2ketidaksesuaianpage.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logsertifikasiawal[i].tahapan_sertifikasi ==
                                'Stage II Verifikasi Temuan') {
                                status = response.stage2temuanverication.status == 1 ?
                                    'Menunggu' :
                                    (
                                        response
                                        .stage2temuanverication
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.stage2temuanverication.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2temuanverication.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2temuanverifcations';
                                date = response.stage2temuanverication.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logsertifikasiawal[i].tahapan_sertifikasi ==
                                'Review Keputusan Sertifikasi') {
                                status = response.reviewkeputusansertifikasi
                                    .status == 1 ?
                                    'Menunggu' :
                                    (
                                        response
                                        .reviewkeputusansertifikasi
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.reviewkeputusansertifikasi
                                    .status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.reviewkeputusansertifikasi.status ==
                                        2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'reviewkeputusansertifikasis';
                                date = response.reviewkeputusansertifikasi.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logsertifikasiawal[i].tahapan_sertifikasi ==
                                'Penerbitan Sertifikat') {
                                status = response.penerbitansertifikat
                                    .status == 1 ?
                                    'Menunggu' :
                                    (
                                        response
                                        .penerbitansertifikat
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.penerbitansertifikat
                                    .status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.penerbitansertifikat.status ==
                                        2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'penerbitansertifikats';
                                date = response.penerbitansertifikat.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            }

                            $('#tahapanSertifikasi').append(`
                                    <div class='timeline-item'>
                                    ` + datelog + `
                                        <div class='timeline-item-marker'>
                                            <div class='timeline-item-marker-text' style='white-space:unset; width:4rem'>
                                                ` + status + `
                                            </div>
                                            ` + marker + `
                                        </div>
                                        <div class='timeline-item-content'><a href='/dashboard/` + link + `/` +
                                response
                                .client.id + '/' +
                                response.logsertifikasiawal[i].listpermohonan_id + `/edit' target='_blank'>
                                            ` + response.logsertifikasiawal[i].tahapan_sertifikasi + `
                                        </a></div>
                                    </div>
                                `);
                        }

                        var timeexpired = response.penerbitansertifikat.tgl_kadaluarsasertifikat;
                        var timenow = (new Date().getFullYear()) + '-' + (new Date().getMonth() +
                            1) + '-' + (
                            new Date()
                            .getDate());

                        let timeexpired_array = timeexpired.split("-");
                        let timenow_array = timenow.split("-");

                        if (timeexpired_array[0] + timeexpired_array[1] + timeexpired_array[2] <=
                            timenow_array[0] + timenow_array[1] + timenow_array[2]) {


                            let text = document.getElementById("tahapanSertifikasi").innerHTML;
                            document.getElementById("tahapanSertifikasi").innerHTML = text
                                .replace(text,
                                    "Expired");
                        }

                    } else if (log == 'surveilance1') {
                        $('#tahapanSertifikasi').html('');
                        if (response.log1surveilance.length == 0) {
                            $('#tahapanSertifikasi').append(`
                                <div class='timeline-item'>
                                    Log Belum Tersedia
                                </div>
                            `);
                        }

                        for (var i = 0; i < response.log1surveilance.length; i++) {

                            let status = '';
                            let marker = '';
                            let link = '';
                            if (response.log1surveilance[i].tahapan_sertifikasi ==
                                'Penugasan Kajian Tim Audit') {
                                status = response.stage1kajiantimaudit.status == 1 ?
                                    'Menunggu' : (
                                        response.stage1kajiantimaudit.status == 2 ?
                                        'Diterima' :
                                        'Dipending'
                                    );
                                marker = response.stage1kajiantimaudit.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage1kajiantimaudit.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage1kajiantimaudits';
                                date = response.stage1kajiantimaudit.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log1surveilance[i].tahapan_sertifikasi ==
                                'Penugasan Penunjukan Tim Audit') {
                                status = response.stage1penunjukantimaudit.status == 1 ?
                                    'Menunggu' : (
                                        response.stage1penunjukantimaudit.status == 2 ?
                                        'Diterima' :
                                        'Dipending');
                                marker = response.stage1penunjukantimaudit.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage1penunjukantimaudit.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage1penunjukantimaudits';
                                date = response.stage1penunjukantimaudit.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log1surveilance[i].tahapan_sertifikasi ==
                                'Audit Rencana Audit') {
                                status = response.stage2rencanaaudit.status == 1 ?
                                    'Menunggu' : (
                                        response.stage2rencanaaudit.status == 2 ?
                                        'Diterima' :
                                        'Dipending');
                                marker = response.stage2rencanaaudit.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2rencanaaudit.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2rencanaaudits';
                                date = response.stage2rencanaaudit.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log1surveilance[i].tahapan_sertifikasi ==
                                'Audit CheckList Audit Stage II') {
                                status = response.stage2checkaudit.status == 1 ?
                                    'Menunggu' : (
                                        response.stage2checkaudit.status == 2 ? 'Diterima' :
                                        'Dipending'
                                    );
                                marker = response.stage2checkaudit.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2checkaudit.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2checkaudits';
                                date = response.stage2checkaudit.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log1surveilance[i].tahapan_sertifikasi ==
                                'Audit Daftar Hadir Audit') {
                                status = response.stage2daftarhadiraudit.status == 1 ?
                                    'Menunggu' : (
                                        response.stage2daftarhadiraudit.status == 2 ?
                                        'Diterima' :
                                        'Dipending');
                                marker = response.stage2daftarhadiraudit.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2daftarhadiraudit.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2daftarhadiraudits';
                                date = response.stage2daftarhadiraudit.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log1surveilance[i].tahapan_sertifikasi ==
                                'Audit Laporan Audit') {
                                status = response.stage2laporanaudit.status == 1 ?
                                    'Menunggu' : (
                                        response.stage2laporanaudit.status == 2 ?
                                        'Diterima' :
                                        'Dipending');
                                marker = response.stage2laporanaudit.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2laporanaudit.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2laporanaudits';
                                date = response.stage2laporanaudit.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log1surveilance[i].tahapan_sertifikasi ==
                                'Audit Lembar Ketidaksesuaian') {
                                status = response.stage2ketidaksesuaianpage.status ==
                                    1 ?
                                    'Menunggu' :
                                    (
                                        response.stage2ketidaksesuaianpage
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.stage2ketidaksesuaianpage.status ==
                                    1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2ketidaksesuaianpage.status ==
                                        2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2ketidaksesuaianpages';
                                date = response.stage2ketidaksesuaianpage.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log1surveilance[i].tahapan_sertifikasi ==
                                'Keputusan Sertifikasi Survei Ketidakpuasan Pelanggan') {
                                status = response.stage2surveikepuasancustomer
                                    .status == 1 ?
                                    'Menunggu' :
                                    (
                                        response
                                        .stage2surveikepuasancustomer
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.stage2surveikepuasancustomer
                                    .status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2surveikepuasancustomer
                                        .status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2surveikepuasancustomers';
                                date = response.stage2surveikepuasancustomer.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log1surveilance[i].tahapan_sertifikasi ==
                                'Keputusan Sertifikasi Verifikasi Temuan') {
                                status = response.stage2temuanverication.status == 1 ?
                                    'Menunggu' :
                                    (
                                        response
                                        .stage2temuanverication
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.stage2temuanverication.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2temuanverication.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2temuanverifcations';
                                date = response.stage2temuanverication.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            }

                            $('#tahapanSertifikasi').append(`
                                            <div class='timeline-item'>
                                            ` + datelog + `
                                                <div class='timeline-item-marker'>
                                                    <div class='timeline-item-marker-text' style='white-space:unset; width:4rem'>
                                                        ` + status + `
                                                    </div>
                                                    ` + marker + `
                                                </div>
                                                <div class='timeline-item-content'><a href='/dashboard/` + link + `/` +
                                response
                                .client.id + '/' +
                                response.log1surveilance[i].listpermohonan_id + `/edit' target='_blank'>
                                                        ` + response.log1surveilance[i].tahapan_sertifikasi + `
                                                    </a></div>
                                                </div>
                                    `);
                        }

                        var timeexpired = response.penerbitansertifikat.tgl_kadaluarsasertifikat;
                        var timenow = (new Date().getFullYear()) + '-' + (new Date().getMonth() + 1) +
                            '-' + (
                                new Date()
                                .getDate());

                        let timeexpired_array = timeexpired.split("-");
                        let timenow_array = timenow.split("-");

                        if (timeexpired_array[0] + timeexpired_array[1] + timeexpired_array[2] <=
                            timenow_array[0] + timenow_array[1] + timenow_array[2]) {


                            let text = document.getElementById("tahapanSertifikasi").innerHTML;
                            document.getElementById("tahapanSertifikasi").innerHTML = text.replace(
                                text,
                                "Expired");
                        }

                    } else if (log == 'surveilance2') {
                        $('#tahapanSertifikasi').html('');
                        if (response.log2surveilance.length == 0) {
                            $('#tahapanSertifikasi').append(`
                                <div class='timeline-item'>
                                    Log Belum Tersedia
                                </div>
                            `);
                        }

                        for (var i = 0; i < response.log2surveilance.length; i++) {

                            let status = '';
                            let marker = '';
                            let link = '';
                            if (response.log2surveilance[i].tahapan_sertifikasi ==
                                'Audit - Rencana Audit') {
                                status = response.stage2rencanaaudit.status == 1 ?
                                    'Menunggu' : (
                                        response.stage2rencanaaudit.status == 2 ?
                                        'Diterima' :
                                        'Dipending');
                                marker = response.stage2rencanaaudit.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2rencanaaudit.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2rencanaaudits';
                                date = response.stage2rencanaaudit.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log2surveilance[i].tahapan_sertifikasi ==
                                'Audit - Laporan Audit') {
                                status = response.stage2laporanaudit.status == 1 ?
                                    'Menunggu' : (
                                        response.stage2laporanaudit.status == 2 ?
                                        'Diterima' :
                                        'Dipending');
                                marker = response.stage2laporanaudit.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2laporanaudit.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2laporanaudits';
                                date = response.stage2laporanaudit.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log2surveilance[i].tahapan_sertifikasi ==
                                'Audit - Lembar Ketidaksesuaian') {
                                status = response.stage2ketidaksesuaianpage.status ==
                                    1 ?
                                    'Menunggu' :
                                    (
                                        response.stage2ketidaksesuaianpage
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.stage2ketidaksesuaianpage.status ==
                                    1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2ketidaksesuaianpage.status ==
                                        2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2ketidaksesuaianpages';
                                date = response.stage2ketidaksesuaianpage.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log2surveilance[i].tahapan_sertifikasi ==
                                'Audit - Survei Kepuasan Pelanggan') {
                                status = response.stage2surveikepuasancustomer
                                    .status == 1 ?
                                    'Menunggu' :
                                    (
                                        response
                                        .stage2surveikepuasancustomer
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.stage2surveikepuasancustomer
                                    .status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2surveikepuasancustomer
                                        .status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2surveikepuasancustomers';
                                date = response.stage2surveikepuasancustomer.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log2surveilance[i].tahapan_sertifikasi ==
                                'Keputusan Sertifikasi - Verifikasi Temuan') {
                                status = response.stage2surveikepuasancustomer
                                    .status == 1 ?
                                    'Menunggu' :
                                    (
                                        response
                                        .stage2surveikepuasancustomer
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.stage2surveikepuasancustomer
                                    .status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2surveikepuasancustomer
                                        .status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2temuanverifcations';
                                date = response.stage2surveikepuasancustomer.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log2surveilance[i].tahapan_sertifikasi ==
                                'Surat Keputusan Surveilance 2') {
                                status = response.stage2temuanverication.status == 1 ?
                                    'Menunggu' :
                                    (
                                        response
                                        .stage2temuanverication
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.stage2temuanverication.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2temuanverication.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'penerbitansertifikats';
                                date = response.stage2temuanverication.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            }

                            $('#tahapanSertifikasi').append(`
                                    <div class='timeline-item'>
                                        ` + datelog + `
                                        <div class='timeline-item-marker'>
                                            <div class='timeline-item-marker-text' style='white-space:unset; width:4rem'>
                                                ` + status + `
                                            </div>
                                            ` + marker + `
                                        </div>
                                        <div class='timeline-item-content'><a href='/dashboard/` + link + `/` +
                                response
                                .client.id + '/' +
                                response.log2surveilance[i].listpermohonan_id + `/edit' target='_blank'>
                                            ` + response.log2surveilance[i].tahapan_sertifikasi + `
                                        </a></div>
                                    </div>
                                `);
                        }

                        var timeexpired = response.penerbitansertifikat.tgl_kadaluarsasertifikat;
                        var timenow = (new Date().getFullYear()) + '-' + (new Date().getMonth() + 1) +
                            '-' + (
                                new Date()
                                .getDate());

                        let timeexpired_array = timeexpired.split("-");
                        let timenow_array = timenow.split("-");

                        if (timeexpired_array[0] + timeexpired_array[1] + timeexpired_array[2] <=
                            timenow_array[0] + timenow_array[1] + timenow_array[2]) {


                            let text = document.getElementById("tahapanSertifikasi").innerHTML;
                            document.getElementById("tahapanSertifikasi").innerHTML = text.replace(
                                text,
                                "Expired");
                        }

                    } else if (log == 'resertifikasi') {
                        $('#tahapanSertifikasi').html('');
                        if (response.logresertifikasi.length == 0) {
                            $('#tahapanSertifikasi').append(`
                                <div class='timeline-item'>
                                    Log Belum Tersedia
                                </div>
                            `);
                        }

                        for (var i = 0; i < response.logresertifikasi.length; i++) {

                            let status = '';
                            let marker = '';
                            let link = '';
                            if (response.logresertifikasi[i].tahapan_sertifikasi ==
                                'Permohonan Sertifikasi') {
                                status = response.permohonansertifikasi.status == 1 ?
                                    'Menunggu' : (
                                        response
                                        .permohonansertifikasi
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.permohonansertifikasi.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.permohonansertifikasi.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'permohonansertifikasis';
                                date = response.permohonansertifikasi.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logresertifikasi[i].tahapan_sertifikasi ==
                                'Kajian Permohonan') {
                                status = response.kajianclient.status == 1 ?
                                    'Menunggu' : (
                                        response
                                        .kajianclient
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.kajianclient.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.kajianclient.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'kajianclients';
                                date = response.kajianclient.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logresertifikasi[i].tahapan_sertifikasi ==
                                'Perjanjian Sertifikasi') {
                                status = response.perjanjianclient.status == 1 ?
                                    'Menunggu' : (
                                        response
                                        .perjanjianclient
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.perjanjianclient.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.perjanjianclient.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'perjanjianclients';
                                date = response.perjanjianclient.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logresertifikasi[i].tahapan_sertifikasi ==
                                'Stage I Check List Audit Stage I') {
                                status = response.stage1checkaudit.status == 1 ?
                                    'Menunggu' : (
                                        response.stage1checkaudit.status == 2 ? 'Diterima' :
                                        'Dipending'
                                    );
                                marker = response.stage1checkaudit.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage1checkaudit.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage1checkaudits';
                                date = response.stage1checkaudit.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logresertifikasi[i].tahapan_sertifikasi ==
                                'Stage II Rencana Audit') {
                                status = response.stage2rencanaaudit.status == 1 ?
                                    'Menunggu' : (
                                        response.stage2rencanaaudit.status == 2 ?
                                        'Diterima' :
                                        'Dipending');
                                marker = response.stage2rencanaaudit.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2rencanaaudit.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2rencanaaudits';
                                date = response.stage2rencanaaudit.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logresertifikasi[i].tahapan_sertifikasi ==
                                'Stage II Laporan Audit') {
                                status = response.stage2laporanaudit.status == 1 ?
                                    'Menunggu' : (
                                        response.stage2laporanaudit.status == 2 ?
                                        'Diterima' :
                                        'Dipending');
                                marker = response.stage2laporanaudit.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2laporanaudit.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2laporanaudits';
                                date = response.stage2laporanaudit.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logresertifikasi[i].tahapan_sertifikasi ==
                                'Stage II Lembar Ketidaksesuaian') {
                                status = response.stage2ketidaksesuaianpage.status ==
                                    1 ?
                                    'Menunggu' :
                                    (
                                        response.stage2ketidaksesuaianpage
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.stage2ketidaksesuaianpage.status ==
                                    1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2ketidaksesuaianpage.status ==
                                        2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2ketidaksesuaianpages';
                                date = response.stage2ketidaksesuaianpage.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logresertifikasi[i].tahapan_sertifikasi ==
                                'Stage II Verifikasi Temua') {
                                status = response.stage2temuanverication.status == 1 ?
                                    'Menunggu' :
                                    (
                                        response
                                        .stage2temuanverication
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.stage2temuanverication.status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.stage2temuanverication.status == 2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'stage2temuanverifcations';
                                date = response.stage2temuanverication.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logresertifikasi[i].tahapan_sertifikasi ==
                                'Review Keputusan Sertifikasi') {
                                status = response.reviewkeputusansertifikasi
                                    .status == 1 ?
                                    'Menunggu' :
                                    (
                                        response
                                        .reviewkeputusansertifikasi
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.reviewkeputusansertifikasi
                                    .status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.reviewkeputusansertifikasi.status ==
                                        2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'reviewkeputusansertifikasis';
                                date = response.reviewkeputusansertifikasi.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logresertifikasi[i].tahapan_sertifikasi ==
                                'Penerbitan Sertifikat') {
                                status = response.penerbitansertifikat
                                    .status == 1 ?
                                    'Menunggu' :
                                    (
                                        response
                                        .penerbitansertifikat
                                        .status == 2 ? 'Diterima' : 'Dipending');
                                marker = response.penerbitansertifikat
                                    .status == 1 ?
                                    "<div class='timeline-item-marker-indicator bg-yellow'></div>" :
                                    (
                                        response.penerbitansertifikat.status ==
                                        2 ?
                                        "<div class='timeline-item-marker-indicator bg-green'></div>" :
                                        "<div class='timeline-item-marker-indicator bg-red'></div>"
                                    );
                                link = 'penerbitansertifikats';
                                date = response.penerbitansertifikat.updated_at;
                                dateFormat = new Date(date);
                                datelog = dateFormat.getDate() +
                                    "/" + (dateFormat.getMonth() + 1) +
                                    "/" + dateFormat.getFullYear();
                            }

                            $('#tahapanSertifikasi').append(`
                                    <div class='timeline-item'>
                                        ` + datelog + `
                                        <div class='timeline-item-marker'>
                                            <div class='timeline-item-marker-text' style='white-space:unset; width:4rem'>
                                                ` + status + `
                                            </div>
                                            ` + marker + `
                                        </div>
                                        <div class='timeline-item-content'><a href='/dashboard/` + link + `/` +
                                response
                                .client.id + '/' +
                                response.logresertifikasi[i].listpermohonan_id + `/edit' target='_blank'>
                                            ` + response.logresertifikasi[i].tahapan_sertifikasi + `
                                        </a></div>
                                    </div>
                                `);
                        }

                        var timeexpired = response.penerbitansertifikat.tgl_kadaluarsasertifikat;
                        var timenow = (new Date().getFullYear()) + '-' + (new Date().getMonth() + 1) +
                            '-' + (
                                new Date()
                                .getDate());

                        let timeexpired_array = timeexpired.split("-");
                        let timenow_array = timenow.split("-");

                        if (timeexpired_array[0] + timeexpired_array[1] + timeexpired_array[2] <=
                            timenow_array[0] + timenow_array[1] + timenow_array[2]) {


                            let text = document.getElementById("tahapanSertifikasi").innerHTML;
                            document.getElementById("tahapanSertifikasi").innerHTML = text.replace(
                                text,
                                "Expired");
                        }
                    }
                }
            });
        });
    </script>
@endsection
