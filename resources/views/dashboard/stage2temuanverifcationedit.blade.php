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
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card-body">
                            @include('dashboard.navbarstatus')

                            {!! session('msg') !!}

                            <h4 style="text-align: center" class="border-bottom">VERIFIKASI</h4>

                            @if ($stage2ketidaksesuaianpage)
                                <div class="row mt-3">
                                    <div class="col-12 grid-margin">
                                        <h4 class="card-title">Lembar Ketidaksesuaian yang telah Client
                                            tanda tangani.</h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    @if (isset($stage2ketidaksesuaianpage->uploadttd))
                                                        <p class="my-2"><i
                                                                class="fas fa-check-square me-1 text-success"></i>
                                                            <a href="/storage/{{ $stage2ketidaksesuaianpage->uploadttd }}"
                                                                target="_blank">Lihat Berkas</a>
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="form-group row">
                                                    @if ($stage2temuanverication)
                                                        @if ($stage2temuanverication->status == 2)
                                                            <p class="my-2"><i
                                                                    class="fas fa-check-square me-1 text-success"></i>
                                                                <a href="#">Telah
                                                                    Terverifikasi</a>
                                                            </p>
                                                        @else
                                                            <p class="my-2"><i
                                                                    class="fas fa-check-square me-1 text-wrong"></i>
                                                                <label>Belum Diverifikasi</label>
                                                            </p>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <form
                    action="/dashboard/stage2temuanvericationsvalidasi{{ $stage2temuanverication ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                    method="post">
                    @csrf

                    @if ($stage2temuanverication)
                        @method('PUT')
                    @endif

                    <input type="hidden" name="client_id" id="client_id" value="{{ $client->id }}">
                    <input type="hidden" name="listpermohonan_id" value="{{ $listpermohonan_id->id }}">
                    <input type="hidden" name="listpermohonan_slug" value="{{ $listpermohonan_id->slug }}">
                    <input type="hidden" id="status" value="{{ $stage2temuanverication->status ?? '' }}">
                    <div class="card mt-3">
                        <div class="card-body">
                            <h4 class="card-title">Status</h4>
                            @if (in_array('F-CER-10 - Survei Kepuasan Pelanggan.validasi', $roles))
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
                                @if ($stage2temuanverication)
                                    @if ($stage2temuanverication->dipending_keterangan)
                                        <label class="mt-3">Keterangan</label>
                                        <div>
                                            <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white" disabled>{{ $stage2temuanverication->dipending_keterangan }}</textarea>
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
                    let status = response.stage2temuanverication.dipending_keterangan ?? '';

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
                        let status = response.stage2temuanverication
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
