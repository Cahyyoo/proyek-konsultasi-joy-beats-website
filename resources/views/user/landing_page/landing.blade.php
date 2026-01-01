<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Joy & Bites: Kenikmatan Lezat, Keseruan Tanpa Batas!</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('landing_page/assets/css/landing.css') }}" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>

  <body style="scroll-behavior: smooth">

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            confirmButtonColor: '#ff8c00'
        });
    </script>
    @endif


    <!-- Ini adalah header dengan navigasi -->
    <header class="main-header" style="position: fixed;">
      <div class="container">
        <nav>
          <div class="logo">
            <img src="{{ asset('landing_page/assets/img/logo.png') }}" alt="Joy N Bites Logo" />
          </div>
          <ul class="nav-links">
            <li><a href="#hero">HOME</a></li>
            <li><a href="#promo">PROMO</a></li>
            <li><a href="#about">TENTANG KAMI</a></li>
            <li><a href="#reservation">RESERVASI</a></li>
            <li><a href="#news">BERITA</a></li>
            <li><a href="#location">LOKASI</a></li>
            <li>
              <a href="/login" class="btn btn-orange">LOGIN</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>

    <!-- Ini adalah section hero -->
    <section id="hero" data-aos="fade-down" class="hero-section" style="background-image: url('{{ asset('landing_page/assets/img/background.png') }}')">
      <div class="container">
        <div class="hero-content">
          <h1>Joy & Bites</h1>
          <p>
            Booking meja billiard, PS, atau sekedar nyantai sambil Netflix-an
            bareng temen? Bisa banget!
          </p>
          <div class="hero-cta-group">
            <a href="#food" class="btn btn-orange btn-block-space">
              Mulai Sekarang
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Ini adalah section promo -->
    <section id="promo" class="promo-section" style="background-image: url('{{ asset('landing_page/assets/img/background_promo.png') }}')">
      <div class="container" data-aos="fade-up">
        <h2>Promo Bulan Ini</h2>
        <p class="promo-description">
          Langsung cek promo seru dari Instagram kita, siapa tahu dapat diskon
          PS atau combo burger!
        </p>

        <div class="promo-image-container">
          <div class="promo-card">
            <img
              src="{{ asset('landing_page/assets/img/promo1.png') }}"
              alt="Promo Game Over Wighware"
              class="promo-img"
            />
          </div>
          <div class="promo-card">
            <img
              src="{{ asset('landing_page/assets/img/promo2.png') }}"
              alt="Promo Best Costume Reward"
              class="promo-img"
            />
          </div>
          <div class="promo-card">
            <img
              src="{{ asset('landing_page/assets/img/promo3.png') }}"
              alt="Promo Nightmare Package"
              class="promo-img"
            />
          </div>
        </div>

        <a
          href="https://instagram.com/joyandbites"
          target="_blank"
          class="btn btn-blue promo-btn"
        >
          LIHAT INSTAGRAM
        </a>
      </div>
    </section>

    <!-- Ini adalah section about -->
    <section id="about"  class="about-section" style="background-image: url('{{ asset('landing_page/assets/img/background_tentang.png') }}')">
      <div class="container about-container" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom">
        <div class="about-image-wrapper">
          <img
            src="{{ asset('landing_page/assets/img/tentang.png') }}"
            alt="Interior Joy & Bites dengan Meja Biliard"
            class="about-img"
          />
        </div>
        <div class="about-content">
          <h2 class="highlight-yellow">Tentang Joy & Bites</h2>
          <p>
            Joy & Bites bukan cuma kafe — tapi tempat nongkrong paling seru di
            Bandung! Di sini lo bisa mabar PS, tanding billiard, nge-race di
            simulator, sampe Netflix-an bareng temen.
          </p>
          <p>
            Mau ngopi santai? Mau booking buat event komunitas? Semua bisa di
            satu tempat. Yuk, datang dan rasain vibes-nya!
          </p>
        </div>
      </div>
    </section>

    <!-- Ini adalah section reservation -->
    <section id="reservation" class="reservation-section" style="background-image: url('{{ asset('landing_page/assets/img/background_reservasi.png') }}')">
      <div class="container reservation-container">
        <div class="reservation-card card-left" data-aos="fade-right">
          <img
            src="{{ asset('landing_page/assets/img/gambar_reservation1.png') }}"
            alt="Sekelompok orang bermain di Playroom"
            class="reservation-img"
          />
          <div class="card-body">
            <h3>Reservasi Main & Nongkrong</h3>
            <p>
              Booking tempat buat PS, billiard, atau racing simulator langsung
              dari HP kamu!
            </p>
            <a href="/pesan-tempat" class="btn btn-blue">PESAN SEKARANG</a>
          </div>
        </div>

        <div class="reservation-card card-right" data-aos="fade-left">
          <img
            src="{{ asset('landing_page/assets/img/gambar_reservation2.png') }}"
            alt="Acara Komunitas/Event"
            class="reservation-img"
          />
          <div class="card-body">
            <h3>Event & Kolaborasi</h3>
            <p>Mau bikin event bareng Joy & Bites? Yuk, collab bareng kami!</p>
            <a href="#" class="btn btn-orange">HUBUNGI KAMI</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Ini adalah section news -->
    <section id="news" class="news-section section-alt-bg" style="background-image: url('{{ asset('landing_page/assets/img/background_berita.png') }}')">
      <div class="container" data-aos="fade-up">
        <h2>Update Terbaru dari Joy & Bites</h2>
        <p class="news-description">
          Lihat info event dan keseruan terbaru kita langsung dari instagram.
        </p>

        <div class="news-image-container">
          <div class="news-card">
            <img
              src="{{ asset('landing_page/assets/img/berita1.png') }}"
              alt="Poster High School Take Over"
              class="news-img"
            />
          </div>
          <div class="news-card">
            <img
              src="{{ asset('landing_page/assets/img/berita2.png') }}"
              alt="Poster FC26 Championship"
              class="news-img"
            />
          </div>
          <div class="news-card">
            <img
              src="{{ asset('landing_page/assets/img/berita3.png') }}"
              alt="Poster Billiard Vol. II"
              class="news-img"
            />
          </div>
        </div>

        <a
          href="https://instagram.com/joyandbites"
          target="_blank"
          class="btn btn-blue news-btn"
        >
          LIHAT INSTAGRAM
        </a>
      </div>
    </section>

    <!-- Ini adalah section location -->
    <section id="location" class="location-section" style="background-image: url('{{ asset('landing_page/assets/img/background_lokasi.png') }}')">
      <div class="container location-grid">
        <div class="location-info-left">
          <div class="logo-large-text">
            <img src="{{ asset('landing_page/assets/img/logo.png') }}" alt="Logo &" class="and-logo-icon" />
          </div>
          <div class="social-icons">
            <a href="https://wa.me/yournumber" target="_blank" title="WhatsApp">
              <i class="fab fa-whatsapp"></i>
            </a>
            <a
              href="https://instagram.com/joyandbites"
              target="_blank"
              title="Instagram"
            >
              <i class="fab fa-instagram"></i>
            </a>
            <a
              href="https://www.tiktok.com/@joyandbites?_r=1&_t=ZS-91TYsXb0mdl"
              target="_blank"
              title="TikTok"
            >
              <i class="fab fa-tiktok"></i>
            </a>
          </div>
        </div>

        <div class="location-info-right">
          <h2>Lokasi Kami</h2>
          <p class="address">
            Jl. Cendana No.11A, Cihapit, Kec. Bandung Wetan, Kota Bandung, Jawa
            Barat 40114
          </p>
          <div class="map-container">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.8510207355835!2d107.62584207499641!3d-6.908411293091034!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e75a0f53182b%3A0x609905ee46b5b43b!2sJoy%20and%20Bites!5e0!3m2!1sid!2sid!4v1763017352199!5m2!1sid!2sid"
              width="600"
              height="450"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
        </div>
      </div>
    </section>

    <!-- Ini adalah footer -->
    <footer id="contact" class="main-footer">
      <div class="container">
        <p>© 2025 Joy N Bites. Jl. Cendana No. 11A, Cihapit, Bandung.</p>
        <p>Jam Buka: Weekdays 11.00 – 00.00 | Weekend 10.00 – 01.00</p>
      </div>
    </footer>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
  </body>
</html>
