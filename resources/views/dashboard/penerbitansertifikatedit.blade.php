@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/penerbitansertifikats{{ $penerbitansertifikat ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
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
                            <h4 class="card-title mb-3 mb-4 text-decoration"
                                style="text-decoration: underline;text-align: center;">
                                @if ($listpermohonan_id->slug == 'surveilance1' || $listpermohonan_id->slug == 'surveilance2')
                                    SURAT KEPUTUSAN SURVEILANCE
                                    {{ $listpermohonan_id->slug == 'surveilance1' ? 'I' : 'II' }}
                                @else
                                    PENERBITAN SERTIFIKAT
                                @endif
                            </h4>
                            <div>
                                <?php
                                $datenow = date('Y-m-d');
                                $datenow_1 = explode('-', $datenow);
                                $dateexpired = $penerbitansertifikat->tgl_kadaluarsasertifikat ?? '';
                                $datenow_2 = explode('-', $dateexpired);
                                ?>
                                @if ($dateexpired)
                                    @if ($datenow_1[0] >= $datenow_2[0] && $datenow_1[1] >= $datenow_2[1] && $datenow_1[2] >= $datenow_2[2])
                                        <div style="text-align: center">
                                            <h1>Expired</h1>
                                        </div>
                                    @else
                                        @if ($penerbitansertifikat->status == 2)
                                            <div class="watermarked" data-watermark="Sakti Indonesia">
                                                <img src="/storage/{{ $penerbitansertifikat->upload }}">
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    -
                                @endif
                            </div>

                            @csrf

                            @if ($penerbitansertifikat)
                                @method('PUT')
                            @endif

                        </div>
                    </div>

                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <input type="hidden" name="listpermohonan_id" value="{{ $listpermohonan_id->id }}">
                    <input type="hidden" name="listpermohonan_slug" value="{{ $listpermohonan_id->slug }}">

                    @if (auth()->user()->level_id != 2)
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">Upload Sertifikat</h4>
                                <div class="row mb-3">
                                    <div>
                                        <div class="col-md-12">
                                            {{-- <div class="form-group row">
                                        </div> --}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        @if (isset($penerbitansertifikat->upload))
                                                            <p class="my-2"><i
                                                                    class="fas fa-check-square me-1 text-success"></i>
                                                                <a href="/storage/{{ $penerbitansertifikat->upload }}"
                                                                    target="_blank">Lihat
                                                                    Berkas</a>
                                                            </p>
                                                        @else
                                                            <label class="mt-5"></label>
                                                        @endif
                                                        <div class="form-group">
                                                            <input type="file" name="upload" id="upload"
                                                                class="form-control mt-1 @error('upload') is-invalid @enderror">
                                                            @error('upload')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="mt-3">Tanggal Kadaluarsa Sertifikat</label>
                                                        <div class="col-sm-12">
                                                            <input type="date"
                                                                class="form-control mt-1 @error('tgl_kadaluarsasertifikat') is-invalid @enderror"
                                                                id="tgl_kadaluarsasertifikat"
                                                                name="tgl_kadaluarsasertifikat"
                                                                value="{{ old('tgl_kadaluarsasertifikat', $penerbitansertifikat->tgl_kadaluarsasertifikat ?? '') }}" />
                                                            @error('tgl_kadaluarsasertifikat')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    @if ($penerbitansertifikat == '')
                                        @if (in_array('F-CER-12 - Memo Penerbitan Sertifikat.store', $roles))
                                            <button type="submit" class="btn btn-primary mt-1 mb-3">Kirim</button>
                                        @endif
                                    @elseif ($penerbitansertifikat->status != 2)
                                        @if (in_array('F-CER-12 - Memo Penerbitan Sertifikat.update', $roles))
                                            <button type="submit" class="btn btn-primary mt-1 mb-3">Kirim</button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
                @if ($penerbitansertifikat)
                    <form
                        action="/dashboard/penerbitansertifikatsvalidasi{{ $penerbitansertifikat ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($penerbitansertifikat)
                            @method('PUT')
                        @endif

                        <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                        <input type="hidden" id="status" value="{{ $penerbitansertifikat->status ?? '' }}">
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
                                    @if ($penerbitansertifikat->dipending_keterangan)
                                        <label class="mt-3">Keterangan</label>
                                        <div>
                                            <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white" disabled>{{ $penerbitansertifikat->dipending_keterangan }}</textarea>
                                        </div>
                                        <button name="status" value="1" type="submit"
                                            class="btn btn-warning mt-3">Simpan Status
                                            Revisi</button>
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
        document.addEventListener("contextmenu", function(e) {
            e.preventDefault();
        }, false);

        document.onkeydown = function(e) {
            return false;
        }
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
                    let status = response.penerbitansertifikat.dipending_keterangan ?? '';

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
                        let status = response.penerbitansertifikat
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
