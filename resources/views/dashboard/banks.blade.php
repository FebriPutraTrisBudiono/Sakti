@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="javascript:void(0)" class="ms-2 addBank" data-bs-toggle="modal" data-bs-target="#bankModal">
                        <?= in_array('banks.store', $roles) ? "<i class='fas fa-plus-circle fa-lg'></i>" : '' ?>
                    </a>
                </span>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="table-responsive">
                    <table id="customTable" class="table table-bordered small" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                <th>BANK</th>
                                <th>NOMOR</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banks as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="editBank" data-id="{{ $row->id }}"
                                            data-bs-toggle="modal" data-bs-target="#bankModal"
                                            <?= in_array('banks.show', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>
                                            {{ $row->name }}
                                        </a>
                                    </td>
                                    <td>{{ $row->bank_name }}</td>
                                    <td>{{ $row->number }}</td>
                                    <td>
                                        <form action="/dashboard/banks/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button {{ $row->barangs_count ? 'disabled' : '' }} type="submit"
                                                class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                <?= in_array('banks.destroy', $roles) ? '' : 'Disabled' ?>><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-5">
                    {{ $banks->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bankModal" tabindex="-1" aria-labelledby="bankModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bankModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Atas Nama</label>
                            <input type="text" name="name" id="name"
                                class="form-control mt-1 @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="bank_name">Bank</label>
                            <input type="text" name="bank_name" id="bank_name"
                                class="form-control mt-1 @error('bank_name') is-invalid @enderror">
                            @error('bank_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="number">Nomor Rekening</label>
                            <input type="text" name="number" id="number"
                                class="form-control mt-1 @error('number') is-invalid @enderror">
                            @error('number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
