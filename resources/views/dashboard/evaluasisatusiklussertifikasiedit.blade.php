@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/evaluasisatusiklussertifikasis{{ $evaluasisatusiklussertifikasi ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                    method="post" enctype="multipart/form-data">
                    <div class="card mb-4">
                        <div class="card-header text-uppercase">
                            <a href="/dashboard/client/{{ $client->id }}" class="me-2"><i
                                    class="fas fa-arrow-circle-left"></i></a>
                            {{ $listpermohonan_id->proses_sertifikasi }}
                        </div>
                        <div class="card-body">
                            @include('dashboard.navbarstatus')

                            {!! session('msg') !!}
                            @csrf

                            @if ($evaluasisatusiklussertifikasi)
                                @method('PUT')
                            @endif

                            <input type="hidden" value="{{ $client->id }}" name="client_id">
                            <input type="hidden" value="{{ $listpermohonan_id->slug }}" name="listpermohonan_slug">
                            <input type="hidden" value="{{ $listpermohonan_id->id }}" name="listpermohonan_id">

                            <div class="col-12 grid-margin stretch-card">
                                <div>
                                    <div class="card-body">
                                        <h4 style="text-align: center;" class="card-title mb-3 border-bottom mb-4">
                                            EVALUASI SATU SIKLUS SERTIFIKASI
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Nama Klien</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('nama_pimpinan') is-invalid @enderror"
                                                            id="nama_pimpinan" name="nama_pimpinan"
                                                            value="{{ old('nama_pimpinan', $permohonansertifikasi->nama_pimpinan ?? '') }}"
                                                            readonly />
                                                        @error('nama_pimpinan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Alamat</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('alamat') is-invalid @enderror"
                                                            id="alamat" name="alamat"
                                                            value="{{ old('alamat', $permohonansertifikasi->alamat ?? '') }}"
                                                            readonly />
                                                        @error('alamat')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Ruang Lingkup</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('b1_lingkup') is-invalid @enderror"
                                                            id="b1_lingkup" name="b1_lingkup"
                                                            value="{{ old('b1_lingkup', $kajianclient->b1_lingkup ?? '') }}"
                                                            readonly />
                                                        @error('b1_lingkup')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Standar</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('standart') is-invalid @enderror mt-1"
                                                            id="standart" name="standart"
                                                            value="{{ old('standart', $rencanaclient->standart ?? '') }}"
                                                            readonly />
                                                        @error('standart')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <h4 class="card-title mb-3 border-bottom mt-4">I. INFORMASI PELAKSANAAN AUDIT</h4>
                                        <h6 class="card-title mb-3 mt-4">TAHAPAN : Stage 1</h6>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Tanggal Audit</label>
                                                    <div class="col-sm-12">
                                                        <input type="date"
                                                            class="form-control mt-1 @error('stage1tanggalaudit') is-invalid @enderror"
                                                            id="stage1tanggalaudit" name="stage1tanggalaudit"
                                                            value="{{ old('stage1tanggalaudit', $evaluasisatusiklussertifikasi->stage1tanggalaudit ?? '') }}" />
                                                        @error('stage1tanggalaudit')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group row">
                                                    <label>Hasil: Major</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('stage1hasilmajor') is-invalid @enderror mt-1"
                                                            id="stage1hasilmajor" name="stage1hasilmajor"
                                                            value="{{ old('stage1hasilmajor', $evaluasisatusiklussertifikasi->stage1hasilmajor ?? '') }}" />
                                                        @error('stage1hasilmajor')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group row">
                                                    <label>Hasil: Minor</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('stage1hasilminor') is-invalid @enderror mt-1"
                                                            id="stage1hasilminor" name="stage1hasilminor"
                                                            value="{{ old('stage1hasilminor', $evaluasisatusiklussertifikasi->stage1hasilminor ?? '') }}" />
                                                        @error('stage1hasilminor')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group row">
                                                    <label>Hasil: Observasi</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('stage1hasilobservasi') is-invalid @enderror mt-1"
                                                            id="stage1hasilobservasi" name="stage1hasilobservasi"
                                                            value="{{ old('stage1hasilobservasi', $evaluasisatusiklussertifikasi->stage1hasilobservasi ?? '') }}" />
                                                        @error('stage1hasilobservasi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>Tindak Lanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" name="stage1tindaklanjut" id="stage1tindaklanjut" cols="30" rows="5">{{ old('stage1tindaklanjut', $evaluasisatusiklussertifikasi->stage1tindaklanjut ?? '') }}</textarea>
                                                        @error('stage1tindaklanjut')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="card-title mb-3 mt-5">TAHAPAN : Stage 2</h6>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Tanggal Audit</label>
                                                    <div class="col-sm-12">
                                                        <input type="date"
                                                            class="form-control mt-1 @error('stage2tanggalaudit') is-invalid @enderror"
                                                            id="stage2tanggalaudit" name="stage2tanggalaudit"
                                                            value="{{ old('stage2tanggalaudit', $evaluasisatusiklussertifikasi->stage2tanggalaudit ?? '') }}" />
                                                        @error('stage2tanggalaudit')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group row">
                                                    <label>Hasil: Major</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('stage2hasilmajor') is-invalid @enderror mt-1"
                                                            id="stage2hasilmajor" name="stage2hasilmajor"
                                                            value="{{ old('stage2hasilmajor', $evaluasisatusiklussertifikasi->stage2hasilmajor ?? '') }}" />
                                                        @error('stage2hasilmajor')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group row">
                                                    <label>Hasil: Minor</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('stage2hasilminor') is-invalid @enderror mt-1"
                                                            id="stage2hasilminor" name="stage2hasilminor"
                                                            value="{{ old('stage2hasilminor', $evaluasisatusiklussertifikasi->stage2hasilminor ?? '') }}" />
                                                        @error('stage2hasilminor')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group row">
                                                    <label>Hasil: Observasi</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('stage2hasilobservasi') is-invalid @enderror mt-1"
                                                            id="stage2hasilobservasi" name="stage2hasilobservasi"
                                                            value="{{ old('stage2hasilobservasi', $evaluasisatusiklussertifikasi->stage2hasilobservasi ?? '') }}" />
                                                        @error('stage2hasilobservasi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>Tindak Lanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" name="stage2tindaklanjut" id="stage2tindaklanjut" cols="30" rows="5">{{ old('stage2tindaklanjut', $evaluasisatusiklussertifikasi->stage2tindaklanjut ?? '') }}</textarea>
                                                        @error('stage2tindaklanjut')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="card-title mb-3 mt-5">TAHAPAN : Survailen I</h6>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Tanggal Audit</label>
                                                    <div class="col-sm-12">
                                                        <input type="date"
                                                            class="form-control mt-1 @error('survailen1tanggalaudit') is-invalid @enderror"
                                                            id="survailen1tanggalaudit" name="survailen1tanggalaudit"
                                                            value="{{ old('survailen1tanggalaudit', $evaluasisatusiklussertifikasi->survailen1tanggalaudit ?? '') }}" />
                                                        @error('survailen1tanggalaudit')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group row">
                                                    <label>Hasil: Major</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('survailen1hasilmajor') is-invalid @enderror mt-1"
                                                            id="survailen1hasilmajor" name="survailen1hasilmajor"
                                                            value="{{ old('survailen1hasilmajor', $evaluasisatusiklussertifikasi->survailen1hasilmajor ?? '') }}" />
                                                        @error('survailen1hasilmajor')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group row">
                                                    <label>Hasil: Minor</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('survailen1hasilminor') is-invalid @enderror mt-1"
                                                            id="survailen1hasilminor" name="survailen1hasilminor"
                                                            value="{{ old('survailen1hasilminor', $evaluasisatusiklussertifikasi->survailen1hasilminor ?? '') }}" />
                                                        @error('survailen1hasilminor')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group row">
                                                    <label>Hasil: Observasi</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('survailen1hasilobservasi') is-invalid @enderror mt-1"
                                                            id="survailen1hasilobservasi" name="survailen1hasilobservasi"
                                                            value="{{ old('survailen1hasilobservasi', $evaluasisatusiklussertifikasi->survailen1hasilobservasi ?? '') }}" />
                                                        @error('survailen1hasilobservasi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>Tindak Lanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" name="survailen1tindaklanjut" id="survailen1tindaklanjut" cols="30"
                                                            rows="5">{{ old('survailen1tindaklanjut', $evaluasisatusiklussertifikasi->survailen1tindaklanjut ?? '') }}</textarea>
                                                        @error('survailen1tindaklanjut')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="card-title mb-3 mt-5">TAHAPAN : Survailen II</h6>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Tanggal Audit</label>
                                                    <div class="col-sm-12">
                                                        <input type="date"
                                                            class="form-control mt-1 @error('survailen2tanggalaudit') is-invalid @enderror"
                                                            id="survailen2tanggalaudit" name="survailen2tanggalaudit"
                                                            value="{{ old('survailen2tanggalaudit', $evaluasisatusiklussertifikasi->survailen2tanggalaudit ?? '') }}" />
                                                        @error('survailen2tanggalaudit')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group row">
                                                    <label>Hasil: Major</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('survailen2hasilmajor') is-invalid @enderror mt-1"
                                                            id="survailen2hasilmajor" name="survailen2hasilmajor"
                                                            value="{{ old('survailen2hasilmajor', $evaluasisatusiklussertifikasi->survailen2hasilmajor ?? '') }}" />
                                                        @error('survailen2hasilmajor')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group row">
                                                    <label>Hasil: Minor</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('survailen2hasilminor') is-invalid @enderror mt-1"
                                                            id="survailen2hasilminor" name="survailen2hasilminor"
                                                            value="{{ old('survailen2hasilminor', $evaluasisatusiklussertifikasi->survailen2hasilminor ?? '') }}" />
                                                        @error('survailen2hasilminor')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group row">
                                                    <label>Hasil: Observasi</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('survailen2hasilobservasi') is-invalid @enderror mt-1"
                                                            id="survailen2hasilobservasi" name="survailen2hasilobservasi"
                                                            value="{{ old('survailen2hasilobservasi', $evaluasisatusiklussertifikasi->survailen2hasilobservasi ?? '') }}" />
                                                        @error('survailen2hasilobservasi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>Tindak Lanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('survailen2tindaklanjut') is-invalid @enderror" name="survailen2tindaklanjut"
                                                            id="survailen2tindaklanjut" cols="30" rows="5">{{ old('survailen2tindaklanjut', $evaluasisatusiklussertifikasi->survailen2tindaklanjut ?? '') }}</textarea>
                                                        @error('survailen2tindaklanjut')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="card-title mb-3 border-bottom mt-5">OVERVIEW</h4>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>1. Apakah terdapat perubahan sistem dokumentasi klien</label>
                                                    <div class="ms-3">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label" for="overview_1">Ya</label>
                                                            <input
                                                                class="form-check-input @error('overview_1') is-invalid @enderror"
                                                                type="radio" name="overview_1" id="overview_1"
                                                                value="1"
                                                                {{ old('overview_1', $evaluasisatusiklussertifikasi->overview_1 ?? '') == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label" for="overview_1">Tidak</label>
                                                            <input
                                                                class="form-check-input @error('overview_1') is-invalid @enderror"
                                                                type="radio" name="overview_1" id="overview_1"
                                                                value="0"
                                                                {{ old('overview_1', $evaluasisatusiklussertifikasi->overview_1 ?? '') == '0' ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>2. Apakah klien menerapkan persyaratan sertifikasi secara
                                                        efektif</label>
                                                    <div class="ms-3">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label" for="overview_2">Ya</label>
                                                            <input
                                                                class="form-check-input @error('overview_2') is-invalid @enderror"
                                                                type="radio" name="overview_2" id="overview_2"
                                                                value="1"
                                                                {{ old('overview_2', $evaluasisatusiklussertifikasi->overview_2 ?? '') == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label" for="overview_2">Tidak</label>
                                                            <input
                                                                class="form-check-input @error('overview_2') is-invalid @enderror"
                                                                type="radio" name="overview_2" id="overview_2"
                                                                value="0"
                                                                {{ old('overview_2', $evaluasisatusiklussertifikasi->overview_2 ?? '') == '0' ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>3. Apakah hasil pelaksanaan audit selama satu siklus sertifikasi
                                                        terdapat temuan yang siginifikan dan berdampak kepada status
                                                        sertifikasi klien</label>
                                                    <div class="ms-3">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label" for="overview_3">Ya</label>
                                                            <input
                                                                class="form-check-input @error('overview_3') is-invalid @enderror"
                                                                type="radio" name="overview_3" id="overview_3"
                                                                value="1"
                                                                {{ old('overview_3', $evaluasisatusiklussertifikasi->overview_3 ?? '') == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label" for="overview_3">Tidak</label>
                                                            <input
                                                                class="form-check-input @error('overview_3') is-invalid @enderror"
                                                                type="radio" name="overview_3" id="overview_3"
                                                                value="0"
                                                                {{ old('overview_3', $evaluasisatusiklussertifikasi->overview_3 ?? '') == '0' ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>4. Apakah dalam pelaksanaan resertifikasi diperlukan stage I
                                                        kepada klien</label>
                                                    <div class="ms-3">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label" for="overview_4">Ya</label>
                                                            <input
                                                                class="form-check-input @error('overview_4') is-invalid @enderror"
                                                                type="radio" name="overview_4" id="overview_4"
                                                                value="1"
                                                                {{ old('overview_4', $evaluasisatusiklussertifikasi->overview_4 ?? '') == '1' ? 'checked' : '' }}>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label" for="overview_4">Tidak</label>
                                                            <input
                                                                class="form-check-input @error('overview_4') is-invalid @enderror"
                                                                type="radio" name="overview_4" id="overview_4"
                                                                value="0"
                                                                {{ old('overview_4', $evaluasisatusiklussertifikasi->overview_4 ?? '') == '0' ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>5. Jika jawaban point 4 YA, sebutkan alasannya</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('overview_5') is-invalid @enderror" name="overview_5" id="overview_5"
                                                            cols="30" rows="10">{{ old('overview_5', $evaluasisatusiklussertifikasi->overview_5 ?? '') }}</textarea>
                                                        @error('overview_5')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>6. Kesimpulan Kajian Satu Siklus Sertifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('overview_6') is-invalid @enderror" name="overview_6" id="overview_6"
                                                            cols="30" rows="10">{{ old('overview_6', $evaluasisatusiklussertifikasi->overview_6 ?? '') }}</textarea>
                                                        @error('overview_6')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>Catatan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('catatan') is-invalid @enderror" name="catatan" id="catatan" cols="30"
                                                            rows="5">{{ old('catatan', $evaluasisatusiklussertifikasi->catatan ?? '') }}</textarea>
                                                        @error('catatan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt-5">
                                            <h6 class="card-title border-bottom mb-4">TANGGAL TTD</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="tgl_ttd">Tanggal</label>
                                                        <input
                                                            class="form-control mt-1 @error('tgl_ttd') is-invalid @enderror"
                                                            name="tgl_ttd" type="date" id="tgl_ttd"
                                                            value="{{ old('tgl_ttd', $evaluasisatusiklussertifikasi->tgl_ttd ?? '') }}" />
                                                        @error('tgl_ttd')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="nama_ttd">Manager Sertifikasi</label>
                                                        <input
                                                            class="form-control mt-1 @error('nama_ttd') is-invalid @enderror"
                                                            name="nama_ttd" type="text" id="nama_ttd"
                                                            value="{{ old('nama_ttd', $evaluasisatusiklussertifikasi->nama_ttd ?? '') }}" />
                                                        @error('nama_ttd')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($evaluasisatusiklussertifikasi == '')
                                            @if (in_array('F-CER-13 - Evaluasi Satu Siklus Sertifikasi.store', $roles))
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    Simpan
                                                </button>
                                            @endif
                                        @elseif ($evaluasisatusiklussertifikasi->status != 2)
                                            @if (in_array('F-CER-13 - Evaluasi Satu Siklus Sertifikasi.update', $roles))
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    Simpan
                                                </button>
                                            @endif
                                        @endif

                                        @if ($evaluasisatusiklussertifikasi)
                                            @if (in_array('F-CER-13 - Evaluasi Satu Siklus Sertifikasi.download', $roles))
                                                <a href="/dashboard/evaluasisatusiklussertifikasis/download/{{ $evaluasisatusiklussertifikasi->id }}"
                                                    class="btn btn-secondary" target='_blank'>
                                                    Download
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @if ($evaluasisatusiklussertifikasi)
                    <form
                        action="/dashboard/evaluasisatusiklussertifikasisvalidasi{{ $evaluasisatusiklussertifikasi ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($evaluasisatusiklussertifikasi)
                            @method('PUT')
                        @endif

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="col-12 grid-margin stretch-card">
                                    <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                                    <input type="hidden" id="status"
                                        value="{{ $evaluasisatusiklussertifikasi->status ?? '' }}">
                                    <div class="card-body">
                                        <h4 class="card-title">Status</h4>
                                        @if (in_array('F-CER-13 - Evaluasi Satu Siklus Sertifikasi.validasi', $roles))
                                            <select name="status" id="status"
                                                class="form-control mt-1 @error('status') is-invalid @enderror">
                                                <option value="">:: Pilih ::</option>
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                                    Menunggu
                                                </option>
                                                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>
                                                    Diterima
                                                </option>
                                                <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>
                                                    Dipending
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
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                                    Menunggu
                                                </option>
                                                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>
                                                    Diterima
                                                </option>
                                                <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>
                                                    Dipending
                                                </option>
                                            </select>
                                            @if ($evaluasisatusiklussertifikasi->dipending_keterangan)
                                                <label class="mt-3">Keterangan</label>
                                                <div>
                                                    <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                                        disabled>{{ $evaluasisatusiklussertifikasi->dipending_keterangan }}</textarea>
                                                </div>
                                                <button name="status" value="1" type="submit"
                                                    class="btn btn-warning mt-3">Simpan Status Revisi</button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
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
                    let status = response.evaluasisatusiklussertifikasi.dipending_keterangan ?? '';

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
                        let status = response.evaluasisatusiklussertifikasi
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
