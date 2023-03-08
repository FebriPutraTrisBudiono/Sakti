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
                    <div class="card-body">
                        @include('dashboard.navbarstatus')

                        {!! session('msg') !!}

                        <input type="hidden" value="{{ $client->id }}" name="client_id" id="client_id">
                        <input type="hidden" value="{{ $listpermohonan_id->id }}" name="listpermohonan_id"
                            id="listpermohonan_id">
                        <input type="hidden" value="{{ $listpermohonan_id->slug }}" name="listpermohonan_slug"
                            id="listpermohonan_slug">
                        <input type="hidden" value="{{ $stage2daftarhadiraudit->status ?? 2 }}" name="status"
                            id="status">

                        <h4 style="text-align: center">DAFTAR HADIR AUDIT</h4>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="rapat">Rapat</label>
                                    <input class="form-control @error('rapat') is-invalid @enderror mt-1" name="rapat"
                                        type="text" id="rapat"
                                        value="{{ old('rapat', $stage2daftarhadiraudit->rapat ?? '') }}" />
                                    @error('rapat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tanggal">Tanggal</label>
                                    <input class="form-control @error('tanggal') is-invalid @enderror mt-1" name="tanggal"
                                        type="date" id="tanggal"
                                        value="{{ old('tanggal', $stage2daftarhadiraudit->tanggal ?? '') }}" />
                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="tempat">Tempat</label>
                                <textarea name="tempat" id="tempat" rows="5"class="form-control mt-1 @error('tempat') is-invalid @enderror">{{ old('tempat', $stage2daftarhadiraudit->tempat ?? '') }}</textarea>
                                @error('tempat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        @if ($stage2daftarhadiraudit)
                            @if (in_array('F-CER-07 - Daftar Hadir Audit.download', $roles))
                                <a href="/dashboard/stage2daftarhadiraudits/download/{{ $stage2daftarhadiraudit->id }}"
                                    class="btn btn-secondary" target='_blank'>
                                    Download
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="card-title mb-3 border-bottom mt-4">Form Hadir</h6>
                        <div class="row control-group after-add-more">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="nama">Nama</label>
                                    <input class="form-control" name="nama" id="nama" type="text" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="jabatan">Jabatan</label>
                                    <input class="form-control" name="jabatan" id="jabatan" type="text" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label for="opening">Kehadiran Opening</label><br>
                                    <select name="opening" id="opening" class="form-control form-control-sm">
                                        <option value="">:: Pilih ::</option>
                                        <option value="ya">Ya</option>
                                        <option value="tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label for="closing">Kehadiran Closing</label>
                                    <select name="closing" id="closing" class="form-control form-control-sm">
                                        <option value="">:: Pilih ::</option>
                                        <option value="ya">Ya</option>
                                        <option value="tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm mt-3 float-start addKehadiran"><i
                                class="fas fa-plus-circle me-1"></i> Tambah</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        DATA KEHADIRAN BARU
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="customTable" class="table table-bordered small" style="width:100%">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="py-2">#</th>
                                        <th class="py-2">Nama</th>
                                        <th class="py-2">Jabatan</th>
                                        <th class="py-2">Kehadiran Opening</th>
                                        <th class="py-2">Kehadiran Closing</th>
                                        <th class="py-2">HAPUS</th>
                                    </tr>
                                </thead>
                                <tbody id="cartListKehadiran">
                                </tbody>
                            </table>

                            <input type="hidden" id="kehadiranid"
                                value="{{ $stage2daftarhadiraudit->client_id ?? '' }}">
                            <button type="button"
                                class="clearItem btn btn-light btn-sm float-start mt-3">Bersihkan</button>
                            @if ($stage2daftarhadiraudit == '')
                                @if (in_array('F-CER-07 - Daftar Hadir Audit.store', $roles))
                                    <button type="button"
                                        class="btnInsertKehadiran btn btn-primary float-end btn-sm mt-3">Simpan</button>
                                @endif
                            @elseif ($stage2daftarhadiraudit->status != 2)
                                @if (in_array('F-CER-07 - Daftar Hadir Audit.update', $roles))
                                    <button type="button"
                                        class="btnInsertKehadiran btn btn-primary float-end btn-sm mt-3">Simpan</button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        DATA KEHADIRAN
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="customTable2" class="table table-bordered small" style="width:100%">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="py-2">#</th>
                                        <th class="py-2">Nama</th>
                                        <th class="py-2">Jabatan</th>
                                        <th class="py-2">Kehadiran Opening</th>
                                        <th class="py-2">Kehadiran Closing</th>
                                        <th class="py-2">HAPUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($daftarhadir_items != '')
                                        @foreach ($daftarhadir_items as $item)
                                            <tr>
                                                <td class="py-2" style="text-align: center">{{ $loop->iteration }}</td>
                                                <td class="py-2" style="vertical-align:middle;">
                                                    {{ $item->nama }}
                                                </td>
                                                <td class="py-2" style="vertical-align:middle;">{{ $item->jabatan }}
                                                </td>
                                                <td class="py-2" style="text-align: center">{{ $item->opening }}</td>
                                                <td class="py-2" style="text-align: center">{{ $item->closing }}</td>
                                                <td class="py-2" style="vertical-align:middle;">
                                                    <form action="/dashboard/stage2daftarhadiraudits/{{ $item->id }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-datatable btn-icon btn-transparent-dark"
                                                            onclick="return confirm('Yakin ingin melanjutkan?')"><i
                                                                data-feather="trash-2"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="py-2" style="text-align: center" colspan="6">Data Belum
                                                Tersedia.
                                            </td>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($stage2daftarhadiraudit)
            <form
                action="/dashboard/stage2daftarhadirauditsvalidasi{{ $stage2daftarhadiraudit ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                method="post">
                @csrf

                @if ($stage2daftarhadiraudit)
                    @method('PUT')
                @endif

                <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                <input type="hidden" id="listpermohonan_id" value="{{ $listpermohonan_id->id ?? '' }}">
                <input type="hidden" id="status" value="{{ $stage2daftarhadiraudit->status ?? '' }}">
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="card-title">Status</h4>
                        @if (in_array('F-CER-07 - Daftar Hadir Audit.validasi', $roles))
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
                            @if ($stage2daftarhadiraudit)
                                @if ($stage2daftarhadiraudit->dipending_keterangan)
                                    <label class="mt-3">Keterangan</label>
                                    <div>
                                        <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                            disabled>{{ $stage2daftarhadiraudit->dipending_keterangan }}</textarea>
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
                    let status = response.stage2daftarhadiraudit.dipending_keterangan ?? '';

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
                        let status = response.stage2daftarhadiraudit
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
    <script>
        cartKehadiran();
        $(document).on('click', '.addKehadiran', function() {
            const cartList = cartLS.list();
            const dataBrg = {
                id: Math.random() + cartList.length + 1,
                name: document.getElementById('nama').value,
                jabatan: document.getElementById('jabatan').value,
                opening: $("#opening").val(),
                closing: $("#closing").val(),
                price: 1
            };
            cartLS.add(dataBrg, 1);

            $("#opening option").prop("selected", false);
            $("#closing option").prop("selected", false);
            $('#nama').val('');
            $('#jabatan').val('');
            cartKehadiran();
        });

        function capitalize(s) {
            if (s) {
                return s[0].toUpperCase() + s.slice(1);
            }
        }

        function cartKehadiran() {
            const cartList = cartLS.list();
            if (cartList.length > 0) {
                $('table #cartListKehadiran').html('');
                for (var i = 0; i < cartList.length; i++) {
                    $('table #cartListKehadiran').append(`
                <tr>
                    <td>` + (i + 1) + `</td>
                    <td>` + cartList[i].name + `</td>
                    <td>` + cartList[i].jabatan + `</td>
                    <td>` + capitalize(cartList[i].opening) + `</td>
                    <td>` + capitalize(cartList[i].closing) + `</td>
                    <td><button class="btn btn-danger btn-sm removeItem" type="button" data-id="` +
                        cartList[i].id + `"><i class="fas fa-sm fa-trash fa-sm"></i></button></td>
                </tr>
            `);
                }
            } else {
                $('table #cartListKehadiran').html('');
                $('table #cartListKehadiran').append(
                    `<tr><td colspan="6" class="py-2 font-italic text-center">Data belum tersedia.</td></tr>`);
            }
        }

        $(document).on('click', '.removeItem', function() {
            r = confirm('Yakin ingin melanjutkan?');
            if (r == true) {
                const id = $(this).data('id');
                if (cartLS.exists(id)) {
                    cartLS.remove(id);
                    cartKehadiran();
                }
            }
        });

        $(document).on('click', '.clearItem', function() {
            r = confirm('Yakin ingin melanjutkan?');
            if (r == true) {
                cartLS.destroy();
                cartKehadiran();
            }
        });

        $(document).on('click', '.btnInsertKehadiran', function() {
            r = confirm('Yakin ingin melanjutkan?');
            if (r == true) {
                const client_id = $('#client_id').val();
                const listpermohonan_id = $('#listpermohonan_id').val();
                const listpermohonan_slug = $('#listpermohonan_slug').val();
                const status = $('#status').val();
                const rapat = $('#rapat').val();
                const tanggal = $('#tanggal').val();
                const tempat = $('#tempat').val();
                const clientid = $('#kehadiranid').val();
                const cartList = cartLS.list();

                if (cartList) {
                    if (clientid != '') {
                        $.ajax({
                            url: '/dashboard/stage2daftarhadiraudits/' + client_id + '/' +
                                listpermohonan_id,
                            method: 'PUT',
                            data: {
                                client_id,
                                listpermohonan_id,
                                status,
                                rapat,
                                tanggal,
                                tempat,
                                data: cartList
                            },
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                if (response.status) {
                                    console.log('berhasil');
                                    cartLS.destroy();
                                    $("#toastAlert").toast({
                                        delay: 3000
                                    });
                                    $("#toastAlert").toast('show');
                                    $("#infoToast").html('Oops!');
                                    $(".toast-body>#message").html(response.msg);
                                    location.reload();
                                } else {
                                    console.log('gagal');
                                    $("#toastAlert").toast({
                                        delay: 3000
                                    });
                                    $("#toastAlert").toast('show');
                                    $("#infoToast").html('Oops!');
                                    $(".toast-body>#message").html(response.msg);
                                }
                            }
                        });
                    } else {
                        $.ajax({
                            url: '/dashboard/stage2daftarhadiraudits',
                            method: 'post',
                            data: {
                                client_id,
                                listpermohonan_id,
                                listpermohonan_slug,
                                status,
                                rapat,
                                tanggal,
                                tempat,
                                data: cartList
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status) {
                                    console.log('berhasil');
                                    cartLS.destroy();
                                    $("#toastAlert").toast({
                                        delay: 3000
                                    });
                                    $("#toastAlert").toast('show');
                                    $("#infoToast").html('Oops!');
                                    $(".toast-body>#message").html(response.msg);
                                    location.reload();
                                } else {
                                    console.log('gagal');
                                    $("#toastAlert").toast({
                                        delay: 3000
                                    });
                                    $("#toastAlert").toast('show');
                                    $("#infoToast").html('Oops!');
                                    $(".toast-body>#message").html(response.msg);
                                }
                            }
                        });
                    }

                } else {
                    $("#toastAlert").toast({
                        delay: 3000
                    });
                    $("#toastAlert").toast('show');
                    $("#infoToast").html('Oops!');
                    $(".toast-body>#message").html('Ada yang salah');
                }
            }
        });
    </script>
@endsection
