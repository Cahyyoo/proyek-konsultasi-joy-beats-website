<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Joy & Bites | Admin Panel</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #0d6efd;
            --primary-dark: #0a58ca;
            --bg-soft: #f4f7fb;
            --text-dark: #1f2937;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-soft);
            color: var(--text-dark);
        }

        /* ================= NAVBAR ================= */
        .topbar {
            height: 64px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 4px 20px rgba(0,0,0,.08);
        }

        .topbar .brand {
            font-weight: 700;
            font-size: 20px;
            letter-spacing: .5px;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 250px;
            background: #fff;
            border-right: 1px solid #e5e7eb;
        }

        .sidebar .menu-title {
            font-size: 11px;
            font-weight: 600;
            color: #9ca3af;
            padding: 16px 20px 6px;
            text-transform: uppercase;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 4px 12px;
            padding: 12px 14px;
            border-radius: 10px;
            font-weight: 500;
            color: #374151;
            transition: all .25s ease;
        }

        .sidebar .nav-link i {
            font-size: 16px;
            color: var(--primary);
        }

        .sidebar .nav-link:hover {
            background: #eef2ff;
            transform: translateX(3px);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            box-shadow: 0 6px 16px rgba(13,110,253,.35);
        }

        .sidebar .nav-link.active i {
            color: #fff;
        }

        /* ================= CONTENT ================= */
        main {
            padding: 28px;
            min-height: calc(100vh - 64px);
        }

        .page-title {
            font-weight: 700;
            margin-bottom: 20px;
        }

        .content-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 25px rgba(0,0,0,.05);
        }

        /* ================= FOOTER ================= */
        footer {
            background: #fff;
            border-top: 1px solid #e5e7eb;
            font-size: 13px;
        }
    </style>
</head>

<body>

{{-- TOPBAR --}}
<nav class="navbar topbar px-4 d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-sm btn-light">
            <i class="fas fa-bars"></i>
        </button>
        <span class="text-white brand">Joy & Bites</span>
    </div>

    <div class="dropdown">
        <a class="text-white dropdown-toggle text-decoration-none"
           href="#" data-bs-toggle="dropdown">
            <i class="fas fa-user-circle fa-lg"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow">
            <li>
                <form action="/logout" method="POST">
                    @csrf
                    <button class="dropdown-item text-danger"
                        onclick="return confirm('Yakin logout?')">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<div class="d-flex">

    {{-- SIDEBAR --}}
    <aside class="sidebar vh-100">
        <div class="menu-title">Main Menu</div>

        <a href="/dashboard"
           class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            Dashboard
        </a>

        @if(Auth::user()->role === 'kasir')

        <a href="/kasir/data-pemesanan-makanan-minuman"
           class="nav-link {{ Request::is('kasir/data-pemesanan-makanan-minuman*') ? 'active' : '' }}">
            <i class="fas fa-receipt"></i>
            Pemesanan
        </a>

        @endif

        @if(Auth::user()->role === 'admin')

        <a href="/admin/data-permainan"
           class="nav-link {{ Request::is('admin/data-permainan*') ? 'active' : '' }}">
            <i class="fas fa-gamepad"></i>
            Permainan
        </a>

        <a href="/admin/data-barcode"
           class="nav-link {{ Request::is('admin/data-barcode*') ? 'active' : '' }}">
            <i class="fas fa-barcode"></i>
            Barcode
        </a>

        <a href="/admin/data-makanan"
           class="nav-link {{ Request::is('admin/data-makanan*') ? 'active' : '' }}">
            <i class="fas fa-utensils"></i>
            Makanan
        </a>

        <a href="/admin/data-minuman"
           class="nav-link {{ Request::is('admin/data-minuman*') ? 'active' : '' }}">
            <i class="fas fa-mug-hot"></i>
            Minuman
        </a>

        @endif
    </aside>

    {{-- CONTENT --}}
    <main class="flex-fill">
        <h4 class="page-title">@yield('header')</h4>

        <div class="content-card">
            @yield('content')
        </div>
    </main>

</div>

<footer class="py-3 px-4 d-flex justify-content-between">
    <span>© {{ date('Y') }} Joy & Bites</span>
    @if (Auth::user()->role == "admin")
        <span class="text-muted">Admin Panel</span>
    @else
        <span class="text-muted">Kasir Panel</span>
    @endif
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
