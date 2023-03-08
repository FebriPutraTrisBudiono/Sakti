@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 mb-4">
                <div class="card h-100">
                    <div class="card-body h-100 p-5">
                        <div class="row align-items-center">
                            <div class="col-xl-8 col-xxl-12">
                                <div class="text-center text-xl-start text-xxl-center mb-4 mb-xl-0 mb-xxl-4">
                                    <h1 class="text-primary">Halo,
                                        <strong>{{ auth()->user()->name }}</strong>
                                    </h1>
                                    <p class="text-gray-700 mb-0">Selamat datang kembali di Dashboard
                                        Aplikasi</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-xxl-12 text-center"><img class="img-fluid" src="assets/img/at-work.svg"
                                    style="max-width: 10rem" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (in_array('clients.index', $roles))
            <div class="row">
                <div class="col-xxl-12 col-xl-12 mb-4">
                    <div class="row">
                        <div class="col-lg-6 col-xl-6 mb-4">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 small">Users</div>
                                            <div class="text-lg fw-bold">{{ $userCount }}</div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="users"></i>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="/dashboard/users">View Detail</a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 mb-4">
                            <div class="card bg-warning text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 small">Payments</div>
                                            <div class="text-lg fw-bold">{{ $paymentCount }}</div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="dollar-sign"></i>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="/dashboard/payments">View Detail</a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xl-6 mb-4">
                            <div class="card bg-danger text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 small">Clients</div>
                                            <div class="text-lg fw-bold">{{ $clientCount }}</div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="file-text"></i>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="/dashboard/clients">View Detail</a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 mb-4">
                            <div class="card bg-success text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 small">Sertifikasi Selesai</div>
                                            <div class="text-lg fw-bold">-</div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="check-square"></i>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="#!">View Detail</a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-xxl-8 col-xl-8 mb-4">
                    <div class="card h-100">
                        <div class="card-body h-100 p-5">
                            <h1 class="text-primary"><strong>Detail Pengguna</strong></h1><br>
                            <h1 class="text-primary border-bottom">Biodata</h1>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input class="form-control mt-1" name="name" type="text" id="name"
                                            value="{{ auth()->user()->name }}" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input class="form-control mt-1" name="username" type="text" id="username"
                                            value="{{ auth()->user()->username }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control mt-1" name="email" type="email" id="email"
                                            value="{{ auth()->user()->email }}" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="telp">Telp</label>
                                        <input type="number" name="telp" id="telp" class="form-control mt-1"
                                            value="{{ auth()->user()->telp }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="address">Alamat</label>
                                <textarea name="address" id="address" rows="5"class="form-control mt-1" readonly>{{ auth()->user()->address }}</textarea>
                            </div>
                            <br>
                            <h1 class="text-primary border-bottom">Proses Sertifikasi Yang Dipilih</h1>
                            @foreach ($client_data as $row)
                                @if ($row->user_id == auth()->user()->id)
                                    <?php
                                    $service_data = new App\Models\Service();
                                    $service = $service_data::find($row->service_id);
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label for="email">Proses Sertifikasi</label>
                                                <input class="form-control mt-1" name="email" type="email"
                                                    id="email" value="{{ $service->name ?? '' }}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body h-100 p-5">
                            <h1 class="text-primary border-bottom">Foto Profil</h1><br>
                            <center>
                                <img class="img-fluid" width="300px"
                                    src="{{ auth()->user()->photo ? '/storage/' . auth()->user()->photo : '/assets/img/profile.png' }}" />
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script>
        if ($('#client_id').val() ?? '') {
            $('#tahapanSertifikasiawal').html('');
            const client_id = $('#client_id').val();
            let sertifikasi_awal = $('#sertifikasi_awal').val();
            $.ajax({
                url: '/dashboard/logsapi/' + client_id + '/' + sertifikasi_awal,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response.logsertifikasiawal.length == 0) {
                        $('#tahapanSertifikasiawal').append(`
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

                        $('#tahapanSertifikasiawal').append(`
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

                    var timeexpired = response.penerbitansertifikat.tgl_kadaluarsasertifikat;
                    var timenow = (new Date().getFullYear()) + '-' + (new Date().getMonth() + 1) + '-' + (
                        new Date()
                        .getDate());

                    let timeexpired_array = timeexpired.split("-");
                    let timenow_array = timenow.split("-");

                    if (timeexpired_array[0] + timeexpired_array[1] + timeexpired_array[2] <=
                        timenow_array[0] + timenow_array[1] + timenow_array[2]) {


                        let text = document.getElementById("tahapanSertifikasiawal").innerHTML;
                        document.getElementById("tahapanSertifikasiawal").innerHTML = text.replace(text,
                            "Expired");
                    }
                }
            });

            $('#tahapanSurveilance1').html('');
            const surveilance1 = $('#surveilance1').val();
            $.ajax({
                url: '/dashboard/logsapi/' + client_id + '/' + surveilance1,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response.log1surveilance.length == 0) {
                        $('#tahapanSurveilance1').append(`
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

                        $('#tahapanSurveilance1').append(`
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
                    var timenow = (new Date().getFullYear()) + '-' + (new Date().getMonth() + 1) + '-' + (
                        new Date()
                        .getDate());

                    let timeexpired_array = timeexpired.split("-");
                    let timenow_array = timenow.split("-");

                    if (timeexpired_array[0] + timeexpired_array[1] + timeexpired_array[2] <=
                        timenow_array[0] + timenow_array[1] + timenow_array[2]) {


                        let text = document.getElementById("tahapanSertifikasiawal").innerHTML;
                        document.getElementById("tahapanSertifikasiawal").innerHTML = text.replace(text,
                            "Expired");
                    }
                }
            });

            $('#tahapanSurveilance2').html('');
            const surveilance2 = $('#surveilance2').val();
            $.ajax({
                url: '/dashboard/logsapi/' + client_id + '/' + surveilance2,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response.log2surveilance.length == 0) {
                        $('#tahapanSurveilance2').append(`
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

                        $('#tahapanSurveilance2').append(`
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
                    var timenow = (new Date().getFullYear()) + '-' + (new Date().getMonth() + 1) + '-' + (
                        new Date()
                        .getDate());

                    let timeexpired_array = timeexpired.split("-");
                    let timenow_array = timenow.split("-");

                    if (timeexpired_array[0] + timeexpired_array[1] + timeexpired_array[2] <=
                        timenow_array[0] + timenow_array[1] + timenow_array[2]) {


                        let text = document.getElementById("tahapanSertifikasiawal").innerHTML;
                        document.getElementById("tahapanSertifikasiawal").innerHTML = text.replace(text,
                            "Expired");
                    }
                }
            });

            $('#tahapanResertifikasi').html('');
            const resertifikasi = $('#resertifikasi').val();
            $.ajax({
                url: '/dashboard/logsapi/' + client_id + '/' + resertifikasi,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response.logresertifikasi.length == 0) {
                        $('#tahapanResertifikasi').append(`
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

                        $('#tahapanResertifikasi').append(`
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

                    var timeexpired = response.penerbitansertifikat.tgl_kadaluarsasertifikat;
                    var timenow = (new Date().getFullYear()) + '-' + (new Date().getMonth() + 1) + '-' + (
                        new Date()
                        .getDate());

                    let timeexpired_array = timeexpired.split("-");
                    let timenow_array = timenow.split("-");

                    if (timeexpired_array[0] + timeexpired_array[1] + timeexpired_array[2] <=
                        timenow_array[0] + timenow_array[1] + timenow_array[2]) {


                        let text = document.getElementById("tahapanSertifikasiawal").innerHTML;
                        document.getElementById("tahapanSertifikasiawal").innerHTML = text.replace(text,
                            "Expired");
                    }

                }
            });
        }
    </script>
@endsection
