@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/stage2laporanaudits{{ $stage2laporanaudit ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                    method="post">
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

                            @if ($stage2laporanaudit)
                                @method('PUT')
                            @endif

                            <input type="hidden" value="{{ $client->id }}" name="client_id">
                            <input type="hidden" value="{{ $listpermohonan_id->id }}" name="listpermohonan_id">
                            <input type="hidden" value="{{ $listpermohonan_id->slug }}" name="listpermohonan_slug">

                            <div class="col-12 grid-margin stretch-card">
                                <div>
                                    <div class="card-body">
                                        <h4 style="text-align: center;" class="card-title mb-3 border-bottom mb-4">LAPORAN
                                            AUDIT
                                        </h4>
                                        <form class="forms-sample">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label>Nama Pemohon</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control @error('nama_client') is-invalid @enderror mt-1"
                                                                id="nama_client" name="nama_client"
                                                                value="{{ old('nama_client', $permohonansertifikasi->nama_pimpinan ?? '') }}"
                                                                readonly />
                                                            @error('nama_client')
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
                                                            <input type="text" class="form-control mt-1"
                                                                value="{{ old('standart', $permohonansertifikasi->alamat ?? '') }}"
                                                                readonly />
                                                            <div class="invalid-feedback">

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label>Wakil Manajemen</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control mt-1"
                                                                value="{{ old('nama_wakil', $permohonansertifikasi->nama_wakil ?? '') }}"
                                                                readonly />
                                                            <div class="invalid-feedback">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
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
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label>Standart</label>
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
                                                                <input type="checkbox"
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
                                                                <input type="checkbox" class="form-check-input"
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
                                                                <input type="checkbox" class="form-check-input"
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
                                                                <input type="checkbox" class="form-check-input"
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
                                                                <input type="checkbox" class="form-check-input"
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
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="audit" id="audit" value="resertifikasi"
                                                                    {{ old('resertifikasi', $arraudit[5] ?? '') == 'resertifikasi' ? 'checked' : '' }}
                                                                    disabled />
                                                                Resertifikasi
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Nama Auditor</label>
                                                        <?php
                                                        $user = new App\Models\User();
                                                        $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor)->first();
                                                        ?>
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('nama_auditor') is-invalid @enderror"
                                                                id="nama_auditor" name="nama_auditor"
                                                                value="{{ old('nama_auditor', $stage1penunjukantimaudit->nama_auditor ? $userid->name : '') }}"
                                                                readonly />
                                                            @error('nama_auditor')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Nama Inisial</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('nama_inisial') is-invalid @enderror"
                                                                id="nama_inisial" name="nama_inisial"
                                                                value="{{ old('nama_inisial', $stage1penunjukantimaudit->nama_inisial ?? '') }}"
                                                                readonly />
                                                            @error('nama_inisial')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Jabatan</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('jabatan') is-invalid @enderror"
                                                                id="jabatan" name="jabatan"
                                                                value="{{ old('jabatan', $stage1penunjukantimaudit->jabatan ?? '') }}"
                                                                readonly />
                                                            @error('jabatan')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <?php
                                                            $user = new App\Models\User();
                                                            $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor2)->first();
                                                            ?>
                                                            <input type="text"
                                                                class="form-control mt-1 @error('nama_auditor2') is-invalid @enderror"
                                                                id="nama_auditor2" name="nama_auditor2"
                                                                placeholder="optional"
                                                                value="{{ old('nama_auditor2', $stage1penunjukantimaudit->nama_auditor2 ? $userid->name : '') }}"
                                                                readonly />
                                                            @error('nama_auditor2')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('nama_inisial2') is-invalid @enderror"
                                                                id="nama_inisial2" name="nama_inisial2"
                                                                placeholder="optional"
                                                                value="{{ old('nama_inisial2', $stage1penunjukantimaudit->nama_inisial2 ?? '') }}"
                                                                readonly />
                                                            @error('nama_inisial2')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('jabatan2') is-invalid @enderror"
                                                                id="jabatan2" name="jabatan2" placeholder="optional"
                                                                value="{{ old('jabatan2', $stage1penunjukantimaudit->jabatan2 ?? '') }}"
                                                                readonly />
                                                            @error('jabatan2')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <?php
                                                            $user = new App\Models\User();
                                                            $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor3)->first();
                                                            ?>
                                                            <input type="text"
                                                                class="form-control mt-1 @error('nama_auditor3') is-invalid @enderror"
                                                                id="nama_auditor3" name="nama_auditor3"
                                                                placeholder="optional"
                                                                value="{{ old('nama_auditor3', $stage1penunjukantimaudit->nama_auditor3 ? $userid->name : '') }}"
                                                                readonly />
                                                            @error('nama_auditor3')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('nama_inisial3') is-invalid @enderror"
                                                                id="nama_inisial3" name="nama_inisial3"
                                                                placeholder="optional"
                                                                value="{{ old('nama_inisial3', $stage1penunjukantimaudit->nama_inisial3 ?? '') }}"
                                                                readonly />
                                                            @error('nama_inisial3')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('jabatan3') is-invalid @enderror"
                                                                id="jabatan3" name="jabatan3" placeholder="optional"
                                                                value="{{ old('jabatan3', $stage1penunjukantimaudit->jabatan3 ?? '') }}"
                                                                readonly />
                                                            @error('jabatan3')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label>Untuk Bertugas Tanggal</label>
                                                        <div class="col-sm-12">
                                                            <input
                                                                class="form-control mt-1 @error('tanggal_bertugas') is-invalid @enderror"
                                                                name="tanggal_bertugas" type="date"
                                                                id="tanggal_bertugas"
                                                                value="{{ old('tanggal_bertugas', isset($stage1penunjukantimaudit->tanggal_bertugas) ? date('Y-m-d', strtotime($stage1penunjukantimaudit->tanggal_bertugas)) : '') }}"
                                                                readonly />
                                                            @error('tanggal_bertugas')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group row">
                                                        <label>Sampai Dengan</label>
                                                        <div class="col-sm-12">
                                                            <input
                                                                class="form-control mt-1 @error('sampai_dengan') is-invalid @enderror"
                                                                name="sampai_dengan" type="date" id="sampai_dengan"
                                                                value="{{ old('sampai_dengan', isset($stage1penunjukantimaudit->sampai_dengan) ? date('Y-m-d', strtotime($stage1penunjukantimaudit->sampai_dengan)) : '') }}"
                                                                readonly />
                                                            @error('sampai_dengan')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <H4 style="text-align: center;" class="mb-3 mt-5">Ringkasan Temuan Audit</H4>
                                            <h4 class="card-title border-bottom">
                                                1. Jumlah Temuan
                                            </h4>
                                            <div class="row">
                                                <label class="col-sm-12 col-form-label">
                                                    Apakah perlu kunjungan tambahan
                                                </label>
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label>Alasan Kunjungan Tambahan:</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('jumlahtemuan_1') is-invalid @enderror" name="jumlahtemuan_1"
                                                                id="jumlahtemuan_1">{{ old('jumlahtemuan_1', $stage2laporanaudit->jumlahtemuan_1 ?? '') }}</textarea>
                                                            @error('jumlahtemuan_1')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="card-title border-bottom mt-3">
                                                2. Major:
                                            </h4>
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('major_2') is-invalid @enderror"
                                                                name="major_2" id="major_2" value="1"
                                                                {{ old('major_2', $stage2laporanaudit->major_2 ?? '') == 1 ? 'checked' : '' }} />
                                                            YA
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('major_2') is-invalid @enderror"
                                                                name="major_2" id="major_2" value="0"
                                                                {{ old('major_2', $stage2laporanaudit->major_2 ?? '') == 0 ? 'checked' : '' }} />
                                                            TIDAK
                                                        </label>
                                                    </div>
                                                </div>
                                                @error('major_2')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <h4 class="card-title border-bottom mt-3">
                                                3. Minor:
                                            </h4>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label>Rencana Kunjungan:</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('rencanakunjungan_3') is-invalid @enderror" name="rencanakunjungan_3"
                                                                id="rencanakunjungan_3">{{ old('rencanakunjungan_3', $stage2laporanaudit->rencanakunjungan_3 ?? '') }}</textarea>
                                                            @error('rencanakunjungan_3')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mt-3">
                                                4. Obsevasi:
                                            </h4>

                                            <div class="row mt-3 mb-5">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input
                                                                class="form-control mt-1 @error('observasi_4') is-invalid @enderror"
                                                                name="observasi_4" type="date" id="observasi_4"
                                                                value="{{ old('observasi_4', isset($stage2laporanaudit->observasi_4) ? date('Y-m-d', strtotime($stage2laporanaudit->observasi_4)) : '') }}" />
                                                            @error('observasi_4')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <H4 style="text-align: center;" class="mb-4">Rekomendasi</H4>
                                            <h4 class="card-title border-bottom">

                                            </h4>

                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('rekomendasi') is-invalid @enderror"
                                                                type="radio" name="rekomendasi" id="rekomendasi"
                                                                value="1"
                                                                {{ old('rekomendasi', $stage2laporanaudit->rekomendasi ?? '') == 1 ? 'checked' : '' }}>
                                                            Direkomendasikan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('rekomendasi') is-invalid @enderror"
                                                                type="radio" name="rekomendasi" id="rekomendasi"
                                                                value="2"
                                                                {{ old('rekomendasi', $stage2laporanaudit->rekomendasi ?? '') == 2 ? 'checked' : '' }}>
                                                            Diproses setelah rencana tindakan perbaikan dinilai memuaskan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('rekomendasi') is-invalid @enderror"
                                                                type="radio" name="rekomendasi" id="rekomendasi"
                                                                value="3"
                                                                {{ old('rekomendasi', $stage2laporanaudit->rekomendasi ?? '') == 3 ? 'checked' : '' }}>
                                                            Dilanjutkan setelah rencana tindakan perbaikan dinilai memuaskan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('rekomendasi') is-invalid @enderror"
                                                                type="radio" name="rekomendasi" id="rekomendasi"
                                                                value="4"
                                                                {{ old('rekomendasi', $stage2laporanaudit->rekomendasi ?? '') == 4 ? 'checked' : '' }}>
                                                            Dipertahankan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('rekomendasi') is-invalid @enderror"
                                                                type="radio" name="rekomendasi" id="rekomendasi"
                                                                value="5"
                                                                {{ old('rekomendasi', $stage2laporanaudit->rekomendasi ?? '') == 5 ? 'checked' : '' }}>
                                                            Dibekukan sampai melengkapi rencana tindakan perbaikan yang
                                                            memadai
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-5">

                                                <div class="col-sm-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('rekomendasi') is-invalid @enderror"
                                                                type="radio" name="rekomendasi" id="rekomendasi"
                                                                value="6"
                                                                {{ old('rekomendasi', $stage2laporanaudit->rekomendasi ?? '') == 6 ? 'checked' : '' }}>
                                                            Dicabut
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <H4 style="text-align: center;" class="mb-4">Ruang Lingkup</H4>
                                            <h4 class="card-title border-bottom"></h4>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <textarea class="form-control" cols="30" rows="10" readonly>{{ $permohonansertifikasi->ruang_lingkup_perusahaan }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Akreditasi</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('rl_akreditasi1') is-invalid @enderror"
                                                                id="rl_akreditasi1" name="rl_akreditasi1"
                                                                value="{{ old('rl_akreditasi1', $stage2laporanaudit->rl_akreditasi1 ?? '') }}" />
                                                            @error('rl_akreditasi1')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Jumlah Sertifikat</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('rl_jmlsertifikat1') is-invalid @enderror"
                                                                id="rl_jmlsertifikat1" name="rl_jmlsertifikat1"
                                                                value="{{ old('rl_jmlsertifikat1', $stage2laporanaudit->rl_jmlsertifikat1 ?? '') }}" />
                                                            @error('rl_jmlsertifikat1')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Bahasa</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('rl_bahasa1') is-invalid @enderror"
                                                                id="rl_bahasa1" name="rl_bahasa1"
                                                                value="{{ old('rl_bahasa1', $stage2laporanaudit->rl_bahasa1 ?? '') }}" />
                                                            @error('rl_bahasa1')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('rl_akreditasi2') is-invalid @enderror"
                                                                id="rl_akreditasi2" name="rl_akreditasi2"
                                                                placeholder="optional"
                                                                value="{{ old('rl_akreditasi2', $stage2laporanaudit->rl_akreditasi2 ?? '') }}" />
                                                            @error('rl_akreditasi2')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('rl_jmlsertifikat2') is-invalid @enderror"
                                                                id="rl_jmlsertifikat2" name="rl_jmlsertifikat2"
                                                                placeholder="optional"
                                                                value="{{ old('rl_jmlsertifikat2', $stage2laporanaudit->rl_jmlsertifikat2 ?? '') }}" />
                                                            @error('rl_jmlsertifikat2')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('rl_bahasa2') is-invalid @enderror"
                                                                id="rl_bahasa2" name="rl_bahasa2" placeholder="optional"
                                                                value="{{ old('rl_bahasa2', $stage2laporanaudit->rl_bahasa2 ?? '') }}" />
                                                            @error('rl_bahasa2')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('rl_akreditasi3') is-invalid @enderror"
                                                                id="rl_akreditasi3" name="rl_akreditasi3"
                                                                placeholder="optional"
                                                                value="{{ old('rl_akreditasi3', $stage2laporanaudit->rl_akreditasi3 ?? '') }}" />
                                                            @error('rl_akreditasi3')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('rl_jmlsertifikat3') is-invalid @enderror"
                                                                id="rl_jmlsertifikat3" name="rl_jmlsertifikat3"
                                                                placeholder="optional"
                                                                value="{{ old('rl_jmlsertifikat3', $stage2laporanaudit->rl_jmlsertifikat3 ?? '') }}" />
                                                            @error('rl_jmlsertifikat3')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 mb-5">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control mt-1 @error('rl_bahasa3') is-invalid @enderror"
                                                                id="rl_bahasa3" name="rl_bahasa3" placeholder="optional"
                                                                value="{{ old('rl_bahasa3', $stage2laporanaudit->rl_bahasa3 ?? '') }}" />
                                                            @error('rl_bahasa3')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <H4 style="text-align: center;" class="mb-4">Ringkasan Audit</H4>

                                            <div class="row mb-4">
                                                <label class="col-sm-12 col-form-label">
                                                    Hasil Audit Sebelumnya
                                                </label>

                                                <h4 class="card-title border-bottom mb-3">
                                                    1. Jumlah ketidaksesuaian audit sebelumnya
                                                </h4>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label>Major</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('ra1_major') is-invalid @enderror" name="ra1_major" id="ra1_major"
                                                                rows="4">{{ old('ra1_major', $stage2laporanaudit->ra1_major ?? '') }}</textarea>
                                                            @error('ra1_major')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group row">
                                                        <label>Minor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('ra1_minor') is-invalid @enderror" name="ra1_minor" id="ra1_minor"
                                                                rows="4">{{ old('ra1_minor', $stage2laporanaudit->ra1_minor ?? '') }}</textarea>
                                                            @error('ra1_minor')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4 class="card-title border-bottom mb-3">
                                                    2. Jumlah ketidaksesuaian yang di “closed”
                                                </h4>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label>Major</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('ra2_major') is-invalid @enderror" name="ra2_major" id="ra2_major"
                                                                rows="4">{{ old('ra2_major', $stage2laporanaudit->ra2_major ?? '') }}</textarea>
                                                            @error('ra2_major')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group row">
                                                        <label>Minor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('ra2_minor') is-invalid @enderror" name="ra2_minor" id="ra2_minor"
                                                                rows="4">{{ old('ra2_minor', $stage2laporanaudit->ra2_minor ?? '') }}</textarea>
                                                            @error('ra2_minor')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="card-title border-bottom mb-3">
                                                    3. Jumlah ketidaksesuaian berulang
                                                </h4>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label>Major</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('ra3_major') is-invalid @enderror" name="ra3_major" id="ra3_major"
                                                                rows="4">{{ old('ra3_major', $stage2laporanaudit->ra3_major ?? '') }}</textarea>
                                                            @error('ra3_major')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group row">
                                                        <label>Minor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('ra3_minor') is-invalid @enderror" name="ra3_minor" id="ra3_minor"
                                                                rows="4">{{ old('ra3_minor', $stage2laporanaudit->ra3_minor ?? '') }}</textarea>
                                                            @error('ra3_minor')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <H4 style="text-align: center;">Rincian Observasi</H4>
                                            <label class="col-sm-12 col-form-label">
                                                Uraian
                                            </label>

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('ro_uraian1') is-invalid @enderror" name="ro_uraian1" id="ro_uraian1"
                                                                rows="4">{{ old('ro_uraian1', $stage2laporanaudit->ro_uraian1 ?? '') }}</textarea>
                                                            @error('ro_uraian1')
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
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('ro_uraian2') is-invalid @enderror" name="ro_uraian2" id="ro_uraian2"
                                                                rows="4">{{ old('ro_uraian2', $stage2laporanaudit->ro_uraian2 ?? '') }}</textarea>
                                                            @error('ro_uraian2')
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
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('ro_uraian3') is-invalid @enderror" name="ro_uraian3" id="ro_uraian3"
                                                                rows="4">{{ old('ro_uraian3', $stage2laporanaudit->ro_uraian3 ?? '') }}</textarea>
                                                            @error('ro_uraian3')
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
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('ro_uraian4') is-invalid @enderror" name="ro_uraian4" id="ro_uraian4"
                                                                rows="4">{{ old('ro_uraian4', $stage2laporanaudit->ro_uraian4 ?? '') }}</textarea>
                                                            @error('ro_uraian4')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <H4 style="text-align: center;" class="mb-4 mt-5">Kesimpulan Hasil Audit</H4>
                                            <h4 class="card-title border-bottom mt-5 mb-3">
                                                Kesesuaian dan efektifitas dari sistem manajemen
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3">
                                                Apakah kemampuan sistem manajemen untuk memenuhi persyaratan dan keluaran
                                                yang diharapkan
                                            </h4>

                                            <div class="form-group row">

                                                <div class="col-sm-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('kha_1') is-invalid @enderror"
                                                                type="radio" name="kha_1" id="kha_1"
                                                                value="Memenuhi"
                                                                {{ old('kha_1', $stage2laporanaudit->kha_1 ?? '') == 'Memenuhi' ? 'checked' : '' }}>
                                                            Memenuhi
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('kha_1') is-invalid @enderror"
                                                                type="radio" name="kha_1" id="kha_1"
                                                                value="Belum Memenuhi"
                                                                {{ old('kha_1', $stage2laporanaudit->kha_1 ?? '') == 'Belum Memenuhi' ? 'checked' : '' }}>
                                                            Belum Memenuhi
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mt-5 mb-4">
                                                Proses audit internal
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3">
                                                Kapan Pelaksanaan Audit Internal ?
                                            </h4>

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('pai_kapanpelaksanaan') is-invalid @enderror" name="pai_kapanpelaksanaan"
                                                                id="pai_kapanpelaksanaan" rows="10">{{ old('pai_kapanpelaksanaan', $stage2laporanaudit->pai_kapanpelaksanaan ?? '') }}</textarea>
                                                            @error('pai_kapanpelaksanaan')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3">
                                                Jumlah temuan audit internal?
                                            </h4>

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('pai_jumlahtemuan') is-invalid @enderror" name="pai_jumlahtemuan"
                                                                id="pai_jumlahtemuan" rows="10">{{ old('pai_jumlahtemuan', $stage2laporanaudit->pai_jumlahtemuan ?? '') }}</textarea>
                                                            @error('pai_jumlahtemuan')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3">
                                                Apakah temuan audit internal telah ditindaklanjuti (diverifikasi dan closed
                                                out)
                                            </h4>

                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('pai_apakahtemuan') is-invalid @enderror"
                                                                type="radio" name="pai_apakahtemuan"
                                                                id="pai_apakahtemuan" value="1"
                                                                {{ old('pai_apakahtemuan', $stage2laporanaudit->pai_apakahtemuan ?? '') == 1 ? 'checked' : '' }}>
                                                            YA
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('pai_apakahtemuan') is-invalid @enderror"
                                                                type="radio" name="pai_apakahtemuan"
                                                                id="pai_apakahtemuan" value="0"
                                                                {{ old('pai_apakahtemuan', $stage2laporanaudit->pai_apakahtemuan ?? '') == 0 ? 'checked' : '' }}>
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label>jumlah yang belum ditindaklanjuti :</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('pai_jumlahyangbelum') is-invalid @enderror" name="pai_jumlahyangbelum"
                                                                id="pai_jumlahyangbelum" rows="10">{{ old('pai_jumlahyangbelum', $stage2laporanaudit->pai_jumlahyangbelum ?? '') }}</textarea>
                                                            @error('pai_jumlahyangbelum')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Apakah Audit Internal dilakukan oleh personil kompeten
                                            </h4>

                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('pai_apakahaudit') is-invalid @enderror"
                                                                type="radio" name="pai_apakahaudit"
                                                                id="pai_apakahaudit" value="1"
                                                                {{ old('pai_apakahaudit', $stage2laporanaudit->pai_apakahaudit ?? '') == 1 ? 'checked' : '' }}>
                                                            YA
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('pai_apakahaudit') is-invalid @enderror"
                                                                type="radio" name="pai_apakahaudit"
                                                                id="pai_apakahaudit" value="0"
                                                                {{ old('pai_apakahaudit', $stage2laporanaudit->pai_apakahaudit ?? '') == 0 ? 'checked' : '' }}>
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Apakah pelaksanaan internal audit efektif dilakukan
                                            </h4>

                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('pai_apakahpelaksanaan') is-invalid @enderror"
                                                                type="radio" name="pai_apakahpelaksanaan"
                                                                id="pai_apakahpelaksanaan" value="1"
                                                                {{ old('pai_apakahpelaksanaan', $stage2laporanaudit->pai_apakahpelaksanaan ?? '') == 1 ? 'checked' : '' }}>
                                                            YA
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('pai_apakahpelaksanaan') is-invalid @enderror"
                                                                type="radio" name="pai_apakahpelaksanaan"
                                                                id="pai_apakahpelaksanaan" value="0"
                                                                {{ old('pai_apakahpelaksanaan', $stage2laporanaudit->pai_apakahpelaksanaan ?? '') == 0 ? 'checked' : '' }}>
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mt-5 mb-4">
                                                Kaji ulang manajemen
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3">
                                                Kapan Pelaksanaan kaji ulang manajemen?
                                            </h4>

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('kum_kapanpelaksanaan') is-invalid @enderror" name="kum_kapanpelaksanaan"
                                                                id="kum_kapanpelaksanaan" rows="10">{{ old('kum_kapanpelaksanaan', $stage2laporanaudit->kum_kapanpelaksanaan ?? '') }}</textarea>
                                                            @error('kum_kapanpelaksanaan')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Apakah kaji ulang manajemen dihadiri top manajemen
                                            </h4>

                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('kum_apakahkaji') is-invalid @enderror"
                                                                type="radio" name="kum_apakahkaji" id="kum_apakahkaji"
                                                                value="1"
                                                                {{ old('kum_apakahkaji', $stage2laporanaudit->kum_apakahkaji ?? '') == 1 ? 'checked' : '' }}>
                                                            YA
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('kum_apakahkaji') is-invalid @enderror"
                                                                type="radio" name="kum_apakahkaji" id="kum_apakahkaji"
                                                                value="0"
                                                                {{ old('kum_apakahkaji', $stage2laporanaudit->kum_apakahkaji ?? '') == 0 ? 'checked' : '' }}>
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                                @error('kum_apakahkaji')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Apakah input dan output kaji ulang manajemen telah sesuai persyaratan
                                            </h4>

                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('kum_apakahinput') is-invalid @enderror"
                                                                type="radio" name="kum_apakahinput"
                                                                id="kum_apakahinput" value="1"
                                                                {{ old('kum_apakahinput', $stage2laporanaudit->kum_apakahinput ?? '') == 1 ? 'checked' : '' }}>
                                                            YA
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('kum_apakahinput') is-invalid @enderror"
                                                                type="radio" name="kum_apakahinput"
                                                                id="kum_apakahinput" value="0"
                                                                {{ old('kum_apakahinput', $stage2laporanaudit->kum_apakahinput ?? '') == 0 ? 'checked' : '' }}>
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                                @error('kum_apakahinput')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Apakah pelaksanaan kaji ulang manajemen efektif dilakukan
                                            </h4>

                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('kum_apakahpelaksanaan') is-invalid @enderror"
                                                                type="radio" name="kum_apakahpelaksanaan"
                                                                id="kum_apakahpelaksanaan" value="1"
                                                                {{ old('kum_apakahpelaksanaan', $stage2laporanaudit->kum_apakahpelaksanaan ?? '') == 1 ? 'checked' : '' }}>
                                                            YA
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('kum_apakahpelaksanaan') is-invalid @enderror"
                                                                type="radio" name="kum_apakahpelaksanaan"
                                                                id="kum_apakahpelaksanaan" value="0"
                                                                {{ old('kum_apakahpelaksanaan', $stage2laporanaudit->kum_apakahpelaksanaan ?? '') == 0 ? 'checked' : '' }}>
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                                @error('kum_apakahpelaksanaan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <h4 class="card-title border-bottom mt-5 mb-3">
                                                Lingkup Sertifikasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3">
                                                Sebutkan lingkup sertifikasi yang diajukan
                                            </h4>

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('ls_sebutkanlingkup') is-invalid @enderror" name="ls_sebutkanlingkup"
                                                                id="ls_sebutkanlingkup" rows="10">{{ old('ls_sebutkanlingkup', $stage2laporanaudit->ls_sebutkanlingkup ?? '') }}</textarea>
                                                            @error('ls_sebutkanlingkup')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Apakah ruang lingkup sertifikasi yang diajukan sesuai dengan bisnis proses
                                                organisasi di onsite
                                            </h4>

                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('ls_apakahruang') is-invalid @enderror"
                                                                type="radio" name="ls_apakahruang" id="ls_apakahruang"
                                                                value="1"
                                                                {{ old('ls_apakahruang', $stage2laporanaudit->ls_apakahruang ?? '') == 1 ? 'checked' : '' }}>
                                                            YA
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input
                                                                class="form-check-input @error('ls_apakahruang') is-invalid @enderror"
                                                                type="radio" name="ls_apakahruang" id="ls_apakahruang"
                                                                value="0"
                                                                {{ old('ls_apakahruang', $stage2laporanaudit->ls_apakahruang ?? '') == 0 ? 'checked' : '' }}>
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Jika jawaban diatas tidak, jelaskan lingkup sertifikasinya
                                            </h4>

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('ls_jikatidak') is-invalid @enderror" name="ls_jikatidak" id="ls_jikatidak"
                                                                rows="10">{{ old('ls_jikatidak', $stage2laporanaudit->ls_jikatidak ?? '') }}</textarea>
                                                            @error('ls_jikatidak')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 style="text-align: center;" class="mb-4 mt-5">Tanggal dan TTD</h4>
                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label>Tanggal</label>
                                                        <div class="col-sm-12">
                                                            <input type="date"
                                                                class="form-control @error('tanggal_ttd') is-invalid @enderror"
                                                                name="tanggal_ttd"
                                                                value="{{ old('tanggal_ttd', $stage2laporanaudit->tanggal_ttd ?? '') }}">
                                                            @error('tanggal_ttd')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group row">
                                                        <label>Nama Auditor</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"
                                                                class="form-control @error('nama_auditorttd') is-invalid @enderror"
                                                                name="nama_auditorttd"
                                                                value="{{ old('nama_auditorttd', $stage2laporanaudit->nama_auditorttd ?? '') }}">
                                                            @error('nama_auditorttd')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 style="text-align: center;" class="mb-4 mt-5">Ringkasan Audit</h4>
                                            <h4 class="card-title border-bottom mt-5 mb-3">
                                                Persyaratan ISO 9001
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-5">
                                                Konteks organisasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-2">
                                                4.1 Memahami organisasi dan konteksnya
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1[]"
                                                                type="checkbox" value="9001_4_1_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_1_stage1', $konteks1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1[]') == '9001_4_1_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1[]"
                                                                type="checkbox" value="9001_4_1_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_1_stage2', $konteks1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1[]') == '9001_4_1_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1[]"
                                                                type="checkbox" value="9001_4_1_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_1_sur1', $konteks1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1[]') == '9001_4_1_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1[]"
                                                                type="checkbox" value="9001_4_1_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_1_sur2', $konteks1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1[]') == '9001_4_1_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1[]"
                                                                type="checkbox" value="9001_4_1_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_1_res', $konteks1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1[]') == '9001_4_1_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                4.2 Memahami kebutuhan dan harapan pihak berkepentingan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks2[]"
                                                                type="checkbox" value="9001_4_2_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_2_stage1', $konteks2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks2[]') == '9001_4_2_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks2[]"
                                                                type="checkbox" value="9001_4_2_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_2_stage2', $konteks2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks2[]') == '9001_4_2_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks2[]"
                                                                type="checkbox" value="9001_4_2_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_2_sur1', $konteks2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks2[]') == '9001_4_2_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks2[]"
                                                                type="checkbox" value="9001_4_2_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_2_sur2', $konteks2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks2[]') == '9001_4_2_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks2[]"
                                                                type="checkbox" value="9001_4_2_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_2_res', $konteks2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks2[]') == '9001_4_2_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                4.3 Menentukan lingkup sistem manajemen mutu
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks3[]"
                                                                type="checkbox" value="9001_4_3_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_3_stage1', $konteks3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks3[]') == '9001_4_3_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks3[]"
                                                                type="checkbox" value="9001_4_3_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_3_stage2', $konteks3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks3[]') == '9001_4_3_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks3[]"
                                                                type="checkbox" value="9001_4_3_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_3_sur1', $konteks3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks3[]') == '9001_4_3_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks3[]"
                                                                type="checkbox" value="9001_4_3_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_3_sur2', $konteks3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks3[]') == '9001_4_3_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks3[]"
                                                                type="checkbox" value="9001_4_3_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_3_res', $konteks3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks3[]') == '9001_4_3_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                4.4 Sistem manajemen mutu dan prosesnya
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks4[]"
                                                                type="checkbox" value="9001_4_4_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_4_stage1', $konteks4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks4[]') == '9001_4_4_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks4[]"
                                                                type="checkbox" value="9001_4_4_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_4_stage2', $konteks4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks4[]') == '9001_4_4_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks4[]"
                                                                type="checkbox" value="9001_4_4_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_4_sur1', $konteks4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks4[]') == '9001_4_4_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks4[]"
                                                                type="checkbox" value="9001_4_4_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_4_sur2', $konteks4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks4[]') == '9001_4_4_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks4[]"
                                                                type="checkbox" value="9001_4_4_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_4_4_res', $konteks4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks4[]') == '9001_4_4_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-5">
                                                Kepemimpinan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-2">
                                                5.1 Kepemimpinan dan komitmen
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1[]"
                                                                type="checkbox" value="9001_5_1_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_1_stage1', $kepemimpinan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1[]') == '9001_5_1_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1[]"
                                                                type="checkbox" value="9001_5_1_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_1_stage2', $kepemimpinan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1[]') == '9001_5_1_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1[]"
                                                                type="checkbox" value="9001_5_1_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_1_sur1', $kepemimpinan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1[]') == '9001_5_1_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1[]"
                                                                type="checkbox" value="9001_5_1_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_1_sur2', $kepemimpinan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1[]') == '9001_5_1_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1[]"
                                                                type="checkbox" value="9001_5_1_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_1_res', $kepemimpinan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1[]') == '9001_5_1_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                5.2 Kebijakan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan2[]"
                                                                type="checkbox" value="9001_5_2_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_2_stage1', $kepemimpinan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan2[]') == '9001_5_2_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan2[]"
                                                                type="checkbox" value="9001_5_2_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_2_stage2', $kepemimpinan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan2[]') == '9001_5_2_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan2[]"
                                                                type="checkbox" value="9001_5_2_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_2_sur1', $kepemimpinan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan2[]') == '9001_5_2_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan2[]"
                                                                type="checkbox" value="9001_5_2_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_2_sur2', $kepemimpinan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan2[]') == '9001_5_2_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan2[]"
                                                                type="checkbox" value="9001_5_2_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_2_res', $kepemimpinan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan2[]') == '9001_5_2_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                5.3 Peran, tanggungjawab dan wewenang organisasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan3[]"
                                                                type="checkbox" value="9001_5_3_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_3_stage1', $kepemimpinan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan3[]') == '9001_5_3_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan3[]"
                                                                type="checkbox" value="9001_5_3_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_3_stage2', $kepemimpinan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan3[]') == '9001_5_3_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan3[]"
                                                                type="checkbox" value="9001_5_3_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_3_sur1', $kepemimpinan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan3[]') == '9001_5_3_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan3[]"
                                                                type="checkbox" value="9001_5_3_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_3_sur2', $kepemimpinan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan3[]') == '9001_5_3_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan3[]"
                                                                type="checkbox" value="9001_5_3_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_5_3_res', $kepemimpinan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan3[]') == '9001_5_3_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-5">
                                                Perencanaan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-2">
                                                6.1 Tindakan ditujukan pada peluang dan risiko
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1[]"
                                                                type="checkbox" value="9001_6_1_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_1_stage1', $perencanaan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1[]') == '9001_6_1_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1[]"
                                                                type="checkbox" value="9001_6_1_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_1_stage2', $perencanaan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1[]') == '9001_6_1_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1[]"
                                                                type="checkbox" value="9001_6_1_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_1_sur1', $perencanaan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1[]') == '9001_6_1_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1[]"
                                                                type="checkbox" value="9001_6_1_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_1_sur2', $perencanaan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1[]') == '9001_6_1_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1[]"
                                                                type="checkbox" value="9001_6_1_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_1_res', $perencanaan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1[]') == '9001_6_1_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                6.2 Sasaran mutu dan perencanaan untuk mencapai sasaran
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan2[]"
                                                                type="checkbox" value="9001_6_2_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_2_stage1', $perencanaan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan2[]') == '9001_6_2_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan2[]"
                                                                type="checkbox" value="9001_6_2_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_2_stage2', $perencanaan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan2[]') == '9001_6_2_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan2[]"
                                                                type="checkbox" value="9001_6_2_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_2_sur1', $perencanaan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan2[]') == '9001_6_2_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan2[]"
                                                                type="checkbox" value="9001_6_2_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_2_sur2', $perencanaan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan2[]') == '9001_6_2_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan2[]"
                                                                type="checkbox" value="9001_6_2_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_2_res', $perencanaan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan2[]') == '9001_6_2_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                6.3 Perubahan perencanaan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan3[]"
                                                                type="checkbox" value="9001_6_3_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_3_stage1', $perencanaan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan3[]') == '9001_6_3_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan3[]"
                                                                type="checkbox" value="9001_6_3_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_3_stage2', $perencanaan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan3[]') == '9001_6_3_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan3[]"
                                                                type="checkbox" value="9001_6_3_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_3_sur1', $perencanaan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan3[]') == '9001_6_3_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan3[]"
                                                                type="checkbox" value="9001_6_3_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_3_sur2', $perencanaan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan3[]') == '9001_6_3_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan3[]"
                                                                type="checkbox" value="9001_6_3_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_6_3_res', $perencanaan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan3[]') == '9001_6_3_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <h4 class="card-title border-bottom mb-3 mt-5">
                                                Dukungan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-2">
                                                7.1 Sumberdaya
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1[]"
                                                                type="checkbox" value="9001_7_1_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_1_stage1', $dukungan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1[]') == '9001_7_1_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1[]"
                                                                type="checkbox" value="9001_7_1_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_1_stage2', $dukungan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1[]') == '9001_7_1_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1[]"
                                                                type="checkbox" value="9001_7_1_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_1_sur1', $dukungan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1[]') == '9001_7_1_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1[]"
                                                                type="checkbox" value="9001_7_1_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_1_sur2', $dukungan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1[]') == '9001_7_1_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1[]"
                                                                type="checkbox" value="9001_7_1_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_1_res', $dukungan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1[]') == '9001_7_1_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                7.2 Kompetensi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan2[]"
                                                                type="checkbox" value="9001_7_2_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_2_stage1', $dukungan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan2[]') == '9001_7_2_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan2[]"
                                                                type="checkbox" value="9001_7_2_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_2_stage2', $dukungan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan2[]') == '9001_7_2_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan2[]"
                                                                type="checkbox" value="9001_7_2_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_2_sur1', $dukungan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan2[]') == '9001_7_2_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan2[]"
                                                                type="checkbox" value="9001_7_2_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_2_sur2', $dukungan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan2[]') == '9001_7_2_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan2[]"
                                                                type="checkbox" value="9001_7_2_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_2_res', $dukungan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan2[]') == '9001_7_2_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                7.3 Kepedulian
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan3[]"
                                                                type="checkbox" value="9001_7_3_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_3_stage1', $dukungan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan3[]') == '9001_7_3_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan3[]"
                                                                type="checkbox" value="9001_7_3_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_3_stage2', $dukungan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan3[]') == '9001_7_3_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan3[]"
                                                                type="checkbox" value="9001_7_3_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_3_sur1', $dukungan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan3[]') == '9001_7_3_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan3[]"
                                                                type="checkbox" value="9001_7_3_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_3_sur2', $dukungan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan3[]') == '9001_7_3_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan3[]"
                                                                type="checkbox" value="9001_7_3_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_3_res', $dukungan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan3[]') == '9001_7_3_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                7.4 Komunikasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan4[]"
                                                                type="checkbox" value="9001_7_4_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_4_stage1', $dukungan4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan4[]') == '9001_7_4_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan4[]"
                                                                type="checkbox" value="9001_7_4_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_4_stage2', $dukungan4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan4[]') == '9001_7_4_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan4[]"
                                                                type="checkbox" value="9001_7_4_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_4_sur1', $dukungan4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan4[]') == '9001_7_4_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan4[]"
                                                                type="checkbox" value="9001_7_4_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_4_sur2', $dukungan4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan4[]') == '9001_7_4_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan4[]"
                                                                type="checkbox" value="9001_7_4_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_4_res', $dukungan4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan4[]') == '9001_7_4_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                7.5 Informasi terdokumentasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan5[]"
                                                                type="checkbox" value="9001_7_5_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_5_stage1', $dukungan5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan5[]') == '9001_7_5_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan5[]"
                                                                type="checkbox" value="9001_7_5_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_5_stage2', $dukungan5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan5[]') == '9001_7_5_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan5[]"
                                                                type="checkbox" value="9001_7_5_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_5_sur1', $dukungan5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan5[]') == '9001_7_5_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan5[]"
                                                                type="checkbox" value="9001_7_5_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_5_sur2', $dukungan5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan5[]') == '9001_7_5_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan5[]"
                                                                type="checkbox" value="9001_7_5_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_7_5_res', $dukungan5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan5[]') == '9001_7_5_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <h4 class="card-title border-bottom mb-3 mt-5">
                                                Operasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-2">
                                                8.1 Perencanaan dan pengendalian operasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1[]"
                                                                type="checkbox" value="9001_8_1_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_1_stage1', $operasi1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1[]') == '9001_8_1_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1[]"
                                                                type="checkbox" value="9001_8_1_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_1_stage2', $operasi1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1[]') == '9001_8_1_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1[]"
                                                                type="checkbox" value="9001_8_1_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_1_sur1', $operasi1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1[]') == '9001_8_1_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1[]"
                                                                type="checkbox" value="9001_8_1_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_1_sur2', $operasi1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1[]') == '9001_8_1_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1[]"
                                                                type="checkbox" value="9001_8_1_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_1_res', $operasi1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1[]') == '9001_8_1_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                8.2 Persyaratan produk dan jasa
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi2[]"
                                                                type="checkbox" value="9001_8_2_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_2_stage1', $operasi2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi2[]') == '9001_8_2_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi2[]"
                                                                type="checkbox" value="9001_8_2_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_2_stage2', $operasi2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi2[]') == '9001_8_2_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi2[]"
                                                                type="checkbox" value="9001_8_2_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_2_sur1', $operasi2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi2[]') == '9001_8_2_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi2[]"
                                                                type="checkbox" value="9001_8_2_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_2_sur2', $operasi2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi2[]') == '9001_8_2_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi2[]"
                                                                type="checkbox" value="9001_8_2_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_2_res', $operasi2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi2[]') == '9001_8_2_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                8.3 Desain dan pengembangan produk dan jasa
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi3[]"
                                                                type="checkbox" value="9001_8_3_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_3_stage1', $operasi3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi3[]') == '9001_8_3_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi3[]"
                                                                type="checkbox" value="9001_8_3_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_3_stage2', $operasi3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi3[]') == '9001_8_3_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi3[]"
                                                                type="checkbox" value="9001_8_3_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_3_sur1', $operasi3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi3[]') == '9001_8_3_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi3[]"
                                                                type="checkbox" value="9001_8_3_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_3_sur2', $operasi3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi3[]') == '9001_8_3_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi3[]"
                                                                type="checkbox" value="9001_8_3_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_3_res', $operasi3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi3[]') == '9001_8_3_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                8.4 Pengendalian proses, produk dan jasa yang disediakan eksternal
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi4[]"
                                                                type="checkbox" value="9001_8_4_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_4_stage1', $operasi4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi4[]') == '9001_8_4_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi4[]"
                                                                type="checkbox" value="9001_8_4_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_4_stage2', $operasi4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi4[]') == '9001_8_4_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi4[]"
                                                                type="checkbox" value="9001_8_4_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_4_sur1', $operasi4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi4[]') == '9001_8_4_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi4[]"
                                                                type="checkbox" value="9001_8_4_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_4_sur2', $operasi4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi4[]') == '9001_8_4_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi4[]"
                                                                type="checkbox" value="9001_8_4_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_4_res', $operasi4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi4[]') == '9001_8_4_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                8.5 Produksi dan penyediaan jasa
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi5[]"
                                                                type="checkbox" value="9001_8_5_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_5_stage1', $operasi5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi5[]') == '9001_8_5_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi5[]"
                                                                type="checkbox" value="9001_8_5_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_5_stage2', $operasi5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi5[]') == '9001_8_5_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi5[]"
                                                                type="checkbox" value="9001_8_5_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_5_sur1', $operasi5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi5[]') == '9001_8_5_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi5[]"
                                                                type="checkbox" value="9001_8_5_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_5_sur2', $operasi5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi5[]') == '9001_8_5_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi5[]"
                                                                type="checkbox" value="9001_8_5_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_5_res', $operasi5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi5[]') == '9001_8_5_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                8.6 Pelepasan produk dan jasa
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi6[]"
                                                                type="checkbox" value="9001_8_6_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_6_stage1', $operasi6)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi6[]') == '9001_8_6_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi6[]"
                                                                type="checkbox" value="9001_8_6_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_6_stage2', $operasi6)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi6[]') == '9001_8_6_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi6[]"
                                                                type="checkbox" value="9001_8_6_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_6_sur1', $operasi6)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi6[]') == '9001_8_6_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi6[]"
                                                                type="checkbox" value="9001_8_6_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_6_sur2', $operasi6)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi6[]') == '9001_8_6_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi6[]"
                                                                type="checkbox" value="9001_8_6_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_6_res', $operasi6)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi6[]') == '9001_8_6_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                8.7 Pengendalian ketidaksesuaian keluaran
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi7[]"
                                                                type="checkbox" value="9001_8_7_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_7_stage1', $operasi7)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi7[]') == '9001_8_7_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi7[]"
                                                                type="checkbox" value="9001_8_7_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_7_stage2', $operasi7)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi7[]') == '9001_8_7_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi7[]"
                                                                type="checkbox" value="9001_8_7_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_7_sur1', $operasi7)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi7[]') == '9001_8_7_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi7[]"
                                                                type="checkbox" value="9001_8_7_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_7_sur2', $operasi7)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi7[]') == '9001_8_7_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi7[]"
                                                                type="checkbox" value="9001_8_7_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_8_7_res', $operasi7)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi7[]') == '9001_8_7_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-5">
                                                Evaluasi kinerja
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-2">
                                                9.1 Pemantauan, pengukuran, analisis dan evaluasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1[]"
                                                                type="checkbox" value="9001_9_1_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_1_stage1', $evaluasi1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1[]') == '9001_9_1_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1[]"
                                                                type="checkbox" value="9001_9_1_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_1_stage2', $evaluasi1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1[]') == '9001_9_1_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1[]"
                                                                type="checkbox" value="9001_9_1_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_1_sur1', $evaluasi1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1[]') == '9001_9_1_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1[]"
                                                                type="checkbox" value="9001_9_1_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_1_sur2', $evaluasi1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1[]') == '9001_9_1_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1[]"
                                                                type="checkbox" value="9001_9_1_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_1_res', $evaluasi1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1[]') == '9001_9_1_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                9.2 Audit internal
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi2[]"
                                                                type="checkbox" value="9001_9_2_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_2_stage1', $evaluasi2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi2[]') == '9001_9_2_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi2[]"
                                                                type="checkbox" value="9001_9_2_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_2_stage2', $evaluasi2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi2[]') == '9001_9_2_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi2[]"
                                                                type="checkbox" value="9001_9_2_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_2_sur1', $evaluasi2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi2[]') == '9001_9_2_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi2[]"
                                                                type="checkbox" value="9001_9_2_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_2_sur2', $evaluasi2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi2[]') == '9001_9_2_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi2[]"
                                                                type="checkbox" value="9001_9_2_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_2_res', $evaluasi2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi2[]') == '9001_9_2_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                9.3 Tinjauan manajemen
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi3[]"
                                                                type="checkbox" value="9001_9_3_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_3_stage1', $evaluasi3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi3[]') == '9001_9_3_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi3[]"
                                                                type="checkbox" value="9001_9_3_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_3_stage2', $evaluasi3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi3[]') == '9001_9_3_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi3[]"
                                                                type="checkbox" value="9001_9_3_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_3_sur1', $evaluasi3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi3[]') == '9001_9_3_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi3[]"
                                                                type="checkbox" value="9001_9_3_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_3_sur2', $evaluasi3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi3[]') == '9001_9_3_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi3[]"
                                                                type="checkbox" value="9001_9_3_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_9_3_res', $evaluasi3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi3[]') == '9001_9_3_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <h4 class="card-title border-bottom mb-3 mt-5">
                                                Peningkatan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-2">
                                                10.1 Umum
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1[]"
                                                                type="checkbox" value="9001_10_1_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_1_stage1', $peningkatan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1[]') == '9001_10_1_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1[]"
                                                                type="checkbox" value="9001_10_1_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_1_stage2', $peningkatan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1[]') == '9001_10_1_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1[]"
                                                                type="checkbox" value="9001_10_1_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_1_sur1', $peningkatan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1[]') == '9001_10_1_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1[]"
                                                                type="checkbox" value="9001_10_1_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_1_sur2', $peningkatan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1[]') == '9001_10_1_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1[]"
                                                                type="checkbox" value="9001_10_1_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_1_res', $peningkatan1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1[]') == '9001_10_1_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                10.2 Ketidaksesuaian dan tindakan korektif
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan2[]"
                                                                type="checkbox" value="9001_10_2_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_2_stage1', $peningkatan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan2[]') == '9001_10_2_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan2[]"
                                                                type="checkbox" value="9001_10_2_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_2_stage2', $peningkatan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan2[]') == '9001_10_2_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan2[]"
                                                                type="checkbox" value="9001_10_2_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_2_sur1', $peningkatan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan2[]') == '9001_10_2_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan2[]"
                                                                type="checkbox" value="9001_10_2_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_2_sur2', $peningkatan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan2[]') == '9001_10_2_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan2[]"
                                                                type="checkbox" value="9001_10_2_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_2_res', $peningkatan2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan2[]') == '9001_10_2_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                10. 3 Peningkatan berkelanjutan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan3[]"
                                                                type="checkbox" value="9001_10_3_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_3_stage1', $peningkatan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan3[]') == '9001_10_3_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan3[]"
                                                                type="checkbox" value="9001_10_3_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_3_stage2', $peningkatan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan3[]') == '9001_10_3_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan3[]"
                                                                type="checkbox" value="9001_10_3_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_3_sur1', $peningkatan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan3[]') == '9001_10_3_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan3[]"
                                                                type="checkbox" value="9001_10_3_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_3_sur2', $peningkatan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan3[]') == '9001_10_3_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan3[]"
                                                                type="checkbox" value="9001_10_3_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('9001_10_3_res', $peningkatan3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan3[]') == '9001_10_3_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>



                                            <h4 class="card-title border-bottom mt-5 mb-3">
                                                Persyaratan ISO 21001
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-5">
                                                Konteks organisasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-2">
                                                4.1 Memahami organisasi dan konteksnya
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_1[]"
                                                                type="checkbox" value="21001_4_1_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_1_stage1', $konteks1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_1[]') == '21001_4_1_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_1[]"
                                                                type="checkbox" value="21001_4_1_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_1_stage2', $konteks1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_1[]') == '21001_4_1_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_1[]"
                                                                type="checkbox" value="21001_4_1_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_1_sur1', $konteks1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_1[]') == '21001_4_1_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_1[]"
                                                                type="checkbox" value="21001_4_1_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_1_sur2', $konteks1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_1[]') == '21001_4_1_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_1[]"
                                                                type="checkbox" value="21001_4_1_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_1_res', $konteks1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_1[]') == '21001_4_1_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                4.2 Memahami kebutuhan dan harapan pihak berkepentingan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_2[]"
                                                                type="checkbox" value="21001_4_2_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_2_stage1', $konteks1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_2[]') == '21001_4_2_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_2[]"
                                                                type="checkbox" value="21001_4_2_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_2_stage2', $konteks1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_2[]') == '21001_4_2_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_2[]"
                                                                type="checkbox" value="21001_4_2_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_2_sur1', $konteks1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_2[]') == '21001_4_2_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_2[]"
                                                                type="checkbox" value="21001_4_2_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_2_sur2', $konteks1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_2[]') == '21001_4_2_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_2[]"
                                                                type="checkbox" value="21001_4_2_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_2_res', $konteks1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_2[]') == '21001_4_2_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                4.3 Menentukan lingkup sistem manajemen mutu
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_3[]"
                                                                type="checkbox" value="21001_4_3_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_3_stage1', $konteks1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_3[]') == '21001_4_3_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_3[]"
                                                                type="checkbox" value="21001_4_3_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_3_stage2', $konteks1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_3[]') == '21001_4_3_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_3[]"
                                                                type="checkbox" value="21001_4_3_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_3_sur1', $konteks1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_3[]') == '21001_4_3_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_3[]"
                                                                type="checkbox" value="21001_4_3_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_3_sur2', $konteks1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_3[]') == '21001_4_3_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_3[]"
                                                                type="checkbox" value="21001_4_3_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_3_res', $konteks1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_3[]') == '21001_4_3_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                4.4 Sistem manajemen mutu dan prosesnya
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_4[]"
                                                                type="checkbox" value="21001_4_4_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_4_stage1', $konteks1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_4[]') == '21001_4_4_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_4[]"
                                                                type="checkbox" value="21001_4_4_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_4_stage2', $konteks1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_4[]') == '21001_4_4_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_4[]"
                                                                type="checkbox" value="21001_4_4_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_4_sur1', $konteks1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_4[]') == '21001_4_4_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_4[]"
                                                                type="checkbox" value="21001_4_4_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_4_sur2', $konteks1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_4[]') == '21001_4_4_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="konteks1_4[]"
                                                                type="checkbox" value="21001_4_4_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_4_4_res', $konteks1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('konteks1_4[]') == '21001_4_4_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-5">
                                                Kepemimpinan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-2">
                                                5.1 Kepemimpinan dan komitmen
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_1[]"
                                                                type="checkbox" value="21001_5_1_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_1_stage1', $kepemimpinan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_1[]') == '21001_5_1_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_1[]"
                                                                type="checkbox" value="21001_5_1_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_1_stage2', $kepemimpinan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_1[]') == '21001_5_1_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_1[]"
                                                                type="checkbox" value="21001_5_1_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_1_sur1', $kepemimpinan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_1[]') == '21001_5_1_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_1[]"
                                                                type="checkbox" value="21001_5_1_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_1_sur2', $kepemimpinan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_1[]') == '21001_5_1_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_1[]"
                                                                type="checkbox" value="21001_5_1_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_1_res', $kepemimpinan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_1[]') == '21001_5_1_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                5.2 Kebijakan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_2[]"
                                                                type="checkbox" value="21001_5_2_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_2_stage1', $kepemimpinan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_2[]') == '21001_5_2_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_2[]"
                                                                type="checkbox" value="21001_5_2_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_2_stage2', $kepemimpinan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_2[]') == '21001_5_2_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_2[]"
                                                                type="checkbox" value="21001_5_2_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_2_sur1', $kepemimpinan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_2[]') == '21001_5_2_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_2[]"
                                                                type="checkbox" value="sur2" <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_2_sur2', $kepemimpinan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_2[]') == '21001_5_2_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_2[]"
                                                                type="checkbox" value="res" <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_2_res', $kepemimpinan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_2[]') == '21001_5_2_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                5.3 Peran, tanggungjawab dan wewenang organisasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_3[]"
                                                                type="checkbox" value="21001_5_3_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_3_stage1', $kepemimpinan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_3[]') == '21001_5_3_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_3[]"
                                                                type="checkbox" value="21001_5_3_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_3_stage2', $kepemimpinan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_3[]') == '21001_5_3_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_3[]"
                                                                type="checkbox" value="21001_5_3_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_3_sur1', $kepemimpinan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_3[]') == '21001_5_3_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_3[]"
                                                                type="checkbox" value="21001_5_3_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_3_sur2', $kepemimpinan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_3[]') == '21001_5_3_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="kepemimpinan1_3[]"
                                                                type="checkbox" value="21001_5_3_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_5_3_res', $kepemimpinan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('kepemimpinan1_3[]') == '21001_5_3_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-5">
                                                Perencanaan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-2">
                                                6.1 Tindakan ditujukan pada peluang dan risiko
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_1[]"
                                                                type="checkbox" value="21001_6_1_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_1_stage1', $perencanaan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_1[]') == '21001_6_1_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_1[]"
                                                                type="checkbox" value="21001_6_1_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_1_stage2', $perencanaan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_1[]') == '21001_6_1_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_1[]"
                                                                type="checkbox" value="21001_6_1_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_1_sur1', $perencanaan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_1[]') == '21001_6_1_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_1[]"
                                                                type="checkbox" value="21001_6_1_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_1_sur2', $perencanaan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_1[]') == '21001_6_1_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_1[]"
                                                                type="checkbox" value="21001_6_1_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_1_res', $perencanaan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_1[]') == '21001_6_1_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                6.2 Sasaran mutu dan perencanaan untuk mencapai sasaran
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_2[]"
                                                                type="checkbox" value="21001_6_2_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_2_stage1', $perencanaan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_2[]') == '21001_6_2_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_2[]"
                                                                type="checkbox" value="21001_6_2_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_2_stage2', $perencanaan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_2[]') == '21001_6_2_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_2[]"
                                                                type="checkbox" value="21001_6_2_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_2_sur1', $perencanaan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_2[]') == '21001_6_2_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_2[]"
                                                                type="checkbox" value="21001_6_2_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_2_sur2', $perencanaan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_2[]') == '21001_6_2_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_2[]"
                                                                type="checkbox" value="21001_6_2_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_2_res', $perencanaan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_2[]') == '21001_6_2_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                6.3 Perubahan perencanaan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_3[]"
                                                                type="checkbox" value="21001_6_3_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_3_stage1', $perencanaan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_3[]') == '21001_6_3_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_3[]"
                                                                type="checkbox" value="21001_6_3_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_3_stage2', $perencanaan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_3[]') == '21001_6_3_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_3[]"
                                                                type="checkbox" value="21001_6_3_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_3_sur1', $perencanaan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_3[]') == '21001_6_3_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_3[]"
                                                                type="checkbox" value="21001_6_3_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_3_sur2', $perencanaan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_3[]') == '21001_6_3_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="perencanaan1_3[]"
                                                                type="checkbox" value="21001_6_3_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_6_3_res', $perencanaan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('perencanaan1_3[]') == '21001_6_3_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <h4 class="card-title border-bottom mb-3 mt-5">
                                                Dukungan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-2">
                                                7.1 Sumberdaya
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_1[]"
                                                                type="checkbox" value="21001_7_1_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_1_stage1', $dukungan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_1[]') == '21001_7_1_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_1[]"
                                                                type="checkbox" value="21001_7_1_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_1_stage2', $dukungan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_1[]') == '21001_7_1_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_1[]"
                                                                type="checkbox" value="21001_7_1_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_1_sur1', $dukungan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_1[]') == '21001_7_1_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_1[]"
                                                                type="checkbox" value="21001_7_1_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_1_sur2', $dukungan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_1[]') == '21001_7_1_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_1[]"
                                                                type="checkbox" value="21001_7_1_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_1_res', $dukungan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_1[]') == '21001_7_1_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                7.2 Kompetensi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_2[]"
                                                                type="checkbox" value="21001_7_2_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_2_stage1', $dukungan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_2[]') == '21001_7_2_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_2[]"
                                                                type="checkbox" value="21001_7_2_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_2_stage2', $dukungan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_2[]') == '21001_7_2_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_2[]"
                                                                type="checkbox" value="sur1" <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_2_sur1', $dukungan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_2[]') == '21001_7_2_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_2[]"
                                                                type="checkbox" value="sur2" <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_2_sur2', $dukungan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_2[]') == '21001_7_2_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_2[]"
                                                                type="checkbox" value="res" <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_2_res', $dukungan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_2[]') == '21001_7_2_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                7.3 Kepedulian
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_3[]"
                                                                type="checkbox" value="21001_7_3_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_3_stage1', $dukungan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_3[]') == '21001_7_3_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_3[]"
                                                                type="checkbox" value="21001_7_3_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_3_stage2', $dukungan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_3[]') == '21001_7_3_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_3[]"
                                                                type="checkbox" value="21001_7_3_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_3_sur1', $dukungan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_3[]') == '21001_7_3_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_3[]"
                                                                type="checkbox" value="21001_7_3_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_3_sur2', $dukungan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_3[]') == '21001_7_3_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_3[]"
                                                                type="checkbox" value="21001_7_3_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_3_res', $dukungan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_3[]') == '21001_7_3_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                7.4 Komunikasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_4[]"
                                                                type="checkbox" value="21001_7_4_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_4_stage1', $dukungan1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_4[]') == '21001_7_4_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_4[]"
                                                                type="checkbox" value="21001_7_4_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_4_stage2', $dukungan1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_4[]') == '21001_7_4_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_4[]"
                                                                type="checkbox" value="21001_7_4_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_4_sur1', $dukungan1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_4[]') == '21001_7_4_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_4[]"
                                                                type="checkbox" value="21001_7_4_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_4_sur2', $dukungan1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_4[]') == '21001_7_4_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_4[]"
                                                                type="checkbox" value="21001_7_4_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_4_res', $dukungan1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_4[]') == '21001_7_4_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                7.5 Informasi terdokumentasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_5[]"
                                                                type="checkbox" value="21001_7_5_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_5_stage1', $dukungan1_5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_5[]') == '21001_7_5_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_5[]"
                                                                type="checkbox" value="21001_7_5_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_5_stage2', $dukungan1_5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_5[]') == '21001_7_5_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_5[]"
                                                                type="checkbox" value="21001_7_5_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_5_sur1', $dukungan1_5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_5[]') == '21001_7_5_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_5[]"
                                                                type="checkbox" value="21001_7_5_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_5_sur2', $dukungan1_5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_5[]') == '21001_7_5_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="dukungan1_5[]"
                                                                type="checkbox" value="21001_7_5_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_7_5_res', $dukungan1_5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('dukungan1_5[]') == '21001_7_5_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <h4 class="card-title border-bottom mb-3 mt-5">
                                                Operasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-2">
                                                8.1 Perencanaan dan pengendalian operasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_1[]"
                                                                type="checkbox" value="21001_8_1_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_1_stage1', $operasi1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_1[]') == '21001_8_1_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_1[]"
                                                                type="checkbox" value="21001_8_1_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_1_stage2', $operasi1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_1[]') == '21001_8_1_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_1[]"
                                                                type="checkbox" value="21001_8_1_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_1_sur1', $operasi1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_1[]') == '21001_8_1_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_1[]"
                                                                type="checkbox" value="21001_8_1_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_1_sur2', $operasi1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_1[]') == '21001_8_1_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_1[]"
                                                                type="checkbox" value="21001_8_1_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_1_res', $operasi1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_1[]') == '21001_8_1_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                8.2 Persyaratan produk dan jasa
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_2[]"
                                                                type="checkbox" value="21001_8_2_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_2_stage1', $operasi1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_2[]') == '21001_8_2_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_2[]"
                                                                type="checkbox" value="21001_8_2_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_2_stage2', $operasi1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_2[]') == '21001_8_2_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_2[]"
                                                                type="checkbox" value="21001_8_2_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_2_sur1', $operasi1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_2[]') == '21001_8_2_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_2[]"
                                                                type="checkbox" value="21001_8_2_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_2_sur2', $operasi1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_2[]') == '21001_8_2_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_2[]"
                                                                type="checkbox" value="21001_8_2_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_2_res', $operasi1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_2[]') == '21001_8_2_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                8.3 Desain dan pengembangan produk dan jasa
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_3[]"
                                                                type="checkbox" value="21001_8_3_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_3_stage1', $operasi1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_3[]') == '21001_8_3_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_3[]"
                                                                type="checkbox" value="21001_8_3_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_3_stage2', $operasi1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_3[]') == '21001_8_3_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_3[]"
                                                                type="checkbox" value="21001_8_3_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_3_sur1', $operasi1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_3[]') == '21001_8_3_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_3[]"
                                                                type="checkbox" value="21001_8_3_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_3_sur2', $operasi1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_3[]') == '21001_8_3_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_3[]"
                                                                type="checkbox" value="21001_8_3_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_3_res', $operasi1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_3[]') == '21001_8_3_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                8.4 Pengendalian proses, produk dan jasa yang disediakan eksternal
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_4[]"
                                                                type="checkbox" value="21001_8_4_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_4_stage1', $operasi1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_4[]') == '21001_8_4_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_4[]"
                                                                type="checkbox" value="stage2" <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_4_stage2', $operasi1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_4[]') == '21001_8_4_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_4[]"
                                                                type="checkbox" value="21001_8_4_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_4_sur1', $operasi1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_4[]') == '21001_8_4_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_4[]"
                                                                type="checkbox" value="sur2" <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_4_sur2', $operasi1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_4[]') == '21001_8_4_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_4[]"
                                                                type="checkbox" value="21001_8_4_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_4_res', $operasi1_4)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_4[]') == '21001_8_4_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                8.5 Produksi dan penyediaan jasa
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_5[]"
                                                                type="checkbox" value="21001_8_5_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_5_stage1', $operasi1_5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_5[]') == '21001_8_5_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_5[]"
                                                                type="checkbox" value="21001_8_5_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_5_stage2', $operasi1_5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_5[]') == '21001_8_5_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_5[]"
                                                                type="checkbox" value="21001_8_5_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_5_sur1', $operasi1_5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_5[]') == '21001_8_5_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_5[]"
                                                                type="checkbox" value="21001_8_5_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_5_sur2', $operasi1_5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_5[]') == '21001_8_5_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_5[]"
                                                                type="checkbox" value="21001_8_5_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_5_res', $operasi1_5)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_5[]') == '21001_8_5_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                8.6 Pelepasan produk dan jasa
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_6[]"
                                                                type="checkbox" value="21001_8_6_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_6_stage1', $operasi1_6)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_6[]') == '21001_8_6_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_6[]"
                                                                type="checkbox" value="21001_8_6_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_6_stage2', $operasi1_6)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_6[]') == '21001_8_6_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_6[]"
                                                                type="checkbox" value="21001_8_6_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_6_sur1', $operasi1_6)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_6[]') == '21001_8_6_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_6[]"
                                                                type="checkbox" value="21001_8_6_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_6_sur2', $operasi1_6)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_6[]') == '21001_8_6_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_6[]"
                                                                type="checkbox" value="21001_8_6_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_6_res', $operasi1_6)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_6[]') == '21001_8_6_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                8.7 Pengendalian ketidaksesuaian keluaran
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_7[]"
                                                                type="checkbox" value="21001_8_7_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_7_stage1', $operasi1_7)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_7[]') == '21001_8_7_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_7[]"
                                                                type="checkbox" value="21001_8_7_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_7_stage2', $operasi1_7)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_7[]') == '21001_8_7_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_7[]"
                                                                type="checkbox" value="21001_8_7_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_7_sur1', $operasi1_7)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_7[]') == '21001_8_7_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_7[]"
                                                                type="checkbox" value="21001_8_7_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_7_sur2', $operasi1_7)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_7[]') == '21001_8_7_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="operasi1_7[]"
                                                                type="checkbox" value="21001_8_7_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_8_7_res', $operasi1_7)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('operasi1_7[]') == '21001_8_7_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-5">
                                                Evaluasi kinerja
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-2">
                                                9.1 Pemantauan, pengukuran, analisis dan evaluasi
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_1[]"
                                                                type="checkbox" value="21001_9_1_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_1_stage1', $evaluasi1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_1[]') == '21001_9_1_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_1[]"
                                                                type="checkbox" value="21001_9_1_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_1_stage2', $evaluasi1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_1[]') == '21001_9_1_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_1[]"
                                                                type="checkbox" value="21001_9_1_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_1_sur1', $evaluasi1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_1[]') == '21001_9_1_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_1[]"
                                                                type="checkbox" value="21001_9_1_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_1_sur2', $evaluasi1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_1[]') == '21001_9_1_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_1[]"
                                                                type="checkbox" value="21001_9_1_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_1_res', $evaluasi1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_1[]') == '21001_9_1_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                9.2 Audit internal
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_2[]"
                                                                type="checkbox" value="21001_9_2_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_2_stage1', $evaluasi1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_2[]') == '21001_9_2_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_2[]"
                                                                type="checkbox" value="21001_9_2_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_2_stage2', $evaluasi1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_2[]') == '21001_9_2_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_2[]"
                                                                type="checkbox" value="21001_9_2_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_2_sur1', $evaluasi1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_2[]') == '21001_9_2_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_2[]"
                                                                type="checkbox" value="21001_9_2_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_2_sur2', $evaluasi1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_2[]') == '21001_9_2_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_2[]"
                                                                type="checkbox" value="21001_9_2_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_2_res', $evaluasi1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_2[]') == '21001_9_2_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                9.3 Tinjauan manajemen
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_3[]"
                                                                type="checkbox" value="21001_9_3_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_3_stage1', $evaluasi1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_3[]') == '21001_9_3_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_3[]"
                                                                type="checkbox" value="21001_9_3_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_3_stage2', $evaluasi1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_3[]') == '21001_9_3_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_3[]"
                                                                type="checkbox" value="21001_9_3_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_3_sur1', $evaluasi1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_3[]') == '21001_9_3_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_3[]"
                                                                type="checkbox" value="21001_9_3_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_3_sur2', $evaluasi1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_3[]') == '21001_9_3_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="evaluasi1_3[]"
                                                                type="checkbox" value="21001_9_3_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_9_3_res', $evaluasi1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('evaluasi1_3[]') == '21001_9_3_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <h4 class="card-title border-bottom mb-3 mt-5">
                                                Peningkatan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-2">
                                                10.1 Umum
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_1[]"
                                                                type="checkbox" value="21001_10_1_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_1_stage1', $peningkatan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_1[]') == '21001_10_1_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_1[]"
                                                                type="checkbox" value="21001_10_1_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_1_stage2', $peningkatan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_1[]') == '21001_10_1_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_1[]"
                                                                type="checkbox" value="21001_10_1_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_1_sur1', $peningkatan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_1[]') == '21001_10_1_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_1[]"
                                                                type="checkbox" value="21001_10_1_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_1_sur2', $peningkatan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_1[]') == '21001_10_1_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_1[]"
                                                                type="checkbox" value="21001_10_1_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_1_res', $peningkatan1_1)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_1[]') == '21001_10_1_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                10.2 Ketidaksesuaian dan tindakan korektif
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_2[]"
                                                                type="checkbox" value="21001_10_2_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_2_stage1', $peningkatan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_2[]') == '21001_10_2_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_2[]"
                                                                type="checkbox" value="21001_10_2_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_2_stage2', $peningkatan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_2[]') == '21001_10_2_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_2[]"
                                                                type="checkbox" value="21001_10_2_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_2_sur1', $peningkatan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_2[]') == '21001_10_2_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_2[]"
                                                                type="checkbox" value="21001_10_2_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_2_sur2', $peningkatan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_2[]') == '21001_10_2_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_2[]"
                                                                type="checkbox" value="21001_10_2_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_2_res', $peningkatan1_2)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_2[]') == '21001_10_2_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                10. 3 Peningkatan berkelanjutan
                                            </h4>

                                            <h4 class="card-title border-bottom mb-3 mt-4">
                                                Tipe Audit
                                            </h4>


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_3[]"
                                                                type="checkbox" value="21001_10_3_stage1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_3_stage1', $peningkatan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_3[]') == '21001_10_3_stage1' ? 'checked' : '';
                                                                } ?> />
                                                            Stage I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_3[]"
                                                                type="checkbox" value="21001_10_3_stage2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_3_stage2', $peningkatan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_3[]') == '21001_10_3_stage2' ? 'checked' : '';
                                                                } ?> />
                                                            Stage II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_3[]"
                                                                type="checkbox" value="21001_10_3_sur1"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_3_sur1', $peningkatan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_3[]') == '21001_10_3_sur1' ? 'checked' : '';
                                                                } ?> />
                                                            Sur I
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_3[]"
                                                                type="checkbox" value="21001_10_3_sur2"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_3_sur2', $peningkatan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_3[]') == '21001_10_3_sur2' ? 'checked' : '';
                                                                } ?> />
                                                            Sur II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 mb-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="peningkatan1_3[]"
                                                                type="checkbox" value="21001_10_3_res"
                                                                <?php if ($stage2laporanaudit) {
                                                                    if (in_array('21001_10_3_res', $peningkatan1_3)) {
                                                                        echo 'checked';
                                                                    }
                                                                } else {
                                                                    echo old('peningkatan1_3[]') == '21001_10_3_res' ? 'checked' : '';
                                                                } ?> />
                                                            Res
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($stage2laporanaudit == '')
                                                @if (in_array('F-CER-08 - Laporan Audit.store', $roles))
                                                    <button type="submit" class="btn btn-primary mr-2">
                                                        Simpan
                                                    </button>
                                                @endif
                                            @elseif ($stage2laporanaudit->status != 2)
                                                @if (in_array('F-CER-08 - Laporan Audit.update', $roles))
                                                    <button type="submit" class="btn btn-primary mr-2">
                                                        Simpan
                                                    </button>
                                                @endif
                                            @endif

                                            @if ($stage2laporanaudit)
                                                @if (in_array('F-CER-08 - Laporan Audit.download', $roles))
                                                    <a href="/dashboard/stage2laporanaudits/download/{{ $stage2laporanaudit->id }}"
                                                        class="btn btn-secondary" target='_blank'>
                                                        Download
                                                    </a>
                                                @endif
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
                @if ($stage2laporanaudit)
                    <form
                        action="/dashboard/stage2laporanauditsvalidasi{{ $stage2laporanaudit ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($stage2laporanaudit)
                            @method('PUT')
                        @endif

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="col-12 grid-margin stretch-card">
                                    <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                                    <input type="hidden" id="status"
                                        value="{{ $stage2laporanaudit->status ?? '' }}">
                                    <div class="card-body">
                                        <h4 class="card-title">Status</h4>
                                        @if (in_array('F-CER-08 - Laporan Audit.validasi', $roles))
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
                                            @if ($stage2laporanaudit->dipending_keterangan)
                                                <label class="mt-3">Keterangan</label>
                                                <div>
                                                    <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                                        disabled>{{ $stage2laporanaudit->dipending_keterangan }}</textarea>
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
                    let status = response.stage2laporanaudit.dipending_keterangan ?? '';

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
                        let status = response.stage2laporanaudit
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
