@extends('frontend.template')
@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center"></div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol class="text-muted">
                    <li><a href="/">Beranda</a></li>
                    <li>{{ $page->title }}</li>
                </ol>
            </div>
        </nav>
    </div>
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row g-5">
                <div class="col-lg-12">
                    <article class="blog-details">
                        @if ($page->image)
                            <div class="post-ismg">
                                <img src="/storage/{{ $page->image }}" alt="{{ $page->title }}" class="img-fluid rounded">
                            </div>
                        @endif
                        <h2 class="title">{{ $page->title }}</h2>
                        <div class="meta-top">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                                    <a href="/posts?author={{ $page->user->username }}">{{ $page->user->name }}</a>
                                </li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                                    <time
                                        datetime="{{ date('Y-m-d', strtotime($page->created_at)) }}">{{ date('d/m/Y', strtotime($page->created_at)) }}</time></a>
                                </li>
                            </ul>
                        </div>
                        <div class="content">
                            {!! Str::replace('<img src="', '<img class="img-fluid" src="', $page->body) !!}
                        </div>

                        <div class="my-3 d-inline-block">
                            <p class="small mb-1">Bagikan ke:</p>
                            <div class="addthis_inline_share_toolbox"></div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
