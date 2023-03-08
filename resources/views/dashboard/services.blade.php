@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="javascript:void(0)" class="ms-2 addService" data-bs-toggle="modal" data-bs-target="#serviceModal">
                        <?= in_array('services.store', $roles) ? "<i class='fas fa-plus-circle fa-lg'></i>" : '' ?>
                    </a>
                </span>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="table-responsive">
                    <table id="customTable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>LAYANAN</th>
                                <th>KODE ISO (Jika ISO)</th>
                                <th>KODE LAYANAN</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="editService" data-id="{{ $row->id }}"
                                            data-bs-toggle="modal" data-bs-target="#serviceModal"
                                            <?= in_array('services.show', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>
                                            {{ $row->name }}
                                        </a>({{ $row->clients_count }})
                                    </td>
                                    <td>
                                        {{ $row->iso_code }}
                                    </td>
                                    <td>
                                        {{ $row->service_code }}
                                    </td>
                                    <td>
                                        <form action="/dashboard/services/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button {{ $row->id === 1 || $row->users_count ? 'disabled' : '' }}
                                                type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                <?= in_array('services.destroy', $roles) ? '' : 'Disabled' ?>><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-5">
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="serviceModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Layanan</label>
                            <input type="text" name="name" id="name"
                                class="form-control mt-1 @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Kode ISO</label>
                            <input type="text" name="iso_code" id="iso_code"
                                class="form-control mt-1 @error('iso_code') is-invalid @enderror">
                            @error('iso_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Kode Layanan</label>
                            <input type="text" name="service_code" id="service_code"
                                class="form-control mt-1 @error('service_code') is-invalid @enderror">
                            @error('service_code')
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
