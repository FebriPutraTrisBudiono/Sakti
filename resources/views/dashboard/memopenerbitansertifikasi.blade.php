@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/memopenerbitansertifikasis{{ $memopenerbitansertifikasi ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
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

                            @if ($memopenerbitansertifikasi)
                                @method('PUT')
                            @endif

                            <input type="hidden" value="{{ $client->id }}" name="client_id">
                            <input type="hidden" value="{{ $listpermohonan_id->id }}" name="listpermohonan_id">

                            <div class="col-12 grid-margin stretch-card">
                                <div>
                                    <div class="card-body">
                                        <h4 style="text-align: center;" class="card-title mb-3 border-bottom">
                                            MEMO PENERBITAN SERTIFIKASI
                                        </h4>

                                        <h5 class="card-title mt-5 mb-3 border-bottom">Header Memo</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Tanggal</label>
                                                    <div class="col-sm-12">
                                                        <input type="date"
                                                            class="form-control mt-1 @error('tanggal') is-invalid @enderror"
                                                            id="tanggal" name="tanggal"
                                                            value="{{ old('tanggal', $memopenerbitansertifikasi->tanggal ?? '') }}" />
                                                        @error('tanggal')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>No.Ref</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('no_ref') is-invalid @enderror"
                                                            id="no_ref" name="no_ref"
                                                            value="{{ old('no_ref', $memopenerbitansertifikasi->no_ref ?? '') }}" />
                                                        @error('no_ref')
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
                                                    <label>Dari</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('dari') is-invalid @enderror"
                                                            id="dari" name="dari"
                                                            value="{{ old('dari', $memopenerbitansertifikasi->dari ?? '') }}" />
                                                        @error('dari')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Perihal</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control mt-1" id="no_ref"
                                                            name="no_ref" value="Penerbitan Sertifikat" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="card-title mt-5 mb-3 border-bottom">Body Memo</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>No. Sertifikat</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('no_sertifikat') is-invalid @enderror"
                                                            id="no_sertifikat" name="no_sertifikat"
                                                            value="{{ old('no_sertifikat', $memopenerbitansertifikasi->no_sertifikat ?? '') }}" />
                                                        @error('no_sertifikat')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Tanggal Sertifikat</label>
                                                    <div class="col-sm-12">
                                                        <input type="date"
                                                            class="form-control mt-1 @error('tgl_sertifikat') is-invalid @enderror"
                                                            id="tgl_sertifikat" name="tgl_sertifikat"
                                                            value="{{ old('tgl_sertifikat', $memopenerbitansertifikasi->tgl_sertifikat ?? '') }}" />
                                                        @error('tgl_sertifikat')
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
                                                    <label>Tanggal Survailen Selanjutnya</label>
                                                    <div class="col-sm-12">
                                                        <input type="date"
                                                            class="form-control mt-1 @error('tgl_survailen') is-invalid @enderror"
                                                            id="tgl_survailen" name="tgl_survailen"
                                                            value="{{ old('tgl_survailen', $memopenerbitansertifikasi->tgl_survailen ?? '') }}" />
                                                        @error('tgl_survailen')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Renewal</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('renewal') is-invalid @enderror"
                                                            id="renewal" name="renewal"
                                                            value="{{ old('renewal', $memopenerbitansertifikasi->renewal ?? '') }}" />
                                                        @error('renewal')
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
                                                    <label>Nama Perusahaan</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('nama_perusahaan') is-invalid @enderror"
                                                            id="nama_perusahaan" name="nama_perusahaan"
                                                            value="{{ old('nama_perusahaan', $permohonansertifikasi->nama_perusahaan ?? '') }}"
                                                            readonly />
                                                        @error('nama_perusahaan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
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
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Scope</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('scope') is-invalid @enderror"
                                                            id="scope" name="scope"
                                                            value="{{ old('scope', $permohonansertifikasi->ruang_lingkup_perusahaan ?? '') }}"
                                                            readonly />
                                                        @error('scope')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Email</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('alamat') is-invalid @enderror"
                                                            id="alamat" name="alamat"
                                                            value="{{ auth()->user()->email }}" readonly />
                                                        @error('alamat')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="card-title mt-5 mb-3 border-bottom">Footer Memo</h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>Nama Manager Sertifikasi</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('manajer_sertifikasi') is-invalid @enderror"
                                                            id="manajer_sertifikasi" name="manajer_sertifikasi"
                                                            value="{{ old('manajer_sertifikasi', $memopenerbitansertifikasi->manajer_sertifikasi ?? '') }}" />
                                                        @error('manajer_sertifikasi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="card-title mt-5 mb-3 border-bottom">Konfirmasi Lingkup Penerapan Sistem
                                            Manajemen berbasis ISO 9001:2015 / ISO
                                            21001:2018</h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>1. Lingkup berdasarkan pengajuan/permohonan: </label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control" rows="5" id="lingkup_1" name="lingkup_1">{{ old('lingkup_1', $memopenerbitansertifikasi->lingkup_1 ?? '') }}</textarea>
                                                        @error('lingkup_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>2. Lingkup berdasarkan verifikasi </label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control" rows="5" id="lingkup_2" name="lingkup_2">{{ old('lingkup_2', $memopenerbitansertifikasi->lingkup_2 ?? '') }}</textarea>
                                                        @error('lingkup_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>3. Lingkup berdasarkan rekomendasi hasil audit </label>
                                                    <div class="col-sm-12">
                                                        <textarea type="text" class="form-control" rows="5" id="lingkup_3" name="lingkup_3">{{ old('lingkup_3', $memopenerbitansertifikasi->lingkup_3 ?? '') }}</textarea>
                                                        @error('lingkup_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>3. Apakah lingkup sertifikasi sesuai dengan lingkup
                                                        Akreditasi PT Sakti Indonesia Sertifikasi? </label>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('lingkup_4') is-invalid @enderror"
                                                                    name="lingkup_4" id="lingkup_4" value="1"
                                                                    {{ old('lingkup_4', $memopenerbitansertifikasi->lingkup_4 ?? '') == '1' ? 'checked' : '' }} />
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('lingkup_4') is-invalid @enderror"
                                                                    name="lingkup_4" id="lingkup_4" value="0"
                                                                    {{ old('lingkup_4', $memopenerbitansertifikasi->lingkup_4 ?? '') == '0' ? 'checked' : '' }} />
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul>
                                                    <li>
                                                        Jika jawaban Ya, Sertifikat diterbitkan dengan menggunakan logo
                                                        akreditasi
                                                    </li>
                                                    <li>
                                                        Jika jawaban Tidak, Sertifikat diterbitkan tanpa logo akreditasi
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col mt-3">
                                            <h6 class="card-title border-bottom mb-4">TTD</h6>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="nama_ttd">Nama Manager
                                                            Sertifikasi</label>
                                                        <input
                                                            class="form-control mt-1 @error('nama_ttd') is-invalid @enderror"
                                                            name="nama_ttd" type="text" id="nama_ttd"
                                                            value="{{ old('nama_ttd', $memopenerbitansertifikasi->nama_ttd ?? '') }}" />
                                                        @error('nama_ttd')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($memopenerbitansertifikasi == '')
                                            @if (in_array('F-CER-12 - Memo Penerbitan Sertifikat.store', $roles))
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    Simpan
                                                </button>
                                            @endif
                                        @elseif ($memopenerbitansertifikasi->status != 2)
                                            @if (in_array('F-CER-12 - Memo Penerbitan Sertifikat.update', $roles))
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    Simpan
                                                </button>
                                            @endif
                                        @endif

                                        @if ($memopenerbitansertifikasi)
                                            @if (in_array('F-CER-12 - Memo Penerbitan Sertifikat.download', $roles))
                                                <a href="/dashboard/memopenerbitansertifikasis/download/{{ $memopenerbitansertifikasi->id }}"
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
                @if ($memopenerbitansertifikasi)
                    <form
                        action="/dashboard/memopenerbitansertifikasisvalidasi{{ $memopenerbitansertifikasi ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($memopenerbitansertifikasi)
                            @method('PUT')
                        @endif

                        <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                        <input type="hidden" id="status" value="{{ $memopenerbitansertifikasi->status ?? '' }}">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">Status</h4>
                                @if (in_array('F-CER-12 - Memo Penerbitan Sertifikat.validasi', $roles))
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
                                    @if ($memopenerbitansertifikasi->dipending_keterangan)
                                        <label class="mt-3">Keterangan</label>
                                        <div>
                                            <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                                disabled>{{ $memopenerbitansertifikasi->dipending_keterangan }}</textarea>
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
                    let status = response.memopenerbitansertifikasi.dipending_keterangan ?? '';

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
                        let status = response.memopenerbitansertifikasi
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
