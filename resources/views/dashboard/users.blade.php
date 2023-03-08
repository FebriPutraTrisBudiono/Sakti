@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="/dashboard/users/create" class="ms-2">
                        <?= in_array('users.store', $roles) ? "<i class='fas fa-plus-circle fa-lg'></i>" : '' ?>
                    </a>
                </span>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <form action="/dashboard/users" method="get" class="bg-light p-3 rounded">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="q" class="small">Nama User</label>
                                <input type="text" name="q" id="q"
                                    class="form-control form-control-sm mt-1" value="{{ request('q') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="level" class="small">Level</label>
                                <select name="level" id="level" class="form-control form-control-sm mt-1">
                                    <option value="">:: Semua ::</option>
                                    @foreach ($levels as $item)
                                        <option value="{{ $item->id }}"
                                            {{ request('level') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="status" class="small">Status</label>
                                <select name="status" id="status" class="form-control form-control-sm mt-1">
                                    <option value="">:: Semua ::</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Nonaktif
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                    {{-- <button type="button" class="btn btn-sm btnReset btn-outline-dark">Reset</button> --}}
                </form>

                <div class="table-responsive mt-4">
                    <table id="customTable" class="table table-bordered small" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                <th>USERNAME</th>
                                <th>EMAIL</th>
                                <th>TELP</th>
                                <th>LEVEL</th>
                                <th>STATUS</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="/dashboard/users/{{ $row->id }}/edit"
                                            <?= in_array('users.edit', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>
                                            {{ $row->name }}
                                        </a>
                                    </td>
                                    <td>{{ $row->username }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->telp ? $row->telp : '-' }}</td>
                                    <td>{{ $row->level->name }}</td>
                                    <td>{{ $row->status ? 'Aktif' : 'Nonaktif' }}</td>
                                    <td>
                                        <form action="/dashboard/users/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                {{ $row->id === auth()->user()->id || $row->id === 1 ? 'disabled' : '' }}
                                                type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                <?= in_array('users.destroy', $roles) ? '' : 'Disabled' ?>><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-5">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
