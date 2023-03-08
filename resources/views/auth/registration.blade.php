@extends('auth.template')
@section('content')
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <a href="/" class="logo d-flex align-items-center">
                    @if ($setting->main_logo)
                        <center>
                            <a href="/">
                                <img width="250" style="margin-top: 10px" src="/storage/{{ $setting->main_logo }}"
                                    alt="{{ $setting->name }}" />
                            </a>
                        </center>
                    @else
                        {{ $setting->name }}
                    @endif
                </a>
                <div class="card shadow-lg border-0 rounded-lg mt-3">
                    <div class="card-header justify-content-center">
                        <h3 class="fw-light my-0">{{ $title_bar }}</h3>
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/auth/registration" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="small mb-1" for="name">Nama</label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="name" type="text" placeholder="Nama" value="{{ old('name') }}"
                                    autofocus />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="username">Username</label>
                                <input class="form-control @error('username') is-invalid @enderror" id="username"
                                    name="username" type="text" placeholder="Username" value="{{ old('username') }}" />
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" name="email"
                                    id="email" type="text" placeholder="Email" value="{{ old('email') }}" />
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="telp">Telp / HP</label>
                                <input class="form-control @error('telp') is-invalid @enderror" name="telp"
                                    id="telp" type="number" placeholder="Telp / HP" value="{{ old('telp') }}" />
                                @error('telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="small mb-1" for="password">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" name="password"
                                    id="password" type="password" placeholder="Password" value="{{ old('password') }}" />
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="small mb-1" for="password">Layanan</label>
                                <select name="service_id" id="service_id"
                                    class="form-control mt-1 @error('service_id') is-invalid @enderror">
                                    <option value="">:: Pilih ::</option>
                                    @foreach ($services as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('service_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3" style="display:flex; justify-content: center;">
                                <div class="g-recaptcha  @error('g-recaptcha-response') is-invalid @enderror"
                                    data-sitekey="{{ env('RECAPTCHAV2_SITEKEY') }}"></div>
                                @error('g-recaptcha-response')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="/auth">Login</a>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small text-muted text-uppercase">
                            &copy; {{ date('Y') }} - SAKTI INDONESIA
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
