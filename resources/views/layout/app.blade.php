<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sirena</title>
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <style>

            * {
                font-family: "Open Sans", serif;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary d-flex justify-content-between align-items-center" style="padding:0 5vw">
            <!-- Navbar Brand-->
            <div class="">
                <a class="navbar ps-3 pe-3 text-decoration-none d-flex justify-content-between" href="/">
                    <div class="text-light" style="font-size: 20px;">Joy & Beats</div>
                    <button class="btn btn-link btn-sm order-1 order-lg-0 me-0 me-lg-0 d-inline-block" id="sidebarToggle" href="#!" ><i class="fas fa-bars"></i></button>
                </a>
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown d-flex align-items-center">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit" onclick="return(confirm('Apakah anda yakin untuk logout?'))">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion" style="border-right: 1px solid #99999950">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            @if(Auth::user()->role == 'admin')
                            <a class="nav-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}" href="/admin/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link {{ Request::is('admin/data-pemesanan-makanan-minuman*') ? 'active' : '' }}" href="/admin/data-pemesanan-makanan-minuman">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-user"></i></div>
                                Data Pemesanan Makanan & Minuman
                            </a>
                            <a class="nav-link {{ Request::is('admin/data-permainan*') ? 'active' : '' }}" href="/admin/data-permainan">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-user"></i></div>
                                Data Permainan
                            </a>
                            <a class="nav-link {{ Request::is('admin/data-barcode*') ? 'active' : '' }}" href="/admin/data-barcode">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-user"></i></div>
                                Data Barcode
                            </a>
                            <a class="nav-link {{ Request::is('admin/data-makanan*') ? 'active' : '' }}" href="/admin/data-makanan">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-user"></i></div>
                                Data Makanan
                            </a>
                            <a class="nav-link {{ Request::is('admin/data-minuman*') ? 'active' : '' }}" href="/admin/data-minuman">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-user"></i></div>
                                Data Minuman
                            </a>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="mx-5 my-4">
                        <h2>@yield('header')</h2>
                        @yield('content')
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Sirena 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script>
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
    </body>
</html>
