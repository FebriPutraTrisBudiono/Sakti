@extends('auth.template')
@section('content')
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <a href="/" class="logo d-flex">
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
                        <div class="cotnainer">
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="fw-light my-0">{{ $title_bar }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/auth" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="small mb-1" for="username">Username / Kode Pengguna</label>
                                <input class="form-control @error('username') is-invalid @enderror" name="username"
                                    id="username1" type="text" placeholder="Username / Kode Pengguna"
                                    value="{{ old('username') }}" autofocus />
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="password">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" id="password"
                                    name="password" type="password" placeholder="Password" />
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                <a class="small" href="/auth/forgot">Lupa password?</a>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                                <a class="small" href="/auth/registration">Belum punya akun?</a>
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
