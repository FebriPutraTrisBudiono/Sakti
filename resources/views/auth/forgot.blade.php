@extends('auth.template')
@section('content')
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header justify-content-center">
                        <h3 class="fw-light my-0">{{ $title_bar }}</h3>
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/auth/forgot" method="post">
                            @csrf
                            <div class="mb-4">
                                <label class="small mb-1" for="username">Username</label>
                                <input class="form-control @error('username') is-invalid @enderror" name="username"
                                    id="username" type="text" placeholder="Username" value="{{ old('username') }}"
                                    autofocus />
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
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
                                <button type="submit" class="btn btn-primary">Reset</button>
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
