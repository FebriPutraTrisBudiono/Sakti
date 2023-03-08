@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="/dashboard/sliders/create" class="ms-2">
                        <?= in_array('sliders.create', $roles) ? "<i class='fas fa-plus-circle fa-lg'></i>" : '' ?>
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
                                <th>SLIDER</th>
                                <th>DEKSTOP</th>
                                <th>MOBILE</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="/dashboard/sliders/{{ $row->id }}/edit"
                                            <?= in_array('sliders.edit', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>{{ $row->name }}</a>
                                    </td>
                                    <td>
                                        <img src="{{ $row->desktop ? '/storage/' . $row->desktop : '/assets/img/noimage.jpeg' }}"
                                            class="img-thumbnail" width="100px">
                                    </td>
                                    <td>
                                        <img src="{{ $row->mobile ? '/storage/' . $row->mobile : '/assets/img/noimage.jpeg' }}"
                                            class="img-thumbnail" width="100px">
                                    </td>
                                    <td>
                                        <form action="/dashboard/sliders/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                <?= in_array('sliders.destroy', $roles) ? '' : 'Disabled' ?>><i
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
@endsection
