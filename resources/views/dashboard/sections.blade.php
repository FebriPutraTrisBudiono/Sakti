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
                    <table id="tableStandar" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>SECTION</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="editSection" data-id="{{ $row->id }}"
                                            data-bs-toggle="modal" data-bs-target="#sectionModal"
                                            <?= in_array('sections.show', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>{{ $row->name }}</a>
                                    </td>
                                    <td>{{ $row->status ? 'Aktif' : 'Nonaktif' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sectionModal" tabindex="-1" aria-labelledby="sectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sectionModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Section</label>
                            <input type="text" name="name" id="name"
                                class="form-control mt-1 @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status"
                                class="form-control mt-1 @error('status') is-invalid @enderror">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
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
                        <button type="submit" class="btn btn-primary"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
