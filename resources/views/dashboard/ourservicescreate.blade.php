@extends('dashboard.template')
@section('content')
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        <a href="/dashboard/ourservices" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                        {{ $title_bar }}
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/dashboard/ourservices" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Judul</label>
                                <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name"
                                    type="text" id="name" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <img src="/assets/img/noimage.jpeg" class="img-thumbnail imagePreview" width="100px">
                                </div>
                                <div class="col-md-10 mb-3">
                                    <div class="form-group">
                                        <label for="image">Gambar</label>
                                        <div class="input-group">
                                            <input type="file" name="image" id="image"
                                                class="form-control @error('image') is-invalid @enderror"
                                                onchange="previewImage('image', 'imagePreview')">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Deskripsi</label>
                                <input type="hidden" name="description" id="description" value="{{ old('description') }}">
                                <trix-editor input="description"></trix-editor>
                                @error('description')
                                    <div class="text-danger small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="link">URL / Link</label>
                                <input class="form-control mt-1 @error('link') is-invalid @enderror" name="link"
                                    type="text" id="link" value="{{ old('link') }}" />
                                @error('link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
