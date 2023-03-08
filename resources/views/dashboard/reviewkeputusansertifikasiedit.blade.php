@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/reviewkeputusansertifikasis{{ $reviewkeputusansertifikasi ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
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

                            @if ($reviewkeputusansertifikasi)
                                @method('PUT')
                            @endif

                            <input type="hidden" value="{{ $client->id }}" name="client_id">
                            <input type="hidden" value="{{ $listpermohonan_id->id }}" name="listpermohonan_id">

                            <div class="col-12 grid-margin stretch-card">
                                <div>
                                    <div class="card-body">
                                        <h4 style="text-align: center;" class="card-title mb-3 border-bottom mb-4">
                                            REVIEW KEPUTUSAN SERTIFIKASI
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Nama Pemohonan</label>
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
                                                            value="{{ old('b1_lingkup', $permohonansertifikasi->ruang_lingkup_perusahaan ?? '') }}"
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

                                        <h6 class="card-title mb-3 border-bottom mb-4">AUDIT</h6>
                                        <div class="col-sm-12 mb-3">
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('audit') is-invalid @enderror"
                                                                name="audit" id="audit" value="pra_audit"
                                                                {{ old('pra_audit', $arraudit[0] ?? '') == 'pra_audit' ? 'checked' : '' }}
                                                                disabled />
                                                            Pra Audit
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('audit') is-invalid @enderror"
                                                                name="audit" id="audit" value="stage1"
                                                                {{ old('stage1', $arraudit[1] ?? '') == 'stage1' ? 'checked' : '' }}
                                                                disabled />
                                                            Stage 1
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('audit') is-invalid @enderror"
                                                                name="audit" id="audit" value="stage2"
                                                                {{ old('stage2', $arraudit[2] ?? '') == 'stage2' ? 'checked' : '' }}
                                                                disabled />
                                                            Stage 2
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('audit') is-invalid @enderror"
                                                                name="audit" id="audit" value="surveilen"
                                                                {{ old('surveilen', $arraudit[3] ?? '') == 'surveilen' ? 'checked' : '' }}
                                                                disabled />
                                                            Surveilan
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('audit') is-invalid @enderror"
                                                                name="audit" id="audit" value="tindaklanjut"
                                                                {{ old('tindaklanjut', $arraudit[4] ?? '') == 'tindaklanjut' ? 'checked' : '' }}
                                                                disabled />
                                                            Tindaklanjut
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 mb-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('audit') is-invalid @enderror"
                                                                name="audit" id="audit" value="resertifikasi"
                                                                {{ old('resertifikasi', $arraudit[5] ?? '') == 'resertifikasi' ? 'checked' : '' }}
                                                                disabled />
                                                            Resertifikasi
                                                        </label>
                                                    </div>
                                                </div>
                                                @error('audit')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control" rows="5" placeholder="Deskripsi Singkat Pemohon:"
                                                            id="deskripsi_pemohon" name="deskripsi_pemohon">{{ old('deskripsi_pemohon', $reviewkeputusansertifikasi->deskripsi_pemohon ?? '') }}</textarea>
                                                        @error('deskripsi_pemohon')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title mb-3 border-bottom mb-4">A. Kelengkapan Hasil Audit
                                            </h6>
                                            <label for="">1. Dokumen yang disampaikan oleh tim telah
                                                lengkap:</label>
                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label"> Laporan audit
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a1_1') is-invalid @enderror"
                                                                    name="kriteria_a1_1" id="kriteria_a1_1"
                                                                    value="1"
                                                                    {{ old('kriteria_a1_1', $reviewkeputusansertifikasi->kriteria_a1_1 ?? '') == '1' ? 'checked' : '' }} />
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a1_1') is-invalid @enderror"
                                                                    name="kriteria_a1_1" id="kriteria_a1_1"
                                                                    value="0"
                                                                    {{ old('kriteria_a1_1', $reviewkeputusansertifikasi->kriteria_a1_1 ?? '') == '0' ? 'checked' : '' }} />
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('kriteria_a1_1')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label"> Hasil verifikasi
                                                        ketidaksesuaian
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a1_2') is-invalid @enderror"
                                                                    name="kriteria_a1_2" id="kriteria_a1_2"
                                                                    value="1"
                                                                    {{ old('kriteria_a1_2', $reviewkeputusansertifikasi->kriteria_a1_2 ?? '') == '1' ? 'checked' : '' }} />
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a1_2') is-invalid @enderror"
                                                                    name="kriteria_a1_2" id="kriteria_a1_2"
                                                                    value="0"
                                                                    {{ old('kriteria_a1_2', $reviewkeputusansertifikasi->kriteria_a1_2 ?? '') == '0' ? 'checked' : '' }} />
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('kriteria_a1_2')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>


                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label"> Rekomendasi tim audit
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a1_3') is-invalid @enderror"
                                                                    name="kriteria_a1_3" id="kriteria_a1_3"
                                                                    value="1"
                                                                    {{ old('kriteria_a1_3', $reviewkeputusansertifikasi->kriteria_a1_3 ?? '') == '1' ? 'checked' : '' }} />
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a1_3') is-invalid @enderror"
                                                                    name="kriteria_a1_3" id="kriteria_a1_3"
                                                                    value="0"
                                                                    {{ old('kriteria_a1_3', $reviewkeputusansertifikasi->kriteria_a1_3 ?? '') == '0' ? 'checked' : '' }} />
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('kriteria_a1_3')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label"> 2. Ketidaksesuaian telah
                                                        diperbaiki oleh pemohon
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a2') is-invalid @enderror"
                                                                    name="kriteria_a2" id="kriteria_a2" value="1"
                                                                    {{ old('kriteria_a2', $reviewkeputusansertifikasi->kriteria_a2 ?? '') == '1' ? 'checked' : '' }} />
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a2') is-invalid @enderror"
                                                                    name="kriteria_a2" id="kriteria_a2" value="0"
                                                                    {{ old('kriteria_a2', $reviewkeputusansertifikasi->kriteria_a2 ?? '') == '0' ? 'checked' : '' }} />
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('kriteria_a2')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label"> 3. Ketidaksesuaian masih
                                                        ada yang berstatus open
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a3') is-invalid @enderror"
                                                                    name="kriteria_a3" id="kriteria_a3" value="1"
                                                                    {{ old('kriteria_a3', $reviewkeputusansertifikasi->kriteria_a3 ?? '') == '1' ? 'checked' : '' }} />
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a3') is-invalid @enderror"
                                                                    name="kriteria_a3" id="kriteria_a3" value="0"
                                                                    {{ old('kriteria_a3', $reviewkeputusansertifikasi->kriteria_a3 ?? '') == '0' ? 'checked' : '' }} />
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('kriteria_a3')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label">4. seluruh ketidaksesuaian
                                                        telah diverifikasi oleh tim auditor, sebutkan
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a4') is-invalid @enderror"
                                                                    name="kriteria_a4" id="kriteria_a4" value="1"
                                                                    {{ old('kriteria_a4', $reviewkeputusansertifikasi->kriteria_a4 ?? '') == '1' ? 'checked' : '' }} />
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a4') is-invalid @enderror"
                                                                    name="kriteria_a4" id="kriteria_a4" value="0"
                                                                    {{ old('kriteria_a4', $reviewkeputusansertifikasi->kriteria_a4 ?? '') == '0' ? 'checked' : '' }} />
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('kriteria_a4')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group row">
                                                    <label>Sebutkan tanggal verifikasi (closing temuan)</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('kriteria_a4_1') is-invalid @enderror"
                                                            id="kriteria_a4_1" name="kriteria_a4_1"
                                                            value="{{ old('kriteria_a4_1', $reviewkeputusansertifikasi->kriteria_a4_1 ?? '') }}" />
                                                        @error('kriteria_a4_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label">5. Mandays audit sesuai
                                                        dengan ketentuan
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a5') is-invalid @enderror"
                                                                    name="kriteria_a5" id="kriteria_a5" value="1"
                                                                    {{ old('kriteria_a5', $reviewkeputusansertifikasi->kriteria_a5 ?? '') == '1' ? 'checked' : '' }} />
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a5') is-invalid @enderror"
                                                                    name="kriteria_a5" id="kriteria_a5" value="0"
                                                                    {{ old('kriteria_a5', $reviewkeputusansertifikasi->kriteria_a5 ?? '') == '0' ? 'checked' : '' }} />
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('kriteria_a5')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group row">
                                                    <label>Jumlah mandays audit actual</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('kriteria_a5_1') is-invalid @enderror"
                                                            id="kriteria_a5_1" name="kriteria_a5_1"
                                                            value="{{ old('kriteria_a5_1', $reviewkeputusansertifikasi->kriteria_a5_1 ?? '') }}" />
                                                        @error('kriteria_a5_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label">6. Apakah ruang lingkup
                                                        permohonan sesuai dengan bisnis proses klien
                                                        yang diaudit
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a6') is-invalid @enderror"
                                                                    name="kriteria_a6" id="kriteria_a6" value="1"
                                                                    {{ old('kriteria_a6', $reviewkeputusansertifikasi->kriteria_a6 ?? '') == '1' ? 'checked' : '' }} />
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a6') is-invalid @enderror"
                                                                    name="kriteria_a6" id="kriteria_a6" value="0"
                                                                    {{ old('kriteria_a6', $reviewkeputusansertifikasi->kriteria_a6 ?? '') == '0' ? 'checked' : '' }} />
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('kriteria_a6')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group row">
                                                    <label>Sebutkan lingkup proses bisnis klien yang diaudit</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control mt-1 " id="kriteria_a6_1" rows="5" name="kriteria_a6_1">{{ old('kriteria_a6_1', $reviewkeputusansertifikasi->kriteria_a6_1 ?? '') }}</textarea>
                                                        @error('kriteria_a6_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label">7. Apakah tujuan
                                                        pelaksanaan audit telah tercapai
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a7') is-invalid @enderror"
                                                                    name="kriteria_a7" id="kriteria_a7" value="1"
                                                                    {{ old('kriteria_a7', $reviewkeputusansertifikasi->kriteria_a7 ?? '') == '1' ? 'checked' : '' }} />
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a7') is-invalid @enderror"
                                                                    name="kriteria_a7" id="kriteria_a7" value="0"
                                                                    {{ old('kriteria_a7', $reviewkeputusansertifikasi->kriteria_a7 ?? '') == '0' ? 'checked' : '' }} />
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('kriteria_a7')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <label for="">Sebutkan tujuan audit:</label>
                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a7_1') is-invalid @enderror"
                                                                    name="kriteria_a7_1" id="kriteria_a7_1"
                                                                    value="Tahap II"
                                                                    {{ old('kriteria_a7_1', $reviewkeputusansertifikasi->kriteria_a7_1 ?? '') == 'Tahap II' ? 'checked' : '' }} />
                                                                Tahap II
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a7_1') is-invalid @enderror"
                                                                    name="kriteria_a7_1" id="kriteria_a7_1"
                                                                    value="Pemeliharaan"
                                                                    {{ old('kriteria_a7_1', $reviewkeputusansertifikasi->kriteria_a7_1 ?? '') == 'Pemeliharaan' ? 'checked' : '' }} />
                                                                Pemeliharaan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a7_1') is-invalid @enderror"
                                                                    name="kriteria_a7_1" id="kriteria_a7_1"
                                                                    value="Resertifikasi"
                                                                    {{ old('kriteria_a7_1', $reviewkeputusansertifikasi->kriteria_a7_1 ?? '') == 'Resertifikasi' ? 'checked' : '' }} />
                                                                Resertifikasi
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a7_1') is-invalid @enderror"
                                                                    name="kriteria_a7_1" id="kriteria_a7_1"
                                                                    value="Perluasan"
                                                                    {{ old('kriteria_a7_1', $reviewkeputusansertifikasi->kriteria_a7_1 ?? '') == 'Perluasan' ? 'checked' : '' }} />
                                                                Perluasan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 mb-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a7_1') is-invalid @enderror"
                                                                    name="kriteria_a7_1" id="kriteria_a7_1"
                                                                    value="Short Notice Audit"
                                                                    {{ old('kriteria_a7_1', $reviewkeputusansertifikasi->kriteria_a7_1 ?? '') == 'Short Notice Audit' ? 'checked' : '' }} />
                                                                Short Notice Audit
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('kriteria_a7_1')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <label for="">8. Khusus Resertifikasi:
                                            </label>
                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label"> Apakah review kinerja satu
                                                        siklus klien telah ditetapkan
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a8_1') is-invalid @enderror"
                                                                    name="kriteria_a8_1" id="kriteria_a8_1"
                                                                    value="1"
                                                                    {{ old('kriteria_a8_1', $reviewkeputusansertifikasi->kriteria_a8_1 ?? '') == '1' ? 'checked' : '' }} />
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a8_1') is-invalid @enderror"
                                                                    name="kriteria_a8_1" id="kriteria_a8_1"
                                                                    value="0"
                                                                    {{ old('kriteria_a8_1', $reviewkeputusansertifikasi->kriteria_a8_1 ?? '') == '0' ? 'checked' : '' }} />
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('kriteria_a8_1')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label">Apakah ada improvement
                                                        terhadap penerapan sistem manajemen klien
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a8_2') is-invalid @enderror"
                                                                    name="kriteria_a8_2" id="kriteria_a8_2"
                                                                    value="1"
                                                                    {{ old('kriteria_a8_2', $reviewkeputusansertifikasi->kriteria_a8_2 ?? '') == '1' ? 'checked' : '' }} />
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a8_2') is-invalid @enderror"
                                                                    name="kriteria_a8_2" id="kriteria_a8_2"
                                                                    value="0"
                                                                    {{ old('kriteria_a8_2', $reviewkeputusansertifikasi->kriteria_a8_2 ?? '') == '0' ? 'checked' : '' }} />
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('kriteria_a8_2')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label">Apakah dilakukan audit
                                                        tahap 1 dalam rangka resertifikasi

                                                    </label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a8_3') is-invalid @enderror"
                                                                    name="kriteria_a8_3" id="kriteria_a8_3"
                                                                    value="1"
                                                                    {{ old('kriteria_a8_3', $reviewkeputusansertifikasi->kriteria_a8_3 ?? '') == '1' ? 'checked' : '' }} />
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a8_3') is-invalid @enderror"
                                                                    name="kriteria_a8_3" id="kriteria_a8_3"
                                                                    value="0"
                                                                    {{ old('kriteria_a8_3', $reviewkeputusansertifikasi->kriteria_a8_3 ?? '') == '0' ? 'checked' : '' }} />
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('kriteria_a8_3')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label">9. Rekomendasi tim audit
                                                        terhadap hasil audit yang telah dilaksanakan
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a9') is-invalid @enderror"
                                                                    name="kriteria_a9" id="kriteria_a9" value="1"
                                                                    {{ old('kriteria_a9', $reviewkeputusansertifikasi->kriteria_a9 ?? '') == '1' ? 'checked' : '' }} />
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('kriteria_a9') is-invalid @enderror"
                                                                    name="kriteria_a9" id="kriteria_a9" value="0"
                                                                    {{ old('kriteria_a9', $reviewkeputusansertifikasi->kriteria_a9 ?? '') == '0' ? 'checked' : '' }} />
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('kriteria_a9')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group row">
                                                    <label>Keputusan Sertifikasi:</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control mt-1 " id="keputusan_sertifikasi" rows="5"
                                                            name="keputusan_sertifikasi">{{ old('keputusan_sertifikasi', $reviewkeputusansertifikasi->keputusan_sertifikasi ?? '') }}</textarea>
                                                        @error('keputusan_sertifikasi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group row">
                                                    <label>Catatan:</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control mt-1 " id="catatan" rows="5" name="catatan">{{ old('catatan', $reviewkeputusansertifikasi->catatan ?? '') }}</textarea>
                                                        @error('catatan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt-3">
                                            <h6 class="card-title border-bottom mb-4">TANGGAL TTD</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="tanggal_pengambilkeputusan">Tanggal Pengambil
                                                            Keputusan</label>
                                                        <input
                                                            class="form-control mt-1 @error('tanggal_pengambilkeputusan') is-invalid @enderror"
                                                            name="tanggal_pengambilkeputusan" type="date"
                                                            id="tanggal_pengambilkeputusan"
                                                            value="{{ old('tanggal_pengambilkeputusan', $reviewkeputusansertifikasi->tanggal_pengambilkeputusan ?? '') }}" />
                                                        @error('tanggal_pengambilkeputusan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="nama_pengambilkeputusan">Nama Pengambil
                                                            Keputusan</label>
                                                        <input
                                                            class="form-control mt-1 @error('nama_pengambilkeputusan') is-invalid @enderror"
                                                            name="nama_pengambilkeputusan" type="text"
                                                            id="nama_pengambilkeputusan"
                                                            value="{{ old('nama_pengambilkeputusan', $reviewkeputusansertifikasi->nama_pengambilkeputusan ?? '') }}" />
                                                        @error('nama_pengambilkeputusan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="nama_ttd">Nama Lead
                                                            Auditor/Auditor/Tenaga
                                                            Ahli</label>
                                                        <input
                                                            class="form-control mt-1 @error('nama_ttd') is-invalid @enderror"
                                                            name="nama_ttd" type="text" id="nama_ttd"
                                                            value="{{ old('nama_ttd', $reviewkeputusansertifikasi->nama_ttd ?? '') }}" />
                                                        @error('nama_ttd')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($reviewkeputusansertifikasi == '')
                                            @if (in_array('F-CER-11 - Review Keputusan Sertifikasi.store', $roles))
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    Simpan
                                                </button>
                                            @endif
                                        @elseif ($reviewkeputusansertifikasi->status != 2)
                                            @if (in_array('F-CER-11 - Review Keputusan Sertifikasi.update', $roles))
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    Simpan
                                                </button>
                                            @endif
                                        @endif

                                        @if ($reviewkeputusansertifikasi)
                                            @if (in_array('F-CER-11 - Review Keputusan Sertifikasi.download', $roles))
                                                <a href="/dashboard/reviewkeputusansertifikasis/download/{{ $reviewkeputusansertifikasi->id }}"
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
                @if ($reviewkeputusansertifikasi)
                    <form
                        action="/dashboard/reviewkeputusansertifikasisvalidasi{{ $reviewkeputusansertifikasi ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($reviewkeputusansertifikasi)
                            @method('PUT')
                        @endif

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="col-12 grid-margin stretch-card">
                                    <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                                    <input type="hidden" id="status"
                                        value="{{ $reviewkeputusansertifikasi->status ?? '' }}">
                                    <div class="card-body">
                                        <h4 class="card-title">Status</h4>
                                        @if (in_array('F-CER-11 - Review Keputusan Sertifikasi.validasi', $roles))
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
                                            @if ($reviewkeputusansertifikasi->dipending_keterangan)
                                                <label class="mt-3">Keterangan</label>
                                                <div>
                                                    <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                                        disabled>{{ $reviewkeputusansertifikasi->dipending_keterangan }}</textarea>
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
                    let status = response.reviewkeputusansertifikasi.dipending_keterangan ?? '';

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
                        let status = response.reviewkeputusansertifikasi
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
