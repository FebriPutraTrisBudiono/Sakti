@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        {{ $title_bar }}
                        <a href="javascript:void(0)" class="addPermohonan" data-bs-toggle="modal"
                            data-bs-target="#permohonanModal"><i class='fas fa-plus-circle fa-lg'></i>
                        </a>
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <input type="hidden" name="client_id" id="client_id" value="{{ $client->id }}">
                        <form action="/dashboard/pembelians" method="get" class="bg-light p-3 rounded">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="q" class="">ID Client</label>
                                        <input type="text" name="q" id="q"
                                            class="form-control form-control mt-1" style="background-color: white"
                                            value="{{ $client->user->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="suplier" class="">Nama</label>
                                        <input type="text" name="q" id="q"
                                            class="form-control form-control mt-1"
                                            value="{{ $client->service->service_code }}-{{ $client->nomor_client }}"
                                            style="background-color: white" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="barang" class="">Jenis Sertifikasi</label>
                                        <input type="text" name="q" id="q"
                                            class="form-control form-control mt-1" style="background-color: white"
                                            value="{{ $client->service->name }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive mt-4">
                            <table id="customTable" class="table table-bordered small" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>TANGGAL</th>
                                        <th>PROSES SERTIFIKASI</th>
                                        <th>STATUS</th>
                                        <th>LOG</th>
                                        <th>SERTIFIKAT</th>
                                        <th>TANGGAL KADALUARSA</th>
                                        {{-- @if (in_array('clients.destroyprosessertifikasi', $roles)) --}}
                                        <th>AKSI</th>
                                        {{-- @endif --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listpermohonan as $item)
                                        <?php $data = $client->penerbitansertifikat_data($item->id)->first();
                                        $datenow = date('Y-m-d');
                                        $dateexpired = $data->tgl_kadaluarsasertifikat ?? '';
                                        ?>
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date_format($item->created_at, 'd/m/Y') }}</td>
                                            <td>
                                                @if ($item->slug == 'sertifikasi_awal')
                                                    @if (auth()->user()->level_id == 3)
                                                        <a
                                                            href="/dashboard/stage1checkaudits/{{ $client->id }}/{{ $item->id }}/edit">
                                                            {{ $item->proses_sertifikasi }}
                                                        </a>
                                                    @else
                                                        <a
                                                            href="/dashboard/permohonansertifikasis/{{ $client->id }}/{{ $item->id }}/edit">
                                                            {{ $item->proses_sertifikasi }}
                                                        </a>
                                                    @endif
                                                @elseif ($item->slug == 'surveilance1')
                                                    @if (auth()->user()->level_id == 3)
                                                        <a
                                                            href="/dashboard/stage1kajiantimaudits/{{ $client->id }}/{{ $item->id }}/edit">
                                                            {{ $item->proses_sertifikasi }}
                                                        </a>
                                                    @else
                                                        <a
                                                            href="/dashboard/stage2rencanaaudits/{{ $client->id }}/{{ $item->id }}/edit">
                                                            {{ $item->proses_sertifikasi }}
                                                        </a>
                                                    @endif
                                                @elseif ($item->proses_sertifikasi == 'surveilance2')
                                                    @if (auth()->user()->level_id == 3)
                                                        <a
                                                            href="/dashboard/stage1kajiantimaudits/{{ $client->id }}/{{ $item->id }}/edit">
                                                            {{ $item->proses_sertifikasi }}
                                                        </a>
                                                    @else
                                                        <a
                                                            href="/dashboard/stage2rencanaaudits/{{ $client->id }}/{{ $item->id }}/edit">
                                                            {{ $item->proses_sertifikasi }}
                                                        </a>
                                                    @endif
                                                @elseif ($item->proses_sertifikasi == 'resertifikasi')
                                                    @if (auth()->user()->level_id == 3)
                                                        <a
                                                            href="/dashboard/stage1checkaudits/{{ $client->id }}/{{ $item->id }}/edit">
                                                            {{ $item->proses_sertifikasi }}
                                                        </a>
                                                    @else
                                                        <a
                                                            href="/dashboard/permohonansertifikasis/{{ $client->id }}/{{ $item->id }}/edit">
                                                            {{ $item->proses_sertifikasi }}
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->slug == 'sertifikasi_awal')
                                                    @if ($dateexpired)
                                                        {{ strtotime($datenow) >= strtotime($dateexpired) ? 'Tidak Aktif' : 'Aktif' }}
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($item->slug == 'surveilance1')
                                                    @if ($dateexpired)
                                                        {{ strtotime($datenow) >= strtotime($dateexpired) ? 'Tidak Aktif' : 'Aktif' }}
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($item->slug == 'surveilance2')
                                                    @if ($dateexpired)
                                                        {{ strtotime($datenow) >= strtotime($dateexpired) ? 'Tidak Aktif' : 'Aktif' }}
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($item->slug == 'resertifikasi')
                                                    @if ($dateexpired)
                                                        {{ strtotime($datenow) >= strtotime($dateexpired) ? 'Tidak Aktif' : 'Aktif' }}
                                                    @else
                                                        -
                                                    @endif
                                                @endif
                                            </td>
                                            <td><small>
                                                    <a href="javascript:void(0)" class="log"
                                                        data-id="{{ $item->id }}" data-slug="{{ $item->slug }}"
                                                        data-bs-toggle="modal" data-bs-target="#logModal"
                                                        style="font-style: italic;">Lihat Log
                                                        Sertifikasi</a></small>
                                            </td>
                                            <td>
                                                @if ($item->slug == 'sertifikasi_awal')
                                                    @if ($dateexpired)
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            <a href="/dashboard/penerbitansertifikats/{{ $client->id }}/{{ $item->id }}/edit"
                                                                target="_blank"><span class="badge bg-success">Lihat
                                                                    Sertifikat</span></a>
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($item->slug == 'surveilance1')
                                                    @if ($dateexpired)
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            <a href="/dashboard/penerbitansertifikats/{{ $client->id }}/{{ $item->id }}/edit"
                                                                target="_blank"><span class="badge bg-success">Surat
                                                                    Keputusan Surveilance
                                                                    {{ $item->slug == 'surveilance1' ? 1 : 2 }}</span></a>
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($item->slug == 'surveilance2')
                                                    @if ($dateexpired)
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            <a href="/dashboard/penerbitansertifikats/{{ $client->id }}/{{ $item->id }}/edit"
                                                                target="_blank"><span class="badge bg-success">Surat
                                                                    Keputusan Surveilance
                                                                    {{ $item->slug == 'surveilance1' ? 1 : 2 }}</span></a>
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($item->slug == 'resertifikasi')
                                                    @if ($dateexpired)
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            <a href="/dashboard/penerbitansertifikats/{{ $client->id }}/{{ $item->id }}/edit"
                                                                target="_blank"><span class="badge bg-success">Lihat
                                                                    Resertifikat</span></a>
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->slug == 'sertifikasi_awal')
                                                    @if ($dateexpired)
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            {{ date('d/m/Y', strtotime($data->tgl_kadaluarsasertifikat)) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($item->slug == 'surveilance1')
                                                    @if ($dateexpired)
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            {{ date('d/m/Y', strtotime($data->tgl_kadaluarsasertifikat)) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($item->slug == 'surveilance2')
                                                    @if ($dateexpired)
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            Expired
                                                        @else
                                                            {{ date('d/m/Y', strtotime($data->tgl_kadaluarsasertifikat)) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @elseif ($item->slug == 'resertifikasi')
                                                    @if ($dateexpired)
                                                        @if (strtotime($datenow) >= strtotime($dateexpired))
                                                            <?php
                                                            // $user = new App\Models\User();
                                                            // $mail = new Illuminate\Support\Facades\Mail();
                                                            // $status = new App\Mail\Status();
                                                            
                                                            // $log = 'Penerbitan Sertifikasi/Surveilance';
                                                            // $clientdata = [
                                                            //     'client' => $client,
                                                            //     'log' => 'Sertifikat/Surat Surveilance',
                                                            //     'status' => 'Expired',
                                                            //     'keterangan' => 'Sertifikasi atau Surveilance telah Expired, Silahkan memperbarui untuk memperpanjang sertifikat atau surveilance.',
                                                            // ];
                                                            // $mail::to($client->user->email)->send($status($clientdata));
                                                            ?>
                                                            Expired
                                                        @else
                                                            {{ date('d/m/Y', strtotime($data->tgl_kadaluarsasertifikat)) }}
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                @endif
                                            </td>
                                            {{-- @if (in_array('clients.destroyprosessertifikasi', $roles)) --}}
                                            <td>
                                                @if ($item->slug == 'sertifikasi_awal')
                                                    <?php
                                                    $logawal = new App\Models\Logawalcertification();
                                                    $log = $logawal::where('listpermohonan_id', $item->id)->first();
                                                    ?>
                                                    @if ($log == '')
                                                        <form action="/dashboard/clientshows/{{ $item->id }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-datatable btn-icon btn-transparent-dark"
                                                                onclick="return confirm('Yakin ingin melanjutkan?')"><i
                                                                    data-feather="trash-2"></i></button>
                                                        </form>
                                                    @else
                                                        <div class="row">
                                                            <form
                                                                action="/dashboard/document/download/{{ $client->id }}/{{ $listpermohonan->first()->id }}"
                                                                method="get">
                                                                <button type="submit"
                                                                    class="btn btn-datatable btn-icon btn-transparent-dark"><i
                                                                        data-feather="download"></i></button>
                                                                <button type="submit"
                                                                    class="btn btn-datatable btn-icon btn-transparent-dark"
                                                                    onclick="return confirm('Yakin ingin melanjutkan?')"
                                                                    disabled><i data-feather="trash-2"></i></button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                @elseif($item->slug == 'surveilance1')
                                                    <?php
                                                    $logsurveilance1 = new App\Models\Log1surveilance();
                                                    $log = $logsurveilance1::where('listpermohonan_id', $item->id)->first();
                                                    ?>
                                                    @if ($log == '')
                                                        <form action="/dashboard/clientshows/{{ $item->id }}"
                                                            method="post">
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
                                                            onclick="return confirm('Yakin ingin melanjutkan?')"
                                                            disabled><i data-feather="trash-2"></i></button>
                                                    @endif
                                                @elseif($item->slug == 'surveilance2')
                                                    <?php
                                                    $logsurveilance2 = new App\Models\Log2surveilance();
                                                    $log = $logsurveilance2::where('listpermohonan_id', $item->id)->first();
                                                    ?>
                                                    @if ($log == '')
                                                        <form action="/dashboard/clientshows/{{ $item->id }}"
                                                            method="post">
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
                                                            onclick="return confirm('Yakin ingin melanjutkan?')"
                                                            disabled><i data-feather="trash-2"></i></button>
                                                    @endif
                                                @elseif($item->slug == 'resertifikasi')
                                                    <?php
                                                    $logresertifikasi = new App\Models\Logresertifikasi();
                                                    $log = $logresertifikasi::where('listpermohonan_id', $item->id)->first();
                                                    ?>
                                                    @if ($log == '')
                                                        <form action="/dashboard/clientshows/{{ $item->id }}"
                                                            method="post">
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
                                                            onclick="return confirm('Yakin ingin melanjutkan?')"
                                                            disabled><i data-feather="trash-2"></i></button>
                                                    @endif
                                                @endif
                                            </td>
                                            {{-- @endif --}}
                                        </tr>
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
                            {{-- <div class="card card-header-actions mb-3">
                                <div class="card-header">
                                    Urutan Permohonan Sertifikasi
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive mt-3">
                                        <table id="customTable" class="table table-bordered small" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tahap 1</th>
                                                    <th>Tahap 2</th>
                                                    <th>Tahap 3</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td><label>Sertifikasi Awal</label></td>
                                                    <td><label>Re Sertifikasi</label></td>
                                                    <td><label>Re Sertifikasi</label></td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td><label>Surveilance 1</label></td>
                                                    <td><label>Surveilance 1</label></td>
                                                    <td><label>Surveilance 1</label></td>
                                                </tr>
                                                <tr>
                                                    <td>3.</td>
                                                    <td><label>Surveilance 2</label></td>
                                                    <td><label>Surveilance 2</label></td>
                                                    <td><label>Surveilance 2</label></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <label><b>NB : Lakukan Sertifikasi dan surveilance sesuai dengan urutan yang
                                                tertera</b></label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="card card-header-actions h-100 mb-3">
                                <div class="card-header">
                                    Permohonan
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="client_id" id="client_id" value="{{ $client->id }}">
                                    <select name="proses_sertifikasi" id="proses_sertifikasi" class="form-control">
                                        <option value="">:: Pilih Permohonan Baru ::</option>
                                        <option value="Surveilance I">Surveilance I</option>
                                        <option value="Surveilance II">Surveilance II</option>
                                        <option value="Re Sertifikasi">Re Sertifikasi</option>
                                    </select>
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
                                    <input readonly type="text"
                                        value="{{ $client->service->service_code }}-{{ $client->nomor_client }}"
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
                            <div class="card card-header-actions h-100">
                                <div class="card-header">
                                    Tahapan Sertifikasi
                                </div>
                                <div class="card-body">
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
            $('#permohonanModalLabel').html('Permohonan Baru');
            $('input[name=_method]').val('POST');
            $('.modal form').prop('action', '/dashboard/listpermohonans');
            $('.modal-footer button[type=submit]').html('Simpan');
            $('#permohonan').val('');
        });

        $('.log').on('click ', function() {
            const id = $('#client_id').val();
            $('#logModalLabel').html('Tahapan Sertifikasi');
            $.ajax({
                url: '/dashboard/clientsapi/' + id,
                method: 'get',
                dataType: 'json',
                success: function(res) {
                    $('#id1').val(id);
                    $('#number1').val(res.client.user.number);
                    $('#name1').val(res.client.user.name);
                }
            });

            const listpermohonan_id = $(this).data('id');
            const listpermohonan_slug = $(this).data('slug');
            $.ajax({
                url: '/dashboard/logsclientapi/' + id + '/' + listpermohonan_id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    if (listpermohonan_slug == 'sertifikasi_awal') {
                        $('#tahapanSertifikasi').html('');
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateFormat = new Date(date);
                                date = response.kajianclient.updated_at;
                                dateFormat = new Date(date);
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.logsertifikasiawal[i].tahapan_sertifikasi ==
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                    <div class='timeline-item-content'><a href='/dashboard/` + link + `/` + response
                                .client.id + '/' +
                                response.logsertifikasiawal[i].listpermohonan_id + `/edit' target='_blank'>
                                        ` + response.logsertifikasiawal[i].tahapan_sertifikasi + `
                                    </a></div>
                                </div>
                            `);
                        }

                    } else if (listpermohonan_slug == 'surveilance1') {
                        console.log(response);
                        $('#tahapanSertifikasi').html('');
                        for (var i = 0; i < response.log1surveilance.length; i++) {

                            let status = '';
                            let marker = '';
                            let link = '';
                            if (response.log1surveilance[i].tahapan_sertifikasi ==
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log1surveilance[i].tahapan_sertifikasi ==
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log1surveilance[i].tahapan_sertifikasi ==
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log1surveilance[i].tahapan_sertifikasi ==
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log1surveilance[i].tahapan_sertifikasi ==
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
                                    "/" + dateFormat.getFullYear();
                            } else if (response.log1surveilance[i].tahapan_sertifikasi ==
                                'Surat Keputusan Surveilance 1') {
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                    } else if (listpermohonan_slug == 'surveilance2') {
                        $('#tahapanSertifikasi').html('');
                        console.log(response);
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                    } else if (listpermohonan_slug == 'resertifikasi') {
                        $('#tahapanSertifikasi').html('');
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
                                dateday = dateFormat.getDate().toString().length == 1 ? '0' + dateFormat
                                    .getDate() : dateFormat.getDate()
                                month = (dateFormat
                                    .getMonth() + 1);
                                datemonth = month.length == 1 ? '0' +
                                    month : month
                                datelog = dateday +
                                    "/" + datemonth +
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
        <div class='timeline-item-content'><a href='/dashboard/` + link + `/` + response
                                .client.id + '/' +
                                response.logresertifikasi[i].listpermohonan_id + `/edit' target='_blank'>
            ` + response.logresertifikasi[i].tahapan_sertifikasi + `
        </a></div>
    </div>
`);
                        }

                    } else {
                        $('#tahapanSertifikasi').html('');
                    }
                }
            });
        });
    </script>
@endsection
