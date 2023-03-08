@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/kajianclients{{ $kajianclient ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
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

                            @if ($kajianclient)
                                @method('PUT')
                            @endif

                            <input type="hidden" value="{{ old('client_id', $client->id) }}" name="client_id">
                            <input type="hidden" value="{{ old('listpermohonan_id', $listpermohonan_id->id) }}"
                                name="listpermohonan_id">
                            <input type="hidden" value="{{ old('listpermohonan_slug', $listpermohonan_id->slug) }}"
                                name="listpermohonan_slug">

                            <h4 class="card-title mb-3 mb-4 text-decoration"
                                style="text-decoration: underline;text-align: center;">
                                KAJIAN PERMOHONAN
                            </h4>
                            <div class="row">
                                <h4 class="card-title border-bottom mb-3">I. SISTEM MANAJEMEN YANG AKAN DISERTIFIKASI(salah
                                    satu
                                    atau
                                    keduanya)</h4>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('iso') is-invalid @enderror"
                                                type="radio" name="iso" id="iso" value="ISO 9001:2015"
                                                {{ old('iso', $permohonansertifikasi->iso ?? $client->service->iso_code) == 'ISO 9001:2015' ? 'checked' : '' }}
                                                disabled>
                                            <label class="form-check-label" for="iso">ISO 9001:2015</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('iso') is-invalid @enderror"
                                                type="radio" name="iso" id="iso" value="ISO 14001:2015"
                                                {{ old('iso', $permohonansertifikasi->iso ?? $client->service->iso_code) == 'ISO 14001:2015' ? 'checked' : '' }}
                                                disabled>
                                            <label class="form-check-label" for="iso">ISO 14001:2015</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('iso') is-invalid @enderror"
                                                type="radio" name="iso" id="iso" value="ISO 21001:2018"
                                                {{ old('iso', $permohonansertifikasi->iso ?? $client->service->iso_code) == 'ISO 21001:2018' ? 'checked' : '' }}
                                                disabled>
                                            <label class="form-check-label" for="iso">ISO 21001:2018</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('iso') is-invalid @enderror"
                                                type="radio" name="iso" id="iso" value="ISO 45001:2018"
                                                {{ old('iso', $permohonansertifikasi->iso ?? $client->service->iso_code) == 'ISO 45001:2018' ? 'checked' : '' }}
                                                disabled>
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
                                                <input class="form-check-input" type="radio">
                                                <label class="form-check-label" for="iso">....</label>
                                            @else
                                                <input class="form-check-input" type="radio" name="iso" id="iso"
                                                    value="{{ $client->service->iso_code }}"
                                                    {{ old('iso', $permohonansertifikasi->iso ?? $client->service->iso_code) == $client->service->iso_code ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="iso">{{ $client->service->iso_code }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <h4 class="card-title mt-3 mb-3 border-bottom">II. INFORMASI UMUM TERKAIT PERMOHONAN
                                    SERTIFIKASI
                                </h4>
                                <h6 class="card-title">A. INFORMASI UMUM:</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="a1_nama">Nama Perusahaan</label>
                                            <input class="form-control mt-1 @error('a1_nama') is-invalid @enderror"
                                                name="a1_nama" type="text" id="a1_nama"
                                                value="{{ old('a1_nama', $permohonansertifikasi->nama_perusahaan) }}"
                                                readonly />
                                            @error('a1_nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="a3_phonefax">Telepon dan Fax</label>
                                            <input class="form-control mt-1 @error('a3_phonefax') is-invalid @enderror"
                                                name="a3_phonefax" type="text" id="a3_phonefax"
                                                value="{{ old('no_phone', $permohonansertifikasi->no_phone) }} / {{ old('no_phone', $permohonansertifikasi->no_fax) }}"
                                                readonly />
                                            @error('a3_phonefax')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label for="a2_alamat">Alamat</label>
                                        <textarea name="a2_alamat" id="a2_alamat"
                                            rows="5"class="form-control mt-1 @error('a2_alamat') is-invalid @enderror" readonly>{{ old('alamat', $permohonansertifikasi->alamat) }}</textarea>
                                        @error('a2_alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="a4_website">Website</label>
                                            <input class="form-control mt-1 @error('a4_website') is-invalid @enderror"
                                                name="a4_website" type="text" id="a4_website"
                                                value="{{ old('a4_website', $permohonansertifikasi->nama_website) }}"
                                                readonly />
                                            @error('a4_website')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="a5_sektor">Sektor Bisnis</label>
                                            <input class="form-control mt-1 @error('a5_sektor') is-invalid @enderror"
                                                name="a5_sektor" type="text" id="a5_sektor"
                                                value="{{ old('a5_sektor', $kajianclient->a5_sektor ?? '') }}" />
                                            @error('a5_sektor')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="a6_jcabang">Jumlah Cabang/site</label>
                                            <input class="form-control mt-1 @error('a6_jcabang') is-invalid @enderror"
                                                name="a6_jcabang" type="number" id="a6_jcabang"
                                                value="{{ old('a6_jcabang', $kajianclient->a6_jcabang ?? '') }}" />
                                            @error('a6_jcabang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="a7_jkaryawan">Jumlah Karyawan Total</label>
                                            <input class="form-control mt-1 @error('jml_karyawan') is-invalid @enderror"
                                                name="jml_karyawan" type="number" id="jml_karyawan"
                                                value="{{ old('jml_karyawan', $permohonansertifikasi->jml_karyawan ?? '') }}"
                                                readonly />
                                            @error('jml_karyawan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="a8_nampim">Nama pimpinan tertinggi organisasi/perusahaan dan
                                                jabatan</label>
                                            <input class="form-control mt-1 @error('a8_nampim') is-invalid @enderror"
                                                name="a8_nampim" type="text" id="a8_nampim"
                                                value="{{ old('nama_pimpinan', $permohonansertifikasi->nama_pimpinan ?? '') }}"
                                                readonly />
                                            @error('a8_nampim')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="a9_cp">Contact person</label>
                                            <input class="form-control mt-1 @error('a9_cp') is-invalid @enderror"
                                                name="a9_cp" type="text" id="a9_cp"
                                                value="{{ old('no_hp_pimpinan', $permohonansertifikasi->no_hp_pimpinan ?? '') }}"
                                                readonly />
                                            @error('a9_cp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label for="a10_perusahaanbesar">Apakah organisasi/perusahaan merupakan bagian
                                            dari organisasi/perusahaan lain(grup) yang lebih besar?</label>
                                        <input
                                            class="form-control mt-1 @error('a10_perusahaanbesar') is-invalid @enderror"
                                            name="a10_perusahaanbesar" type="text" id="a10_perusahaanbesar"
                                            value="{{ old('nama_website', $kajianclient->a10_perusahaanbesar ?? '') }}" />
                                        @error('a10_perusahaanbesar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <h6 class="card-title mt-3">B. RUANG LINGKUP SERTIFIKASI YANG DIAJUKAN:</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="b1_lingkup">Ruang lingkup</label>
                                            <input class="form-control mt-1 @error('b1_lingkup') is-invalid @enderror"
                                                name="b1_lingkup" type="text" id="b1_lingkup"
                                                value="{{ old('b1_lingkup', $kajianclient->b1_lingkup ?? '') }}" />
                                            @error('b1_lingkup')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="b2_ea">EA code</label>
                                            <input class="form-control mt-1 @error('b2_ea') is-invalid @enderror"
                                                name="b2_ea" type="text" id="b2_ea"
                                                value="{{ old('b2_ea', $kajianclient->b2_ea ?? '') }}" />
                                            @error('b2_ea')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label for="b3_target">Target pelaksanaan audit</label>
                                        <input class="form-control mt-1 @error('b3_target') is-invalid @enderror"
                                            name="b3_target" type="text" id="b3_target"
                                            value="{{ old('b3_target', $kajianclient->b3_target ?? '') }}" />
                                        @error('b3_target')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <h6 class="card-title mt-3">C. INFORMASI KEGIATAN ORGANISASI YANG MENJADI LINGKUP
                                    SERTIFIKASI:
                                </h6>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah organisasi/perusahaan terlibat dalam kegiatan
                                            desain
                                            suatu produk</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('c1_question') is-invalid @enderror"
                                                type="radio" name="c1_question" id="c1_question" value="1"
                                                {{ old('c1_question', $kajianclient->c1_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('c1_question') is-invalid @enderror"
                                                type="radio" name="c1_question" id="c1_question" value="0"
                                                {{ old('c1_question', $kajianclient->c1_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('c1_question')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah organisasi/perusahaan menyerahkan sebagaian
                                            prosesnya kepada pihak lain (subkontraktor)</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('c2_question') is-invalid @enderror"
                                                type="radio" name="c2_question" id="c2_question" value="1"
                                                {{ old('c2_question', $kajianclient->c2_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('c2_question') is-invalid @enderror"
                                                type="radio" name="c2_question" id="c2_question" value="0"
                                                {{ old('c2_question', $kajianclient->c2_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('c2_question')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah organisasi/perusahaan menggunakan barang milik
                                            pelanggan untuk digunakan atau digabungkan dalam produk?</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('c3_question') is-invalid @enderror"
                                                type="radio" name="c3_question" id="c3_question" value="1"
                                                {{ old('c3_question', $kajianclient->c3_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('c3_question') is-invalid @enderror"
                                                type="radio" name="c3_question" id="c3_question" value="0"
                                                {{ old('c3_question', $kajianclient->c3_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('c3_question')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah ada peraturan nasional maupun internasional
                                            (misalnya: SNI,JIS,ASTM dan sebagainya) yang terkait dengan produk/jasa
                                            organisasi/perusahaan?</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('c4_question') is-invalid @enderror"
                                                type="radio" name="c4_question" id="c4_question" value="1"
                                                {{ old('c4_question', $kajianclient->c4_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('c4_question') is-invalid @enderror"
                                                type="radio" name="c4_question" id="c4_question" value="0"
                                                {{ old('c4_question', $kajianclient->c4_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('c4_question')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Resiko terkait dengan produk (barang/jasa) yang timbul
                                            dan
                                            bisnis proses klien</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('c5_question') is-invalid @enderror"
                                                type="radio" name="c5_question" id="c5_question" value="1"
                                                {{ old('c5_question', $kajianclient->c5_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('c5_question') is-invalid @enderror"
                                                type="radio" name="c5_question" id="c5_question" value="0"
                                                {{ old('c5_question', $kajianclient->c5_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('c5_question')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <h6 class="card-title mt-3">D. INFORMASI SISTEM MANAJEMEN ORGANISASI:</h6>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah sistem manajemen (ISO 9001:2015,ISO 21001:2018)
                                            pada organisasi yang akan disertifikasi merupakan transfer/pindah dari
                                            lembaga sertifikasi lain?</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('d1_question') is-invalid @enderror"
                                                type="radio" name="d1_question" id="d1_question" value="1"
                                                {{ old('d1_question', $kajianclient->d1_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('d1_question') is-invalid @enderror"
                                                type="radio" name="d1_question" id="d1_question" value="0"
                                                {{ old('d1_question', $kajianclient->d1_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('d1_question')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="exampleTextarea1">Jika jawaban iya, sebutkan lembaga
                                                sertifikasi yang menerbitkan sertifikat sebelumnya?</label>
                                            <div class="col-sm-12">
                                                <textarea name="d1_answer" id="d1_answer"
                                                    rows="5"class="form-control mt-1 @error('d1_answer') is-invalid @enderror">{{ old('d1_answer', $kajianclient->d1_answer ?? '') }}</textarea>
                                                @error('d1_answer')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Berapa lama sistem manajemen (ISO
                                        9001:2015,ISO 21001:2018)sudah diterapkan di organisasi?</label>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <input class="form-control @error('d2_answerthn') is-invalid @enderror"
                                                    name="d2_answerthn" type="number" id="d2_answerthn"
                                                    value="{{ old('d2_answerthn', $kajianclient->d2_answerthn ?? '') }}" />
                                                @error('d2_answerthn')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <label class="col-sm-3 col-form-label">Tahun</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <select name="d2_answerbln" id="d2_answerbln"
                                                    class="form-control  mt-1 @error('d2_answerbln') is-invalid @enderror">
                                                    <option value="">:: PILIH ::</option>
                                                    @foreach (\App\Helpers\Bulan::get()->all() as $bulan => $nama)
                                                        <option value="{{ $bulan }}"
                                                            {{ old('d2_answerbln', $kajianclient->d2_answerbln ?? '') == $bulan ? 'selected' : '' }}>
                                                            {{ $nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label class="col-sm-3 col-form-label">Bulan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah dalam awal penerapan sistem manajemen(ISO
                                            9001:2015,ISO 21001:2018)oraganisasi menggunakan jasa konsultan?</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('d3_question') is-invalid @enderror"
                                                type="radio" name="d3_question" id="d3_question" value="1"
                                                {{ old('d3_question', $kajianclient->d3_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('d3_question') is-invalid @enderror"
                                                type="radio" name="d3_question" id="d3_question" value="0"
                                                {{ old('d3_question', $kajianclient->d3_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('d3_question')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="exampleTextarea1">Jika jawaban iya, sebutkan lembaga konsultan
                                                yang digunakan?</label>
                                            <div class="col-sm-12">
                                                <textarea name="d3_answer" id="d3_answer"
                                                    rows="5"class="form-control mt-1 @error('d3_answer') is-invalid @enderror">{{ old('d3_answer', $kajianclient->d3_answer ?? '') }}</textarea>
                                                @error('d3_answer')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah dokumen manual dari sistem manajemen yang
                                            diajukan sertifikasi sudah lengkap dan diimplementasikan disemua
                                            proses?</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('d3_answer') is-invalid @enderror"
                                                type="radio" name="d4_question" id="d4_question" value="1"
                                                {{ old('d4_question', $kajianclient->d4_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('d3_answer') is-invalid @enderror"
                                                type="radio" name="d4_question" id="d4_question" value="0"
                                                {{ old('d4_question', $kajianclient->d4_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('d3_answer')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <h6 class="card-title mt-3">E. TRANSFER SERTIFIKASI:</h6>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah masa berlaku sertifikat organisasi masih
                                            berlaku</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('e1_question') is-invalid @enderror"
                                                type="radio" name="e1_question" id="e1_question	" value="1"
                                                {{ old('e1_question	', $kajianclient->e1_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('e1_question') is-invalid @enderror"
                                                type="radio" name="e1_question" id="e1_question" value="0"
                                                {{ old('e1_question', $kajianclient->e1_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('e1_question')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="exampleTextarea1">Jika jawaban iya, sebutkan masa berlaku
                                                sertifikat dari organisasi?</label>
                                            <div class="col-sm-12">
                                                <textarea name="e1_answer" id="e1_answer"
                                                    rows="5"class="form-control mt-1 @error('e1_answer') is-invalid @enderror">{{ old('e1_answer', $kajianclient->e1_answer ?? '') }}</textarea>
                                            </div>
                                            @error('e1_answer')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah organisasi menyampaikan alasan dilakukan
                                            transfer kepada PT. Sakti Indonesia Sertifikasi?</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('e2_question') is-invalid @enderror"
                                                type="radio" name="e2_question" id="e2_question	" value="1"
                                                {{ old('e2_question	', $kajianclient->e2_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('e2_question') is-invalid @enderror"
                                                type="radio" name="e2_question" id="e2_question" value="0"
                                                {{ old('e2_question', $kajianclient->e2_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('e2_question')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="exampleTextarea1">Jika jawaban iya, jelaskan alasan transfer
                                                yang
                                                disampaikan?</label>
                                            <div class="col-sm-12">
                                                <textarea name="e2_answer" id="e2_answer"
                                                    rows="5"class="form-control mt-1 @error('e2_answer') is-invalid @enderror">{{ old('e2_answer', $kajianclient->e2_answer ?? '') }}</textarea>
                                                @error('e2_answer')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah lembaga sertifikasi sebelumnya telah
                                            diakreditasi
                                            untuk standar dan ruang lingkup yang diterbitkan?</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('e3_question') is-invalid @enderror"
                                                type="radio" name="e3_question" id="e3_question	" value="1"
                                                {{ old('e3_question	', $kajianclient->e3_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('e3_question') is-invalid @enderror"
                                                type="radio" name="e3_question" id="e3_question" value="0"
                                                {{ old('e3_question', $kajianclient->e3_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('e3_question')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="exampleTextarea1">Jika jawaban iya, sebutkan badan akreditasi
                                                dan
                                                ruang lingkup yang diakreditasi?</label>
                                            <div class="col-sm-12">
                                                <textarea name="e3_answer" id="e3_answer"
                                                    rows="5"class="form-control mt-1 @error('e3_answer') is-invalid @enderror">{{ old('e3_answer', $kajianclient->e3_answer ?? '') }}</textarea>
                                                @error('e3_answer')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah organisasi menyampaikan laporan audit terakhir
                                            dari
                                            lembaga sertifikasi sebelumnya?</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('e4_question') is-invalid @enderror"
                                                type="radio" name="e4_question" id="e4_question	" value="1"
                                                {{ old('e4_question	', $kajianclient->e4_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('e4_question') is-invalid @enderror"
                                                type="radio" name="e4_question" id="e4_question" value="0"
                                                {{ old('e4_question', $kajianclient->e4_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('e4_question')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah seluruh hasil audit dari lembaga sertifikasi
                                            sebelumnya telah ditindaklanjuti oleh organisasi?</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('e5_question') is-invalid @enderror"
                                                type="radio" name="e5_question" id="e5_question	" value="1"
                                                {{ old('e5_question	', $kajianclient->e5_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('e5_question') is-invalid @enderror"
                                                type="radio" name="e5_question" id="e5_question" value="0"
                                                {{ old('e5_question', $kajianclient->e5_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('e5_question')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="exampleTextarea1">Jika jawaban tidak, jelaskan temuan yang
                                                belum
                                                ditindaklanjuti ?</label>
                                            <div class="col-sm-12">
                                                <textarea name="e5_answer" id="e5_answer"
                                                    rows="5"class="form-control mt-1 @error('e5_answer') is-invalid @enderror">{{ old('e5_answer', $kajianclient->e5_answer ?? '') }}</textarea>
                                                @error('e5_answer')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah ada pengaduan/keluhan yang diterima terkait
                                            dengan
                                            kinerja organisasi yang ditransfer sertifikasinya?</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('e6_question') is-invalid @enderror"
                                                type="radio" name="e6_question" id="e6_question	" value="1"
                                                {{ old('e6_question	', $kajianclient->e6_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('e6_question') is-invalid @enderror"
                                                type="radio" name="e6_question" id="e6_question" value="0"
                                                {{ old('e6_question', $kajianclient->e6_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('e6_question')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="exampleTextarea1">Jika jawaban ya, jelaskan pengaduan/keluhan
                                                yang diterima?</label>
                                            <div class="col-sm-12">
                                                <textarea name="e6_answer" id="e6_answer"
                                                    rows="5"class="form-control mt-1 @error('e6_answer') is-invalid @enderror">{{ old('e6_answer', $kajianclient->e6_answer ?? '') }}</textarea>
                                                @error('e6_answer')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="card-title mt-3">F. MULTISITE:</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="f1_answer">Jumlah Site</label>
                                            <input class="form-control mt-1 @error('f1_answer') is-invalid @enderror"
                                                name="f1_answer" type="number" id="f1_answer"
                                                value="{{ old('f1_answer', $kajianclient->f1_answer ?? '') }}" />
                                            @error('f1_answer')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="f2_answer">Lokasi Site</label>
                                            <input class="form-control mt-1 @error('f2_answer') is-invalid @enderror"
                                                name="f2_answer" type="text" id="f2_answer"
                                                value="{{ old('f2_answer', $kajianclient->f2_answer ?? '') }}" />
                                            @error('f2_answer')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <h6 class="card-title mt-3">G. INFORMASI UNTUK PENJADWALAN AUDIT:</h6>
                                <label>Apakah organisasi/perusahaan telah melaksanakan kegiatan</label>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="g1_answer">Audit Internal</label>
                                            <input class="form-control mt-1 @error('g1_answer') is-invalid @enderror"
                                                name="g1_answer" type="text" id="g1_answer"
                                                value="{{ old('g1_answer', $kajianclient->g1_answer ?? '') }}" />
                                            @error('g1_answer')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="g2_answer">Tinjauan Manajemen</label>
                                            <input class="form-control mt-1 @error('g2_answer') is-invalid @enderror"
                                                name="g2_answer" type="text" id="g2_answer"
                                                value="{{ old('g2_answer', $kajianclient->g2_answer ?? '') }}" />
                                            @error('g2_answer')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <h4 class="card-title mt-3 mb-3 border-bottom">HASIL KAJIAN PERMOHONAN SERTIFIKASI</h4>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah permohonan sertifikasi diterima?</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('hasil1_question') is-invalid @enderror"
                                                type="radio" name="hasil1_question" id="hasil1_question	"
                                                value="1"
                                                {{ old('hasil1_question	', $kajianclient->hasil1_question ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('hasil1_question') is-invalid @enderror"
                                                type="radio" name="hasil1_question" id="hasil1_question"
                                                value="0"
                                                {{ old('hasil1_question', $kajianclient->hasil1_question ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('hasil1_question')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="exampleTextarea1">Jika tidak, berikan alasannya?</label>
                                            <div class="col-sm-12">
                                                <textarea name="hasil1_answer" id="hasil1_answer"
                                                    rows="5"class="form-control mt-1 @error('hasil1_answer') is-invalid @enderror">{{ old('hasil1_answer', $kajianclient->hasil1_answer ?? '') }}</textarea>
                                                @error('hasil1_answer')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label for="hasil2_answer">Kompetensi tim auditor yang diperlukan</label>
                                        <input class="form-control mt-1 @error('hasil2_answer') is-invalid @enderror"
                                            name="hasil2_answer" type="text" id="hasil2_answer"
                                            value="{{ old('hasil2_answer', $kajianclient->hasil2_answer ?? '') }}" />
                                        @error('hasil2_answer')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <label>Usulan tim audit</label>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="">Lead Auditor</label>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <div class="col-sm-9">
                                                    <select name="hasil3_lead1" id="hasil3_lead1"
                                                        class="form-control mt-1 @error('hasil3_lead1') is-invalid @enderror">
                                                        <option value="">:: Pilih ::</option>
                                                        @foreach ($user as $item)
                                                            @if ($item->level_id == 4 && $item->status == 1)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $hasil3_lead1 == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('hasil3_lead1')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Auditor</label>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <div class="col-sm-9">
                                                    <select name="hasil3_auditor1" id="hasil3_auditor1"
                                                        class="form-control mt-1 @error('hasil3_auditor1') is-invalid @enderror">
                                                        <option value="">:: Pilih ::</option>
                                                        @foreach ($user as $item)
                                                            @if ($item->level_id == 3 && $item->status == 1)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $hasil3_auditor1 == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('hasil3_auditor1')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Tenaga Ahli</label>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <div class="col-sm-9">
                                                    <select name="hasil3_tenaga1" id="hasil3_tenaga1"
                                                        class="form-control mt-1 @error('hasil3_tenaga1') is-invalid @enderror">
                                                        <option value="">:: Pilih ::</option>
                                                        @foreach ($user as $item)
                                                            @if ($item->level_id == 5 && $item->status == 1)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $hasil3_tenaga1 == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('hasil3_tenaga1')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="">Lead Auditor</label>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <div class="col-sm-9">
                                                    <select name="hasil3_lead2" id="hasil3_lead2"
                                                        class="form-control mt-1 @error('hasil3_lead2') is-invalid @enderror">
                                                        <option value="">:: Pilih ::</option>
                                                        @foreach ($user as $item)
                                                            @if ($item->level_id == 4 && $item->status == 1)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $hasil3_lead2 == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('hasil3_lead2')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Auditor</label>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <div class="col-sm-9">
                                                    <select name="hasil3_auditor2" id="hasil3_auditor2"
                                                        class="form-control mt-1 @error('hasil3_auditor2') is-invalid @enderror">
                                                        <option value="">:: Pilih ::</option>
                                                        @foreach ($user as $item)
                                                            @if ($item->level_id == 3 && $item->status == 1)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $hasil3_auditor2 == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('hasil3_auditor2')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Tenaga Ahli</label>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <div class="col-sm-9">
                                                    <select name="hasil3_tenaga2" id="hasil3_tenaga2"
                                                        class="form-control mt-1 @error('hasil3_tenaga2') is-invalid @enderror">
                                                        <option value="">:: Pilih ::</option>
                                                        @foreach ($user as $item)
                                                            @if ($item->level_id == 5 && $item->status == 1)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $hasil3_tenaga2 == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('hasil3_tenaga2')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="">Lead Auditor</label>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <div class="col-sm-9">
                                                    <select name="hasil3_lead3" id="hasil3_lead3"
                                                        class="form-control mt-1 @error('hasil3_lead3') is-invalid @enderror">
                                                        <option value="">:: Pilih ::</option>
                                                        @foreach ($user as $item)
                                                            @if ($item->level_id == 4 && $item->status == 1)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $hasil3_lead3 == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('hasil3_lead3')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Auditor</label>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <div class="col-sm-9">
                                                    <select name="hasil3_auditor3" id="hasil3_auditor3"
                                                        class="form-control mt-1 @error('hasil3_auditor3') is-invalid @enderror">
                                                        <option value="">:: Pilih ::</option>
                                                        @foreach ($user as $item)
                                                            @if ($item->level_id == 3 && $item->status == 1)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $hasil3_auditor3 == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('hasil3_auditor3')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Tenaga Ahli</label>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <div class="col-sm-9">
                                                    <select name="hasil3_tenaga3" id="hasil3_tenaga3"
                                                        class="form-control mt-1 @error('hasil3_tenaga3') is-invalid @enderror">
                                                        <option value="">:: Pilih ::</option>
                                                        @foreach ($user as $item)
                                                            @if ($item->level_id == 5 && $item->status == 1)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $hasil3_tenaga3 == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('hasil3_tenaga3')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label for="hasil4_jumlah">Jumlah Mandays</label>
                                        <input class="form-control mt-1 @error('hasil4_jumlah') is-invalid @enderror"
                                            name="hasil4_jumlah" type="number" id="hasil4_jumlah"
                                            value="{{ old('hasil4_jumlah', $kajianclient->hasil4_jumlah ?? '') }}" />
                                        @error('hasil4_jumlah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <h6 class="card-title text-center mt-3">Faktor Penambah</h6>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpenambah_1"
                                                    id="fpenambah_1" value="1"
                                                    {{ old('fpenambah_1', $kajianclient->fpenambah_1 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio1">Kompleksitas lokasi
                                                audit penggunaan bahasa yang memerlukan penterjemah</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpenambah_2"
                                                    id="fpenambah_2" value="1"
                                                    {{ old('fpenambah_2', $kajianclient->fpenambah_2 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio2">Lokasi lingkungan
                                                dengan sensitivitas yang tinggi dibandingkan dengan lokasi lain untuk
                                                sektor industri tertentu</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpenambah_3"
                                                    id="fpenambah_3" value="1"
                                                    {{ old('fpenambah_3', $kajianclient->fpenambah_3 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio1">Jumlah personil yang
                                                sangat besar(lebih dari 100 orang)</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpenambah_4"
                                                    id="fpenambah_4" value="1"
                                                    {{ old('fpenambah_4', $kajianclient->fpenambah_4 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio2">Masukkan dari para
                                                pihak yang berkepentingan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpenambah_5"
                                                    id="fpenambah_5" value="1"
                                                    {{ old('fpenambah_5', $kajianclient->fpenambah_5 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio1">Tingkat keharusan
                                                untuk memenuhi peraturan perundang-undang yang tinggi dan
                                                kompleks(makanan,obat-obatan,tenaga nuklir dsb)</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpenambah_6"
                                                    id="fpenambah_6" value="1"
                                                    {{ old('fpenambah_6', $kajianclient->fpenambah_6 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio2">Aspek tidak langsung
                                                yang mengharuskan penambahan mandays audit</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpenambah_7"
                                                    id="fpenambah_7" value="1"
                                                    {{ old('fpenambah_7', $kajianclient->fpenambah_7 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio1">Tingkat kompleksitas
                                                proses yang tinggi</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpenambah_8"
                                                    id="fpenambah_8" value="1"
                                                    {{ old('fpenambah_8', $kajianclient->fpenambah_8 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio2">Aspek lingkungan
                                                tambahan atau kondisi yang tidak biasa yang diatur untuk sektor industri
                                                tertentu</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpenambah_9"
                                                    id="fpenambah_9" value="1"
                                                    {{ old('fpenambah_9', $kajianclient->fpenambah_9 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio1">Audit memerlukan
                                                kunjungan ke lokasi proyek sementara, dimana masuk dalam lingkup
                                                sertifikasi</label>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="card-title text-center mt-3">Faktor Pengurang</h6>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpengurang_1"
                                                    id="fpengurang_1" value="1"
                                                    {{ old('fpengurang_1', $kajianclient->fpengurang_1 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio1">Klien tidak
                                                menerapkan desain & pengembangan</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpengurang_2"
                                                    id="fpengurang_2" value="1"
                                                    {{ old('fpengurang_2', $kajianclient->fpengurang_2 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio2">Jumlah personil
                                                sedikit(kurang dari 15)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpengurang_3"
                                                    id="fpengurang_3" value="1"
                                                    {{ old('fpengurang_3', $kajianclient->fpengurang_3 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio1">Tingkat kematangan
                                                sistem manajemen</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpengurang_4"
                                                    id="fpengurang_4" value="1"
                                                    {{ old('fpengurang_4', $kajianclient->fpengurang_4 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio2">Klien pernah
                                                disertifikasi oleh lembaga sertifikasi lain</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpengurang_5"
                                                    id="fpengurang_5" value="1"
                                                    {{ old('fpengurang_5', $kajianclient->fpengurang_5 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio1">Klien telah
                                                mengetahui tentang sistem manajemen</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpengurang_7"
                                                    id="fpengurang_7" value="1"
                                                    {{ old('fpengurang_7', $kajianclient->fpengurang_7 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio2">Jumlah staf lapangan
                                                yang diluar jajaran manajemen</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fpengurang_6"
                                                    id="fpengurang_6" value="1"
                                                    {{ old('fpengurang_6', $kajianclient->fpengurang_6 ?? '') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div><br>
                                            <label class="form-check-label" for="inlineRadio2">Tingkat kompleksitas
                                                klien antara lain:</label>
                                            <ul>
                                                <li>
                                                    1 (satu) aktivitas proses
                                                </li>
                                                <li>
                                                    Beberapa aktivitas namun identik/sejenis
                                                </li>
                                                <li>
                                                    Sejumlah staf melakukan aktivitas yang identik/sejenis
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label for="j_nambahkurang">Justifikasi penambah/pengurangan mandays</label>
                                        <input class="form-control mt-1 @error('j_nambahkurang') is-invalid @enderror"
                                            name="j_nambahkurang" type="text" id="j_nambahkurang"
                                            value="{{ old('j_nambahkurang', $kajianclient->j_nambahkurang ?? '') }}" />
                                        @error('j_nambahkurang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Actual Mandays</label>
                                            <input class="form-control @error('actual_mandays') is-invalid @enderror"
                                                name="actual_mandays" type="text" id="actual_mandays"
                                                value="{{ old('actual_mandays', $kajianclient->actual_mandays ?? '') }}" />
                                            @error('actual_mandays')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Mandays</label>
                                            <input class="form-control @error('mandays1') is-invalid @enderror"
                                                name="mandays1" type="text" id="mandays1"
                                                value="{{ old('mandays1', $kajianclient->mandays1 ?? '') }}" />
                                            @error('mandays1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label">Stage I</label>
                                                <input class="form-control @error('stage1') is-invalid @enderror"
                                                    name="stage1" type="text" id="stage1"
                                                    value="{{ old('stage1', $kajianclient->stage1 ?? '') }}" />
                                                @error('stage1')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Mandays</label>
                                            <input class="form-control @error('mandays2') is-invalid @enderror"
                                                name="mandays2" type="text" id="mandays2"
                                                value="{{ old('mandays2', $kajianclient->mandays2 ?? '') }}" />
                                            @error('mandays2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Stage II</label>
                                            <input class="form-control @error('stage2') is-invalid @enderror"
                                                name="stage2" type="text" id="stage2"
                                                value="{{ old('stage2', $kajianclient->stage2 ?? '') }}" />
                                            @error('stage2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Mandays</label>
                                            <input class="form-control @error('mandays3') is-invalid @enderror"
                                                name="mandays3" type="text" id="mandays3"
                                                value="{{ old('mandays3', $kajianclient->mandays3 ?? '') }}" />
                                            @error('mandays3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Sur I</label>
                                            <input class="form-control @error('sur1') is-invalid @enderror"
                                                name="sur1" type="text" id="sur1"
                                                value="{{ old('sur1', $kajianclient->sur1 ?? '') }}" />
                                            @error('sur1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Mandays</label>
                                            <input class="form-control @error('mandays4') is-invalid @enderror"
                                                name="mandays4" type="text" id="mandays4"
                                                value="{{ old('mandays4', $kajianclient->mandays4 ?? '') }}" />
                                            @error('mandays4')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Sur II</label>
                                            <input class="form-control @error('sur2') is-invalid @enderror"
                                                name="sur2" type="text" id="sur2"
                                                value="{{ old('sur2', $kajianclient->sur2 ?? '') }}" />
                                            @error('sur2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Mandays</label>
                                            <input class="form-control @error('mandays5') is-invalid @enderror"
                                                name="mandays5" type="text" id="mandays5"
                                                value="{{ old('mandays5', $kajianclient->mandays5 ?? '') }}" />
                                            @error('mandays5')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Res</label>
                                            <input class="form-control @error('res') is-invalid @enderror"
                                                name="res" type="text" id="res"
                                                value="{{ old('res', $kajianclient->res ?? '') }}" />
                                            @error('res')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Mandays</label>
                                            <input class="form-control @error('mandays6') is-invalid @enderror"
                                                name="mandays6" type="text" id="mandays6"
                                                value="{{ old('mandays6', $kajianclient->mandays6 ?? '') }}" />
                                            @error('mandays6')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <h6 class="card-title">Transfer Sertifikat*)</h6>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="col-sm-8">Apakah pengajuan transfer sertifikat diterima</label>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('transfer_sertifikat') is-invalid @enderror"
                                                type="radio" name="transfer_sertifikat" id="transfer_sertifikat	"
                                                value="1"
                                                {{ old('transfer_sertifikat	', $kajianclient->transfer_sertifikat ?? '') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('transfer_sertifikat') is-invalid @enderror"
                                                type="radio" name="transfer_sertifikat" id="transfer_sertifikat"
                                                value="0"
                                                {{ old('transfer_sertifikat', $kajianclient->transfer_sertifikat ?? '') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                        </div>
                                        @error('transfer_sertifikat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="exampleTextarea1">jika tidak, jelaskan alasanya</label>
                                        <textarea class="form-control @error('transfersertifikat_alasanditolak') is-invalid @enderror"
                                            id="transfersertifikat_alasanditolak" name="transfersertifikat_alasanditolak" rows="4">{{ old('transfersertifikat_alasanditolak', $kajianclient->transfersertifikat_alasanditolak ?? '') }}</textarea>
                                        @error('transfersertifikat_alasanditolak')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="exampleTextarea1">jika ya, Jelaskan tahapan lanjutan transfer
                                            sertikat</label>
                                        <textarea class="form-control @error('transfersertifikat_alasanditerima') is-invalid @enderror"
                                            id="transfersertifikat_alasanditerima" name="transfersertifikat_alasanditerima" rows="4">{{ old('transfersertifikat_alasanditerima', $kajianclient->transfersertifikat_alasanditerima ?? '') }}</textarea>
                                        @error('transfersertifikat_alasanditerima')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label>Rencana Samping Multisite</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Sertifikasi awal</label>
                                            </label>
                                            <input class="form-control @error('sertifikasi_awal') is-invalid @enderror"
                                                name="sertifikasi_awal" type="text" id="sertifikasi_awal"
                                                value="{{ old('sertifikasi_awal', $kajianclient->sertifikasi_awal ?? '') }}" />
                                            @error('sertifikasi_awal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Site</label>
                                            <input class="form-control @error('site1') is-invalid @enderror"
                                                name="site1" type="text" id="site1"
                                                value="{{ old('site1', $kajianclient->site1 ?? '') }}" />
                                            @error('site1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Survailen I</label>
                                            <input class="form-control @error('survailen_1') is-invalid @enderror"
                                                name="survailen_1" type="text" id="survailen_1"
                                                value="{{ old('survailen_1', $kajianclient->survailen_1 ?? '') }}" />
                                            @error('survailen_1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Site</label>
                                            <input class="form-control @error('site2') is-invalid @enderror"
                                                name="site2" type="text" id="site2"
                                                value="{{ old('site2', $kajianclient->site2 ?? '') }}" />
                                            @error('site2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Survailen II</label>
                                            <input class="form-control @error('survailen_2') is-invalid @enderror"
                                                name="survailen_2" type="text" id="survailen_2"
                                                value="{{ old('survailen_2', $kajianclient->survailen_2 ?? '') }}" />
                                            @error('survailen_2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Site</label>
                                            <input class="form-control @error('site3') is-invalid @enderror"
                                                name="site3" type="text" id="site3"
                                                value="{{ old('site3', $kajianclient->site3 ?? '') }}" />
                                            @error('site3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Resertifikasi</label>
                                            <input class="form-control @error('resertifikasi') is-invalid @enderror"
                                                name="resertifikasi" type="text" id="resertifikasi"
                                                value="{{ old('resertifikasi', $kajianclient->resertifikasi ?? '') }}" />
                                            @error('resertifikasi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Site</label>
                                            <input class="form-control @error('site4') is-invalid @enderror"
                                                name="site4" type="text" id="site4"
                                                value="{{ old('site4', $kajianclient->site4 ?? '') }}" />
                                            @error('site4')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Tanggal Permohonan</label>
                                            <input class="form-control @error('tgl_permohonan') is-invalid @enderror"
                                                name="tgl_permohonan" type="date" id="tgl_permohonan"
                                                value="{{ old('tgl_permohonan', $kajianclient->tgl_permohonan ?? '') }}" />
                                            @error('tgl_permohonan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Tanggal Kajian</label>
                                            <input class="form-control @error('tgl_kajian') is-invalid @enderror"
                                                name="tgl_kajian" type="date" id="tgl_kajian"
                                                value="{{ old('tgl_kajian', $kajianclient->tgl_kajian ?? '') }}" />
                                            @error('tgl_kajian')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                @if ($kajianclient == '')
                                    @if (in_array('F-CER-02 - Kajian Permohon.store', $roles))
                                        <button type="submit" class="btn btn-primary mt-1">Simpan</button>
                                    @endif
                                @elseif ($kajianclient->status != 2)
                                    @if (in_array('F-CER-02 - Kajian Permohon.update', $roles))
                                        <button type="submit" class="btn btn-primary mt-1">Simpan</button>
                                    @endif
                                @endif

                                @if ($kajianclient)
                                    @if (in_array('F-CER-02 - Kajian Permohon.download', $roles))
                                        <a href="/dashboard/kajianpermohonan/download/{{ $kajianclient->id }}"
                                            class="btn btn-secondary mt-1" target='_blank'>
                                            Download
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
                @if ($kajianclient)
                    <form
                        action="/dashboard/kajianclientsvalidasi{{ $kajianclient ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($kajianclient)
                            @method('PUT')
                        @endif

                        <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                        <input type="hidden" id="status" value="{{ $kajianclient->status ?? '' }}">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">Status</h4>
                                @if (in_array('F-CER-02 - Kajian Permohon.validasi', $roles))
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
                                    @if ($kajianclient->dipending_keterangan)
                                        <label class="mt-3">Keterangan</label>
                                        <div>
                                            <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                                disabled>{{ $kajianclient->dipending_keterangan }}</textarea>
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
                    let status = response.kajianclient.dipending_keterangan ?? '';

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
                        let status = response.kajianclient
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
