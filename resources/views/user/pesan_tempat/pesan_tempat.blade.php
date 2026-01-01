<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pesan Menu - Joy & Bites</title>

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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
            <li><a href="#makanan">MAKANAN</a></li>
            <li><a href="#games">GAMES</a></li>
            <li>
              <a href="{{ url('/login') }}" class="btn btn-yellow">Login</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>

    <section id="games" class="section-content bg-orange">
      <div class="container">
        <h2 class="section-title">GAME</h2>

        <div class="card-grid">
          @foreach ($Permainan as $item)
          @php
              // Cari booking aktif untuk game ini
              $activeBooking = null;
              foreach ($bookings as $booking) {
                  if ($booking->permainan_id == $item->id) {
                      $activeBooking = $booking;
                      break;
                  }
              }
          @endphp

          <div class="card game-card" data-aos="fade-down">
            <div class="game-img-box">
              <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : asset('pesan_tempat/ps5.png') }}" alt="{{ $item->nama_game ?? 'Game' }}" />
            </div>

            <div class="card-body">
                @if ($item->jenis_permainan == "bl")
                    <h4>Billiard Meja {{ $item->no_permainan }}</h4>
                @elseif ($item->jenis_permainan == "rs")
                    <h4>Race Simulation No {{ $item->no_permainan }}</h4>
                @else
                    <h4>Playstation No {{ $item->no_permainan }}</h4>
                @endif

              <p class="sub-text">{{ $item->deskripsi ?? 'Deskripsi game tersedia di sini.' }}</p>

              <div class="price-row">
                <div class="slot-item">
                  <span class="slot-label">Timer</span>
                  <div id="timer-{{ $item->id }}" class="slot-timer">
                    @if($activeBooking)
                        <!-- Data untuk timer -->
                        <div class="timer-data"
                             data-start="{{ $activeBooking->jam_mulai }}"
                             data-end="{{ $activeBooking->jam_selesai }}"
                             data-date="{{ $activeBooking->tanggal }}"
                             data-booking-id="{{ $activeBooking->id }}">
                            Menghitung...
                        </div>
                    @else
                        <span class="available">AVAILABLE</span>
                    @endif
                  </div>
                </div>
                <a href="/booking-tempat/{{ $item->id }}" class="info-text">
                    BOOK
                </a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        // Fungsi untuk menghitung selisih waktu
        function calculateTimeRemaining(startTime, endTime, date) {
            const now = new Date();
            const bookingDate = new Date(date + 'T' + startTime);
            const endDate = new Date(date + 'T' + endTime);

            // Jika booking sedang berlangsung
            if (now >= bookingDate && now <= endDate) {
                const diff = endDate - now;
                return {
                    status: 'running',
                    message: formatTime(diff),
                    remaining: diff
                };
            }

            // Jika booking sudah selesai
            return {
                status: 'available',
                message: 'AVAILABLE',
                remaining: 0
            };
        }

        // Format waktu menjadi HH:MM:SS
        function formatTime(milliseconds) {
            const totalSeconds = Math.floor(milliseconds / 1000);
            const hours = Math.floor(totalSeconds / 3600);
            const minutes = Math.floor((totalSeconds % 3600) / 60);
            const seconds = totalSeconds % 60;

            return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        // Update semua timer
        function updateAllTimers() {
            document.querySelectorAll('[id^="timer-"]').forEach(timerElement => {
                const timerData = timerElement.querySelector('.timer-data');
                if (timerData) {
                    const startTime = timerData.dataset.start;
                    const endTime = timerData.dataset.end;
                    const date = timerData.dataset.date;

                    if (startTime && endTime && date) {
                        const timeInfo = calculateTimeRemaining(startTime, endTime, date);

                        switch(timeInfo.status) {
                            case 'running':
                                timerData.innerHTML = `<span class="running">${timeInfo.message}</span>`;
                                break;
                            case 'available':
                                timerData.innerHTML = `<span class="available">${timeInfo.message}</span>`;
                                // Jika sudah selesai, refresh halaman untuk update status
                                setTimeout(() => {
                                    location.reload();
                                }, 30000); // Refresh setelah 30 detik
                                break;
                        }
                    }
                }
            });
        }

        // Jalankan timer setiap detik
        updateAllTimers();
        setInterval(updateAllTimers, 1000);

        // Inisialisasi saat halaman load
        document.addEventListener('DOMContentLoaded', function() {
            updateAllTimers();
        });
    </script>

    <style>
        .slot-timer .running {
            color: #FF0000; /* Red untuk running */
            font-weight: bold;
        }

        .slot-timer .available {
            color: #28a745;
            font-weight: bold;
        }

        .timer-data {
            font-family: monospace;
            font-size: 14px;
        }
    </style>
</body>
</html>
