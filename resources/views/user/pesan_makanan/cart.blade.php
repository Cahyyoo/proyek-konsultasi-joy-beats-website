<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout Pesanan - Joy & Bites</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    {{-- pakai css checkout kamu --}}
    <link rel="stylesheet" href="{{ asset('pesan_makanan/buatpesan.css') }}" />
    <style>
        .qty-btn {
            background: #f1f1f1;
            border: none;
            width: 28px;
            height: 28px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
        }

        .qty-btn:hover {
            background: #ffcc00;
        }

        .item-remove {
            margin-left: 12px;
        }

        .remove-btn {
            background: #ff4d4d;
            border: none;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .remove-btn:hover {
            background: #e53935;
        }

    </style>
</head>

<body>

<div class="background-overlay"></div>

<header class="main-header">
    <div class="container">
        <nav>
            <div class="logo">
                <img src="{{ asset('pesan_makanan/logo.png') }}" alt="Joy N Bites Logo" />
            </div>
            <ul class="nav-links">
                <li><a href="{{ url('/pesan-makanan') }}">MAKANAN & MINUMAN</a></li>
                <li>
                    <a href="{{ url('/') }}" class="btn btn-yellow">BACK</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

@php
    $totalHarga = 0;
    $totalItem  = 0;
@endphp

<main class="checkout-container">
    <div class="container">
        <div class="checkout-card">

            {{-- ================= DETAIL PESANAN ================= --}}
            <div class="order-section">
                <h2 class="card-title">Detail Pesanan</h2>

                <div class="order-list">

                    @forelse ($cart as $item)
                        @php
                            $subtotal = $item['harga'] * $item['qty'];
                            $totalHarga += $subtotal;
                            $totalItem  += $item['qty'];
                            $gambar = $item['img'];
                        @endphp

                        <div class="order-item">
                            <div class="item-img-box">
                                <img src="{{ asset('storage/' . $gambar) }}" alt="{{ $item['nama'] }}">
                            </div>

                            <div class="item-details">
                                <h4>{{ $item['nama'] }}</h4>
                                <p class="item-price">
                                    Rp {{ number_format($item['harga'],0,',','.') }}
                                </p>
                            </div>

                            <div class="item-qty">
                                <form action="{{ route('cart.update') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <input type="hidden" name="type" value="minus">
                                    <button class="qty-btn">−</button>
                                </form>

                                <span>{{ $item['qty'] }}</span>

                                <form action="{{ route('cart.update') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <input type="hidden" name="type" value="plus">
                                    <button class="qty-btn">+</button>
                                </form>
                            </div>


                            <div class="item-total">
                                Rp {{ number_format($subtotal,0,',','.') }}
                            </div>

                            <div class="item-remove">
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <button class="remove-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p>Keranjang masih kosong.</p>
                    @endforelse

                </div>
            </div>

            {{-- ================= PEMBAYARAN ================= --}}
            <div class="payment-section">
                <h2 class="card-title">Ringkasan Pembayaran</h2>

                @php
                    $pajak = $totalHarga * 0.1;
                    $grandTotal = $totalHarga + $pajak;
                @endphp

                <div class="summary-box">
                    <div class="summary-row">
                        <span>Total Item</span>
                        <span>{{ $totalItem }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Pajak (10%)</span>
                        <span>Rp {{ number_format($pajak,0,',','.') }}</span>
                    </div>
                    <div class="summary-row total-row">
                        <span>Total Bayar</span>
                        <span>Rp {{ number_format($grandTotal,0,',','.') }}</span>
                    </div>
                </div>

                {{-- PINDAH KE HALAMAN PEMBAYARAN --}}
                <form action="{{ route('pembayaran.makanan') }}" method="GET">
                    <button class="btn btn-yellow btn-block">
                        LANJUT KE PEMBAYARAN
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

</body>
</html>
