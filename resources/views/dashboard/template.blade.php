<?php
$level = new App\Models\Level();

$bagian = $level::where('id', auth()->user()->level_id)->first();
$roles = explode(',', $bagian['access']);

$lognotifikasi = new App\Models\Lognotifikasiexpired();
$lognotifikasiexpired = $lognotifikasi
    ::with('penerbitansertifikat')
    ->orderBy('id', 'DESC')
    ->get();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sakti Indonesia</title>
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="/assets/css/styles.css" rel="stylesheet" />
    <script data-search-pseudo-elements="" defer=""
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="/assets/backend/css/trix.css">
    <script type="text/javascript" src="/assets/backend/js/trix.js"></script>
    <style>
        a {
            text-decoration: none !important;
        }

        .watermarked {
            position: relative;
            overflow: hidden;
            text-align: center
        }

        .watermarked img {
            width: 100%;
        }

        .watermarked::before {
            position: absolute;
            top: -75%;
            left: -75%;

            display: block;
            width: 150%;
            height: 150%;

            transform: rotate(-45deg);
            content: attr(data-watermark);

            opacity: 0.3;
            line-height: 3em;
            letter-spacing: 2px;
            color: rgb(0, 104, 223);
        }
    </style>
</head>

<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white"
        id="sidenavAccordion">
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i
                data-feather="menu"></i></button>
        <a class="navbar-brand pe-3 ps-4 ps-lg-2 text-uppercase" href="/dashboard">SAKTI INDONESIA</a>
        {{-- <form class="form-inline me-auto d-none d-lg-block me-3">
            <div class="input-group input-group-joined input-group-solid">
                <input class="form-control pe-0" type="search" placeholder="Cari Barang" aria-label="Search" />
                <div class="input-group-text"><i data-feather="search"></i></div>
            </div>
        </form> --}}
        <ul class="navbar-nav align-items-center ms-auto">
            {{-- <li class="nav-item dropdown no-caret me-3 d-lg-none">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#"
                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        data-feather="search"></i></a>
                <div class="dropdown-menu dropdown-menu-end p-3 shadow animated--fade-in-up"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline me-auto w-100">
                        <div class="input-group input-group-joined input-group-solid">
                            <input class="form-control pe-0" type="text" placeholder="Cari Barang"
                                aria-label="Search" aria-describedby="basic-addon2" />
                            <div class="input-group-text"><i data-feather="search"></i></div>
                        </div>
                    </form>
                </div>
            </li> --}}
            <li class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications">
                <a href="/">Kembali ke Website</a>
            </li>
            <li class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts"
                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                    aria-labelledby="navbarDropdownAlerts">
                    <h6 class="dropdown-header dropdown-notifications-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-bell me-2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        Notifikasi
                    </h6>
                    @if (in_array('Log Notifikasi Expired.index', $roles))
                        <!-- Example Alert 1-->
                        @foreach ($lognotifikasiexpired as $itemtemplate)
                            <?php
                            $datenow = $itemtemplate->created_at ?? '';
                            $dateexpired = $itemtemplate->penerbitansertifikat->tgl_kadaluarsasertifikat ?? '';
                            $badge = strtotime($datenow) >= strtotime($dateexpired) ? 'badge bg-dark' : 'badge bg-warning';
                            
                            $listpermohonan_data = new App\Models\Listpermohonan();
                            $listpermohonan = $listpermohonan_data::where('id', $itemtemplate ? $itemtemplate->listpermohonan_id : '')->first();
                            ?>
                            <a class="dropdown-item dropdown-notifications-item" href="#!">
                                <div class="dropdown-notifications-item-icon bg-warning">
                                    <img class="img-fluid" style="width:40px; height:40px; border-radius:50%"
                                        src="{{ $itemtemplate->penerbitansertifikat->client->user->photo ? '/storage/' . $itemtemplate->penerbitansertifikat->client->user->photo : '/assets/img/profile.png' }}" />
                                </div>
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-details">
                                        <?php $data = date_create($itemtemplate->created_at ?? ''); ?>
                                        {{ $itemtemplate->penerbitansertifikat->client->user->name }},
                                        {{ date_format($data, 'F d Y') }}
                                    </div>
                                    <div class="dropdown-notifications-item-content-text">
                                        {{ $itemtemplate->keterangan }}
                                    </div>
                                    @if ($listpermohonan != '')
                                        @if ($listpermohonan->slug == 'sertifikasi_awal')
                                            <span class="{{ $badge }}">Sertifikasi Awal :
                                                {{ $listpermohonan->proses_sertifikasi }}</span>
                                        @elseif ($listpermohonan->slug == 'surveilance1')
                                            <span class="{{ $badge }}">Surveilance I</span>
                                        @elseif ($listpermohonan->slug == 'surveilance2')
                                            <span class="{{ $badge }}">Surveilance II</span>
                                        @elseif ($listpermohonan->slug == 'resertifikasi')
                                            <span class="{{ $badge }}">Re Sertifikasi</span>
                                        @endif
                                    @endif
                                </div>
                            </a>
                        @endforeach
                        <a class="dropdown-item dropdown-notifications-footer"
                            href="/dashboard/lognotifikasiexpireds">View
                            More</a>
                    @else
                        <!-- Example Alert 1-->
                        @foreach ($lognotifikasiexpired as $itemtemplate)
                            @if (auth()->user()->id == $itemtemplate->client->user->id)
                                <?php
                                $datenow = $itemtemplate->created_at ?? '';
                                $dateexpired = $itemtemplate->penerbitansertifikat->tgl_kadaluarsasertifikat ?? '';
                                $badge = strtotime($datenow) >= strtotime($dateexpired) ? 'badge bg-dark' : 'badge bg-warning';
                                
                                $listpermohonan_data = new App\Models\Listpermohonan();
                                $listpermohonan = $listpermohonan_data::where('id', $itemtemplate ? $itemtemplate->listpermohonan_id : '')->first();
                                ?>
                                <a class="dropdown-item dropdown-notifications-item" href="#!">
                                    <div class="dropdown-notifications-item-icon bg-warning">
                                        <img class="img-fluid" style="width:40px; height:40px; border-radius:50%"
                                            src="{{ $itemtemplate->penerbitansertifikat->client->user->photo ? '/storage/' . $itemtemplate->penerbitansertifikat->client->user->photo : '/assets/img/profile.png' }}" />
                                    </div>
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-details">
                                            <?php $data = date_create($itemtemplate->created_at ?? ''); ?>
                                            {{ $itemtemplate->penerbitansertifikat->client->user->name }},
                                            {{ date_format($data, 'F d Y') }}
                                        </div>
                                        <div class="dropdown-notifications-item-content-text">
                                            {{ $itemtemplate->keterangan }}
                                        </div>
                                        @if ($listpermohonan != '')
                                            @if ($listpermohonan->slug == 'sertifikasi_awal')
                                                <span class="{{ $badge }}">Sertifikasi Awal :
                                                    {{ $listpermohonan->proses_sertifikasi }}</span>
                                            @elseif ($listpermohonan->slug == 'surveilance1')
                                                <span class="{{ $badge }}">Surveilance I</span>
                                            @elseif ($listpermohonan->slug == 'surveilance2')
                                                <span class="{{ $badge }}">Surveilance II</span>
                                            @elseif ($listpermohonan->slug == 'resertifikasi')
                                                <span class="{{ $badge }}">Re Sertifikasi</span>
                                            @endif
                                        @endif
                                    </div>
                                </a>
                            @endif
                        @endforeach
                        <a class="dropdown-item dropdown-notifications-footer"
                            href="/dashboard/lognotifikasiexpireds">View
                            More</a>
                    @endif
                </div>
            </li>
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><img class="img-fluid"
                        src="{{ auth()->user()->photo ? '/storage/' . auth()->user()->photo : '/assets/img/profile.png' }}" /></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                    aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img"
                            src="{{ auth()->user()->photo ? '/storage/' . auth()->user()->photo : '/assets/img/profile.png' }}" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name mb-2">{{ auth()->user()->name }}</div>
                            <div class="dropdown-user-details-email">{{ '@' . auth()->user()->username }}</div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/dashboard/profile">
                        <div class="dropdown-item-icon"><i data-feather="user"></i></div>
                        Profil
                    </a>
                    <a class="dropdown-item" href="/auth/logout">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Keluar
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">
                        <div class="sidenav-menu-heading d-sm-none">Notifikasi</div>
                        <a class="nav-link d-sm-none" href="/dashboard/lognotifikasiexpireds">
                            <div class="nav-link-icon"><i data-feather="bell"></i></div>
                            Alerts
                        </a>

                        <div class="sidenav-menu-heading">Selamat Datang</div>
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Dashboard
                        </a>
                        @if (in_array('levels.index', $roles) ||
                            in_array('users.index', $roles) ||
                            in_array('banks.index', $roles) ||
                            in_array('registrationfees.index', $roles) ||
                            in_array('services.index', $roles))
                            <a class="{{ Request::is('dashboard/levels*') ||
                            Request::is('dashboard/users*') ||
                            Request::is('dashboard/banks*') ||
                            Request::is('dashboard/registrationfees*') ||
                            Request::is('dashboard/services*')
                                ? 'nav-link'
                                : 'nav-link collapsed' }}"
                                href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseApp"
                                aria-expanded="{{ Request::is('dashboard/levels*') ||
                                Request::is('dashboard/users*') ||
                                Request::is('dashboard/banks*') ||
                                Request::is('dashboard/registrationfees*') ||
                                Request::is('dashboard/services*')
                                    ? 'true'
                                    : 'false' }}"
                                aria-controls="collapseApps">
                                <div class="nav-link-icon"><i data-feather="database"></i></div>
                                Master Data
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="{{ Request::is('dashboard/levels*') ||
                            Request::is('dashboard/users*') ||
                            Request::is('dashboard/banks*') ||
                            Request::is('dashboard/registrationfees*') ||
                            Request::is('dashboard/services*')
                                ? 'collapse show'
                                : 'collapse' }}"
                                id="collapseApp" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                                    @if (in_array('levels.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/levels*') ? 'active' : '' }}'
                                            href='/dashboard/levels'>Level</a>
                                    @endif
                                    @if (in_array('users.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}'
                                            href='/dashboard/users'>User</a>
                                    @endif
                                    @if (in_array('banks.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/banks*') ? 'active' : '' }}'
                                            href='/dashboard/banks'>Bank</a>
                                    @endif
                                    @if (in_array('registrationfees.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/registrationfees*') ? 'active' : '' }}'
                                            href='/dashboard/registrationfees'>Fee</a>
                                    @endif
                                    @if (in_array('services.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/services*') ? 'active' : '' }}'
                                            href='/dashboard/services'>Layanan</a>
                                    @endif
                                </nav>
                            </div>
                        @endif
                        @if (in_array('sections.index', $roles) ||
                            in_array('menus.index', $roles) ||
                            in_array('dashboard/sliders', $roles))
                            <a class="{{ Request::is('dashboard/sections*') || Request::is('dashboard/menus*') || Request::is('dashboard/sliders*')
                                ? 'nav-link'
                                : 'nav-link collapsed' }}"
                                href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseApps"
                                aria-expanded="{{ Request::is('dashboard/sections*') || Request::is('dashboard/menus*') || Request::is('dashboard/sliders*')
                                    ? 'true'
                                    : 'false' }}"
                                aria-controls="collapseApps">
                                <div class="nav-link-icon"><i data-feather="layout"></i></div>
                                Layout
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="{{ Request::is('dashboard/sections*') || Request::is('dashboard/menus*') || Request::is('dashboard/sliders*')
                                ? 'collapse show'
                                : 'collapse' }}"
                                id="collapseApps" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                                    @if (in_array('sections.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/sections*') ? 'active' : '' }}'
                                            href='/dashboard/sections'>Section</a>
                                    @endif
                                    @if (in_array('menus.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/menus*') ? 'active' : '' }}'
                                            href='/dashboard/menus'>Menu</a>
                                    @endif
                                    @if (in_array('sliders.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/sliders*') ? 'active' : '' }}'
                                            href='/dashboard/sliders'>Slider
                                        </a>
                                    @endif
                                </nav>
                            </div>
                        @endif
                        <?php
                        if (in_array("settings.index", $roles)) { 
                            ?>
                        <a class='nav-link {{ Request::is('dashboard/settings*') ? 'active' : '' }}'
                            href='/dashboard/settings'>
                            <div class='nav-link-icon'><i data-feather='settings'></i></div>Pengaturan
                        </a>
                        <?php } else {
                            '';
                        }
                        ?>

                        <div class="sidenav-menu-heading">MENU UTAMA</div>

                        <a class='nav-link {{ Request::is('dashboard/clients*') ? 'active' : '' }}'
                            href='/dashboard/clients'>
                            <div class='nav-link-icon'><i data-feather='credit-card'></i></div>
                            @if (auth()->user()->level_id == 2)
                                Permohonan Anda
                            @else
                                Klien
                            @endif
                        </a>
                        @if (in_array('pages.index', $roles))
                            <a class='nav-link {{ Request::is('dashboard/pages*') ? 'active' : '' }}'
                                href='/dashboard/pages'>
                                <div class='nav-link-icon'><i data-feather='credit-card'></i></div>Halaman
                            </a>
                        @endif
                        @if (in_array('pembayaran.index', $roles))
                            <a class='nav-link {{ Request::is('dashboard/payments*') ? 'active' : '' }}'
                                href='/dashboard/payments'>
                                <div class='nav-link-icon'><i data-feather='credit-card'></i></div>Pembayaran
                            </a>
                        @endif
                    </div>
                </div>
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Masuk sebagai:</div>
                        <div class="sidenav-footer-title">{{ auth()->user()->name }}</div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                    <div class="container-xl px-4">
                        <div class="page-header-content pt-4">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mt-4">
                                    <h1 class="page-header-title text-uppercase"
                                        style="font-size: 26px; font-weight: bold;">
                                        SAKTI INDONESIA
                                    </h1>
                                    <div class="page-header-subtitle text-uppercase" style="font-size: 12px">
                                        <p>Jl. Rungkut Industri Raya No.10, Rungkut Tengah, Kota SBY, Jawa Timur 60293
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                @yield('content')
            </main>
            <footer class="footer-admin mt-auto footer-light">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small text-uppercase text-muted">&copy; {{ date('Y') }} - SAKTI
                            INDONESIA</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
    <script src="/assets/js/litepicker.js"></script>
    <script src="/assets/backend/ckeditor5/build/ckeditor.js"></script>
    <script src="https://unpkg.com/cart-localstorage@1.1.4/dist/cart-localstorage.min.js" type="text/javascript"></script>

    @yield('script')

    <script>
        document.querySelectorAll('.watermarked').forEach(function(el) {
            el.dataset.watermark = (el.dataset.watermark + ' ').repeat(1000);
        });

        // Modal Menu
        $(".addMenu").on("click", function() {
            $("#menuModalLabel").html("Menu Baru");
            $("input[name=_method]").val("POST");
            $(".modal form").prop("action", "/dashboard/menus");
            $(".modal-footer button[type=submit]").html("Simpan");
            $("#id").val("");
            $("#name").val("");
            $("#link").val("");
            $('#child option[value=""]').prop("selected", true);
            $("#sort").val("");
        });

        $(document).on("click", ".editMenu", function() {
            const id = $(this).data("id");
            $("input[name=_method]").val("PUT");
            $("#menuModalLabel").html("Perbarui Menu");
            $(".modal form").prop("action", "/dashboard/menus/" + id);
            $(".modal-footer button[type=submit]").html("Perbarui");
            $.ajax({
                url: "/dashboard/menus/" + id,
                method: "get",
                dataType: "json",
                success: function(response) {
                    const child = response.child ? response.child : "";
                    $("#id").val(response.id);
                    $("#name").val(response.name);
                    $("#link").val(response.link);
                    $('#child option[value="' + child + '"]').prop("selected", true);
                    $("#sort").val(response.sort);
                },
            });
        });
        // End Modal Menu

        // Modal Section
        $(document).on('click', '.editSection', function() {
            const id = $(this).data('id');
            $('input[name=_method]').val('PUT');
            $('#sectionModalLabel').html('Perbarui Section');
            $('.modal form').prop('action', '/dashboard/sections/' + id);
            $('.modal-footer button[type=submit]').html('Perbarui');
            $.ajax({
                url: '/dashboard/sections/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    const status = response.status ? response.status : '0';
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#status option[value="' + status + '"]').prop('selected', 'selected');
                }
            });
        });
        // End Modal Section

        $(document).ready(function() {
            $('#customTable').DataTable({
                "lengthChange": false,
                "paging": false,
                "bInfo": false
            });
            $('#tableStandar').DataTable();

            formatStrNum('fee');

            $('#username').on('keyup', function() {
                const username = $(this).val().toLowerCase().replace(/\W/g, '');
                $('#username').val(username);
            });

            const name = document.querySelector('#name');
            if (name) {
                name.addEventListener('change', function() {
                    fetch('/create/users/username?name=' + name.value)
                        .then(response => response.json())
                        .then(data => username.value = data.username)
                });
            }

        });

        function previewImage(fieldId, previewClass) {
            const image = document.querySelector('#' +
                fieldId);
            const imgPreview = document.querySelector('.' + previewClass);

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(img) {
                imgPreview.src = img.target.result;
            }
        }

        $('.addBank').on('click', function() {
            $('#bankModalLabel').html('Bank Baru');
            $('input[name=_method]').val('POST');
            $('.modal form').prop('action', '/dashboard/banks');
            $('.modal-footer button[type=submit]').html('Simpan');
            $('#id').val('');
            $('#name').val('');
            $('#number').val('');
            $('#bank_name').val('');
        });

        $('.editBank').on('click ', function() {
            const id = $(this).data('id');
            $('input[name=_method]').val('PUT');
            $('#bankModalLabel').html('Perbarui Bank');
            $('.modal form').prop('action', '/dashboard/banks/' + id);
            $('.modal-footer button[type=submit]').html('Perbarui');
            $.ajax({
                url: '/dashboard/banks/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#bank_name').val(response.bank_name);
                    $('#number').val(response.number);
                }
            });
        });

        $('.addFee').on('click', function() {
            $('#feeModalLabel').html('Fee Baru');
            $('input[name=_method]').val('POST');
            $('.modal form').prop('action', '/dashboard/registrationfees');
            $('.modal-footer button[type=submit]').html('Simpan');
            $('#id').val('');
            $('#name').val('');
            $('#fee').val('');
        });

        $('.editFee').on('click ', function() {
            const id = $(this).data('id');
            $('input[name=_method]').val('PUT');
            $('#feeModalLabel').html('Perbarui Fee');
            $('.modal form').prop('action', '/dashboard/registrationfees/' + id);
            $('.modal-footer button[type=submit]').html('Perbarui');
            $.ajax({
                url: '/dashboard/registrationfees/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    const fee = numFormat(response.fee);
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#fee').val(fee);
                }
            });
        });

        $('.addLevel').on('click', function() {
            $('#levelModalLabel').html('Level Baru');
            $('input[name=_method]').val('POST');
            $('.modal form').prop('action', '/dashboard/levels');
            $('.modal-footer button[type=submit]').html('Simpan');
            $('#id').val('');
            $('#name').val('');
        });

        $('.confirm').on('click ', function() {
            const id = $(this).data('id');
            $('#confirmationModalLabel').html('Perbarui Status');
            $('.modal form').prop('action', '/dashboard/payments/confirmation/' + id);
            $.ajax({
                url: '/dashboard/payments/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    const status = response.status ? response.status : "";
                    $('#number').val(response.number);
                    $('#name').val(response.user.name);
                    if (status) {
                        $('#status option[value=' + status + ']').prop('selected', true);
                    }
                }
            });
        });

        $('.addService').on('click', function() {
            $('#serviceModalLabel').html('Layanan Baru');
            $('input[name=_method]').val('POST');
            $('.modal form').prop('action', '/dashboard/services');
            $('.modal-footer button[type=submit]').html('Simpan');
            $('#id').val('');
            $('#name').val('');
            $('#service_code').val('');
        });

        $('.editService').on('click ', function() {
            const id = $(this).data('id');
            $('input[name=_method]').val('PUT');
            $('#serviceModalLabel').html('Perbarui Layanan');
            $('.modal form').prop('action', '/dashboard/services/' + id);
            $('.modal-footer button[type=submit]').html('Perbarui');
            $.ajax({
                url: '/dashboard/services/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#iso_code').val(response.iso_code);
                    $('#service_code').val(response.service_code);
                }
            });
        });

        function formatStrNum(inputId) {
            return $('#' + inputId).val() ? $('#' + inputId).val(numFormat($('#' + inputId).val().replace('.', ','))) :
                '';
        }

        function strToNum(inputId) {
            const result = numFormat($('#' + inputId).val());
            return $('#' + inputId).val(result);
        }

        function numFormat(bilangan, prefix) {
            var number_string = bilangan.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function addOption(inputId, val, text) {
            $('#' + inputId).append($('<option>').val(val).text(text));
        }
    </script>
    <script>
        var msg = '{{ Session::get('alert') }}';
        var exist = '{{ Session::has('alert') }}';
        if (exist) {
            alert(msg);
        }
    </script>

</body>

</html>
