<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="
        default-src * 'unsafe-inline' 'unsafe-eval';
        script-src * 'unsafe-inline' 'unsafe-eval';
        connect-src * 'unsafe-inline';
        img-src * data: blob: 'unsafe-inline';
        frame-src *;
        style-src * 'unsafe-inline';
    ">
    <meta name="referrer" content="no-referrer-when-downgrade">
    <title>Pembayaran Booking - Joy & Bites</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Midtrans Snap --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-server-ZNFJQAs0K9hF-G6xNaBcBPiQ">
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        * {
            overflow-x: hidden;
            overflow-y: hidden;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding-top: 100px;

            position: relative;
        }

        /* ORNAMEN BLUR */
        body::before,
        body::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 140, 0, 0.35);
            filter: blur(120px);
            z-index: 0;
        }

        body::before {
            top: 50px;
            left: -100px;
        }

        body::after {
            bottom: 50px;
            right: -100px;
            background: rgba(26, 50, 80, 0.4);
        }

        .payment-container {
            max-width: 600px;
            margin: 25vh auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
            padding: 30px;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(8px);
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
            margin-bottom: 12px;
            color: #555;
        }

        .payment-row strong {
            color: #333;
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
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(255, 140, 0, 0.4);
        }

        .btn-pay:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(255, 140, 0, 0.6);
        }

        /* =======================
            MOBILE OPTIMIZATION
            ======================= */
            @media (max-width: 576px) {

                body {
                    padding-top: 60px;
                }

                body::before,
                body::after {
                    width: 200px;
                    height: 200px;
                    filter: blur(90px);
                }

                .payment-container {
                    max-width: 92%;
                    padding: 20px;
                    border-radius: 16px;
                }

                .payment-title {
                    font-size: 20px;
                    margin-bottom: 15px;
                }

                .payment-row {
                    font-size: 14px;
                    gap: 10px;
                }

                .payment-row span {
                    flex: 1;
                }

                .payment-row strong {
                    flex: 1;
                    text-align: right;
                }

                .total-box {
                    font-size: 16px;
                    padding: 12px;
                }

                .btn-pay {
                    padding: 14px;
                    font-size: 15px;
                    border-radius: 10px;
                }
            }

            /* EXTRA SMALL DEVICES */
            @media (max-width: 360px) {
                .payment-title {
                    font-size: 18px;
                }

                .payment-row {
                    font-size: 13px;
                }

                .total-box {
                    font-size: 15px;
                }
            }
    </style>
<link rel="stylesheet" href="{{ asset('pesan_tempat/pesan.css') }}" />

</head>
<body>
    <header class="main-header" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;">
      <div class="container">
        <nav>
          <div class="logo">
            <img src="{{ asset('pesan_tempat/logo.png') }}" alt="Joy N Bites Logo" />
          </div>
          <ul class="nav-links">
            <li><a href="#games">GAMES</a></li>
          </ul>
        </nav>
      </div>
    </header>


<div class="payment-container">
    <div class="payment-title">Detail Pembayaran</div>

    <div class="payment-row">
        <span>Nama</span>
        <strong>{{ $booking->nama }}</strong>
    </div>

    <div class="payment-row">
        <span>Game</span>
        <strong>
            @if($booking->permainan->jenis_permainan == "bl")
                <td>Billiard {{ $booking->permainan->no_permainan }}</td>
                @elseif ($booking->permainan->jenis_permainan == "ps")
                <td>PlayStation {{ $booking->permainan->no_permainan }}</td>
                @elseif ($booking->permainan->jenis_permainan == "rs")
                <td>Race Simulation {{ $booking->permainan->no_permainan }}</td>
            @endif
        </strong>
    </div>

    <div class="payment-row">
        <span>Tanggal</span>
        <strong>{{ \Carbon\Carbon::parse($booking->tanggal)->locale('id')->translatedFormat('l, d F Y') }}</strong>
    </div>

    <div class="payment-row">
        <span>Jam Mulai</span>
        <strong>{{ $booking->jam_mulai }}</strong>
    </div>

    <div class="payment-row">
        <span>Durasi</span>
        <strong>{{ $durasi }} Jam</strong>
    </div>

    <div class="total-box">
        <span>Total Bayar</span>
        <span>Rp {{ number_format($booking->jumlah,0,',','.') }}</span>
    </div>

    {{-- CELL MIDTRANS --}}
    <button id="pay-button" class="btn-pay">
        Bayar Sekarang
    </button>

</div>

<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                window.location.href = "{{ route('booking.invoice', $booking->id) }}";
            },
            onPending: function(result){
                alert("Menunggu pembayaran...");
            },
            onError: function(result){
                alert("Pembayaran gagal!");
            },
            onClose: function(){
                alert('Pembayaran dibatalkan');
            }
        });
    });
</script>

</body>
</html>
