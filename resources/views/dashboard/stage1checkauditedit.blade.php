@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/stage1checkaudits{{ $stage1checkaudit ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
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

                            @if ($stage1checkaudit)
                                @method('PUT')
                            @endif

                            <input type="hidden" value="{{ $client->id }}" name="client_id">
                            <input type="hidden" value="{{ $listpermohonan_id->id }}" name="listpermohonan_id">
                            <input type="hidden" value="{{ $listpermohonan_id->slug }}" name="listpermohonan_slug">

                            <div class="col-12 grid-margin stretch-card">
                                <div>
                                    <div class="card-body">
                                        <h4 style="text-align: center;" class="card-title mb-3 border-bottom mb-4">CHECKLIST
                                            AUDIT TAHAP 1
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Nama Klien</label>
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
                                                    <label>Lingkup Sertifikasi</label>
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
                                                <input class="form-control mt-1 @error('iso') is-invalid @enderror"
                                                    name="audit" type="hidden" id="audit"
                                                    value="{{ $permohonansertifikasi->audit }}" readonly />
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
                                                            <input type="checkbox" class="form-check-input" name="audit"
                                                                id="audit" value="stage1"
                                                                {{ old('stage1', $arraudit[1] ?? '') == 'stage1' ? 'checked' : '' }}
                                                                disabled />
                                                            Stage 1
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" name="audit"
                                                                id="audit" value="stage2"
                                                                {{ old('stage2', $arraudit[2] ?? '') == 'stage2' ? 'checked' : '' }}
                                                                disabled />
                                                            Stage 2
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" name="audit"
                                                                id="audit" value="surveilen"
                                                                {{ old('surveilen', $arraudit[3] ?? '') == 'surveilen' ? 'checked' : '' }}
                                                                disabled />
                                                            Surveilan
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" name="audit"
                                                                id="audit" value="tindaklanjut"
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
                                                    <div class="col-sm-12">
                                                        <?php
                                                        $user = new App\Models\User();
                                                        $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor)->first();
                                                        ?>
                                                        <input type="text"
                                                            class="form-control mt-1 @error('nama_auditor') is-invalid @enderror"
                                                            id="nama_auditor" name="nama_auditor"
                                                            value="{{ old('nama_auditor', $userid->name ?? '') }}"
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
                                                            value="{{ old('nama_auditor2', $userid->name ?? '') }}"
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
                                                            value="{{ old('nama_auditor3', $stage1penunjukantimaudit->nama_auditor3 ?? '') }}"
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

                                        <div class="row mt-3 mb-5">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Untuk Bertugas Tanggal</label>
                                                    <div class="col-sm-12">
                                                        <input
                                                            class="form-control mt-1 @error('tanggal_bertugas') is-invalid @enderror"
                                                            name="tanggal_bertugas" type="date" id="tanggal_bertugas"
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

                                        <H4 style="text-align: center;" class="mb-4">HASIL PENGAMATAN AUDIT
                                            TAHAP 1</H4>
                                        <h4 class="card-title border-bottom">
                                            1. Evaluasi Dokumentasi Sistem Manajemen Klien
                                        </h4>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Apakah klien memiliki sistem yg
                                                meliputi perarutan, SOP dan ketentuan lainnya terkait dengan
                                                persyaratan
                                                sertifikasi
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_1') is-invalid @enderror" name="pemenuhan_1" id="pemenuhan_1">{{ old('pemenuhan_1', $stage1checkaudit->pemenuhan_1 ?? '') }}</textarea>
                                                        @error('pemenuhan_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_1') is-invalid @enderror" name="tindaklanjut_1"
                                                            id="tindaklanjut_1">{{ old('tindaklanjut_1', $stage1checkaudit->tindaklanjut_1 ?? '') }}</textarea>
                                                        @error('tindaklanjut_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title border-bottom mt-3">
                                            2. Evaluasi lokasi dan kondisi klien dan diskusi dengan klien untuk
                                            menentukan
                                            kesiapan audit tahap II
                                        </h4>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Lokasi audit apakah terjangkau
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_2_1') is-invalid @enderror" name="pemenuhan_2_1" id="pemenuhan_2_1">{{ old('pemenuhan_2_1', $stage1checkaudit->pemenuhan_2_1 ?? '') }}</textarea>
                                                        @error('pemenuhan_2_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_2_1') is-invalid @enderror" name="tindaklanjut_2_1"
                                                            id="tindaklanjut_2_1">{{ old('tindaklanjut_2_1', $stage1checkaudit->tindaklanjut_2_1 ?? '') }}</textarea>
                                                        @error('tindaklanjut_2_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Apakah lokasi klien dapat
                                                diakses
                                                dengan menggunakan transportasi pribadi atau umum
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_2_2') is-invalid @enderror" name="pemenuhan_2_2" id="pemenuhan_2_2">{{ old('pemenuhan_2_2', $stage1checkaudit->pemenuhan_2_2 ?? '') }}</textarea>
                                                        @error('pemenuhan_2_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_2_2') is-invalid @enderror" name="tindaklanjut_2_2"
                                                            id="tindaklanjut_2_2">{{ old('tindaklanjut_2_2', $stage1checkaudit->tindaklanjut_2_2 ?? '') }}</textarea>
                                                        @error('tindaklanjut_2_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Jika sulit diakses dengan
                                                transportasi
                                                pribadi atau umum, apakah klien menyiapkan transportasi khusus yg
                                                menjamin
                                                tingkat keamanan tim audit
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_2_3') is-invalid @enderror" name="pemenuhan_2_3" id="pemenuhan_2_3">{{ old('pemenuhan_2_3', $stage1checkaudit->pemenuhan_2_3 ?? '') }}</textarea>
                                                        @error('pemenuhan_2_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_2_3') is-invalid @enderror" name="tindaklanjut_2_3"
                                                            id="tindaklanjut_2_3">{{ old('tindaklanjut_2_3', $stage1checkaudit->tindaklanjut_2_3 ?? '') }}</textarea>
                                                        @error('tindaklanjut_2_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Berapa jumlah karyawan yg
                                                dimiliki
                                                oleh
                                                klien
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_2_4') is-invalid @enderror" name="pemenuhan_2_4" id="pemenuhan_2_4">{{ old('pemenuhan_2_4', $stage1checkaudit->pemenuhan_2_4 ?? '') }}</textarea>
                                                        @error('pemenuhan_2_4')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_2_4') is-invalid @enderror" name="tindaklanjut_2_4"
                                                            id="tindaklanjut_2_4">{{ old('tindaklanjut_2_4', $stage1checkaudit->tindaklanjut_2_4 ?? '') }}</textarea>
                                                        @error('tindaklanjut_2_4')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Apakah klien telah siap untuk
                                                diaudit
                                                sesuai dgn jadwal yg telah ditentukan
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_2_5') is-invalid @enderror" name="pemenuhan_2_5" id="pemenuhan_2_5">{{ old('pemenuhan_2_5', $stage1checkaudit->pemenuhan_2_5 ?? '') }}</textarea>
                                                        @error('pemenuhan_2_5')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_2_5') is-invalid @enderror" name="tindaklanjut_2_5"
                                                            id="tindaklanjut_2_5">{{ old('tindaklanjut_2_5', $stage1checkaudit->tindaklanjut_2_5 ?? '') }}</textarea>
                                                        @error('tindaklanjut_2_5')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title border-bottom mt-3">
                                            3. Evaluasi status dan pemahaman klien terkait dengan persyaratan
                                            standar,
                                            khususnya identifikasi kinerja utama atau aspek yg signifikan, proses,
                                            sasaran
                                            dan operasi sistem manajemen
                                        </h4>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Sejak kapan sistem dokumentasi
                                                klien
                                                diterapkan
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_3_1') is-invalid @enderror" name="pemenuhan_3_1" id="pemenuhan_3_1">{{ old('pemenuhan_3_1', $stage1checkaudit->pemenuhan_3_1 ?? '') }}</textarea>
                                                        @error('pemenuhan_3_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_3_1') is-invalid @enderror" name="tindaklanjut_3_1"
                                                            id="tindaklanjut_3_1">{{ old('tindaklanjut_3_1', $stage1checkaudit->tindaklanjut_3_1 ?? '') }}</textarea>
                                                        @error('tindaklanjut_3_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Apakah klien telah menetapkan
                                                Key
                                                Performance Indicator untuk masing-masing fungsi yang dimiliki
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_3_2') is-invalid @enderror" name="pemenuhan_3_2" id="pemenuhan_3_2">{{ old('pemenuhan_3_2', $stage1checkaudit->pemenuhan_3_2 ?? '') }}</textarea>
                                                        @error('pemenuhan_3_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_3_2') is-invalid @enderror" name="tindaklanjut_3_2"
                                                            id="tindaklanjut_3_2">{{ old('tindaklanjut_3_2', $stage1checkaudit->tindaklanjut_3_2 ?? '') }}</textarea>
                                                        @error('tindaklanjut_3_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Apakah klien telah
                                                melaksanakan
                                                audit
                                                internal

                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_3_3') is-invalid @enderror" name="pemenuhan_3_3" id="pemenuhan_3_3">{{ old('pemenuhan_3_3', $stage1checkaudit->pemenuhan_3_3 ?? '') }}</textarea>
                                                        @error('pemenuhan_3_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_3_3') is-invalid @enderror" name="tindaklanjut_3_3"
                                                            id="tindaklanjut_3_3">{{ old('tindaklanjut_3_3', $stage1checkaudit->tindaklanjut_3_3 ?? '') }}</textarea>
                                                        @error('tindaklanjut_3_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Apakah klien telah
                                                melaksanakan
                                                tinjauan manajemen
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_3_4') is-invalid @enderror" name="pemenuhan_3_4" id="pemenuhan_3_4">{{ old('pemenuhan_3_4', $stage1checkaudit->pemenuhan_3_4 ?? '') }}</textarea>
                                                        @error('pemenuhan_3_4')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_3_4') is-invalid @enderror" name="tindaklanjut_3_4"
                                                            id="tindaklanjut_3_4">{{ old('tindaklanjut_3_4', $stage1checkaudit->tindaklanjut_3_4 ?? '') }}</textarea>
                                                        @error('tindaklanjut_3_4')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title border-bottom mt-3">
                                            4. Verifikasi informasi terkait dengan ling-kup sistem manajemen, proses
                                            &
                                            lokasi klien serta peraturan perundang-undangan yg digunakan oleh klien
                                        </h4>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Apakah lingkup sertifikasi
                                                yang
                                                diajukan sesuai dengan bisnis proses yg dimiliki oleh klien
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_4_1') is-invalid @enderror" name="pemenuhan_4_1" id="pemenuhan_4_1">{{ old('pemenuhan_4_1', $stage1checkaudit->pemenuhan_4_1 ?? '') }}</textarea>
                                                        @error('pemenuhan_4_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_4_1') is-invalid @enderror" name="tindaklanjut_4_1"
                                                            id="tindaklanjut_4_1">{{ old('tindaklanjut_4_1', $stage1checkaudit->tindaklanjut_4_1 ?? '') }}</textarea>
                                                        @error('tindaklanjut_4_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Apakah ada lingkup bisnis
                                                proses yg
                                                dikecualikan oleh klien dalam rangka sertifikasi
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_4_2') is-invalid @enderror" name="pemenuhan_4_2" id="pemenuhan_4_2">{{ old('pemenuhan_4_2', $stage1checkaudit->pemenuhan_4_2 ?? '') }}</textarea>
                                                        @error('pemenuhan_4_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_4_2') is-invalid @enderror" name="tindaklanjut_4_2"
                                                            id="tindaklanjut_4_2">{{ old('tindaklanjut_4_2', $stage1checkaudit->tindaklanjut_4_2 ?? '') }}</textarea>
                                                        @error('tindaklanjut_4_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Apakah ada peraturan dan
                                                perundangan yg
                                                diacu dalam menjalankan bisnis proses klien
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_4_3') is-invalid @enderror" name="pemenuhan_4_3" id="pemenuhan_4_3">{{ old('pemenuhan_4_3', $stage1checkaudit->pemenuhan_4_3 ?? '') }}</textarea>
                                                        @error('pemenuhan_4_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_4_3') is-invalid @enderror" name="tindaklanjut_4_3"
                                                            id="tindaklanjut_4_3">{{ old('tindaklanjut_4_3', $stage1checkaudit->tindaklanjut_4_3 ?? '') }}</textarea>
                                                        @error('tindaklanjut_4_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title border-bottom mt-3">
                                            5. Alokasi sumber daya untuk audit tahap II dan persetujuan klien
                                            terkait
                                            rencana audit tahap II
                                        </h4>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Apakah tim audit yg
                                                ditugaskan,
                                                telah
                                                memiliki kompetensi yg sesuai dengan bisnis proses klien
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_5_1') is-invalid @enderror" name="pemenuhan_5_1" id="pemenuhan_5_1">{{ old('pemenuhan_5_1', $stage1checkaudit->pemenuhan_5_1 ?? '') }}</textarea>
                                                        @error('pemenuhan_5_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_5_1') is-invalid @enderror" name="tindaklanjut_5_1"
                                                            id="tindaklanjut_5_1">{{ old('tindaklanjut_5_1', $stage1checkaudit->tindaklanjut_5_1 ?? '') }}</textarea>
                                                        @error('tindaklanjut_5_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Apakah diperlukan penambahan
                                                mandays audit dalam pelaksanaan audit yang direncanakan
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_5_2') is-invalid @enderror" name="pemenuhan_5_2" id="pemenuhan_5_2">{{ old('pemenuhan_5_2', $stage1checkaudit->pemenuhan_5_2 ?? '') }}</textarea>
                                                        @error('pemenuhan_5_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_5_2') is-invalid @enderror" name="tindaklanjut_5_2"
                                                            id="tindaklanjut_5_2">{{ old('tindaklanjut_5_2', $stage1checkaudit->tindaklanjut_5_2 ?? '') }}</textarea>
                                                        @error('tindaklanjut_5_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-12 col-form-label">Apakah diperlukan penambahan
                                                sumberdaya (penterjemah, guide) dalam pelaksanaan audit
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Pemenuhan</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('pemenuhan_5_3') is-invalid @enderror" name="pemenuhan_5_3" id="pemenuhan_5_3">{{ old('pemenuhan_5_3', $stage1checkaudit->pemenuhan_5_3 ?? '') }}</textarea>
                                                        @error('pemenuhan_5_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Tindaklanjut</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('tindaklanjut_5_3') is-invalid @enderror" name="tindaklanjut_5_3"
                                                            id="tindaklanjut_5_3">{{ old('tindaklanjut_5_3', $stage1checkaudit->tindaklanjut_5_3 ?? '') }}</textarea>
                                                        @error('tindaklanjut_5_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title border-bottom mt-3">
                                            6. Hal-hal yg menjadi fokus pada pelaksanaan audit tahap II
                                        </h4>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control @error('fokus_pelaksanaan_tahap2') is-invalid @enderror" rows="10"
                                                            name="fokus_pelaksanaan_tahap2" id="fokus_pelaksanaan_tahap2">{{ old('fokus_pelaksanaan_tahap2', $stage1checkaudit->fokus_pelaksanaan_tahap2 ?? '') }}</textarea>
                                                        @error('fokus_pelaksanaan_tahap2')
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
                                                        <textarea class="form-control @error('catatan') is-invalid @enderror" name="catatan" id="catatan">{{ old('catatan', $stage1checkaudit->catatan ?? '') }}</textarea>
                                                        @error('catatan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title">
                                            Rekomendasi Audit Tahap
                                        </h4>
                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <div class="form-check">
                                                        <label class="form-check-label col-sm-12">
                                                            <input type="radio" class="form-check-input"
                                                                name="rekom_tahap_audit" id="rekom_tahap_audit"
                                                                value="lanjut"
                                                                {{ old('lanjut', $stage1checkaudit->rekom_tahap_audit ?? '') == 'lanjut' ? 'checked' : '' }} />
                                                            Dilanjutkan audit tahap II
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-7 mb-5">
                                                    <div class="form-check">
                                                        <label class="form-check-label col-sm-12">
                                                            <input type="radio" class="form-check-input"
                                                                name="rekom_tahap_audit" id="rekom_tahap_audit"
                                                                value="ditunda"
                                                                {{ old('ditunda', $stage1checkaudit->rekom_tahap_audit ?? '') == 'ditunda' ? 'checked' : '' }} />
                                                            Ditunda sampai organisasi menyelesaikan tindakan
                                                            perbaikan
                                                            audit
                                                            tahap I
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <hr style="margin-top:-10px; border:2px solid rgb(0, 0, 0)">
                                        <br>
                                        <h4 class="card-title mb-3 border-bottom mb-4">
                                            1. Konteks Organisasi
                                        </h4>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">4.1 Memahami organisasi dan
                                                konteksnya
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_4_1') is-invalid @enderror" name="acuan_4_1"
                                                            id="acuan_4_1">{{ old('acuan_4_1', $stage1checkaudit->acuan_4_1 ?? '') }}</textarea>
                                                        @error('acuan_4_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_4_1') is-invalid @enderror" name="verifikasi_4_1"
                                                            id="verifikasi_4_1">{{ old('verifikasi_4_1', $stage1checkaudit->verifikasi_4_1 ?? '') }}</textarea>
                                                        @error('verifikasi_4_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">4.2 Memahami kebutuhan dan
                                                harapan pihak berkepentingan
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_4_2') is-invalid @enderror" name="acuan_4_2"
                                                            id="acuan_4_2">{{ old('acuan_4_2', $stage1checkaudit->acuan_4_2 ?? '') }}</textarea>
                                                        @error('acuan_4_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_4_2') is-invalid @enderror" name="verifikasi_4_2"
                                                            id="verifikasi_4_2">{{ old('verifikasi_4_2', $stage1checkaudit->verifikasi_4_2 ?? '') }}</textarea>
                                                        @error('verifikasi_4_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">4.3 Menentukan lingkup sistem
                                                manajemen mutu
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_4_3') is-invalid @enderror" name="acuan_4_3"
                                                            id="acuan_4_3">{{ old('acuan_4_3', $stage1checkaudit->acuan_4_3 ?? '') }}</textarea>
                                                        @error('acuan_4_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_4_3') is-invalid @enderror" name="verifikasi_4_3"
                                                            id="verifikasi_4_3">{{ old('verifikasi_4_3', $stage1checkaudit->verifikasi_4_3 ?? '') }}</textarea>
                                                        @error('verifikasi_4_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">4.4 Sistem manajemen mutu
                                                dan prosesnya
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_4_4') is-invalid @enderror" name="acuan_4_4"
                                                            id="acuan_4_4">{{ old('acuan_4_4', $stage1checkaudit->acuan_4_4 ?? '') }}</textarea>
                                                        @error('acuan_4_4')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_4_4') is-invalid @enderror" name="verifikasi_4_4"
                                                            id="verifikasi_4_4">{{ old('verifikasi_4_4', $stage1checkaudit->verifikasi_4_4 ?? '') }}</textarea>
                                                        @error('verifikasi_4_4')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-3 border-bottom mb-4">
                                            2. Kepemimpinan
                                        </h4>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">5.1 Kepemimpinan dan
                                                komitmen
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_5_1') is-invalid @enderror" name="acuan_5_1"
                                                            id="acuan_5_1">{{ old('acuan_5_1', $stage1checkaudit->acuan_5_1 ?? '') }}</textarea>
                                                        @error('acuan_5_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_5_1') is-invalid @enderror" name="verifikasi_5_1"
                                                            id="verifikasi_5_1">{{ old('verifikasi_5_1', $stage1checkaudit->verifikasi_5_1 ?? '') }}</textarea>
                                                        @error('verifikasi_5_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">5.2 Kebijakan
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_5_2') is-invalid @enderror" name="acuan_5_2"
                                                            id="acuan_5_2">{{ old('acuan_5_2', $stage1checkaudit->acuan_5_2 ?? '') }}</textarea>
                                                        @error('acuan_5_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_5_2') is-invalid @enderror" name="verifikasi_5_2"
                                                            id="verifikasi_5_2">{{ old('verifikasi_5_2', $stage1checkaudit->verifikasi_5_2 ?? '') }}</textarea>
                                                        @error('verifikasi_5_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">5.3 Peran, tanggungjawab dan
                                                wewenang organisasi
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_5_3') is-invalid @enderror" name="acuan_5_3"
                                                            id="acuan_5_3">{{ old('acuan_5_3', $stage1checkaudit->acuan_5_3 ?? '') }}</textarea>
                                                        @error('acuan_5_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_5_3') is-invalid @enderror" name="verifikasi_5_3"
                                                            id="verifikasi_5_3">{{ old('verifikasi_5_3', $stage1checkaudit->verifikasi_5_3 ?? '') }}</textarea>
                                                        @error('verifikasi_5_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-3 border-bottom mb-4">
                                            3. Perencanaan
                                        </h4>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">6.1 Tindakan ditujukan pada
                                                peluang dan risiko
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_6_1') is-invalid @enderror" name="acuan_6_1"
                                                            id="acuan_6_1">{{ old('acuan_6_1', $stage1checkaudit->acuan_6_1 ?? '') }}</textarea>
                                                        @error('acuan_6_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_6_1') is-invalid @enderror" name="verifikasi_6_1"
                                                            id="verifikasi_6_1">{{ old('verifikasi_6_1', $stage1checkaudit->verifikasi_6_1 ?? '') }}</textarea>
                                                        @error('verifikasi_6_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">6.2 Sasaran mutu dan
                                                perencanaan untuk mencapai sasaran
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_6_2') is-invalid @enderror" name="acuan_6_2"
                                                            id="acuan_6_2">{{ old('acuan_6_2', $stage1checkaudit->acuan_6_2 ?? '') }}</textarea>
                                                        @error('acuan_6_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_6_2') is-invalid @enderror" name="verifikasi_6_2"
                                                            id="verifikasi_6_2">{{ old('verifikasi_6_2', $stage1checkaudit->verifikasi_6_2 ?? '') }}</textarea>
                                                        @error('verifikasi_6_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">6.3 Perubahan perencanaan
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_6_3') is-invalid @enderror" name="acuan_6_3"
                                                            id="acuan_6_3">{{ old('acuan_6_3', $stage1checkaudit->acuan_6_3 ?? '') }}</textarea>
                                                        @error('acuan_6_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_6_3') is-invalid @enderror" name="verifikasi_6_3"
                                                            id="verifikasi_6_3">{{ old('verifikasi_6_3', $stage1checkaudit->verifikasi_6_3 ?? '') }}</textarea>
                                                        @error('verifikasi_6_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-3 border-bottom mb-4">
                                            4. Dukungan
                                        </h4>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">7.1 Sumberdaya
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_7_1') is-invalid @enderror" name="acuan_7_1"
                                                            id="acuan_7_1">{{ old('acuan_7_1', $stage1checkaudit->acuan_7_1 ?? '') }}</textarea>
                                                        @error('acuan_7_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_7_1') is-invalid @enderror" name="verifikasi_7_1"
                                                            id="verifikasi_7_1">{{ old('verifikasi_7_1', $stage1checkaudit->verifikasi_7_1 ?? '') }}</textarea>
                                                        @error('verifikasi_7_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">7.2 Kompetensi
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_7_2') is-invalid @enderror" name="acuan_7_2"
                                                            id="acuan_7_2">{{ old('acuan_7_2', $stage1checkaudit->acuan_7_2 ?? '') }}</textarea>
                                                        @error('acuan_7_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_7_2') is-invalid @enderror" name="verifikasi_7_2"
                                                            id="verifikasi_7_2">{{ old('verifikasi_7_2', $stage1checkaudit->verifikasi_7_2 ?? '') }}</textarea>
                                                        @error('verifikasi_7_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">7.3 Kepedulian
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_7_3') is-invalid @enderror" name="acuan_7_3"
                                                            id="acuan_7_3">{{ old('acuan_7_3', $stage1checkaudit->acuan_7_3 ?? '') }}</textarea>
                                                        @error('acuan_7_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_7_3') is-invalid @enderror" name="verifikasi_7_3"
                                                            id="verifikasi_7_3">{{ old('verifikasi_7_3', $stage1checkaudit->verifikasi_7_3 ?? '') }}</textarea>
                                                        @error('verifikasi_7_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">7.4 Komunikas
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_7_4') is-invalid @enderror" name="acuan_7_4"
                                                            id="acuan_7_4">{{ old('acuan_7_4', $stage1checkaudit->acuan_7_4 ?? '') }}</textarea>
                                                        @error('acuan_7_4')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_7_4') is-invalid @enderror" name="verifikasi_7_4"
                                                            id="verifikasi_7_4">{{ old('verifikasi_7_4', $stage1checkaudit->verifikasi_7_4 ?? '') }}</textarea>
                                                        @error('verifikasi_7_4')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">7.5 Informasi terdokumentasi
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_7_5') is-invalid @enderror" name="acuan_7_5"
                                                            id="acuan_7_5">{{ old('acuan_7_5', $stage1checkaudit->acuan_7_5 ?? '') }}</textarea>
                                                        @error('acuan_7_5')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_7_5') is-invalid @enderror" name="verifikasi_7_5"
                                                            id="verifikasi_7_5">{{ old('verifikasi_7_5', $stage1checkaudit->verifikasi_7_5 ?? '') }}</textarea>
                                                        @error('verifikasi_7_5')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title mt-3 border-bottom mb-4">
                                            5. Operasi
                                        </h4>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">8.1 Perencanaan dan
                                                pengendalian operasi
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_8_1') is-invalid @enderror" name="acuan_8_1"
                                                            id="acuan_8_1">{{ old('acuan_8_1', $stage1checkaudit->acuan_8_1 ?? '') }}</textarea>
                                                        @error('acuan_8_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_8_1') is-invalid @enderror" name="verifikasi_8_1"
                                                            id="verifikasi_8_1">{{ old('verifikasi_8_1', $stage1checkaudit->verifikasi_8_1 ?? '') }}</textarea>
                                                        @error('verifikasi_8_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">8.2 Persyaratan produk dan
                                                jasa
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_8_2') is-invalid @enderror" name="acuan_8_2"
                                                            id="acuan_8_2">{{ old('acuan_8_2', $stage1checkaudit->acuan_8_2 ?? '') }}</textarea>
                                                        @error('acuan_8_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_8_2') is-invalid @enderror" name="verifikasi_8_2"
                                                            id="verifikasi_8_2">{{ old('verifikasi_8_2', $stage1checkaudit->verifikasi_8_2 ?? '') }}</textarea>
                                                        @error('verifikasi_8_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">8.3 Desain dan pengembangan
                                                produk dan jasa
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_8_3') is-invalid @enderror" name="acuan_8_3"
                                                            id="acuan_8_3">{{ old('acuan_8_3', $stage1checkaudit->acuan_8_3 ?? '') }}</textarea>
                                                        @error('acuan_8_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_8_3') is-invalid @enderror" name="verifikasi_8_3"
                                                            id="verifikasi_8_3">{{ old('verifikasi_8_3', $stage1checkaudit->verifikasi_8_3 ?? '') }}</textarea>
                                                        @error('verifikasi_8_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">8.4 Pengendalian proses,
                                                produk dan jasa yang disediakan eksternal
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_8_4') is-invalid @enderror" name="acuan_8_4"
                                                            id="acuan_8_4">{{ old('acuan_8_4', $stage1checkaudit->acuan_8_4 ?? '') }}</textarea>
                                                        @error('acuan_8_4')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_8_4') is-invalid @enderror" name="verifikasi_8_4"
                                                            id="verifikasi_8_4">{{ old('verifikasi_8_4', $stage1checkaudit->verifikasi_8_4 ?? '') }}</textarea>
                                                        @error('verifikasi_8_4')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">8.5 Produksi dan penyediaan
                                                jasa
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_8_5') is-invalid @enderror" name="acuan_8_5"
                                                            id="acuan_8_5">{{ old('acuan_8_5', $stage1checkaudit->acuan_8_5 ?? '') }}</textarea>
                                                        @error('acuan_8_5')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_8_5') is-invalid @enderror" name="verifikasi_8_5"
                                                            id="verifikasi_8_5">{{ old('verifikasi_8_5', $stage1checkaudit->verifikasi_8_5 ?? '') }}</textarea>
                                                        @error('verifikasi_8_5')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">8.6 Pelepasan produk dan jasa
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_8_6') is-invalid @enderror" name="acuan_8_6"
                                                            id="acuan_8_6">{{ old('acuan_8_6', $stage1checkaudit->acuan_8_6 ?? '') }}</textarea>
                                                        @error('acuan_8_6')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_8_6') is-invalid @enderror" name="verifikasi_8_6"
                                                            id="verifikasi_8_6">{{ old('verifikasi_8_6', $stage1checkaudit->verifikasi_8_6 ?? '') }}</textarea>
                                                        @error('verifikasi_8_6')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">8.7 Pengendalian
                                                ketidaksesuaian keluaran
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_8_7') is-invalid @enderror" name="acuan_8_7"
                                                            id="acuan_8_7">{{ old('acuan_8_7', $stage1checkaudit->acuan_8_7 ?? '') }}</textarea>
                                                        @error('acuan_8_7')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_8_7') is-invalid @enderror" name="verifikasi_8_7"
                                                            id="verifikasi_8_7">{{ old('verifikasi_8_7', $stage1checkaudit->verifikasi_8_7 ?? '') }}</textarea>
                                                        @error('verifikasi_8_7')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title mt-3 border-bottom mb-4">
                                            6. Evaluasi kinerja
                                        </h4>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">9.1 Pemantauan, pengukuran,
                                                analisis dan evaluas
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_9_1') is-invalid @enderror" name="acuan_9_1"
                                                            id="acuan_9_1">{{ old('acuan_9_1', $stage1checkaudit->acuan_9_1 ?? '') }}</textarea>
                                                        @error('acuan_9_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_9_1') is-invalid @enderror" name="verifikasi_9_1"
                                                            id="verifikasi_9_1">{{ old('verifikasi_9_1', $stage1checkaudit->verifikasi_9_1 ?? '') }}</textarea>
                                                        @error('verifikasi_9_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">9.2 Audit internal
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_9_2') is-invalid @enderror" name="acuan_9_2"
                                                            id="acuan_9_2">{{ old('acuan_9_2', $stage1checkaudit->acuan_9_2 ?? '') }}</textarea>
                                                        @error('acuan_9_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_9_2') is-invalid @enderror" name="verifikasi_9_2"
                                                            id="verifikasi_9_2">{{ old('verifikasi_9_2', $stage1checkaudit->verifikasi_9_2 ?? '') }}</textarea>
                                                        @error('verifikasi_9_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">9.3 Tinjauan manajemen
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_9_3') is-invalid @enderror" name="acuan_9_3"
                                                            id="acuan_9_3">{{ old('acuan_9_3', $stage1checkaudit->acuan_9_3 ?? '') }}</textarea>
                                                        @error('acuan_9_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_9_3') is-invalid @enderror" name="verifikasi_9_3"
                                                            id="verifikasi_9_3">{{ old('verifikasi_9_3', $stage1checkaudit->verifikasi_9_3 ?? '') }}</textarea>
                                                        @error('verifikasi_9_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title mt-3 border-bottom mb-4">
                                            7. Peningkatan
                                        </h4>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">10.1 Umum
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_10_1') is-invalid @enderror" name="acuan_10_1"
                                                            id="acuan_10_1">{{ old('acuan_10_1', $stage1checkaudit->acuan_10_1 ?? '') }}</textarea>
                                                        @error('acuan_10_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_10_1') is-invalid @enderror"
                                                            name="verifikasi_10_1" id="verifikasi_10_1">{{ old('verifikasi_10_1', $stage1checkaudit->verifikasi_10_1 ?? '') }}</textarea>
                                                        @error('verifikasi_10_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">10.2 Ketidaksesuaian dan
                                                tindakan korektif
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_10_2') is-invalid @enderror" name="acuan_10_2"
                                                            id="acuan_10_2">{{ old('acuan_10_2', $stage1checkaudit->acuan_10_2 ?? '') }}</textarea>
                                                        @error('acuan_10_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_10_2') is-invalid @enderror"
                                                            name="verifikasi_10_2" id="verifikasi_10_2">{{ old('verifikasi_10_2', $stage1checkaudit->verifikasi_10_2 ?? '') }}</textarea>
                                                        @error('verifikasi_10_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <h6 class="card-title">
                                                Persyaratan:
                                            </h6>
                                            <label class="col-sm-12 col-form-label">10.3 Peningkatan berkelanjutan
                                            </label>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Acuan</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('acuan_10_3') is-invalid @enderror" name="acuan_10_3"
                                                            id="acuan_10_3">{{ old('acuan_10_3', $stage1checkaudit->acuan_10_3 ?? '') }}</textarea>
                                                        @error('acuan_10_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Verifikasi</label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control @error('verifikasi_10_3') is-invalid @enderror"
                                                            name="verifikasi_10_3" id="verifikasi_10_3">{{ old('verifikasi_10_3', $stage1checkaudit->verifikasi_10_3 ?? '') }}</textarea>
                                                        @error('verifikasi_10_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mb-3 mt-3">
                                            <h6 class="card-title border-bottom mb-4">TANGGAL TTD</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="tanggal_ttd">Tanggal</label>
                                                        <input
                                                            class="form-control mt-1 @error('tanggal_ttd') is-invalid @enderror"
                                                            name="tanggal_ttd" type="date" id="tanggal_ttd"
                                                            value="{{ old('tanggal_ttd', $stage1checkaudit->tanggal_ttd ?? '') }}" />
                                                        @error('tanggal_ttd')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="nama_auditor">Nama Auditor </label>
                                                        <input
                                                            class="form-control mt-1 @error('nama_auditor') is-invalid @enderror"
                                                            name="nama_auditor" type="text" id="nama_auditor"
                                                            value="{{ old('nama_auditor', $stage1checkaudit->nama_auditor ?? '') }}" />
                                                        @error('nama_auditor')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($stage1checkaudit == '')
                                            @if (in_array('F-CER-06 - Check List Audit Stage I.store', $roles))
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    Simpan
                                                </button>
                                            @endif
                                        @elseif($stage1checkaudit->status != 2)
                                            @if (in_array('F-CER-06 - Check List Audit Stage I.update', $roles))
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    Simpan
                                                </button>
                                            @endif
                                        @endif

                                        @if ($stage1checkaudit)
                                            @if (in_array('F-CER-06 - Check List Audit Stage I.download', $roles))
                                                <a href="/dashboard/stage1checkaudits/download/{{ $stage1checkaudit->id }}"
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
                @if ($stage1checkaudit)
                    <form
                        action="/dashboard/stage1checkauditsvalidasi{{ $stage1checkaudit ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($stage1checkaudit)
                            @method('PUT')
                        @endif

                        <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                        <input type="hidden" id="status" value="{{ $stage1checkaudit->status ?? '' }}">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">Status</h4>
                                @if (in_array('F-CER-06 - Check List Audit Stage I.validasi', $roles))
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
                                    @if ($stage1checkaudit->dipending_keterangan)
                                        <label class="mt-3">Keterangan</label>
                                        <div>
                                            <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                                disabled>{{ $stage1checkaudit->dipending_keterangan }}</textarea>
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
                    let status = response.stage1checkaudit.dipending_keterangan ?? '';

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
                        let status = response.stage1checkaudit
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
