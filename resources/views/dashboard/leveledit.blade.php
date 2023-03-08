@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        <a href="/dashboard/levels" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                        {{ $title_bar }}
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/dashboard/levels/{{ $level->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Level</label>
                                <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name"
                                    type="text" id="name" value="{{ old('name', $level->name) }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row mt-4 mb-3">
                                @foreach ($roles as $role)
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="checkbox" class="text-capitalize">{{ $role[0]['group'] }}</label>
                                            @foreach ($role as $row)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $row['route'] }}" id="{{ $row['route'] }}" name="roles[]"
                                                        {{ in_array($row['route'], $access) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="{{ $row['route'] }}">
                                                        {{ $row['name'] }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
