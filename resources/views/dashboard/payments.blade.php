@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="table-responsive">
                    <table id="customTable" class="table table-bordered small" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NOMOR</th>
                                <th>TANGGAL</th>
                                <th>NAMA</th>
                                <th>FEE</th>
                                <th>BANK</th>
                                <th>NOMINAL</th>
                                <th>STATUS</th>
                                <th>USER</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $row)
                                <?php if ($row->status === 1) {
                                    $status = 'Menunggu';
                                } elseif ($row->status === 2) {
                                    $status = 'Sukses';
                                } else {
                                    $status = 'Ditolak';
                                } ?>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->number }}</td>
                                    <td>{{ date('d/m/Y H:i', strtotime($row->trx_date)) }}</td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{ $row->fee->name }}</td>
                                    <td>{{ $row->bank->bank_name }}</td>
                                    <td>
                                        @currency($row->trx_amount)
                                        @if ($row->proof)
                                            <br /><br />
                                            <small><a href="/storage/{{ $row->proof }}" target="_blank"
                                                    <?= in_array('pembayaran.show', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>><em>Bukti
                                                        Transfer</em></a></small>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="confirm" data-id="{{ $row->id }}"
                                            data-bs-toggle="modal" data-bs-target="#confirmationModal"
                                            <?= in_array('pembayaran.show', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>{{ $status }}</a>
                                    </td>
                                    <td>{{ $row->approval ? $row->approval->name : '-' }}</td>
                                    <td>
                                        <form action="/dashboard/payments/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                <?= in_array('pembayaran.destroy', $roles) ? '' : 'Disabled' ?>><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-5">
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="_method" value="PUT">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="number">Nomor</label>
                                    <input readonly type="text" name="number" id="number"
                                        class="form-control mt-1 @error('number') is-invalid @enderror">
                                    @error('number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">Nama</label>
                                    <input readonly type="text" name="name" id="name"
                                        class="form-control mt-1 @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status"
                                class="form-control mt-1 @error('status') is-invalid @enderror">
                                <option value="">:: Pilih ::</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Sukses
                                </option>
                                <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
