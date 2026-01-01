<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking Game - Joy & Bites</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />

    <link rel="stylesheet" href="{{ asset('pesan_tempat/pesan.css') }}" />

    <style>
        /* CSS Tambahan Khusus Halaman Booking */
        body {
            background-color: #f9f9f9;
        }

        .booking-section {
            padding-top: 100px; /* Spacer karena navbar fixed */
            padding-bottom: 50px;
            min-height: 100vh;
        }

        .booking-container {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            padding: 20px;
        }

        /* Bagian Kiri: Info Game */
        .game-preview {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .game-preview img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .game-details {
            padding: 25px;
        }

        .game-details h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .price-tag {
            font-size: 24px;
            color: #FF8C00; /* Warna Oranye sesuai tema */
            font-weight: 600;
            margin-bottom: 20px;
            display: block;
        }

        .game-desc {
            color: #666;
            line-height: 1.6;
        }

        /* Bagian Kanan: Form Booking */
        .booking-form-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .form-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            color: #333;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #eee;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #FF8C00;
            outline: none;
        }

        .total-price-box {
            background: #fff8e1;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 700;
            color: #333;
        }

        .btn-confirm {
            width: 100%;
            padding: 15px;
            background: #FF8C00; /* Atau warna kuning btn-yellow */
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 25px;
            transition: 0.3s;
        }

        .btn-confirm:hover {
            background: #e67e00;
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .booking-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
  </head>
  <body style="background-image: url('{{ asset('landing_page/assets/img/background_pengguna.png') }}')">
    <header class="main-header" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 1000; background: rgba(0,0,0,0.7);">
      <div class="container">
        <nav>
          <div class="logo">
             <img src="{{ asset('pesan_tempat/logo.png') }}" alt="Joy N Bites Logo" />
          </div>
          <ul class="nav-links">
            <li><a href="#games" style="color: white;">GAMES</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <section class="booking-section">
        <div class="booking-container">

            <div class="game-preview">
                <img src="{{ $permainan->gambar ? asset('storage/'.$permainan->gambar) : asset('pesan_tempat/ps5.png') }}" alt="Game Image">

                <div class="game-details">
                    @if ($permainan->jenis_permainan == "bl")
                        <h2>Billiard Meja {{ $permainan->no_permainan }}</h2>
                    @elseif ($permainan->jenis_permainan == "rs")
                        <h2>Race Simulation No {{ $permainan->no_permainan }}</h2>
                    @else
                        <h2>Playstation No {{ $permainan->no_permainan }}</h2>
                    @endif

                    <span class="price-tag">Rp {{ number_format($permainan->harga_per_jam ?? 50000, 0, ',', '.') }} / Jam</span>

                    <p class="game-desc">
                        {{ $permainan->deskripsi ?? 'Nikmati pengalaman bermain yang seru bersama teman-temanmu. Fasilitas lengkap dan nyaman.' }}
                    </p>

                    <div style="margin-top: 20px; color: #777; font-size: 14px;">
                        <i class="fas fa-info-circle"></i> Silahkan pilih tanggal dan durasi bermain di formulir samping.
                    </div>
                </div>
            </div>

            <div class="booking-form-card">
                <div class="form-title">Atur Jadwal Bermain</div>
                <form action="/bayar-tempat/{{ $permainan->id }}" method="GET" id="bookingForm">
                    @csrf
                    <input type="hidden" name="permainan_id" value="{{ $permainan->id }}">
                    <input type="hidden" id="hargaPerJam" value="{{ $permainan->harga_per_jam ?? 50000 }}">
                    <input type="hidden" name="jumlah" id="total">

                    <div class="form-group">
                        <label for="nama_pembooking"><i class="fa-solid fa-user"></i> Nama Pembooking</label>
                        <input type="input" id="nama_pembooking" name="nama" class="form-control" placeholder="-- Masukan Nama --" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal"><i class="far fa-calendar-alt"></i> Tanggal Booking</label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jam_mulai"><i class="far fa-clock"></i> Jam Mulai</label>
                        <select name="jam_mulai" id="jam_mulai" class="form-control" required>
                            <option value="">-- Pilih Jam Mulai --</option>
                            {{-- Sesuaikan jam awal (9) dan jam akhir (23) sesuai jam operasional --}}
                            @for ($i = 9; $i <= 23; $i++)
                                <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="durasi"><i class="fas fa-hourglass-half"></i> Durasi Bermain</label>
                        <select name="durasi" id="durasi" class="form-control">
                            <option value="1">1 Jam</option>
                            <option value="2">2 Jam</option>
                            <option value="3">3 Jam</option>
                            <option value="4">4 Jam</option>
                            <option value="5">5 Jam</option>
                        </select>
                    </div>

                    <div class="total-price-box">
                        <span>Total Bayar:</span>
                        <span id="totalDisplay" style="font-size: 20px; color: #FF8C00;">Rp 0</span>
                    </div>

                    <button type="submit" class="btn-confirm">
                        Konfirmasi Booking <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>

        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Set Min Date ke Hari Ini
            const dateInput = document.getElementById('tanggal');
            const today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('min', today);

            // 2. Kalkulasi Total Harga Otomatis
            const hargaPerJam = parseInt(document.getElementById('hargaPerJam').value);
            const durasiSelect = document.getElementById('durasi');
            const totalInput = document.getElementById('total');
            const totalDisplay = document.getElementById('totalDisplay');

            function updateTotal() {
                const durasi = parseInt(durasiSelect.value);
                const total = hargaPerJam * durasi;
                // Format Rupiah
                totalInput.textContent = 'Rp ' + total.toLocaleString('id-ID');
                totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
                totalInput.value = total;
            }

            // Jalankan saat durasi berubah
            durasiSelect.addEventListener('change', updateTotal);

            // Jalankan sekali saat load
            updateTotal();
        });
    </script>

  </body>
</html>
