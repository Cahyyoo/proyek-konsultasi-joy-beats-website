<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Makanan - Joy & Bites</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- MIDTRANS SNAP --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('pesan_tempat/pesan.css') }}">

    <style>
        * { overflow-x: hidden; }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding-top: 100px;
            position: relative;
        }

        body::before, body::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255,140,0,.35);
            filter: blur(120px);
            z-index: 0;
        }

        body::before { top: 50px; left: -100px; }
        body::after {
            bottom: 50px;
            right: -100px;
            background: rgba(26,50,80,.4);
        }

        .payment-container {
            max-width: 600px;
            margin: 22vh auto;
            background: rgba(255,255,255,.96);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,.25);
            padding: 30px;
            position: relative;
            z-index: 1;
        }

        .payment-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            color: #0f1a2a;
        }

        .payment-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #555;
        }

        .payment-row strong { color: #333; }

        .item-list {
            margin-top: 10px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .total-box {
            background: linear-gradient(135deg, #fff3cd, #ffe082);
            border-radius: 12px;
            padding: 15px;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: 700;
            color: #ff8c00;
        }

        .btn-pay {
            width: 100%;
            margin-top: 25px;
            padding: 15px;
            background: linear-gradient(135deg, #ff8c00, #ff6f00);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all .3s ease;
            box-shadow: 0 10px 20px rgba(255,140,0,.4);
        }

        .btn-pay:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(255,140,0,.6);
        }
    </style>
</head>

<body>

<header class="main-header" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;">
    <div class="container">
        <nav>
            <div class="logo">
                <img src="{{ asset('pesan_tempat/logo.png') }}" alt="Joy N Bites Logo">
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('cart.index', $id) }}">CART</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="payment-container">
    <div class="payment-title">Detail Pembayaran</div>

    <div class="payment-row">
        <span>Kode Transaksi</span>
        <strong>{{ $kode_transaksi }}</strong>
    </div>

    <div class="payment-row">
        <span>Jumlah Item</span>
        <strong>{{ count($items) }}</strong>
    </div>

    <div class="item-list">
        @foreach ($items as $item)
            <div class="item">
                <span>{{ $item['nama'] }} (x{{ $item['qty'] }})</span>
                <strong>Rp {{ number_format($item['subtotal'],0,',','.') }}</strong>
            </div>
        @endforeach
    </div>

    <div class="total-box">
        <span>Total Bayar</span>
        <span>Rp {{ number_format($grandTotal,0,',','.') }}</span>
    </div>

    <button id="pay-button" class="btn-pay">
        Bayar Sekarang
    </button>
</div>

<script>
document.getElementById('pay-button').addEventListener('click', function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function () {
            window.location.href = "{{ route('invoice.show', $kode_transaksi) }}";
        },
        onPending: function () {
            alert("Menunggu pembayaran...");
        },
        onError: function () {
            alert("Pembayaran gagal!");
        },
        onClose: function () {
            alert("Pembayaran dibatalkan");
        }
    });
});
</script>

</body>
</html>
