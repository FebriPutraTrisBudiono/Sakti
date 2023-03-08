@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="javascript:void(0)" class="ms-2 addMenu" data-bs-toggle="modal" data-bs-target="#menuModal">
                        <?= in_array('menus.store', $roles) ? "<i class='fas fa-plus-circle fa-lg'></i>" : '' ?>
                    </a>
                </span>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="table-responsive">
                    <table id="tableStandar" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>MAIN MENU</th>
                                <th>SUB MENU</th>
                                <th>URUTAN</th>
                                <th>URL / SLUG</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if (!$row->child)
                                            <a href="javascript:void(0)" class="editMenu" data-id="{{ $row->id }}"
                                                data-bs-toggle="modal" data-bs-target="#menuModal"
                                                <?= in_array('menus.show', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>{{ $row->name }}</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row->child)
                                            <a href="javascript:void(0)" class="editMenu" data-id="{{ $row->id }}"
                                                data-bs-toggle="modal" data-bs-target="#menuModal"
                                                <?= in_array('menus.show', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>{{ $row->name }}</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $row->sort }}</td>
                                    <td>{{ $row->link }}</td>
                                    <td>
                                        <form action="/dashboard/menus/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                <?= in_array('menus.destroy', $roles) ? '' : 'Disabled' ?>><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="menuModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Nama Menu</label>
                            <input type="text" name="name" id="name"
                                class="form-control mt-1 @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="link">URL / Link</label>
                            <input type="text" name="link" id="link"
                                class="form-control mt-1 @error('link') is-invalid @enderror">
                            @error('link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="child">Sub Menu</label>
                            <select name="child" id="child" class="form-control @error('name') is-invalid @enderror">
                                <option value="">:: Pilih ::</option>
                                @foreach ($mainMenus as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                            @error('link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="sort">Urutan</label>
                            <input type="number" name="sort" id="sort" step="0.01"
                                class="form-control mt-1 @error('sort') is-invalid @enderror">
                            @error('sort')
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
