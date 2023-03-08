@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/stage2ketidaksesuaianpages{{ $stage2ketidaksesuaianpage ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
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

                            @if ($stage2ketidaksesuaianpage)
                                @method('PUT')
                            @endif

                            <input type="hidden" value="{{ $client->id }}" name="client_id" id="client_id">
                            <input type="hidden" value="{{ $listpermohonan_id->id }}" name="listpermohonan_id">
                            <input type="hidden" value="{{ $listpermohonan_id->slug }}" name="listpermohonan_slug">

                            <h4 style="text-align: center" class="card-title border-bottom mb-4">LEMBAR KETIDAKSESUAIAN</h4>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_pimpinan">Nama Pemohon</label>
                                        <input class="form-control @error('nama_pimpinan') is-invalid @enderror mt-1"
                                            name="nama_pimpinan" type="text" id="nama_pimpinan"
                                            value="{{ old('nama_pimpinan', $permohonansertifikasi->nama_pimpinan ?? '') }}"
                                            readonly />
                                        @error('nama_pimpinan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="b1_lingkup">Ruang Lingkup</label>
                                        <input class="form-control @error('b1_lingkup') is-invalid @enderror mt-1"
                                            name="b1_lingkup" type="text" id="b1_lingkup"
                                            value="{{ old('tanggal', $permohonansertifikasi->ruang_lingkup_perusahaan ?? '') }}"
                                            readonly />
                                        @error('b1_lingkup')
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

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_wakil">Wakil Manajemen</label>
                                        <input class="form-control @error('nama_wakil') is-invalid @enderror mt-1"
                                            name="nama_wakil" type="text" id="nama_wakil"
                                            value="{{ old('nama_wakil', $permohonansertifikasi->nama_wakil ?? '') }}"
                                            readonly />
                                        @error('nama_wakil')
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
                                            value="{{ old('tanggal', $rencanaclient->standart ?? '') }}" readonly />
                                        @error('standart')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <h6 class="card-title mb-3 border-bottom mt-4">AUDIT</h6>
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
                                                <input type="checkbox" class="form-check-input" name="audit"
                                                    id="audit" value="resertifikasi"
                                                    {{ old('resertifikasi', $arraudit[5] ?? '') == 'resertifikasi' ? 'checked' : '' }}
                                                    disabled />
                                                Resertifikasi
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label>Tanggal Bertugas</label>
                                        <div class="col-sm-12">
                                            <input
                                                class="form-control mt-1 @error('tanggal_bertugas') is-invalid @enderror"
                                                name="tanggal_bertugas" type="date" id="tanggal_bertugas"
                                                value="{{ old('tanggal_bertugas', isset($stage1penunjukantimaudit->tanggal_bertugas) ? date('Y-m-d', strtotime($stage1penunjukantimaudit->tanggal_bertugas)) : '') }}"
                                                disabled />
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
                                                disabled />
                                            @error('sampai_dengan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="card-title mb-3 border-bottom mt-4">DAFTAR KETIDAKSESUAIAN</h6>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label>Kategori & Referensi Klausul</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="kategori" id="kategori">{{ old('kategori', $stage2ketidaksesuaianpage->kategori ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label>Ketidaksesuaian</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="ketidaksesuaian" id="ketidaksesuaian">{{ old('ketidaksesuaian', $stage2ketidaksesuaianpage->ketidaksesuaian ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label>Analisa Penyebab:</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="analisa" id="analisa">{{ old('analisa', $stage2ketidaksesuaianpage->analisa ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group row">
                                        <label>Tindakan Koreksi:</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="koreksi" id="koreksi">{{ old('koreksi', $stage2ketidaksesuaianpage->koreksi ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group row">
                                        <label>Korektif:</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="korektif" id="korektif">{{ old('korektif', $stage2ketidaksesuaianpage->korektif ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label>Hasil Verifikasi</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="hasil_verifikasi" id="hasil_verifikasi">{{ old('hasil_verifikasi', $stage2ketidaksesuaianpage->hasil_verifikasi ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label>Keterangan</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="keterangan" id="keterangan">{{ old('keterangan', $stage2ketidaksesuaianpage->keterangan ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="card-title mb-3 border-bottom mt-4">DAFTAR KETIDAKSESUAIAN (Optional)</h6>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label>Kategori & Referensi Klausul</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="kategori2" id="kategori2">{{ old('kategori2', $stage2ketidaksesuaianpage->kategori2 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label>Ketidaksesuaian</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="ketidaksesuaian2" id="ketidaksesuaian2">{{ old('ketidaksesuaian2', $stage2ketidaksesuaianpage->ketidaksesuaian2 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label>Analisa Penyebab:</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="analisa2" id="analisa2">{{ old('analisa2', $stage2ketidaksesuaianpage->analisa2 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group row">
                                        <label>Tindakan Koreksi:</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="koreksi2" id="koreksi2">{{ old('koreksi2', $stage2ketidaksesuaianpage->koreksi2 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group row">
                                        <label>Korektif:</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="korektif2" id="korektif2">{{ old('korektif2', $stage2ketidaksesuaianpage->korektif2 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label>Hasil Verifikasi</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="hasil_verifikasi2" id="hasil_verifikasi2">{{ old('hasil_verifikasi2', $stage2ketidaksesuaianpage->hasil_verifikasi2 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label>Keterangan</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="keterangan2" id="keterangan2">{{ old('keterangan2', $stage2ketidaksesuaianpage->keterangan2 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="card-title mb-3 border-bottom mt-4">DAFTAR KETIDAKSESUAIAN (Optional)</h6>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label>Kategori & Referensi Klausul</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="kategori3" id="kategori3">{{ old('kategori3', $stage2ketidaksesuaianpage->kategori3 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label>Ketidaksesuaian</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="ketidaksesuaian3" id="ketidaksesuaian3">{{ old('ketidaksesuaian3', $stage2ketidaksesuaianpage->ketidaksesuaian3 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label>Analisa Penyebab:</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="analisa3" id="analisa3">{{ old('analisa3', $stage2ketidaksesuaianpage->analisa3 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group row">
                                        <label>Tindakan Koreksi:</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="koreksi3" id="koreksi3">{{ old('koreksi3', $stage2ketidaksesuaianpage->koreksi3 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group row">
                                        <label>Korektif:</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="korektif3" id="korektif3">{{ old('korektif3', $stage2ketidaksesuaianpage->korektif3 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label>Hasil Verifikasi</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="hasil_verifikasi3" id="hasil_verifikasi3">{{ old('hasil_verifikasi3', $stage2ketidaksesuaianpage->hasil_verifikasi3 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label>Keterangan</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="keterangan3" id="keterangan3">{{ old('keterangan3', $stage2ketidaksesuaianpage->keterangan3 ?? '') }}</textarea>
                                        </div>
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
                                                value="{{ old('tempat_ttd', $stage2ketidaksesuaianpage->tempat_ttd ?? '') }}" />
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
                                                value="{{ old('tgl_ttd', $stage2ketidaksesuaianpage->tgl_ttd ?? '') }}" />
                                            @error('tgl_ttd')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="nama_ttd">Nama Lead Auditor</label>
                                            <input class="form-control mt-1 @error('nama_ttd') is-invalid @enderror"
                                                name="nama_ttd" type="text" id="nama_ttd"
                                                value="{{ old('nama_ttd', $stage2ketidaksesuaianpage->nama_ttd ?? '') }}" />
                                            @error('nama_ttd')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($stage2ketidaksesuaianpage == '')
                                @if (in_array('F-CER-09 - Lembar Ketidaksesuaian.store', $roles))
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                @endif
                            @elseif ($stage2ketidaksesuaianpage->status != 2)
                                @if (in_array('F-CER-09 - Lembar Ketidaksesuaian.update', $roles))
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                @endif
                            @endif

                            @if ($stage2ketidaksesuaianpage)
                                @if (in_array('F-CER-09 - Lembar Ketidaksesuaian.download', $roles))
                                    <a href="/dashboard/stage2ketidaksesuaianpages/download/{{ $stage2ketidaksesuaianpage->id }}"
                                        class="btn btn-secondary" target='_blank'>
                                        Download
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="card">
                        @if ($stage2ketidaksesuaianpage)
                            @if ($stage2ketidaksesuaianpage->status >= '1')
                                <div class="card-body">
                                    <h4 class="card-title">Upload Lembar Ketidaksesuaian yang telah di
                                        tanda tangani.</h4>
                                    <div class="row mb-3">
                                        <div>
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    @if (isset($stage2ketidaksesuaianpage->uploadttd))
                                                        <p class="my-2"><i
                                                                class="fas fa-check-square me-1 text-success"></i>
                                                            <a href="/storage/{{ $stage2ketidaksesuaianpage->uploadttd }}"
                                                                target="_blank">Lihat Berkas</a>
                                                        </p>
                                                    @endif
                                                    <div class="form-group">
                                                        <input type="file" name="uploadttd" id="uploadttd"
                                                            class="form-control mt-1 @error('uploadttd') is-invalid @enderror">
                                                        @error('uploadttd')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        @if ($stage2ketidaksesuaianpage == '')
                                            @if (in_array('F-CER-09 - Lembar Ketidaksesuaian.store', $roles))
                                                <button type="submit" class="btn btn-primary mt-1 mb-3">Kirim</button>
                                            @endif
                                        @elseif ($stage2ketidaksesuaianpage->status != 2)
                                            @if (in_array('F-CER-09 - Lembar Ketidaksesuaian.update', $roles))
                                                <button type="submit" class="btn btn-primary mt-1 mb-3">Kirim</button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </form>
                @if ($stage2ketidaksesuaianpage)
                    <form
                        action="/dashboard/stage2ketidaksesuaianpagesvalidasi{{ $stage2ketidaksesuaianpage ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($stage2ketidaksesuaianpage)
                            @method('PUT')
                        @endif

                        <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                        <input type="hidden" id="status" value="{{ $stage2ketidaksesuaianpage->status ?? '' }}">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">Status</h4>
                                @if (in_array('F-CER-09 - Lembar Ketidaksesuaian.validasi', $roles))
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
                                    @if ($stage2ketidaksesuaianpage->dipending_keterangan)
                                        <label class="mt-3">Keterangan</label>
                                        <div>
                                            <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                                disabled>{{ $stage2ketidaksesuaianpage->dipending_keterangan }}</textarea>
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
                    let status = response.stage2ketidaksesuaianpage.dipending_keterangan ?? '';

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
                        let status = response.stage2ketidaksesuaianpage
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
