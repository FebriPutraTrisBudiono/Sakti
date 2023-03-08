@extends('frontend.template')
@section('content')
    <?php $sectionSlider = \App\Models\Section::getSection('sliders'); ?>
    @if ($sectionSlider)
        <?php $sliders = \App\Models\Slider::orderBy('id', 'DESC')->get(); ?>
        <div class="slider" style="margin-top: -1px;">
            <div id="slide-home" class="owl-carousel owl-theme mobil-hidden" data-aos="fade-in">
                @foreach ($sliders as $row)
                    <div class="item">
                        <img src="/storage/{{ $row->desktop }}" alt="{{ $row->name }}">
                    </div>
                @endforeach
            </div>
            <div id="slide-home1" class="owl-carousel owl-theme only-mobile" data-aos="fade-in">
                @foreach ($sliders as $row)
                    <div class="item">
                        <img src="/storage/{{ $row->mobile }}" alt="{{ $row->name }}">
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <?php $sectionAbout = \App\Models\Section::getSection('about'); ?>
    @if ($sectionAbout)
        <?php $about = \App\Models\About::where('id', 1)->first(); ?>
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>{{ $sectionAbout->name }}</h2>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-3">
                        <img class="img-fluid rounded-4 mb-4" src="/storage/{{ $about->image }}" alt="{{ $about->name }}">
                    </div>
                    <div class="col-lg-9">
                        <div class="content ps-0 ps-lg-5">
                            <div class="mb-3">{!! $about->description !!}</div>
                            <a class="readmore stretched-link" href="{{ $about->link }}">Selengkapnya <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <?php $sectionService = \App\Models\Section::getSection('services'); ?>
    @if ($sectionService)
        <?php $sevices = \App\Models\Ourservice::orderBy('id', 'DESC')->get(); ?>
        <section id="services" class="services sections-bg">
            <div class="container pt-4" data-aos="fade-up">
                <div class="section-header">
                    <h2>{{ $sectionService->name }}</h2>
                </div>
                <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
                    @foreach ($sevices as $row)
                        <div class="col-lg-3 col-md-6">
                            <div class="service-item position-relative justify-content-center text-center">
                                <img class="img-fluid rounded" src="/storage/{{ $row->image }}"
                                    alt="{{ $row->name }}">
                                <p class="text-uppercase"><strong>{{ $row->name }}</strong></p>
                                <a href="{{ $row->link }}" class="stretched-link"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <?php $sectionKelurahan = \App\Models\Section::getSection('kelurahan'); ?>
    @if ($sectionKelurahan)
        <style>
            #map {
                min-width: 200px;
                width: 100%;
                min-height: 200px;
                height: 500px;
            }

            .mapboxgl-popup-close-button {
                display: none;
            }

            .mapboxgl-popup-content {
                text-align: center;
            }
        </style>
        <section id="kelurahan">
            <div class="container pt-4" data-aos="zoom-out">
                <div class="section-header">
                    <h2>{{ $sectionKelurahan->name }}</h2>
                </div>
            </div>
            <div id="map"></div>
        </section>
    @endif

    <?php $sectionCta = \App\Models\Section::getSection('call-to-action'); ?>
    @if ($sectionCta)
        <?php $cta = \App\Models\CallToAction::where('id', 1)->first(); ?>
        <section id="call-to-action" class="call-to-action pt-0">
            <div class="text-center p-5 my-3" data-aos="zoom-out"
                style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/storage/{{ $cta->image }}') center center;">
                <h3>{{ $cta->name }}</h3>
                <div class="text-white">{!! $cta->description !!}</div>
                <a class="cta-btn mt-4" href="{{ $cta->link }}">{{ $sectionCta->name }}</a>
            </div>
        </section>
    @endif

    <?php $sectionLinks = \App\Models\Section::getSection('links'); ?>
    @if ($sectionLinks)
        <?php $links = \App\Models\Link::orderBy('id', 'ASC')->get(); ?>
        <section id="links" class="testimonials sections-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-header py-4">
                    <h2><?= $sectionLinks->name ?></h2>
                </div>
                <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        @foreach ($links as $row)
                            <div class="swiper-slide">
                                <div class="testimonial-wrap">
                                    <div class="testimonial-item">
                                        <a href="{{ $row->link }}" target="_blank">
                                            <img src="/storage/{{ $row->image }}" class="img-fluid"
                                                alt="{{ $row->name }}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endif

    <?php $sectionTesti = \App\Models\Section::getSection('testimonials'); ?>
    @if ($sectionTesti)
        <?php $testimonials = \App\Models\Testimonial::orderBy('id', 'ASC')->get(); ?>
        <section id="testimonials" class="testimonials">
            <div class="container" data-aos="fade-up">
                <div class="section-header py-4">
                    <h2><?= $sectionTesti->name ?></h2>
                </div>
                <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $row)
                            <div class="swiper-slide">
                                <div class="testimonial-wrap">
                                    <div class="testimonial-item">
                                        <div class="d-flex align-items-center"> <img src="/storage/{{ $row->image }}"
                                                alt="{{ $row->name }}" class="testimonial-img flex-shrink-0">
                                            <div>
                                                <h3>{{ $row->name }}</h3>
                                                <h4>{{ $row->title }}</h4>
                                                <div class="stars"> <i class="bi bi-star-fill"></i><i
                                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                                            </div>
                                        </div>
                                        <p> <i class="bi bi-quote quote-icon-left"></i> {{ $row->description }} <i
                                                class="bi bi-quote quote-icon-right"></i></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endif

    <?php $sectionPosts = \App\Models\Section::getSection('posts'); ?>
    @if ($sectionPosts)
        <?php $posts = \App\Models\Post::with(['category', 'user'])
            ->latest()
            ->where('status', 1)
            ->paginate(6); ?>
        <section id="recent-posts" class="recent-posts sections-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-header py-4">
                    <h2><?= $sectionPosts->name ?></h2>
                </div>
                <div class="row gy-4">
                    @foreach ($posts as $row)
                        <div class="col-xl-4 col-md-6">
                            <article>
                                <div class="post-img">
                                    <img src="/storage/{{ $row->image }}" alt="{{ $row->title }}"
                                        class="img-fluid">
                                </div>
                                <p class="post-category">
                                    <a href="/posts?category={{ $row->category->slug }}">{{ $row->category->name }}</a>
                                </p>
                                <h2 class="title">
                                    <a href="/posts/{{ $row->slug }}">{{ $row->title }}</a>
                                </h2>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $row->user->photo ? '/storage/' . $row->user->photo : '/assets/img/profile.png' }}"
                                        alt="{{ $row->user->name }}" class="img-fluid post-author-img flex-shrink-0">
                                    <div class="post-meta">
                                        <p class="post-author">
                                            <a href="/posts?author={{ $row->user->username }}">{{ $row->user->name }}</a>
                                        </p>
                                        <p class="post-date">
                                            <time
                                                datetime="{{ date('Y-m-d', strtotime($row->created_at)) }}">{{ date('d/m/Y', strtotime($row->created_at)) }}</time>
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <?php $sectionPPID = \App\Models\Section::getSection('ppid'); ?>
    @if ($sectionPPID)
        <?php $ppid = \App\Http\Helpers\ApiPPID::getNews(); ?>
        <section id="recent-posts" class="recent-posts sections-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-header py-4">
                    <h2><?= $sectionPPID->name ?></h2>
                </div>
                <div class="row gy-4">
                    @foreach (array_slice($ppid, 0, 6) as $row)
                        <div class="col-xl-4 col-md-6">
                            <article>
                                <div class="post-img">
                                    <img src="https://ppid.jemberkab.go.id/{{ str_replace('public/', 'storage/', $row['foto_berita']) }}"
                                        alt="{{ $row['judul_berita'] }}" class="img-fluid">
                                </div>
                                <h2 class="title">
                                    <a target="_blank"
                                        href="https://ppid.jemberkab.go.id/berita-ppid/detail/{{ $row['slug'] }}">{{ $row['judul_berita'] }}</a>
                                </h2>
                                <div class="d-flex align-items-center">
                                    <img src="/assets/img/profile.png" alt="{{ $row['diposting_oleh'] }}"
                                        class="img-fluid post-author-img flex-shrink-0">
                                    <div class="post-meta">
                                        <p class="post-author">
                                            {{ $row['diposting_oleh'] }}
                                        </p>
                                        <p class="post-date">
                                            <time
                                                datetime="{{ date('Y-m-d', strtotime($row['created_at'])) }}">{{ date('d/m/Y', strtotime($row['created_at'])) }}</time>
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
