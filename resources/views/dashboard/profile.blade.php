@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        {{ $title_bar }}
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/dashboard/profile/{{ $user->username }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name"
                                            type="text" id="name" value="{{ old('name', $user->name) }}" />
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input class="form-control mt-1 @error('username') is-invalid @enderror"
                                            name="username" type="text" id="username"
                                            value="{{ old('username', $user->username) }}" />
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control mt-1 @error('email') is-invalid @enderror" name="email"
                                            type="email" id="email" value="{{ old('email', $user->email) }}" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="telp">Telp</label>
                                        <input type="number" name="telp" id="telp"
                                            class="form-control mt-1 @error('telp') is-invalid @enderror"
                                            value="{{ old('telp', $user->telp) }}">
                                        @error('telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="address">Alamat</label>
                                <textarea name="address" id="address" rows="5"class="form-control mt-1 @error('address') is-invalid @enderror">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <img src="{{ $user->photo ? '/storage/' . $user->photo : '/assets/img/noimage.jpeg' }}"
                                        class="img-thumbnail imagePreview" width="100px">
                                </div>
                                <div class="col-md-10 mb-3">
                                    <div class="form-group">
                                        <label for="photo">Photo Profil</label>
                                        <div class="input-group">
                                            <input type="file" name="photo" id="photo"
                                                class="form-control @error('photo') is-invalid @enderror"
                                                onchange="previewImage('photo', 'imagePreview')">
                                            @error('photo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password <small>(Biarkan kosong jika tidak ingin
                                        mengganti)</small></label>
                                <input class="form-control mt-1 @error('password') is-invalid @enderror" name="password"
                                    type="password" id="password" />
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-1 mb-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
