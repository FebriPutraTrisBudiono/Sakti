@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/permohonansertifikasis{{ $permohonansertifikasi ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                    method="post" enctype="multipart/form-data">
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

                            @if ($permohonansertifikasi)
                                @method('PUT')
                            @endif

                            <input type="hidden" name="client_id" value="{{ old('client_id', $client->id) }}">
                            <input type="hidden" name="listpermohonan_id" value="{{ $listpermohonan_id->id }}">
                            <input type="hidden" name="listpermohonan_slug" value="{{ $listpermohonan_id->slug }}">

                            <h4 class="card-title mb-3 mb-4 text-decoration"
                                style="text-decoration: underline;text-align: center;">
                                PERMOHONAN SERTIFIKASI
                            </h4>
                            <h4 class="border-bottom mb-4">UMUM</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_perusahaan">Nama Perusahaan</label>
                                        <input class="form-control @error('nama_perusahaan') is-invalid @enderror mt-1"
                                            name="nama_perusahaan" type="text" id="nama_perusahaan"
                                            value="{{ old('nama_perusahaan', $permohonansertifikasi->nama_perusahaan ?? '') }}" />
                                        @error('nama_perusahaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="no_siup">No. SIUP/TDP</label>
                                        <input class="form-control @error('no_siup') is-invalid @enderror mt-1"
                                            name="no_siup" type="text" id="no_siup"
                                            value="{{ old('no_siup', $permohonansertifikasi->no_siup ?? '') }}" />
                                        @error('no_siup')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="alamat">Alamat Lengkap</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror mt-1" name="alamat" id="alamat" rows="3">{{ old('alamat', $permohonansertifikasi->alamat ?? '') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="nama_website">URL Website</label>
                                <input class="form-control @error('nama_website') is-invalid @enderror mt-1"
                                    name="nama_website" type="text" id="nama_website"
                                    value="{{ old('nama_website', $permohonansertifikasi->nama_website ?? '') }}" />
                                @error('nama_website')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="no_phone">No. Telp</label>
                                        <input class="form-control @error('no_phone') is-invalid @enderror mt-1"
                                            name="no_phone" type="number" id="no_phone"
                                            value="{{ old('no_phone', $permohonansertifikasi->no_phone ?? '') }}" />
                                        @error('no_phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="no_fax">Fax</label>
                                        <input class="form-control @error('no_fax') is-invalid @enderror mt-1"
                                            name="no_fax" type="text" id="no_fax"
                                            value="{{ old('no_fax', $permohonansertifikasi->no_fax ?? '') }}" />
                                        @error('no_fax')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="me-3">Jenis Industri: </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('type_industry') is-invalid @enderror"
                                        type="radio" name="type_industry" id="type_industry" value="pabrikan"
                                        {{ old('type_industry', $permohonansertifikasi->type_industry ?? '') == 'pabrikan' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="type_industry">Pabrikan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input  @error('type_industry') is-invalid @enderror"
                                        type="radio" name="type_industry" id="type_industry" value="jasa"
                                        {{ old('type_industry', $permohonansertifikasi->type_industry ?? '') == 'jasa' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="type_industry">Jasa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input  @error('type_industry') is-invalid @enderror"
                                        type="radio" name="type_industry" id="type_industry" value="lainnya"
                                        {{ old('type_industry', $permohonansertifikasi->type_industry ?? '') == 'lainnya' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="type_industry">Lainnya</label>
                                </div>
                                @error('type_industry')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="produk_akhir_perusahaan">Produk Akhir Perusahaan</label>
                                        <textarea class="form-control @error('produk_akhir_perusahaan') is-invalid @enderror mt-1"
                                            name="produk_akhir_perusahaan" id="produk_akhir_perusahaan" rows="3">{{ old('produk_akhir_perusahaan', $permohonansertifikasi->produk_akhir_perusahaan ?? '') }}</textarea>
                                        @error('produk_akhir_perusahaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="ruang_lingkup_perusahaan">Ruang Lingkup Perusahaan</label>
                                        <textarea class="form-control @error('ruang_lingkup_perusahaan') is-invalid @enderror mt-1"
                                            name="ruang_lingkup_perusahaan" id="ruang_lingkup_perusahaan" rows="3">{{ old('ruang_lingkup_perusahaan', $permohonansertifikasi->ruang_lingkup_perusahaan ?? '') }}</textarea>
                                        @error('ruang_lingkup_perusahaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <h4 class="border-bottom my-4">Pimpinan Organisasi</h4>
                            <div class="form-group mb-3">
                                <label for="nama_pimpinan">Nama Lengkap</label>
                                <input class="form-control @error('nama_pimpinan') is-invalid @enderror mt-1"
                                    name="nama_pimpinan" type="text" id="nama_pimpinan"
                                    value="{{ old('nama_pimpinan', $permohonansertifikasi->nama_pimpinan ?? '') }}" />
                                @error('nama_pimpinan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="no_phone_pimpinan">No. Telp</label>
                                        <input class="form-control @error('no_phone_pimpinan') is-invalid @enderror mt-1"
                                            name="no_phone_pimpinan" type="number" id="no_phone_pimpinan"
                                            value="{{ old('no_phone_pimpinan', $permohonansertifikasi->no_phone_pimpinan ?? '') }}" />
                                        @error('no_phone_pimpinan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="no_fax_pimpinan">Fax</label>
                                        <input class="form-control @error('no_fax_pimpinan') is-invalid @enderror mt-1"
                                            name="no_fax_pimpinan" type="number" id="no_fax_pimpinan"
                                            value="{{ old('no_fax_pimpinan', $permohonansertifikasi->no_fax_pimpinan ?? '') }}" />
                                        @error('no_fax_pimpinan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email_pimpinan">Email</label>
                                        <input class="form-control @error('email_pimpinan') is-invalid @enderror mt-1"
                                            name="email_pimpinan" type="email" id="email_pimpinan"
                                            value="{{ old('email_pimpinan', $permohonansertifikasi->email_pimpinan ?? '') }}" />
                                        @error('email_pimpinan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="no_hp_pimpinan">No. HP</label>
                                        <input class="form-control @error('no_hp_pimpinan') is-invalid @enderror mt-1"
                                            name="no_hp_pimpinan" type="number" id="no_hp_pimpinan"
                                            value="{{ old('no_hp_pimpinan', $permohonansertifikasi->no_hp_pimpinan ?? '') }}" />
                                        @error('no_hp_pimpinan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <h4 class="border-bottom my-4">Wakil Manajemen</h4>
                            <div class="form-group mb-3">
                                <label for="nama_wakil">Nama Lengkap</label>
                                <input class="form-control @error('nama_wakil') is-invalid @enderror mt-1"
                                    name="nama_wakil" type="text" id="nama_wakil"
                                    value="{{ old('nama_wakil', $permohonansertifikasi->nama_wakil ?? '') }}" />
                                @error('nama_wakil')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="no_phone_wakil">Telp</label>
                                        <input class="form-control @error('no_phone_wakil') is-invalid @enderror mt-1"
                                            name="no_phone_wakil" type="number" id="no_phone_wakil"
                                            value="{{ old('no_phone_wakil', $permohonansertifikasi->no_phone_wakil ?? '') }}" />
                                        @error('no_phone_wakil')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="no_fax_wakil">Fax</label>
                                        <input class="form-control @error('no_fax_wakil') is-invalid @enderror mt-1"
                                            name="no_fax_wakil" type="number" id="no_fax_wakil"
                                            value="{{ old('no_fax_wakil', $permohonansertifikasi->no_fax_wakil ?? '') }}" />
                                        @error('no_fax_wakil')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email_wakil">Email</label>
                                        <input class="form-control @error('email_wakil') is-invalid @enderror mt-1"
                                            name="email_wakil" type="email" id="email_wakil"
                                            value="{{ old('email_wakil', $permohonansertifikasi->email_wakil ?? '') }}" />
                                        @error('email_wakil')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="no_hp_wakil">No. HP</label>
                                        <input class="form-control @error('no_hp_wakil') is-invalid @enderror mt-1"
                                            name="no_hp_wakil" type="number" id="no_hp_wakil"
                                            value="{{ old('no_hp_wakil', $permohonansertifikasi->no_hp_wakil ?? '') }}" />
                                        @error('no_hp_wakil')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <h4 class="border-bottom my-4">Jumlah Karyawan</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="jml_karyawan">Jumlah Karyawan</label>
                                        <input class="form-control @error('jml_karyawan') is-invalid @enderror mt-1"
                                            name="jml_karyawan" type="number" id="jml_karyawan"
                                            value="{{ old('jml_karyawan', $permohonansertifikasi->jml_karyawan ?? '') }}" />
                                        @error('jml_karyawan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label for="shift1">Shift 1</label>
                                        <input class="form-control @error('shift1') is-invalid @enderror mt-1"
                                            name="shift1" type="number" id="shift1"
                                            value="{{ old('shift1', $permohonansertifikasi->shift1 ?? '') }}" />
                                        @error('shift1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label for="shift2">Shift 2</label>
                                        <input class="form-control @error('shift2') is-invalid @enderror mt-1"
                                            name="shift2" type="number" id="shift2"
                                            value="{{ old('shift2', $permohonansertifikasi->shift2 ?? '') }}" />
                                        @error('shift2')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label for="shift3">Shift 3</label>
                                        <input class="form-control @error('shift3') is-invalid @enderror mt-1"
                                            name="shift3" type="number" id="shift3"
                                            value="{{ old('shift3', $permohonansertifikasi->shift3 ?? '') }}" />
                                        @error('shift3')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="me-3">Apakah ada riset & pengembangan?</label>
                                    <div class="form-check form-check-inline mt-1">
                                        <input
                                            class="form-check-input @error('riset_dan_perkembangan') is-invalid @enderror"
                                            type="radio" name="riset_dan_perkembangan" id="riset_dan_perkembangan"
                                            value="1"
                                            {{ old('riset_dan_perkembangan', $permohonansertifikasi->riset_dan_perkembangan ?? '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="riset_dan_perkembangan">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input @error('riset_dan_perkembangan') is-invalid @enderror"
                                            type="radio" name="riset_dan_perkembangan" id="riset_dan_perkembangan"
                                            value="0"
                                            {{ old('riset_dan_perkembangan', $permohonansertifikasi->riset_dan_perkembangan ?? '') == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="riset_dan_perkembangan">Tidak</label>
                                    </div>
                                    @error('riset_dan_perkembangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="me-3">Jumlah lokasi yang akan audit?</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('jumlah_lokasi_audit') is-invalid @enderror"
                                            type="checkbox" name="jumlah_lokasi_audit" id="jumlah_lokasi_audit"
                                            value="1"
                                            {{ old('jumlah_lokasi_audit', $permohonansertifikasi->jumlah_lokasi_audit ?? '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jumlah_lokasi_audit">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('jumlah_lokasi_audit') is-invalid @enderror"
                                            type="checkbox" name="jumlah_lokasi_audit" id="jumlah_lokasi_audit"
                                            value="1"
                                            {{ old('jumlah_lokasi_audit', $permohonansertifikasi->jumlah_lokasi_audit ?? '') == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jumlah_lokasi_audit">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('jumlah_lokasi_audit') is-invalid @enderror"
                                            type="checkbox" name="jumlah_lokasi_audit" id="jumlah_lokasi_audit"
                                            value="1"
                                            {{ old('jumlah_lokasi_audit', $permohonansertifikasi->jumlah_lokasi_audit ?? '') == 3 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jumlah_lokasi_audit">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('jumlah_lokasi_audit') is-invalid @enderror"
                                            type="checkbox" name="jumlah_lokasi_audit" id="jumlah_lokasi_audit"
                                            value="1"
                                            {{ old('jumlah_lokasi_audit', $permohonansertifikasi->jumlah_lokasi_audit ?? '') == 4 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jumlah_lokasi_audit">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('jumlah_lokasi_audit') is-invalid @enderror"
                                            type="checkbox" name="jumlah_lokasi_audit" id="jumlah_lokasi_audit"
                                            value="1"
                                            {{ old('jumlah_lokasi_audit', $permohonansertifikasi->jumlah_lokasi_audit ?? '') == 5 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jumlah_lokasi_audit">5</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('jumlah_lokasi_audit') is-invalid @enderror"
                                            type="checkbox"
                                            name="jumlah_lokasi_audit @error('jumlah_lokasi_audit') is-invalid @enderror"
                                            id="jumlah_lokasi_audit" value="1"
                                            {{ old('jumlah_lokasi_audit', $permohonansertifikasi->jumlah_lokasi_audit ?? '') == '>5' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jumlah_lokasi_audit">>5</label>
                                    </div>
                                    @error('riset_dan_perkembangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="alamat_audit">Alamat Audit</label>
                                <textarea class="form-control @error('alamat_audit') is-invalid @enderror mt-1" name="alamat_audit"
                                    id="alamat_audit" rows="3">{{ old('alamat_audit', $permohonansertifikasi->alamat_audit ?? '') }}</textarea>
                                @error('alamat_audit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="me-3">Apakah perusahaan sudah sertifikasi saat ini?</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('sudah_sertifikasi') is-invalid @enderror"
                                            type="radio" name="sudah_sertifikasi" id="sudah_sertifikasi"
                                            value="1"
                                            {{ old('sudah_sertifikasi', $permohonansertifikasi->sudah_sertifikasi ?? '') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sudah_sertifikasi">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('sudah_sertifikasi') is-invalid @enderror"
                                            type="radio" name="sudah_sertifikasi" id="sudah_sertifikasi"
                                            value="0"
                                            {{ old('sudah_sertifikasi', $permohonansertifikasi->sudah_sertifikasi ?? '') == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sudah_sertifikasi">Tidak</label>
                                    </div>
                                    @error('sudah_sertifikasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="badan_sertifikasi">Jika ya, dengan badan sertifikasi
                                            apa?</label>
                                        <input type="text" name="badan_sertifikasi" id="badan_sertifikasi"
                                            class="form-control mt-1 @error('badan_sertifikasi') is-invalid @enderror"
                                            value="{{ old('badan_sertifikasi', $permohonansertifikasi->badan_sertifikasi ?? '') }}">
                                        @error('badan_sertifikasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_badan_sertifikasi">Nama Badan Sertifikasi</label>
                                        <input type="text" name="nama_badan_sertifikasi" id="nama_badan_sertifikasi"
                                            class="form-control mt-1 @error('nama_badan_sertifikasi') is-invalid @enderror"
                                            value="{{ old('nama_badan_sertifikasi', $permohonansertifikasi->nama_badan_sertifikasi ?? '') }}">
                                        @error('nama_badan_sertifikasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <h4 class="border-bottom my-4">Skema Sertifikasi yang Diajukan</h4>
                            <div class="row">
                                <input type="hidden" name="iso" id="iso"
                                    value="{{ old('iso', $permohonansertifikasi->iso ?? $client->service->iso_code) }}">
                                <div class="col-md-3 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('iso') is-invalid @enderror" type="radio"
                                            name="iso" id="iso" value="ISO 9001:2015"
                                            {{ old('iso', $permohonansertifikasi->iso ?? $client->service->iso_code) == 'ISO 9001:2015' ? 'checked' : '' }}
                                            disabled>
                                        <label class="form-check-label" for="iso">ISO 9001:2015</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('iso') is-invalid @enderror" type="radio"
                                            name="iso" id="iso" value="ISO 14001:2015"
                                            {{ old('iso', $permohonansertifikasi->iso ?? $client->service->iso_code) == 'ISO 14001:2015' ? 'checked' : '' }}
                                            disabled>
                                        <label class="form-check-label" for="iso">ISO 14001:2015</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('iso') is-invalid @enderror" type="radio"
                                            name="iso" id="iso" value="ISO 21001:2018"
                                            {{ old('iso', $permohonansertifikasi->iso ?? $client->service->iso_code) == 'ISO 21001:2018' ? 'checked' : '' }}
                                            disabled>
                                        <label class="form-check-label" for="iso">ISO 21001:2018</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('iso') is-invalid @enderror" type="radio"
                                            name="iso" id="iso" value="ISO 45001:2018"
                                            {{ old('iso', $permohonansertifikasi->iso ?? $client->service->iso_code) == 'ISO 45001:2018' ? 'checked' : '' }}
                                            readonly>
                                        <label class="form-check-label" for="iso">ISO 45001:2018</label>
                                    </div>
                                </div>
                                @error('iso')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="form-check form-check-inline">
                                        @if ($client->service->iso_code == 'ISO 9001:2015' ||
                                            $client->service->iso_code == 'ISO 14001:2015' ||
                                            $client->service->iso_code == 'ISO 21001:2018' ||
                                            $client->service->iso_code == 'ISO 45001:2018')
                                            <input class="form-check-input" type="radio" disabled>
                                            <label class="form-check-label" for="iso">....</label>
                                        @else
                                            <input class="form-check-input" type="radio" name="iso" id="iso"
                                                value="{{ $client->service->iso_code }}"
                                                {{ old('iso', $permohonansertifikasi->iso ?? $client->service->iso_code) == $client->service->iso_code ? 'checked' : '' }}
                                                disabled>
                                            <label class="form-check-label"
                                                for="iso">{{ $client->service->iso_code }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>Apakah dibantu konsultasi?</label>
                                    <div class="form-group mt-1">
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('dibantu_konsultasi') is-invalid @enderror"
                                                type="radio" name="dibantu_konsultasi" id="dibantu_konsultasi"
                                                value="1"
                                                {{ old('dibantu_konsultasi', $permohonansertifikasi->dibantu_konsultasi ?? '') == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="dibantu_konsultasi">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('dibantu_konsultasi') is-invalid @enderror"
                                                type="radio" name="dibantu_konsultasi" id="dibantu_konsultasi"
                                                value="0"
                                                {{ old('dibantu_konsultasi', $permohonansertifikasi->dibantu_konsultasi ?? '') == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="dibantu_konsultasi">Tidak</label>
                                        </div>
                                    </div>
                                    @error('dibantu_konsultasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="form-group">
                                        <label for="nama_konsultasi">Nama Konsultasi</label>
                                        <input
                                            class="form-control mt-1 @error('nama_badan_sertifikasi') is-invalid @enderror"
                                            name="nama_konsultasi" type="text" id="nama_konsultasi"
                                            value="{{ old('nama_konsultasi', $permohonansertifikasi->nama_konsultasi ?? '') }}" />
                                        @error('nama_konsultasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>Apakah sistem manajemen yang akan
                                        disertifikasi merupakan bagian dari organisasi lain/grup?</label>
                                    <div class="form-group mt-1">
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('sertifikasi_bagian_grup_lain') is-invalid @enderror"
                                                type="radio" name="sertifikasi_bagian_grup_lain"
                                                id="sertifikasi_bagian_grup_lain" value="1"
                                                {{ old('sertifikasi_bagian_grup_lain', $permohonansertifikasi->sertifikasi_bagian_grup_lain ?? '') == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sertifikasi_bagian_grup_lain">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('sertifikasi_bagian_grup_lain') is-invalid @enderror"
                                                type="radio" name="sertifikasi_bagian_grup_lain"
                                                id="sertifikasi_bagian_grup_lain" value="0"
                                                {{ old('sertifikasi_bagian_grup_lain', $permohonansertifikasi->sertifikasi_bagian_grup_lain ?? '') == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="sertifikasi_bagian_grup_lain">Tidak</label>
                                        </div>
                                        @error('sertifikasi_bagian_grup_lain')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="form-group">
                                        <label for="sertifikasi_bagian_grup_lain_jelaskan">Jika ya, jelaskan:</label>
                                        <input
                                            class="form-control mt-1 @error('sertifikasi_bagian_grup_lain_jelaskan') is-invalid @enderror"
                                            name="sertifikasi_bagian_grup_lain_jelaskan" type="text"
                                            id="sertifikasi_bagian_grup_lain_jelaskan"
                                            value="{{ old('sertifikasi_bagian_grup_lain_jelaskan', $permohonansertifikasi->sertifikasi_bagian_grup_lain_jelaskan ?? '') }}" />
                                        @error('sertifikasi_bagian_grup_lain_jelaskan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>Apakah diberlakukan jam kerja shift?</label>
                                    <div class="form-group mt-1">
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('diberlakukan_jam_kerja_shift') is-invalid @enderror"
                                                type="radio" name="diberlakukan_jam_kerja_shift"
                                                id="diberlakukan_jam_kerja_shift" value="1"
                                                {{ old('diberlakukan_jam_kerja_shift', $permohonansertifikasi->diberlakukan_jam_kerja_shift ?? '') == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="diberlakukan_jam_kerja_shift">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('diberlakukan_jam_kerja_shift') is-invalid @enderror"
                                                type="radio" name="diberlakukan_jam_kerja_shift"
                                                id="diberlakukan_jam_kerja_shift" value="0"
                                                {{ old('diberlakukan_jam_kerja_shift', $permohonansertifikasi->diberlakukan_jam_kerja_shift ?? '') == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="diberlakukan_jam_kerja_shift">Tidak</label>
                                        </div>
                                    </div>
                                    @error('diberlakukan_jam_kerja_shift')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="form-group">
                                        <label for="diberlakukan_jam_kerja_shift_jelaskan">Jika ya, jelaskan:</label>
                                        <input
                                            class="form-control mt-1 @error('diberlakukan_jam_kerja_shift_jelaskan') is-invalid @enderror"
                                            name="diberlakukan_jam_kerja_shift_jelaskan" type="text"
                                            id="diberlakukan_jam_kerja_shift_jelaskan"
                                            value="{{ old('diberlakukan_jam_kerja_shift_jelaskan', $permohonansertifikasi->diberlakukan_jam_kerja_shift_jelaskan ?? '') }}" />
                                        @error('diberlakukan_jam_kerja_shift_jelaskan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>Apakah ada proses pekerjaan yang disubkontrakkan?</label>
                                    <div class="form-group mt-1">
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('diberlakukan_jam_kerja_shift_jelaskan') is-invalid @enderror"
                                                type="radio" name="pekerjaan_disubkontrakkan"
                                                id="pekerjaan_disubkontrakkan" value="1"
                                                {{ old('pekerjaan_disubkontrakkan', $permohonansertifikasi->pekerjaan_disubkontrakkan ?? '') == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="pekerjaan_disubkontrakkan">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('pekerjaan_disubkontrakkan') is-invalid @enderror"
                                                type="radio" name="pekerjaan_disubkontrakkan"
                                                id="pekerjaan_disubkontrakkan" value="0"
                                                {{ old('pekerjaan_disubkontrakkan', $permohonansertifikasi->pekerjaan_disubkontrakkan ?? '') == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="pekerjaan_disubkontrakkan">Tidak</label>
                                        </div>
                                    </div>
                                    @error('pekerjaan_disubkontrakkan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <div class="form-group">
                                        <label for="pekerjaan_disubkontrakkan_jelaskan">Jika ya, jelaskan:</label>
                                        <input
                                            class="form-control mt-1 @error('pekerjaan_disubkontrakkan_jelaskan') is-invalid @enderror"
                                            name="pekerjaan_disubkontrakkan_jelaskan" type="text"
                                            id="pekerjaan_disubkontrakkan_jelaskan"
                                            value="{{ old('pekerjaan_disubkontrakkan_jelaskan', $permohonansertifikasi->pekerjaan_disubkontrakkan_jelaskan ?? '') }}" />
                                        @error('pekerjaan_disubkontrakkan_jelaskan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="status_akreditasi">Jelaskan status akreditasi organisasi pendidikan (khusus
                                    SNI ISO 21001)</label>
                                <textarea class="form-control mt-1 @error('status_akreditasi') is-invalid @enderror" id="status_akreditasi"
                                    name="status_akreditasi" rows="3">{{ old('status_akreditasi', $permohonansertifikasi->status_akreditasi ?? '') }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="tanggal_internal_audit_terakhir">Tanggal internal audit
                                            terakhir</label>
                                        <input
                                            class="form-control mt-1 @error('tanggal_internal_audit_terakhir') is-invalid @enderror"
                                            name="tanggal_internal_audit_terakhir" type="date"
                                            id="tanggal_internal_audit_terakhir"
                                            value="{{ old('tanggal_internal_audit_terakhir', isset($permohonansertifikasi->tanggal_internal_audit_terakhir) ? date('Y-m-d', strtotime($permohonansertifikasi->tanggal_internal_audit_terakhir)) : '') }}" />
                                        @error('tanggal_internal_audit_terakhir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="tanggal_rapat_tinjauan_terakhir">Tanggal rapat tinjauan manajemen
                                            terakhir?</label>
                                        <input
                                            class="form-control mt-1 @error('tanggal_rapat_tinjauan_terakhir') is-invalid @enderror"
                                            name="tanggal_rapat_tinjauan_terakhir" type="date"
                                            id="tanggal_rapat_tinjauan_terakhir"
                                            value="{{ old('tanggal_rapat_tinjauan_terakhir', isset($permohonansertifikasi->tanggal_rapat_tinjauan_terakhir) ? date('Y-m-d', strtotime($permohonansertifikasi->tanggal_rapat_tinjauan_terakhir)) : '') }}" />
                                        @error('tanggal_rapat_tinjauan_terakhir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md mb-3">
                                    <label>Apakah dokumen manual dari sistem manajemen yang diajukan sertifikasi sudah
                                        lengkap dan diimplementasikan disemua proses?</label>
                                    <div class="form-group mt-1">
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('dokumen_manual_lengkap') is-invalid @enderror"
                                                type="radio" name="dokumen_manual_lengkap" id="dokumen_manual_lengkap"
                                                value="1"
                                                {{ old('dokumen_manual_lengkap', $permohonansertifikasi->dokumen_manual_lengkap ?? '') == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="dokumen_manual_lengkap">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('dokumen_manual_lengkap') is-invalid @enderror"
                                                type="radio" name="dokumen_manual_lengkap" id="dokumen_manual_lengkap"
                                                value="0"
                                                {{ old('dokumen_manual_lengkap', $permohonansertifikasi->dokumen_manual_lengkap ?? '') == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="dokumen_manual_lengkap">Tidak</label>
                                        </div>
                                    </div>
                                    @error('dokumen_manual_lengkap')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md mb-3">
                                    <label>Apakah sistem manajemen yang akan disertifikasi sudah melaksanakan internal
                                        audit dan tinjauan manajemen?</label>
                                    <div class="form-group mt-1">
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('sistem_manajemen_sudah_audit') is-invalid @enderror"
                                                type="radio" name="sistem_manajemen_sudah_audit"
                                                id="sistem_manajemen_sudah_audit" value="1"
                                                {{ old('sistem_manajemen_sudah_audit', $permohonansertifikasi->sistem_manajemen_sudah_audit ?? '') == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sistem_manajemen_sudah_audit">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('sistem_manajemen_sudah_audit') is-invalid @enderror"
                                                type="radio" name="sistem_manajemen_sudah_audit"
                                                id="sistem_manajemen_sudah_audit" value="0"
                                                {{ old('sistem_manajemen_sudah_audit', $permohonansertifikasi->sistem_manajemen_sudah_audit ?? '') == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="sistem_manajemen_sudah_audit">Tidak</label>
                                        </div>
                                    </div>
                                    @error('sistem_manajemen_sudah_audit')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <label class="mb-3">Rencana / Target sertifikasi</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="rencana_bulan_sertifikasi">Bulan</label>
                                        <select name="rencana_bulan_sertifikasi" id="rencana_bulan_sertifikasi"
                                            class="form-control  mt-1 @error('rencana_bulan_sertifikasi') is-invalid @enderror">
                                            <option value="">:: PILIH ::</option>
                                            @foreach (\App\Helpers\Bulan::get()->all() as $bulan => $nama)
                                                <option value="{{ $bulan }}"
                                                    {{ old('rencana_bulan_sertifikasi', $permohonansertifikasi->rencana_bulan_sertifikasi ?? '') == $bulan ? 'selected' : '' }}>
                                                    {{ $nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('rencana_bulan_sertifikasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="rencana_tahun_sertifikasi">Tahun</label>
                                        <input
                                            class="form-control mt-1 @error('rencana_tahun_sertifikasi') is-invalid @enderror"
                                            name="rencana_tahun_sertifikasi" type="number"
                                            id="rencana_tahun_sertifikasi"
                                            value="{{ old('rencana_tahun_sertifikasi', $permohonansertifikasi->rencana_tahun_sertifikasi ?? '') }}" />
                                        @error('rencana_tahun_sertifikasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <p>Pemohon harus menyertakan kelengkapan aplikasi sertifikasi berikut:</p>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="input_akte">a. Akte notaris atau legalitas pemohon/organisasi</label>
                                    @if (isset($permohonansertifikasi->input_akte))
                                        <p class="my-2"><i class="fas fa-check-square me-1 text-success"></i> <a
                                                href="/storage/{{ $permohonansertifikasi->input_akte }}"
                                                target="_blank">Lihat
                                                Berkas</a></p>
                                    @endif
                                    <div class="form-group">
                                        <input type="file" name="input_akte" id="input_akte"
                                            class="form-control mt-1 @error('input_akte') is-invalid @enderror">
                                        @error('input_akte')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="input_struktur">b. Struktur organisasi</label>
                                    @if (isset($permohonansertifikasi->input_struktur))
                                        <p class="my-2"><i class="fas fa-check-square me-1 text-success"></i> <a
                                                href="/storage/{{ $permohonansertifikasi->input_struktur }}"
                                                target="_blank"><b>Telah Diupload</b> Lihat Berkas</a></p>
                                    @endif
                                    <div class="form-group">
                                        <input type="file" name="input_struktur" id="input_struktur"
                                            class="form-control mt-1 @error('input_struktur') is-invalid @enderror">
                                        @error('input_struktur')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="input_mutu">c. Manual dan prosedur mutu</label>
                                    @if (isset($permohonansertifikasi->input_mutu))
                                        <p class="my-2"><i class="fas fa-check-square me-1 text-success"></i> <a
                                                href="/storage/{{ $permohonansertifikasi->input_mutu }}"
                                                target="_blank">Lihat Berkas</a></p>
                                    @endif
                                    <div class="form-group">
                                        <input type="file" name="input_mutu" id="input_mutu"
                                            class="form-control mt-1 @error('input_mutu') is-invalid @enderror">
                                        @error('input_mutu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="input_denah">d. Denah (Layout)</label>
                                    @if (isset($permohonansertifikasi->input_denah))
                                        <p class="my-2"><i class="fas fa-check-square me-1 text-success"></i> <a
                                                href="/storage/{{ $permohonansertifikasi->input_denah }}"
                                                target="_blank">Lihat Berkas</a></p>
                                    @endif
                                    <div class="form-group">
                                        <input type="file" name="input_denah" id="input_denah"
                                            class="form-control mt-1 @error('input_denah') is-invalid @enderror">
                                        @error('input_denah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-4">
                                <div class="form-check">
                                    <input type="checkbox" class="@error('pernyataan') is-invalid @enderror"
                                        value="1" name="pernyataan" id="pernyataan"
                                        {{ old('pernyataan', $permohonansertifikasi->pernyataan ?? '') == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Saya yakin bahwa data yang saya inputkan ini adalah benar dan bisa
                                        dipertanggungjawabkan.
                                    </label>
                                    @error('pernyataan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            @if ($permohonansertifikasi == '')
                                @if (in_array('F-CER-01 - Daftar Isian Permohon.store', $roles))
                                    <button type="submit" class="btn btn-primary mt-1 mb-3">Simpan</button>
                                @endif
                            @endif

                            @if ($permohonansertifikasi)
                                @if (in_array('F-CER-01 - Daftar Isian Permohon.download', $roles))
                                    <a href="/dashboard/permohonansertifikasi/download/{{ $permohonansertifikasi->id }}"
                                        class="btn btn-secondary mt-1 mb-3" target='_blank'>
                                        Download
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                    @if ($permohonansertifikasi)
                        <div class="row mt-3">
                            <div class="col-12 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Upload Permohonan Sertifikasi yang telah di
                                            tanda tangani.</h4>
                                        <div class="row mb-3">
                                            <div>
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        @if (isset($permohonansertifikasi->uploadttd))
                                                            <p class="my-2"><i
                                                                    class="fas fa-check-square me-1 text-success"></i>
                                                                <a href="/storage/{{ $permohonansertifikasi->uploadttd }}"
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
                                        @if ($permohonansertifikasi->status != 2)
                                            @if (in_array('F-CER-01 - Daftar Isian Permohon.update', $roles))
                                                <button type="submit" class="btn btn-primary mt-1">Simpan</button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
                @if ($permohonansertifikasi)
                    <form
                        action="/dashboard/permohonanclientsvalidasi{{ $permohonansertifikasi ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($permohonansertifikasi)
                            @method('PUT')
                        @endif

                        <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                        <input type="hidden" id="listpermohonan_id" value="{{ $listpermohonan_id->id ?? '' }}">
                        <input type="hidden" id="status" value="{{ $permohonansertifikasi->status ?? '' }}">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">Status</h4>
                                @if (in_array('F-CER-01 - Daftar Isian Permohon.validasi', $roles))
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
                                    @if ($permohonansertifikasi)
                                        @if ($permohonansertifikasi->dipending_keterangan)
                                            <label class="mt-3">Keterangan</label>
                                            <div>
                                                <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                                    disabled>{{ $permohonansertifikasi->dipending_keterangan }}</textarea>
                                            </div>
                                            <button name="status" value="1" type="submit"
                                                class="btn btn-warning mt-3">Simpan
                                                Status Revisi</button>
                                        @endif
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
                    let status = response.permohonansertifikasi.dipending_keterangan ?? '';

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
                        let status = response.permohonansertifikasi
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
