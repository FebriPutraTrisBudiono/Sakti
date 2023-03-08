<?php
$setting = \App\Models\Setting::where('id', 1)->first();
$menus = \App\Models\Menu::where('child', null)
    ->orderBy('sort', 'ASC')
    ->get();
$footerMenus = App\Models\Menu::where('child', null)
    ->where('link', '!=', '#')
    ->orderBy('sort', 'ASC')
    ->get();
$sectionLink = App\Models\Section::getSection('links');
$sectionMap = \App\Models\Section::getSection('maps');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title_bar }}</title>
    <link href="/storage/{{ $setting->favicon }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link href="/assets/frontend/css/owl.carousel.css" rel="stylesheet">
    <link href="/assets/frontend/css/owl.theme.css" rel="stylesheet">
    <link href="/assets/frontend/css/owl.transitions.css" rel="stylesheet">
    <link href="/assets/frontend/css/main.css" rel="stylesheet">
    <link href="/assets/frontend/css/styles.css" rel="stylesheet" />
</head>

<body>
    <div class="colorprimary">
        <header id="header" class="header d-flex align-items-center bg-transparent">
            <div class="container-fluid container-xl d-flex align-items-center justify-content-between"> <a
                    href="/" class="logo d-flex align-items-center">
                    @if ($setting->main_logo)
                        <img width="150" src="/storage/{{ $setting->main_logo }}" alt="{{ $setting->name }}">
                    @else
                        <h1>{{ $setting->name }}</h1>
                    @endif
                </a>
                <nav id="navbar" class="navbar">
                    <ul>
                        @foreach ($menus as $index => $row)
                            <?php $checkSubmenu = \App\Models\Menu::where('child', $row->id)->count(); ?>
                            @if ($checkSubmenu > 0)
                                <?php $submenu = \App\Models\Menu::where('child', $row->id)
                                    ->orderBy('sort', 'ASC')
                                    ->get(); ?>
                                <li class="dropdown"><a href="javascript:void(0)">{{ $row->name }} &nbsp;<i
                                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                                    <ul>
                                        @foreach ($submenu as $sub)
                                            <li><a href="{{ $sub->link }}">{{ $sub->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ $row->link }}">{{ $row->name }}</a></li>
                            @endif
                        @endforeach
                        @if (auth()->user())
                            <li>
                                <a href="/auth" style="color: white">
                                    <button class="btn btn-secondary">
                                        {{ auth()->user()->username }}
                                    </button>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="/auth" style="color: white">
                                    <button class="btn btn-primary">
                                        Login
                                    </button>
                                </a>

                            </li>
                        @endif
                    </ul>
                </nav> <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i> <i
                    class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            </div>
        </header>
    </div>
    <main id="main">
        @yield('content')
    </main>
    <footer id="footer" class="footer">
        {{-- <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 col-md-12 footer-info">
                    <a href="/" class="logo d-flex align-items-center">
                        @if ($setting->main_logo)
                            <a href="/">
                                <img width="250" src="/storage/{{ $setting->sec_logo }}"
                                    alt="{{ $setting->name }}" />
                            </a>
                        @else
                            {{ $setting->name }}
                        @endif
                    </a>
                    <p class="mt-4">{{ $setting->description }}</p>
                    <p class="mb-1"><strong>Alamat:</strong> {{ $setting->address }}</p>
                    <p class="mb-1"><strong>Telp:</strong> {{ $setting->telp }}</p>
                    <p><strong>Email:</strong> {{ $setting->email }}</p>
                    <div class="social-links d-flex mt-4">
                        @if ($setting->whatsapp)
                            <a href="{{ $setting->whatsapp ? 'https://wa.me/' . $setting->whatsapp : '#' }}"
                                class="icon" target="_blank" style="background-color: #5558f7"><i class="fab fa-whatsapp"></i></a>
                        @endif
                        @if ($setting->telegram)
                            <a href="{{ $setting->telegram ? $setting->telegram : '#' }}" class="icon"
                                target="_blank" style="background-color: #5558f7"><i class="fab fa-telegram"></i></a>
                        @endif
                        @if ($setting->facebook)
                            <a href="{{ $setting->facebook ? $setting->facebook : '#' }}" class="icon"
                                target="_blank" style="background-color: #5558f7"><i class="fab fa-facebook"></i></a>
                        @endif
                        @if ($setting->instagram)
                            <a href="{{ $setting->instagram ? $setting->instagram : '#' }}" class="icon"
                                target="_blank" style="background-color: #5558f7"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if ($setting->twitter)
                            <a href="{{ $setting->twitter ? $setting->twitter : '#' }}" class="icon"
                                target="_blank" style="background-color: #5558f7"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if ($setting->youtube)
                            <a href="{{ $setting->youtube ? $setting->youtube : '#' }}" class="icon"
                                target="_blank" style="background-color: #5558f7"><i class="fab fa-youtube"></i></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-6 footer-links">
                    <h4>Menu Utama</h4>
                    <ul>
                        @foreach ($footerMenus as $row)
                            <li><a href="{{ $row->link }}" style="color: black;">{{ $row->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @if ($sectionMap)
                    <div class="col-lg-3 col-6 footer-links">
                        <h4>{{ $sectionMap->name }}</h4>
                        <div id="map" style="width: 100%; height: 300px;"></div>
                    </div>
                @endif
            </div>
        </div> --}}
        <div class="container mt-4">
            <div class="copyright text-uppercase"> &copy; {{ date('Y') }}
                <strong><span>{{ $setting->name }}</span></strong>
            </div>
        </div>
    </footer> <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs@1.4.0/js/purecounter_vanilla.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.1.3/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/frontend/js/owl.carousel.min.js"></script>
    <script src="/assets/frontend/js/detect-browser.js"></script>
    <script src="/assets/frontend/js/main.js"></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-621c8314ac1c5ed7"></script>

    @yield('script')
</body>

</html>
