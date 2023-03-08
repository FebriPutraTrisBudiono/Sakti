@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        <a href="/dashboard/client/{{ $client->id }}" class="me-2"><i
                                class="fas fa-arrow-circle-left"></i></a>
                        {{ $listpermohonan_id->proses_sertifikasi }}
                    </div>
                    <div class="card-body">
                        @include('dashboard.navbarstatus')

                        {!! session('msg') !!}

                        <input type="hidden" value="{{ $client->id }}" name="client_id" id="client_id">
                        <input type="hidden" value="{{ $listpermohonan_id->id }}" name="listpermohonan_id"
                            id="listpermohonan_id">
                        <input type="hidden" value="{{ $listpermohonan_id->slug }}" name="listpermohonan_slug"
                            id="listpermohonan_slug">

                        <h4 style="text-align: center">RENCANA AUDIT</h4>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nama_client">Nama Organisasi</label>
                                    <input class="form-control @error('nama_client') is-invalid @enderror mt-1"
                                        name="nama_client" type="text" id="nama_client"
                                        value="{{ old('nama_client', $permohonansertifikasi->nama_perusahaan ?? '') }}"
                                        readonly />
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
                                    <input class="form-control @error('standart') is-invalid @enderror mt-1" name="standart"
                                        type="text" id="standart"
                                        value="{{ old('standart', $rencanaclient->standart ?? '') }}" readonly />
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
                                    readonly>{{ old('alamat', $permohonansertifikasi->alamat ?? '') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="form-group mb-3">
                                <label for="ruang_lingkup">Ruang Lingkup Sertifikasi</label>
                                <input class="form-control mt-1 @error('ruang_lingkup') is-invalid @enderror"
                                    name="ruang_lingkup" type="text" id="ruang_lingkup"
                                    value="{{ old('ruang_lingkup', $permohonansertifikasi->ruang_lingkup_perusahaan ?? '') }}"
                                    readonly />
                                @error('ruang_lingkup')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <h6 class="card-title mb-3 border-bottom mb-4">Sasaran</h6>
                        <div class="col-sm-12 mb-3">
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox"
                                                class="form-check-input @error('audit') is-invalid @enderror" name="audit"
                                                id="audit" value="pra_audit"
                                                {{ old('pra_audit', $arraudit[0]) == 'pra_audit' ? 'checked' : '' }}
                                                disabled />
                                            Pra Audit
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="audit" id="audit"
                                                value="stage1"
                                                {{ old('stage1', $arraudit[1]) == 'stage1' ? 'checked' : '' }} disabled />
                                            Stage 1
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="audit" id="audit"
                                                value="stage2"
                                                {{ old('stage2', $arraudit[2]) == 'stage2' ? 'checked' : '' }} disabled />
                                            Stage 2
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="audit" id="audit"
                                                value="surveilen"
                                                {{ old('surveilen', $arraudit[3]) == 'surveilen' ? 'checked' : '' }}
                                                disabled />
                                            Surveilan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="audit" id="audit"
                                                value="tindaklanjut"
                                                {{ old('tindaklanjut', $arraudit[4]) == 'tindaklanjut' ? 'checked' : '' }}
                                                disabled />
                                            Tindaklanjut
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2 mb-3">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="audit"
                                                id="audit" value="resertifikasi"
                                                {{ old('resertifikasi', $arraudit[5]) == 'resertifikasi' ? 'checked' : '' }}
                                                disabled />
                                            Resertifikasi
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h6 class="card-title mb-3 border-bottom mb-4">Tim Audit</h6>
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
                                    <label>Inisial</label>
                                    <div class="col-sm-12">
                                        <input type="text"
                                            class="form-control mt-1 @error('nama_inisial') is-invalid @enderror"
                                            id="nama_inisial" name="nama_inisial"
                                            value="{{ old('nama_inisial', $stage1penunjukantimaudit->nama_inisial ?? '') }}"readonly />
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
                                            id="nama_auditor2" name="nama_auditor2" placeholder="optional"
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
                                            id="nama_inisial2" name="nama_inisial2" placeholder="optional"
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
                                            id="nama_auditor3" name="nama_auditor3" placeholder="optional"
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
                                            id="nama_inisial3" name="nama_inisial3" placeholder="optional"
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

                        <div class="row mt-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Untuk Bertugas Tanggal</label>
                                    <div class="col-sm-12">
                                        <input class="form-control mt-1 @error('tanggal_bertugas') is-invalid @enderror"
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
                                        <input class="form-control mt-1 @error('sampai_dengan') is-invalid @enderror"
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

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label for="waktu_rapat">Waktu</label>
                                    <input class="form-control @error('waktu_rapat') is-invalid @enderror mt-1"
                                        name="waktu_rapat" type="date" id="waktu_rapat"
                                        value="{{ old('waktu_rapat', $stage2rencanaaudit->waktu_rapat ?? '') }}" />
                                    @error('waktu_rapat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group mb-3">
                                    <label for="standart"></label>
                                    <input class="form-control @error('standart') is-invalid @enderror mt-1"
                                        name="standart" type="text" id="standart" value="Rapat Pembukaan"
                                        readonly />
                                    @error('standart')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label for="waktu_verifikasi">Waktu</label>
                                    <input class="form-control @error('waktu_verifikasi') is-invalid @enderror mt-1"
                                        name="waktu_verifikasi" type="date" id="waktu_verifikasi"
                                        value="{{ old('waktu_verifikasi', $stage2rencanaaudit->waktu_verifikasi ?? '') }}" />
                                    @error('waktu_verifikasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group mb-3">
                                    <label for="standart"></label>
                                    <input class="form-control @error('standart') is-invalid @enderror mt-1"
                                        name="standart" type="text" id="standart"
                                        value="Verifikasi Tindakan Perbaikan (khusus Survailen)
                                        "
                                        readonly />
                                    @error('standart')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col mb-3 mt-3">
                            <h6 class="card-title border-bottom mb-4">TANGGAL TTD</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="tanggal_ttd">Tanggal</label>
                                        <input class="form-control mt-1 @error('tanggal_ttd') is-invalid @enderror"
                                            name="tanggal_ttd" type="date" id="tanggal_ttd"
                                            value="{{ old('tanggal_ttd', $stage2rencanaaudit->tanggal_ttd ?? '') }}" />
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
                                        <?php
                                        $user = new App\Models\User();
                                        $userid = $user::where('id', $stage1penunjukantimaudit->nama_auditor)->first();
                                        ?>
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
                        </div>
                        <div class="col mb-3">
                            <h6 class="card-title border-bottom mb-4">Disetujui Oleh</h6>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="nama_manajer">Nama Manajer Sertifikasi</label>
                                        <input class="form-control mt-1 @error('nama_manajer') is-invalid @enderror"
                                            name="nama_manajer" type="text" id="nama_manajer"
                                            value="{{ old('nama_manajer', $stage2rencanaaudit->nama_manajer ?? '') }}" />
                                        @error('nama_manajer')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (in_array('F-CER-05 - Rencana Audit.download', $roles))
                            @if ($stage2rencanaaudit)
                                <a href="/dashboard/stage2rencanaaudits/download/{{ $stage2rencanaaudit->id }}"
                                    class="btn btn-secondary" target='_blank'>
                                    Download
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="card-title mb-3 border-bottom mt-4">Form fungsi yang diaudit</h6>
                        <div class="row control-group after-add-more">
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label for="waktu">Waktu</label>
                                    <input class="form-control" name="waktu" id="waktu" type="date" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label for="bagian">Bagian</label>
                                    <input class="form-control" name="bagian" id="bagian" type="text" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label for="klausul">Klausul</label>
                                    <input class="form-control" name="klausul" id="klausul" type="text" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label for="auditor">Auditor</label>
                                    <input class="form-control" name="auditor" id="auditor" type="text" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                                </div>
                            </div>
                        </div>
                        @if ($stage2rencanaaudit == '' || $stage2rencanaaudit->status != 2)
                            <button type="button" class="btn btn-primary btn-sm mt-3 float-start addFungsiAudit"><i
                                    class="fas fa-plus-circle me-1"></i> Tambah</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        DATA FUNGSI YANG DI AUDIT BARU
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="customTable" class="table table-bordered small" style="width:100%">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="py-2">#</th>
                                        <th class="py-2">Waktu</th>
                                        <th class="py-2">Bagian</th>
                                        <th class="py-2">Klausul</th>
                                        <th class="py-2">Auditor</th>
                                        <th class="py-2">Keterangan</th>
                                        <th class="py-2">HAPUS</th>
                                    </tr>
                                </thead>
                                <tbody id="cartListFungsiAudit">
                                </tbody>
                            </table>

                            <input type="hidden" value="{{ $stage2rencanaaudit->client_id ?? '' }}"
                                name="stage2rencanaaudit_clientid" id="stage2rencanaaudit_clientid">
                            <button type="button"
                                class="clearItem btn btn-light btn-sm float-start mt-3">Bersihkan</button>
                            @if ($stage2rencanaaudit == '')
                                @if (in_array('F-CER-05 - Rencana Audit.store', $roles))
                                    <button type="button"
                                        class="btnInsertFungsiAudit btn btn-primary float-end btn-sm mt-3">Simpan</button>
                                @endif
                            @elseif ($stage2rencanaaudit->status != 2)
                                @if (in_array('F-CER-05 - Rencana Audit.update', $roles))
                                    <button type="button"
                                        class="btnInsertFungsiAudit btn btn-primary float-end btn-sm mt-3">Simpan</button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        DATA FUNGSI YANG DI AUDIT
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablefungsiaudit" class="table table-bordered small" style="width:100%">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="py-2">#</th>
                                        <th class="py-2">Waktu</th>
                                        <th class="py-2">Bagian</th>
                                        <th class="py-2">Klausul</th>
                                        <th class="py-2">Auditor</th>
                                        <th class="py-2">Keterangan</th>
                                        <th class="py-2">HAPUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($stage2rencanaaudit_items != '')
                                        @foreach ($stage2rencanaaudit_items as $item)
                                            <tr>
                                                <td class="py-2" style="text-align: center">{{ $loop->iteration }}</td>
                                                <td class="py-2" style="vertical-align:middle;">
                                                    {{ $item->waktu }}
                                                </td>
                                                <td class="py-2" style="vertical-align:middle;">{{ $item->bagian }}
                                                </td>
                                                <td class="py-2" style="text-align: center">{{ $item->klausul }}</td>
                                                <td class="py-2" style="text-align: center">{{ $item->auditor }}</td>
                                                <td class="py-2" style="text-align: center">{{ $item->keterangan }}
                                                </td>
                                                <td class="py-2" style="vertical-align:middle;">
                                                    <form action="/dashboard/stage2rencanaaudits/{{ $item->id }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-datatable btn-icon btn-transparent-dark"
                                                            onclick="return confirm('Yakin ingin melanjutkan?')"><i
                                                                data-feather="trash-2"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="py-2" style="text-align: center" colspan="6">Data Belum
                                                Tersedia.
                                            </td>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($stage2rencanaaudit)
            <div class="row">
                <div class="col-lg">
                    <form
                        action="/dashboard/stage2rencanaauditsvalidasi{{ $stage2rencanaaudit ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($stage2rencanaaudit)
                            @method('PUT')
                        @endif

                        <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                        <input type="hidden" id="status" value="{{ $stage2rencanaaudit->status ?? '' }}">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Status</h4>
                                @if (in_array('F-CER-05 - Rencana Audit.validasi', $roles))
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
                                    @if ($stage2rencanaaudit->dipending_keterangan)
                                        <label class="mt-3">Keterangan</label>
                                        <div>
                                            <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                                disabled>{{ $stage2rencanaaudit->dipending_keterangan }}</textarea>
                                        </div>
                                        <button name="status" value="1" type="submit"
                                            class="btn btn-warning mt-3">Simpan Status Revisi</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script>
        cartFungsiAudit();
        $(document).on('click', '.addFungsiAudit', function() {
            const cartList = cartLS.list();
            const dataBrg = {
                id: Math.random() + cartList.length + 1,
                waktu: $("#waktu").val(),
                bagian: $("#bagian").val(),
                klausul: $("#klausul").val(),
                auditor: $("#auditor").val(),
                keterangan: $("#keterangan").val(),
                price: 1
            };
            cartLS.add(dataBrg, 1);

            $('#waktu').val('');
            $('#bagian').val('');
            $('#klausul').val('');
            $('#auditor').val('');
            $('#keterangan').val('');
            cartFungsiAudit();
        });

        function cartFungsiAudit() {
            const cartList = cartLS.list();
            if (cartList.length > 0) {
                $('table #cartListFungsiAudit').html('');
                for (var i = 0; i < cartList.length; i++) {
                    $('table #cartListFungsiAudit').append(`
        <tr>
            <td>` + (i + 1) + `</td>
            <td>` + cartList[i].waktu + `</td>
            <td>` + cartList[i].bagian + `</td>
            <td>` + cartList[i].klausul + `</td>
            <td>` + cartList[i].auditor + `</td>
            <td>` + cartList[i].keterangan + `</td>
            <td><button class="btn btn-danger btn-sm removeItem" type="button" data-id="` +
                        cartList[i].id + `"><i class="fas fa-sm fa-trash fa-sm"></i></button></td>
        </tr>
    `);
                }
            } else {
                $('table #cartListFungsiAudit').html('');
                $('table #cartListFungsiAudit').append(
                    `<tr><td colspan="7" class="py-2 font-italic text-center">Data belum tersedia.</td></tr>`);
            }
        }

        $(document).on('click', '.removeItem', function() {
            r = confirm('Yakin ingin melanjutkan?');
            if (r == true) {
                const id = $(this).data('id');
                if (cartLS.exists(id)) {
                    cartLS.remove(id);
                    cartFungsiAudit();
                }
            }
        });

        $(document).on('click', '.clearItem', function() {
            r = confirm('Yakin ingin melanjutkan?');
            if (r == true) {
                cartLS.destroy();
                cartFungsiAudit();
            }
        });

        $(document).on('click', '.btnInsertFungsiAudit', function() {
            r = confirm('Yakin ingin melanjutkan?');
            if (r == true) {
                const client_id = $('#client_id').val();
                const listpermohonan_id = $('#listpermohonan_id').val();
                const listpermohonan_slug = $('#listpermohonan_slug').val();
                const waktu_rapat = $('#waktu_rapat').val();
                const waktu_verifikasi = $('#waktu_verifikasi').val();
                const tanggal_ttd = $('#tanggal_ttd').val();
                const nama_auditor = $('#nama_auditor').val();
                const nama_manajer = $('#nama_manajer').val();
                const clientid = $('#stage2rencanaaudit_clientid').val();
                const cartList = cartLS.list();

                if (cartList) {
                    if (clientid != '') {
                        $.ajax({
                            url: '/dashboard/stage2rencanaaudits/' + clientid + '/' + listpermohonan_id,
                            method: 'PUT',
                            data: {
                                client_id,
                                listpermohonan_id,
                                waktu_rapat,
                                waktu_verifikasi,
                                tanggal_ttd,
                                nama_auditor,
                                nama_manajer,
                                data: cartList
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status) {
                                    console.log('berhasil');
                                    cartLS.destroy();
                                    $("#toastAlert").toast({
                                        delay: 3000
                                    });
                                    $("#toastAlert").toast('show');
                                    $("#infoToast").html('Oops!');
                                    $(".toast-body>#message").html(response.msg);
                                    location.reload();
                                } else {
                                    console.log('gagal');
                                    $("#toastAlert").toast({
                                        delay: 3000
                                    });
                                    $("#toastAlert").toast('show');
                                    $("#infoToast").html('Oops!');
                                    $(".toast-body>#message").html(response.msg);
                                }
                            }
                        });
                    } else {
                        $.ajax({
                            url: '/dashboard/stage2rencanaaudits',
                            method: 'post',
                            data: {
                                client_id,
                                listpermohonan_id,
                                listpermohonan_slug,
                                waktu_rapat,
                                waktu_verifikasi,
                                tanggal_ttd,
                                nama_auditor,
                                nama_manajer,
                                data: cartList
                            },
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                if (response.status) {
                                    console.log('berhasil');
                                    cartLS.destroy();
                                    $("#toastAlert").toast({
                                        delay: 3000
                                    });
                                    $("#toastAlert").toast('show');
                                    $("#infoToast").html('Oops!');
                                    $(".toast-body>#message").html(response.msg);
                                    location.reload();
                                } else {
                                    console.log('gagal');
                                    $("#toastAlert").toast({
                                        delay: 3000
                                    });
                                    $("#toastAlert").toast('show');
                                    $("#infoToast").html('Oops!');
                                    $(".toast-body>#message").html(response.msg);
                                }
                            }
                        });
                    }

                } else {
                    $("#toastAlert").toast({
                        delay: 3000
                    });
                    $("#toastAlert").toast('show');
                    $("#infoToast").html('Oops!');
                    $(".toast-body>#message").html('Ada yang salah');
                }
            }
        });
    </script>
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
                    let status = response.stage2rencanaaudit.dipending_keterangan ?? '';

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
                        let status = response.stage2rencanaaudit
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
