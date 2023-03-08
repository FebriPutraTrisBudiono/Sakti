@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="javascript:void(0)" class="ms-2 addFee" data-bs-toggle="modal" data-bs-target="#feeModal">
                        <?= in_array('registrationfees.store', $roles) ? "<i class='fas fa-plus-circle fa-lg'></i>" : '' ?>
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
                                <th>FEE</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fees as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="editFee" data-id="{{ $row->id }}"
                                            data-bs-toggle="modal" data-bs-target="#feeModal"
                                            <?= in_array('registrationfees.show', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>
                                            {{ $row->name }}
                                        </a>
                                    </td>
                                    <td>@currency($row->fee)</td>
                                    <td>
                                        <form action="/dashboard/registrationfees/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button {{ $row->id === 1 ? 'disabled' : '' }} type="submit"
                                                class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                <?= in_array('registrationfees.destroy', $roles) ? '' : 'Disabled' ?>><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-5">
                    {{ $fees->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="feeModal" tabindex="-1" aria-labelledby="feeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="feeModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name"
                                class="form-control mt-1 @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="fee">Fee</label>
                            <input type="text" name="fee" id="fee"
                                class="form-control mt-1 @error('fee') is-invalid @enderror" onkeyup="strToNum('fee')">
                            @error('fee')
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
