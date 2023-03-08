@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/stage2checkaudits{{ $stage2checkaudit ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
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

                            @if ($stage2checkaudit)
                                @method('PUT')
                            @endif

                            <input type="hidden" value="{{ $client->id }}" name="client_id">
                            <input type="hidden" value="{{ $listpermohonan_id->id }}" name="listpermohonan_id">
                            <input type="hidden" value="{{ $listpermohonan_id->slug }}" name="listpermohonan_slug">

                            <h4 style="text-align: center;" class="card-title mb-3 border-bottom mb-4">CHECKLIST
                                AUDIT TAHAP 2
                            </h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label>Tanggal audit</label>
                                        <div class="col-sm-12">
                                            <input class="form-control mt-1 @error('tanggal_bertugas') is-invalid @enderror"
                                                name="tanggal_bertugas" type="date" id="tanggal_bertugas"
                                                value="{{ old('tanggal_bertugas', $stage1penunjukantimaudit->tanggal_bertugas ?? '') }}"
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
                                        <label>Auditi</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="auditi"
                                                value="{{ old('auditi', $stage2checkaudit->auditi ?? '') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group row">
                                        <label>Auditor</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="auditor"
                                                value="{{ old('auditor', $stage2checkaudit->auditor ?? '') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h6 class="card-title border-bottom mb-4">Standar</h6>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('standart_iso') is-invalid @enderror"
                                                type="radio" name="standart_iso" id="standart_iso" value="ISO 9001:2015"
                                                {{ old('standart_iso', $stage2checkaudit->standart_iso ?? '') == 'ISO 9001:2015' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="standart_iso">ISO 9001:2015</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('standart_iso') is-invalid @enderror"
                                                type="radio" name="standart_iso" id="standart_iso" value="ISO 14001:2015"
                                                {{ old('standart_iso', $stage2checkaudit->standart_iso ?? '') == 'ISO 14001:2015' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="standart_iso">ISO 14001:2015</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('standart_iso') is-invalid @enderror"
                                                type="radio" name="standart_iso" id="standart_iso" value="ISO 21001:2018"
                                                {{ old('standart_iso', $stage2checkaudit->standart_iso ?? '') == 'ISO 21001:2018' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="standart_iso">ISO 21001:2018</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('standart_iso') is-invalid @enderror"
                                                type="radio" name="standart_iso" id="standart_iso" value="ISO 45001:2018"
                                                {{ old('standart_iso', $stage2checkaudit->standart_iso ?? '') == 'ISO 45001:2018' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="standart_iso">ISO 45001:2018</label>
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
                                                <input class="form-check-input" type="radio" name="standart_iso"
                                                    id="standart_iso" value="{{ $client->service->iso_code }}"
                                                    {{ old('standart_iso', $stage2checkaudit->standart_iso ?? '') == $client->service->iso_code ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="standart_iso">{{ $client->service->iso_code }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="card-title mb-3 border-bottom mt-4">TABEL AUDIT</h6>
                            <?php
                                        for ($i = 0; $i < 5; $i++) { ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label>DOKUMEN YANG DIUJI</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="doc_diuji[]" type="text"
                                                value="{{ old('doc_diuji[]', $doc_diuji[$i] ?? '') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label>KLAUSUL</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="klausul[]" type="text"
                                                value="{{ old('klausul[]', $klausul[$i] ?? '') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label>MAJ</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="maj[]" type="text"
                                                value="{{ old('maj[]', $maj[$i] ?? '') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label>MIN</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="min[]" type="text"
                                                value="{{ old('min[]', $min[$i] ?? '') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <div class="form-group row">
                                        <label>OBS</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="obs[]" type="text"
                                                value="{{ old('obs[]', $obs[$i] ?? '') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                        }
                                        ?>
                            @if ($stage2checkaudit == '')
                                @if (in_array('F-CER-06B - Checklist Audit Stage II.store', $roles))
                                    <button type="submit" class="btn btn-primary mr-2">
                                        Simpan
                                    </button>
                                @endif
                            @elseif ($stage2checkaudit->status != 2)
                                @if (in_array('F-CER-06B - Checklist Audit Stage II.update', $roles))
                                    <button type="submit" class="btn btn-primary mr-2">
                                        Simpan
                                    </button>
                                @endif
                            @endif
                            @if ($stage2checkaudit)
                                @if (in_array('F-CER-06B - Checklist Audit Stage II.download', $roles))
                                    <a href="/dashboard/stage2checkaudits/download/{{ $stage2checkaudit->id }}"
                                        class="btn btn-secondary" target='_blank'>
                                        Download
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </form>
                @if ($stage2checkaudit)
                    <form
                        action="/dashboard/stage2checkauditsvalidasi{{ $stage2checkaudit ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($stage2checkaudit)
                            @method('PUT')
                        @endif

                        <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                        <input type="hidden" id="listpermohonan_id" value="{{ $listpermohonan_id->id ?? '' }}">
                        <input type="hidden" id="status" value="{{ $stage2checkaudit->status ?? '' }}">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">Status</h4>
                                @if (in_array('F-CER-06B - Checklist Audit Stage II.validasi', $roles))
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
                                    @if ($stage2checkaudit)
                                        @if ($stage2checkaudit->dipending_keterangan)
                                            <label class="mt-3">Keterangan</label>
                                            <div>
                                                <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                                    disabled>{{ $stage2checkaudit->dipending_keterangan }}</textarea>
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
                    let status = response.stage2checkaudit.dipending_keterangan ?? '';

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
                        let status = response.stage2checkaudit
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
