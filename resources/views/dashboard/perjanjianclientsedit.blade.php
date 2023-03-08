@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/perjanjiansertifikasi{{ $perjanjianclient ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
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
                            <div class="row">
                                @if (in_array('DOC-CER-01 - Kontrak Sertifikasi.download', $roles))
                                    <a href="/dashboard/perjanjiansertifikasi/download/{{ $kajianclient->id }}"
                                        class="btn btn-success mt-3" target='_blank'>
                                        Download
                                    </a>
                                @endif
                            </div>

                            @csrf

                            @if ($perjanjianclient)
                                @method('PUT')
                            @endif

                        </div>
                    </div>

                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <input type="hidden" name="listpermohonan_id" value="{{ $listpermohonan_id->id }}">
                    <input type="hidden" name="listpermohonan_slug" value="{{ $listpermohonan_id->slug }}">

                    <div class="card mt-3">
                        <div class="card-body">
                            <h4 class="card-title">Upload Permohonan Sertifikasi yang telah di tanda
                                tangani.</h4>
                            <div class="row mb-3">
                                <div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            @if (isset($perjanjianclient->upload))
                                                <p class="my-2"><i class="fas fa-check-square me-1 text-success"></i>
                                                    <a href="/storage/{{ $perjanjianclient->upload }}" target="_blank">Lihat
                                                        Berkas</a>
                                                </p>
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
                                </div>
                            </div>
                            <div class="mt-3">
                                @if ($perjanjianclient == '')
                                    @if (in_array('DOC-CER-01 - Kontrak Sertifikasi.store', $roles))
                                        <button type="submit" class="btn btn-primary mt-1 mb-3">Kirim</button>
                                    @endif
                                @elseif ($perjanjianclient->status != 2)
                                    @if (in_array('DOC-CER-01 - Kontrak Sertifikasi.update', $roles))
                                        <button type="submit" class="btn btn-primary mt-1 mb-3">Kirim</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
                @if ($perjanjianclient)
                    <form
                        action="/dashboard/perjanjianclientsvalidasi{{ $perjanjianclient ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($perjanjianclient)
                            @method('PUT')
                        @endif

                        <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                        <input type="hidden" id="listpermohonan_id" value="{{ $listpermohonan_id->id }}">
                        <input type="hidden" id="status" value="{{ $perjanjianclient->status ?? '' }}">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">Status</h4>
                                @if (in_array('DOC-CER-01 - Kontrak Sertifikasi.validasi', $roles))
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
                                    @if ($perjanjianclient->dipending_keterangan)
                                        <label class="mt-3">Keterangan</label>
                                        <div>
                                            <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white" disabled>{{ $perjanjianclient->dipending_keterangan }}</textarea>
                                        </div>
                                        <button name="status" value="1" type="submit"
                                            class="btn btn-warning mt-3">Simpan
                                            Status Revisi</button>
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
                    let status = response.perjanjianclient.dipending_keterangan ?? '';

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
                        let status = response.perjanjianclient
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
