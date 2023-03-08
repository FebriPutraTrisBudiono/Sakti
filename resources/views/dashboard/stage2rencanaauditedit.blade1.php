@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form action="/dashboard/stage2rencanaaudits{{ $stage2rencanaaudit ? '/' . $client->id : '' }}"
                    method="post">
                    <div class="card mb-4">
                        <div class="card-header text-uppercase">
                            <a href="/dashboard/clients" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                            {{ $title_bar }}
                        </div>
                        <div class="card-body">
                            @include('dashboard.navbarstatus')

                            {!! session('msg') !!}
                            @csrf

                            @if ($stage2rencanaaudit)
                                @method('PUT')
                            @endif

                            <input type="hidden" value="{{ $client->user->id }}" name="user_id">
                            <input type="hidden" value="{{ $permohonanclient->client_id }}" name="client_id">
                            <input type="hidden" value="{{ $permohonanclient->id }}" name="permohonanclient_id">
                            <input type="hidden" value="{{ $kajianclient->id }}" name="kajianclient_id">
                            <input type="hidden" value="{{ $perjanjianclient->id }}" name="perjanjianclient_id">
                            <input type="hidden" value="{{ $rencanaclient->id }}" name="rencanaclient_id">
                            <input type="hidden" value="{{ $stage1kajiantimaudit->id }}" name="stage1kajiantimaudit_id">
                            <input type="hidden" value="{{ $stage1penunjukantimaudit->id }}"
                                name="stage1penunjukantimaudit_id">
                            <input type="hidden" value="{{ $stage1checkaudit->id }}" name="stage1checkaudit_id">

                            <h4 style="text-align: center" class="card-title border-bottom mb-4">RENCANA AUDIT</h4>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_client">Nama Organisasi</label>
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
                                        readonly>{{ old('alamat', $permohonanclient->alamat) }}</textarea>
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
                                        value="{{ old('ruang_lingkup', $kajianclient->b1_lingkup ?? '') }}" readonly />
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
                                                <input type="radio"
                                                    class="form-check-input @error('audit') is-invalid @enderror"
                                                    name="audit" id="audit" value="pra_audit"
                                                    {{ old('pra_audit', $stage1penunjukantimaudit->audit ?? '') == 'pra_audit' ? 'checked' : '' }}
                                                    disabled />
                                                Pra Audit
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="audit" id="audit"
                                                    value="stage1"
                                                    {{ old('stage1', $stage1penunjukantimaudit->audit ?? '') == 'stage1' ? 'checked' : '' }}
                                                    disabled />
                                                Stage 1
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="audit"
                                                    id="audit" value="stage2"
                                                    {{ old('stage2', $stage1penunjukantimaudit->audit ?? '') == 'stage2' ? 'checked' : '' }}
                                                    disabled />
                                                Stage 2
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="audit"
                                                    id="audit" value="surveilen"
                                                    {{ old('surveilen', $stage1penunjukantimaudit->audit ?? '') == 'surveilen' ? 'checked' : '' }}
                                                    disabled />
                                                Surveilan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="audit"
                                                    id="audit" value="tindaklanjut"
                                                    {{ old('tindaklanjut', $stage1penunjukantimaudit->audit ?? '') == 'tindaklanjut' ? 'checked' : '' }}
                                                    disabled />
                                                Tindaklanjut
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 mb-3">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="audit"
                                                    id="audit" value="resertifikasi"
                                                    {{ old('resertifikasi', $stage1penunjukantimaudit->audit ?? '') == 'resertifikasi' ? 'checked' : '' }}
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
                                            <input type="text"
                                                class="form-control mt-1 @error('nama_auditor') is-invalid @enderror"
                                                id="nama_auditor" name="nama_auditor"
                                                value="{{ old('nama_auditor', $stage1penunjukantimaudit->nama_auditor ?? '') }}"
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
                                            <input type="text"
                                                class="form-control mt-1 @error('nama_auditor2') is-invalid @enderror"
                                                id="nama_auditor2" name="nama_auditor2" placeholder="optional"
                                                value="{{ old('nama_auditor2', $stage1penunjukantimaudit->nama_auditor2 ?? '') }}"
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

                            <div class="row mt-3 mb-4">
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

                            <h6 class="card-title mb-3 border-bottom mb-4">Fungsi yang diaudit</h6>
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

                            <?php
                            for ($i = 0; $i <= 14; $i++) { ?>
                            <div class="row control-group after-add-more">
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label for="waktu">Waktu</label>
                                        <input class="form-control" name="waktu[]" type="date"
                                            value="{{ old('waktu[]', $waktu[$i] ?? '') }}" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label for="bagian">Bagian</label>
                                        <input class="form-control" name="bagian[]" type="text"
                                            value="{{ old('bagian[]', $bagian[$i] ?? '') }}" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label for="klausul">Klausul</label>
                                        <input class="form-control" name="klausul[]" type="text" id="klausul"
                                            value="{{ old('klausul[]', $klausul[$i] ?? '') }}" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label for="auditor">Auditor</label>
                                        <input class="form-control" name="auditor[]" type="text" id="auditor"
                                            value="{{ old('auditor[]', $auditor[$i] ?? '') }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" name="keterangan[]" id="keterangan">{{ old('keterangan[]', $keterangan[$i] ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
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
                                            <input class="form-control mt-1 @error('nama_auditor') is-invalid @enderror"
                                                name="nama_auditor" type="text" id="nama_auditor"
                                                value="{{ old('nama_auditor', $stage2rencanaaudit->nama_auditor ?? '') }}" />
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
                            <button type="submit" class="btn btn-primary mr-2">
                                Simpan
                            </button>
                            @if ($stage2rencanaaudit)
                                {{-- @if ($kajianclient->status == '2') --}}
                                @if ($client->status_sertifikasi >= 1)
                                    <a href="/dashboard/stage2rencanaaudits/download/{{ $stage2rencanaaudit->id }}"
                                        class="btn btn-secondary" target='_blank'>
                                        Download
                                    </a>
                                @endif
                                {{-- @endif --}}
                            @endif
                        </div>
                    </div>
                </form>
                <form
                    action="/dashboard/stage2rencanaauditsvalidasi{{ $client->stage2rencanaaudit ? '/' . $client->id : '' }}"
                    method="post">
                    @csrf

                    @if ($client->stage2rencanaaudit)
                        @method('PUT')
                    @endif

                    <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                    <input type="hidden" id="status" value="{{ $client->stage2rencanaaudit->status ?? '' }}">
                    <div class="card mt-3">
                        <div class="card-body">
                            <h4 class="card-title">Status</h4>
                            @if (in_array('clients.index', $roles))
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
                                <select id="status" class="form-control mt-1 @error('status') is-invalid @enderror"
                                    disabled>
                                    <option value="">:: Pilih ::</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Menunggu
                                    </option>
                                    <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Diterima
                                    </option>
                                    <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Dipending
                                    </option>
                                </select>
                                @if ($client->stage2rencanaaudit->dipending_keterangan)
                                    <label class="mt-3">Keterangan</label>
                                    <div>
                                        <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                            disabled>{{ $client->stage2rencanaaudit->dipending_keterangan }}</textarea>
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
    </div>
@endsection

@section('script')
    <script>
        let id = $('#clientid').val();
        let statusid = $('#status').val();
        $.ajax({
            url: '/dashboard/clientsapi/' + id,
            method: 'get',
            dataType: 'json',
            success: function(response) {
                // console.log(response);
                $('#status option[value="' + statusid + '"]').prop('selected', true);

                if (statusid == 3) {
                    $('#dipending_keterangan').html('');
                    let status = response.client.stage2rencanaaudit.dipending_keterangan ?? '';

                    $('#dipending_keterangan').append(`
                        <textarea class='form-control' name='dipending_keterangan' cols="30" rows="10">` +
                        status + `</textarea>
                `);
                    // $('#dipending_keterangan').val(status);
                } else {
                    $('#dipending_keterangan').html('-');
                }
            }
        });

        $(document).on('change', '#status', function() {
            const idstatus = $(this).val();
            // console.log(idstatus);
            $.ajax({
                url: '/dashboard/clientsapi/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    if (idstatus == 3) {
                        $('#dipending_keterangan').html('');
                        let status = response.client.stage2rencanaaudit
                            .dipending_keterangan ?? '';

                        $('#dipending_keterangan').append(`
                                <textarea class='form-control' name='dipending_keterangan' cols="30" rows="10">` +
                            status + `</textarea>
                        `);
                        // $('#dipending_keterangan').val(status);
                    } else {
                        $('#dipending_keterangan').html('-');
                    }
                }
            });
        });
    </script>
@endsection
