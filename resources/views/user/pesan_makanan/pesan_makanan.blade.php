<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pesan Menu - Joy & Bites</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('pesan_tempat/pesan.css') }}" />

    <style>
        .toast {
            position: fixed;
            top: 90px;
            right: 25px;
            background: #1abc9c;
            color: #fff;
            padding: 14px 20px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            animation: slideIn 0.5s ease, fadeOut 0.5s ease 3s forwards;
            z-index: 9999;
        }

        .toast i {
            font-size: 18px;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(40px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: translateX(40px);
            }
        }

        /* ===== BUTTON PESAN ===== */
        .info-text {
            background: linear-gradient(135deg, #ffcc00, #ff9800);
            color: #2c2c2c;
            border: none;
            padding: 8px 18px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(255, 152, 0, 0.35);
        }

        .info-text:hover {
            background: linear-gradient(135deg, #ffb300, #ff6f00);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(255, 152, 0, 0.45);
        }

        .info-text:active {
            transform: scale(0.95);
            box-shadow: 0 3px 8px rgba(255, 152, 0, 0.3);
        }

        /* Supaya form tidak merusak layout */
        .price-row form {
            display: inline;
        }

        .info-text i {
            margin-right: 6px;
            font-size: 13px;
        }

    </style>
</head>

<body>

    @if (session('success'))
    <div id="toast-success" class="toast">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif


<header class="main-header" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;">
    <div class="container">
        <nav>
            <div class="logo">
                <img src="{{ asset('pesan_tempat/logo.png') }}" alt="Joy N Bites Logo" />
            </div>
            <ul class="nav-links">
                <li><a href="#makanan">MAKANAN & MINUMAN</a></li>
                <li>
                    <a href="{{ route('cart.index', $id_barcode) }}" class="btn btn-yellow">
                        🛒 Cart ({{ count(session('cart', [])) }})
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<section id="makanan" class="section-content">
    <div class="container">

        {{-- ================= MAKANAN ================= --}}
        <h2 class="section-title">MAKANAN</h2>
        <div class="card-grid">

            @foreach ($makanan as $item)
            <div class="card food-card">
                <div class="game-img-box">
                    <img src="{{ $item->img ? asset('storage/'.$item->img) : asset('pesan_tempat/food.png') }}"
                         alt="{{ $item->nama_makanan }}" />
                </div>

                <div class="card-body">
                    <h4>{{ $item->nama_makanan }}</h4>
                    <p class="sub-text">Menu favorit Joy & Bites</p>

                    <div class="price-row">
                        <span class="price-text">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </span>

                        {{-- FORM PESAN MAKANAN --}}
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="makanan-{{ $item->id }}">
                            <input type="hidden" name="nama" value="{{ $item->nama_makanan }}">
                            <input type="hidden" name="harga" value="{{ $item->harga }}">
                            <input type="hidden" name="img" value="{{ $item->img }}">

                            <button type="submit" class="info-text">
                                <i class="fas fa-cart-plus"></i> PESAN
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        {{-- ================= MINUMAN ================= --}}
        <h2 class="section-title">MINUMAN</h2>
        <div class="card-grid">

            @foreach ($minuman as $item)
            <div class="card food-card">
                <div class="game-img-box">
                    <img src="{{ $item->img ? asset('storage/'.$item->img) : asset('pesan_tempat/food.png') }}"
                         alt="{{ $item->nama_minuman }}" />
                </div>

                <div class="card-body">
                    <h4>{{ $item->nama_minuman }}</h4>
                    <p class="sub-text">Menu favorit Joy & Bites</p>

                    <div class="price-row">
                        <span class="price-text">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </span>

                        {{-- FORM PESAN MINUMAN --}}
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="minuman-{{ $item->id }}">
                            <input type="hidden" name="nama" value="{{ $item->nama_minuman }}">
                            <input type="hidden" name="harga" value="{{ $item->harga }}">
                            <input type="hidden" name="img" value="{{ $item->img }}">

                            <button type="submit" class="info-text">
                                <i class="fas fa-cart-plus"></i> PESAN
                            </button>

                        </form>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</section>
<script>
    setTimeout(() => {
        const toast = document.getElementById('toast-success');
        if (toast) toast.remove();
    }, 4000);
</script>

</body>
</html>
