@extends('frontend.template')
@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-6 text-center">
                        <h2>{{ $title_bar }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol class="text-muted">
                    <li><a href="/">Beranda</a></li>
                    <li>{{ $title_bar }}</li>
                </ol>
            </div>
        </nav>
    </div>

    <?php $setting = \App\Models\Setting::where('id', 1)->first(); ?>
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="row gx-lg-0 gy-4">
                <div class="col-lg-4">
                    <div class="info-container d-flex flex-column align-items-center justify-content-center">
                        <div class="info-item">
                            @if ($setting->main_logo)
                                <center>
                                    <img src="/storage/{{ $setting->sec_logo }}" alt="{{ $setting->name }}"
                                        width="250" />
                                </center>
                            @else
                                {{ $setting->name }}
                            @endif
                        </div>
                        <div class="info-item d-flex"> <i class="bi bi-geo-alt flex-shrink-0" style="background-color: #5558f7"></i>
                            <div>
                                <h4 style="color: black">Alamat:</h4>
                                <p style="color: black">{{ $setting->address }}</p>
                            </div>
                        </div>
                        <div class="info-item d-flex"> <i class="bi bi-envelope flex-shrink-0" style="background-color: #5558f7"></i>
                            <div>
                                <h4 style="color: black">Email:</h4>
                                <p style="color: black">{{ $setting->email }}</p>
                            </div>
                        </div>
                        <div class="info-item d-flex"> <i class="bi bi-phone flex-shrink-0" style="background-color: #5558f7"></i>
                            <div>
                                <h4 style="color: black">Telp:</h4>
                                <p style="color: black">{{ $setting->telp }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <form action="/contact/sendmessage" method="post" role="form" class="php-email-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="Nama" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" placeholder="Email" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject"
                                id="subject" placeholder="Subject" required>
                            @error('subject')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="7" placeholder="Pesan"
                                required></textarea>
                            @error('message')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {!! session('msg') !!}
                        <div class="text-center mt-4"><button type="submit">Kirim</button></div>
                    </form>
                </div>
            </div>
            <div id="atf-map-area" class="mt-4">
                {!! $setting->map !!}
            </div>
        </div>
    </section>
@endsection
