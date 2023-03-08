@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/stage1penunjukantimaudits{{ $stage1penunjukantimaudit ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
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

                            @if ($stage1penunjukantimaudit)
                                @method('PUT')
                            @endif

                            <input type="hidden" value="{{ $client->id }}" name="client_id">
                            <input type="hidden" value="{{ $listpermohonan_id->id }}" name="listpermohonan_id">
                            <input type="hidden" value="{{ $listpermohonan_id->slug }}" name="listpermohonan_slug">

                            <div class="col-12 grid-margin stretch-card">
                                <div>
                                    <div class="card-body">
                                        <h4 style="text-align: center;" class="card-title border-bottom mb-4">
                                            PENUNJUKAN
                                            TIM
                                            AUDIT
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Nama Pemohonan</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('nama_client') is-invalid @enderror mt-1"
                                                            id="nama_client" name="nama_client"
                                                            value="{{ old('nama_client', $permohonanclient->nama_pimpinan ?? '') }}"
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
                                                    <label>Ruang Lingkup</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('b1_lingkup') is-invalid @enderror"
                                                            id="b1_lingkup" name="b1_lingkup"
                                                            value="{{ old('b1_lingkup', $permohonanclient->ruang_lingkup_perusahaan ?? '') }}"
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
                                                                name="pra_audit" id="pra_audit" value="pra_audit"
                                                                {{ old('pra_audit', $audit[0] ?? '') == 'pra_audit' ? 'checked' : '' }} />
                                                            Pra Audit
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" name="stage1"
                                                                id="stage1" value="stage1"
                                                                {{ old('stage1', $audit[1] ?? '') == 'stage1' ? 'checked' : '' }} />
                                                            Stage 1
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" name="stage2"
                                                                id="stage2" value="stage2"
                                                                {{ old('stage2', $audit[2] ?? '') == 'stage2' ? 'checked' : '' }} />
                                                            Stage 2
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" name="surveilen"
                                                                id="surveilen" value="surveilen"
                                                                {{ old('surveilen', $audit[3] ?? '') == 'surveilen' ? 'checked' : '' }} />
                                                            Surveilan
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="tindaklanjut" id="tindaklanjut" value="tindaklanjut"
                                                                {{ old('tindaklanjut', $audit[4] ?? '') == 'tindaklanjut' ? 'checked' : '' }} />
                                                            Tindaklanjut
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 mb-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="resertifikasi" id="resertifikasi"
                                                                value="resertifikasi"
                                                                {{ old('resertifikasi', $audit[5] ?? '') == 'resertifikasi' ? 'checked' : '' }} />
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
                                                        <select name="nama_auditor" id="nama_auditor"
                                                            class="form-control mt-1 @error('nama_auditor') is-invalid @enderror">
                                                            <option value="">:: Pilih ::</option>
                                                            @foreach ($hasil3_auditor as $item)
                                                                @if ($item != '')
                                                                    <option value="{{ $item }}"
                                                                        class="form-control"
                                                                        {{ ($stage1penunjukantimaudit->nama_auditor ?? '') == $item ? 'selected' : '' }}>
                                                                        <?php
                                                                        $user = new App\Models\User();
                                                                        $userid = $user::where('id', $item)->first();
                                                                        ?>
                                                                        {{ $userid->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
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
                                                            value="{{ old('nama_inisial', $stage1penunjukantimaudit->nama_inisial ?? '') }}" />
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
                                                            value="{{ old('jabatan', $stage1penunjukantimaudit->jabatan ?? '') }}" />
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
                                                        <select name="nama_auditor2" id="nama_auditor2"
                                                            class="form-control mt-1 @error('nama_auditor2') is-invalid @enderror">
                                                            <option value="">:: Pilih ::</option>
                                                            @foreach ($hasil3_auditor as $item)
                                                                @if ($item != '')
                                                                    <option value="{{ $item }}"
                                                                        class="form-control"
                                                                        {{ ($stage1penunjukantimaudit->nama_auditor2 ?? '') == $item ? 'selected' : '' }}>
                                                                        <?php
                                                                        $user = new App\Models\User();
                                                                        $userid = $user::where('id', $item)->first();
                                                                        ?>
                                                                        {{ $userid->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
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
                                                            value="{{ old('nama_inisial2', $stage1penunjukantimaudit->nama_inisial2 ?? '') }}" />
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
                                                            value="{{ old('jabatan2', $stage1penunjukantimaudit->jabatan2 ?? '') }}" />
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
                                                        <select name="nama_auditor3" id="nama_auditor3"
                                                            class="form-control mt-1 @error('nama_auditor3') is-invalid @enderror">
                                                            <option value="">:: Pilih ::</option>
                                                            @foreach ($hasil3_auditor as $item)
                                                                @if ($item != '')
                                                                    <option value="{{ $item }}"
                                                                        class="form-control"
                                                                        {{ ($stage1penunjukantimaudit->nama_auditor3 ?? '') == $item ? 'selected' : '' }}>
                                                                        <?php
                                                                        $user = new App\Models\User();
                                                                        $userid = $user::where('id', $item)->first();
                                                                        ?>
                                                                        {{ $userid->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
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
                                                            value="{{ old('nama_inisial3', $stage1penunjukantimaudit->nama_inisial3 ?? '') }}" />
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
                                                            value="{{ old('jabatan3', $stage1penunjukantimaudit->jabatan3 ?? '') }}" />
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
                                                            name="tanggal_bertugas" type="date" id="tanggal_bertugas"
                                                            value="{{ old('tanggal_bertugas', isset($stage1penunjukantimaudit->tanggal_bertugas) ? date('Y-m-d', strtotime($stage1penunjukantimaudit->tanggal_bertugas)) : '') }}" />
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
                                                            value="{{ old('sampai_dengan', isset($stage1penunjukantimaudit->sampai_dengan) ? date('Y-m-d', strtotime($stage1penunjukantimaudit->sampai_dengan)) : '') }}" />
                                                        @error('sampai_dengan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt-3">
                                            <h6 class="card-title border-bottom mb-4">TTD</h6>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="tempat_ttd">Tempat</label>
                                                        <input
                                                            class="form-control mt-1 @error('tempat_ttd') is-invalid @enderror"
                                                            name="tempat_ttd" type="text" id="tempat_ttd"
                                                            value="{{ old('tempat_ttd', $stage1penunjukantimaudit->tempat_ttd ?? '') }}" />
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
                                                        <input
                                                            class="form-control mt-1 @error('tgl_ttd') is-invalid @enderror"
                                                            name="tgl_ttd" type="date" id="tgl_ttd"
                                                            value="{{ old('tgl_ttd', $stage1penunjukantimaudit->tgl_ttd ?? '') }}" />
                                                        @error('tgl_ttd')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="nama_ttd">Nama Manager Sertifikasi</label>
                                                        <input
                                                            class="form-control mt-1 @error('nama_ttd') is-invalid @enderror"
                                                            name="nama_ttd" type="text" id="nama_ttd"
                                                            value="{{ old('nama_ttd', $stage1penunjukantimaudit->nama_ttd ?? '') }}" />
                                                        @error('nama_ttd')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($stage1penunjukantimaudit == '')
                                            @if (in_array('F-CER-04 - Penunjukan Tim Audit.store', $roles))
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    Simpan
                                                </button>
                                            @endif
                                        @elseif ($stage1penunjukantimaudit->status != 2)
                                            @if (in_array('F-CER-04 - Penunjukan Tim Audit.update', $roles))
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    Simpan
                                                </button>
                                            @endif
                                        @endif

                                        @if ($stage1penunjukantimaudit)
                                            @if (in_array('F-CER-04 - Penunjukan Tim Audit.download', $roles))
                                                <a href="/dashboard/stage1penunjukantimaudits/download/{{ $stage1penunjukantimaudit->id }}"
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
                @if ($stage1penunjukantimaudit)
                    <form
                        action="/dashboard/stage1penunjukantimauditsvalidasi{{ $stage1penunjukantimaudit ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($stage1penunjukantimaudit)
                            @method('PUT')
                        @endif

                        <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                        <input type="hidden" id="listpermohonan_id" value="{{ $listpermohonan_id->id ?? '' }}">
                        <input type="hidden" id="status" value="{{ $stage1penunjukantimaudit->status ?? '' }}">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">Status</h4>
                                @if (in_array('F-CER-04 - Penunjukan Tim Audit.validasi', $roles))
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
                                    @if ($stage1penunjukantimaudit)
                                        @if ($stage1penunjukantimaudit->dipending_keterangan)
                                            <label class="mt-3">Keterangan</label>
                                            <div>
                                                <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                                    disabled>{{ $stage1penunjukantimaudit->dipending_keterangan }}</textarea>
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
                    let status = response.stage1penunjukantimaudit.dipending_keterangan ?? '';

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
                        let status = response.stage1penunjukantimaudit
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
