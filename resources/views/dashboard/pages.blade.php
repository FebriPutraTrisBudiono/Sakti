@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="/dashboard/pages/create" class="ms-2"><i class="fas fa-plus-circle fa-lg"></i></a>
                </span>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="table-responsive">
                    <table id="customTable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>JUDUL</th>
                                <th>SLUG</th>
                                <th>PENULIS</th>
                                <th>VIEW</th>
                                <th>LIHAT</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if (auth()->user()->id !== $row->user_id && auth()->user()->level_id !== 1)
                                            {{ $row->title }}
                                        @else
                                            <a href="/dashboard/pages/{{ $row->id }}/edit">{{ $row->title }}</a>
                                        @endif
                                    </td>
                                    <td>{{ $row->slug }}</td>
                                    <td>{{ $row->user_id ? $row->user->name : '-' }}</td>
                                    <td>{{ $row->views ? number_format($row->views, 0, ',', '.') : 0 }}</td>
                                    <td><a href="/pages/{{ $row->slug }}" target="_blank"><i
                                                class="fas fa-external-link"></i></a></td>
                                    <td>
                                        <form action="/dashboard/pages/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                {{ auth()->user()->id !== $row->user_id && auth()->user()->level_id !== 1 ? 'disabled' : '' }}
                                                type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mb-5">
                    {{ $pages->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
