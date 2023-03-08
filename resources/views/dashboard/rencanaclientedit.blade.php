@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/rencanaclients{{ $rencanaclient ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                    method="post">
                    <div class="card">
                        <div class="card-header text-uppercase">
                            <a href="/dashboard/client/{{ $client->id }}" class="me-2"><i
                                    class="fas fa-arrow-circle-left"></i></a>
                            {{ $listpermohonan_id->proses_sertifikasi }}
                        </div>
                        <div class="card-body">
                            @include('dashboard.navbarstatus')

                            {!! session('msg') !!}

                            @csrf

                            @if ($rencanaclient)
                                @method('PUT')
                            @endif

                            <input type="hidden" name="client_id" value="{{ $client->id }}">
                            <input type="hidden" name="listpermohonan_id" value="{{ $listpermohonan_id->id }}">
                            <input type="hidden" name="listpermohonan_slug" value="{{ $listpermohonan_id->slug }}">

                            <h4 style="text-align: center;" class="card-title border-bottom mt-5 mb-4">
                                RENCANA SIKLUS SERTIFIKASI
                            </h4>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_client">Nama Klien</label>
                                        <input class="form-control @error('nama_client') is-invalid @enderror mt-1"
                                            name="nama_client" type="text" id="nama_client"
                                            value="{{ old('nama_client', $client->user->name ?? '') }}" readonly />
                                        @error('nama_client')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="standart">Standart</label>
                                        <input class="form-control @error('standart') is-invalid @enderror mt-1"
                                            name="standart" type="text" id="standart"
                                            value="{{ old('standart', $rencanaclient->standart ?? '') }}" />
                                        @error('standart')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="5"class="form-control mt-1 @error('alamat') is-invalid @enderror"
                                        readonly>{{ old('alamat', $permohonansertifikasi->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row border-bottom mb-4">
                                <div class="form-group mb-3">
                                    <label for="ruang_lingkup">Ruang Lingkup Sertifikasi</label>
                                    <input class="form-control mt-1 @error('ruang_lingkup') is-invalid @enderror"
                                        name="ruang_lingkup" type="text" id="ruang_lingkup"
                                        value="{{ old('ruang_lingkup', $kajianclient->b1_lingkup ?? '') }}" readonly />
                                    @error('ruang_lingkup')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_perusahaan">Tahapan</label>
                                        <input class="form-control" name="nama_perusahaan" type="text"
                                            id="nama_perusahaan" value="Audit Tahap I" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="rencana1">Rencana</label><br>
                                        <input class="form-control @error('rencana1') is-invalid @enderror mt-1"
                                            name="rencana1" type="date" id="rencana1"
                                            value="{{ old('rencana1', $rencanaclient->rencana1 ?? '') }}" />

                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="me-3">Klausul</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_audit1_4"
                                            id="klausul_audit1_4" value="klausul_audit1_4" <?php if ($rencanaclient) {
                                                if (in_array('klausul_audit1_4', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_audit1_4') == 'klausul_audit1_4' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_audit1_4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_audit1_5"
                                            id="klausul_audit1_5" value="klausul_audit1_5" <?php if ($rencanaclient) {
                                                if (in_array('klausul_audit1_5', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_audit1_5') == 'klausul_audit1_5' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_audit1_5">5</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_audit1_6"
                                            id="klausul_audit1_6" value="klausul_audit1_6" <?php if ($rencanaclient) {
                                                if (in_array('klausul_audit1_6', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_audit1_6') == 'klausul_audit1_6' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_audit1_6">6</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_audit1_7"
                                            id="klausul_audit1_7" value="klausul_audit1_7" <?php if ($rencanaclient) {
                                                if (in_array('klausul_audit1_7', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_audit1_7') == 'klausul_audit1_7' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_audit1_7">7</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_audit1_8"
                                            id="klausul_audit1_8" value="klausul_audit1_8" <?php if ($rencanaclient) {
                                                if (in_array('klausul_audit1_8', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_audit1_8') == 'klausul_audit1_8' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_audit1_8">8</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_audit1_9"
                                            id="klausul_audit1_9" value="klausul_audit1_9"
                                            {{ old('klausul_audit1_9', $rencanaclient->klausul_audit1_9 ?? '') == '9' ? 'checked' : '' }}
                                            <?php if ($rencanaclient) {
                                                if (in_array('klausul_audit1_9', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_audit1_9') == 'klausul_audit1_9' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_audit1_9">9</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_audit1_10"
                                            id="klausul_audit1_10" value="klausul_audit1_10" <?php if ($rencanaclient) {
                                                if (in_array('klausul_audit1_10', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_audit1_10') == 'klausul_audit1_10' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_audit1_10">10</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_perusahaan">Tahapan</label>
                                        <input class="form-control" name="nama_perusahaan" type="text"
                                            id="nama_perusahaan" value="Audit Tahap II" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="rencana2">Rencana</label><br>
                                        <input class="form-control @error('rencana2') is-invalid @enderror mt-1"
                                            name="rencana2" type="date" id="rencana2"
                                            value="{{ old('rencana2', $rencanaclient->rencana2 ?? '') }}" />

                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="me-3">Klausul</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_audit2_4"
                                            id="klausul_audit2_4" value="klausul_audit2_4" <?php if ($rencanaclient) {
                                                if (in_array('klausul_audit2_4', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_audit2_4') == 'klausul_audit2_4' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_audit2_4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_audit2_5"
                                            id="klausul_audit2_5" value="klausul_audit2_5" <?php if ($rencanaclient) {
                                                if (in_array('klausul_audit2_5', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_audit2_5') == 'klausul_audit2_5' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_audit2_5">5</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_audit2_6"
                                            id="klausul_audit2_6" value="klausul_audit2_6" <?php if ($rencanaclient) {
                                                if (in_array('klausul_audit2_6', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_audit2_6') == 'klausul_audit2_6' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_audit2_6">6</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_audit2_7"
                                            id="klausul_audit2_7" value="klausul_audit2_7" <?php if ($rencanaclient) {
                                                if (in_array('klausul_audit2_7', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_audit2_7') == 'klausul_audit2_7' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_audit2_7">7</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_audit2_8"
                                            id="klausul_audit2_8" value="klausul_audit2_8" <?php if ($rencanaclient) {
                                                if (in_array('klausul_audit2_8', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_audit2_8') == 'klausul_audit2_8' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_audit2_8">8</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_audit2_9"
                                            id="klausul_audit2_9" value="klausul_audit2_9" <?php if ($rencanaclient) {
                                                if (in_array('klausul_audit2_9', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_audit2_9') == 'klausul_audit2_9' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_audit2_9">9</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_audit2_10"
                                            id="klausul_audit2_10" value="klausul_audit2_10" <?php if ($rencanaclient) {
                                                if (in_array('klausul_audit2_10', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_audit2_10') == 'klausul_audit2_10' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_audit2_10">10</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_perusahaan">Tahapan</label>
                                        <input class="form-control" name="nama_perusahaan" type="text"
                                            id="nama_perusahaan" value="Survailen I" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="rencana3">Rencana</label><br>
                                        <input class="form-control @error('rencana3') is-invalid @enderror mt-1"
                                            name="rencana3" type="date" id="rencana3"
                                            value="{{ old('rencana3', $rencanaclient->rencana3 ?? '') }}" />

                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="me-3">Klausul</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_survailen1_4"
                                            id="klausul_survailen1_4" value="klausul_survailen1_4" <?php if ($rencanaclient) {
                                                if (in_array('klausul_survailen1_4', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_survailen1_4') == 'klausul_survailen1_4' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_survailen1_4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_survailen1_5"
                                            id="klausul_survailen1_5" value="klausul_survailen1_5" <?php if ($rencanaclient) {
                                                if (in_array('klausul_survailen1_5', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_survailen1_5') == 'klausul_survailen1_5' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_survailen1_5">5</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_survailen1_6"
                                            id="klausul_survailen1_6" value="klausul_survailen1_6" <?php if ($rencanaclient) {
                                                if (in_array('klausul_survailen1_6', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_survailen1_6') == 'klausul_survailen1_6' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_survailen1_6">6</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_survailen1_7"
                                            id="klausul_survailen1_7" value="klausul_survailen1_7" <?php if ($rencanaclient) {
                                                if (in_array('klausul_survailen1_7', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_survailen1_7') == 'klausul_survailen1_7' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_survailen1_7">7</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_survailen1_8"
                                            id="klausul_survailen1_8" value="klausul_survailen1_8" <?php if ($rencanaclient) {
                                                if (in_array('klausul_survailen1_8', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_survailen1_8') == 'klausul_survailen1_8' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_survailen1_8">8</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_survailen1_9"
                                            id="klausul_survailen1_9" value="klausul_survailen1_9" <?php if ($rencanaclient) {
                                                if (in_array('klausul_survailen1_9', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_survailen1_9') == 'klausul_survailen1_9' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_survailen1_9">9</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_survailen1_10"
                                            id="klausul_survailen1_10" value="klausul_survailen1_10" <?php if ($rencanaclient) {
                                                if (in_array('klausul_survailen1_10', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_survailen1_10') == 'klausul_survailen1_10' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_survailen1_10">10</label>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_perusahaan">Tahapan</label>
                                        <input class="form-control" name="nama_perusahaan" type="text"
                                            id="nama_perusahaan" value="Survailen II" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="rencana4">Rencana</label><br>
                                        <input class="form-control @error('rencana4') is-invalid @enderror mt-1"
                                            name="rencana4" type="date" id="rencana4"
                                            value="{{ old('rencana4', $rencanaclient->rencana4 ?? '') }}" />

                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="me-3">Klausul</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_survailen2_4"
                                            id="klausul_survailen2_4" value="klausul_survailen2_4" <?php if ($rencanaclient) {
                                                if (in_array('klausul_survailen2_4', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_survailen2_4') == 'klausul_survailen2_4' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_survailen2_4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_survailen2_5"
                                            id="klausul_survailen2_5" value="klausul_survailen2_5" <?php if ($rencanaclient) {
                                                if (in_array('klausul_survailen2_5', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_survailen2_5') == 'klausul_survailen2_5' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_survailen2_5">5</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_survailen2_6"
                                            id="klausul_survailen2_6" value="klausul_survailen2_6" <?php if ($rencanaclient) {
                                                if (in_array('klausul_survailen2_6', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_survailen2_6') == 'klausul_survailen2_6' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_survailen2_6">6</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_survailen1_7"
                                            id="klausul_survailen2_7" value="klausul_survailen2_7" <?php if ($rencanaclient) {
                                                if (in_array('klausul_survailen2_7', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_survailen2_7') == 'klausul_survailen2_7' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_survailen2_7">7</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_survailen2_8"
                                            id="klausul_survailen2_8" value="klausul_survailen2_8" <?php if ($rencanaclient) {
                                                if (in_array('klausul_survailen2_8', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_survailen2_8') == 'klausul_survailen2_8' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_survailen2_8">8</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_survailen2_9"
                                            id="klausul_survailen2_9" value="klausul_survailen2_9" <?php if ($rencanaclient) {
                                                if (in_array('klausul_survailen2_9', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_survailen2_9') == 'klausul_survailen2_9' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_survailen2_9">9</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_survailen2_10"
                                            id="klausul_survailen2_10" value="klausul_survailen2_10" <?php if ($rencanaclient) {
                                                if (in_array('klausul_survailen2_10', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_survailen2_10') == 'klausul_survailen2_10' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_survailen2_10">10</label>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_perusahaan">Tahapan</label>
                                        <input class="form-control" name="nama_perusahaan" type="text"
                                            id="nama_perusahaan" value="Resertifikasi" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="rencana5">Rencana</label><br>
                                        <input class="form-control @error('rencana5') is-invalid @enderror mt-1"
                                            name="rencana5" type="date" id="rencana5"
                                            value="{{ old('rencana5', $rencanaclient->rencana5 ?? '') }}" />

                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="me-3">Klausul</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_resertifikasi_4"
                                            id="klausul_resertifikasi_4" value="klausul_resertifikasi_4"
                                            <?php if ($rencanaclient) {
                                                if (in_array('klausul_resertifikasi_4', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_resertifikasi_4') == 'klausul_resertifikasi_4' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_resertifikasi_4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_resertifikasi_5"
                                            id="klausul_resertifikasi_5" value="klausul_resertifikasi_5"
                                            <?php if ($rencanaclient) {
                                                if (in_array('klausul_resertifikasi_5', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_resertifikasi_5') == 'klausul_resertifikasi_5' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_resertifikasi_5">5</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_resertifikasi_6"
                                            id="klausul_resertifikasi_6" value="klausul_resertifikasi_6"
                                            <?php if ($rencanaclient) {
                                                if (in_array('klausul_resertifikasi_6', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_resertifikasi_6') == 'klausul_resertifikasi_6' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_resertifikasi_6">6</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_resertifikasi_7"
                                            id="klausul_resertifikasi_7" value="klausul_resertifikasi_7"
                                            <?php if ($rencanaclient) {
                                                if (in_array('klausul_resertifikasi_7', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_resertifikasi_7') == 'klausul_resertifikasi_7' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_resertifikasi_7">7</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_resertifikasi_8"
                                            id="klausul_resertifikasi_8" value="klausul_resertifikasi_8"
                                            <?php if ($rencanaclient) {
                                                if (in_array('klausul_resertifikasi_8', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_resertifikasi_8') == 'klausul_resertifikasi_8' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_resertifikasi_8">8</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_resertifikasi_9"
                                            id="klausul_resertifikasi_9" value="klausul_resertifikasi_9"
                                            <?php if ($rencanaclient) {
                                                if (in_array('klausul_resertifikasi_9', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_resertifikasi_9') == 'klausul_resertifikasi_9' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_resertifikasi_9">9</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="klausul_resertifikasi_10"
                                            id="klausul_resertifikasi_10" value="klausul_resertifikasi_10"
                                            <?php if ($rencanaclient) {
                                                if (in_array('klausul_resertifikasi_10', $klausul)) {
                                                    echo 'checked';
                                                }
                                            } else {
                                                echo old('klausul_resertifikasi_10') == 'klausul_resertifikasi_10' ? 'checked' : '';
                                            } ?>>
                                        <label class="form-check-label" for="klausul_resertifikasi_10">10</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col mt-5">
                                <h6 class="card-title border-bottom mb-4">TTD</h6>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="tempat_ttd">Tempat</label>
                                            <input class="form-control mt-1 @error('tempat_ttd') is-invalid @enderror"
                                                name="tempat_ttd" type="text" id="tempat_ttd"
                                                value="{{ old('tempat_ttd', $rencanaclient->tempat_ttd ?? '') }}" />
                                            @error('tempat_ttd')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="tgl_ttd">Tanggal</label>
                                            <input class="form-control mt-1 @error('tgl_ttd') is-invalid @enderror"
                                                name="tgl_ttd" type="date" id="tgl_ttd"
                                                value="{{ old('tgl_ttd', $rencanaclient->tgl_ttd ?? '') }}" />
                                            @error('tgl_ttd')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="nama_ttd">Nama Manager Sertifikasi</label>
                                            <input class="form-control mt-1 @error('nama_ttd') is-invalid @enderror"
                                                name="nama_ttd" type="text" id="nama_ttd"
                                                value="{{ old('nama_ttd', $rencanaclient->nama_ttd ?? '') }}" />
                                            @error('nama_ttd')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($rencanaclient == '')
                                @if (in_array('F-CER-03 - Rencana Siklus Sertifikasi.store', $roles))
                                    <button type="submit" class="btn btn-primary mt-1 mb-3">Simpan</button>
                                @endif
                            @endif
                            @if ($rencanaclient ? $rencanaclient->status != 2 : '')
                                @if (in_array('F-CER-03 - Rencana Siklus Sertifikasi.update', $roles))
                                    <button type="submit" class="btn btn-primary mt-1 mb-3">Simpan</button>
                                @endif
                            @endif

                            @if ($rencanaclient)
                                @if (in_array('F-CER-03 - Rencana Siklus Sertifikasi.download', $roles))
                                    <a href="/dashboard/rencanaclients/download/{{ $rencanaclient->id }}"
                                        class="btn btn-secondary mt-1 mb-3" target='_blank'>
                                        Download
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </form>
                @if ($rencanaclient)
                    <form
                        action="/dashboard/rencanaclientsvalidasi{{ $rencanaclient ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($rencanaclient)
                            @method('PUT')
                        @endif

                        <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                        <input type="hidden" id="status" value="{{ $rencanaclient->status ?? '' }}">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">Status</h4>
                                @if (in_array('F-CER-03 - Rencana Siklus Sertifikasi.validasi', $roles))
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
                                    <button type="submit" class="btn btn-primary mt-3">Simpan Status</button>
                                @else
                                    <select id="status"
                                        class="form-control mt-1 @error('status') is-invalid @enderror" disabled>
                                        <option value="">:: Pilih ::</option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Menunggu
                                        </option>
                                        <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Diterima
                                        </option>
                                        <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Dipending
                                        </option>
                                    </select>
                                    @if ($rencanaclient->dipending_keterangan)
                                        <label class="mt-3">Keterangan</label>
                                        <div>
                                            <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                                disabled>{{ $rencanaclient->dipending_keterangan }}</textarea>
                                        </div>
                                        <button name="status" value="1" type="submit"
                                            class="btn btn-warning mt-3">Simpan Status Revisi</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let id = $('#clientid').val();
        let listpermohonan_id = $('#listpermohonan_id').val();
        let statusid = $('#status').val();
        $.ajax({
            url: '/dashboard/statusapi/' + id + '/' + listpermohonan_id,
            method: 'get',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $('#status option[value="' + statusid + '"]').prop('selected', true);

                if (statusid == 3) {
                    $('#dipending_keterangan').html('');
                    let status = response.rencanaclient.dipending_keterangan ?? '';

                    $('#dipending_keterangan').append(`
                <textarea class='form-control' name='dipending_keterangan' cols="30" rows="10">` +
                        status + `</textarea>
        `);
                } else {
                    $('#dipending_keterangan').html('-');
                }
            }
        });

        $(document).on('change', '#status', function() {
            const idstatus = $(this).val();
            let listpermohonan_id = $('#listpermohonan_id').val();
            // console.log(idstatus);
            $.ajax({
                url: '/dashboard/statusapi/' + id + '/' + listpermohonan_id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    if (idstatus == 3) {
                        $('#dipending_keterangan').html('');
                        let status = response.rencanaclient
                            .dipending_keterangan ?? '';

                        $('#dipending_keterangan').append(`
                        <textarea class='form-control' name='dipending_keterangan' cols="30" rows="10">` +
                            status + `</textarea>
                `);
                    } else {
                        $('#dipending_keterangan').html('-');
                    }
                }
            });
        });
    </script>
@endsection
