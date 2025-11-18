<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sirena</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('landing_page/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing_page/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('landing_page/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('landing_page/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing_page/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('landing_page/assets/css/main.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Lumia
  * Template URL: https://bootstrapmade.com/lumia-bootstrap-business-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <h1 class="sitename">Sirena</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <a href="/login" class="btn d-xl-none" style="color: #ffffff; background-color: #3498db; border-radius: 0;">Login</a>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

          <a href="/login" class="btn d-none d-xl-block" style="color: #ffffff; background-color: #3498db; border-radius: 0;">Login</a>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="{{asset('landing_page/assets/img/bg.jpg')}}" alt="" data-aos="fade-in">

      <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <h2>Selamat datang di SIRENA</h2>
            <p>Selamat datang di Sistem Rekomendasi Peminatan - Teknik Komputer</p>
            <a href="#about" class="btn-get-started">Mulai Sekarang</a>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Tentang Kami</h2>
        <p>Berikut adalah penjelasan singkat tentang kami</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-3">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <img src="https://plus.unsplash.com/premium_photo-1676670617568-d5e8c1b79afc?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDI3fHx8ZW58MHx8fHx8" alt="" class="img-fluid">
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="about-content ps-0 ps-lg-3">
              <h3>Sistem Rekomendasi Peminatan</h3>
              <p>Sistem ini membantu mahasiswa memilih peminatan berdasarkan nilai mata kuliah dan kuesioner minat. Nilai akademik menunjukkan kemampuan di bidang tertentu, sementara kuesioner mengungkap minat pribadi.</p>

                <p>Cara Kerja</p>

                <p>1. Analisis nilai mata kuliah terkait peminatan</p>

                <p>2. Evaluasi hasil kuesioner minat dan preferensi</p>

                <p>3. Gabungkan kedua data dengan bobot tertentu</p>

                <p>Contoh:</p>
                <p>Mahasiswa dengan nilai tinggi di Jaringan Komputer dan minat di Cyber Security akan direkomendasikan peminatan Keamanan Siber.</p>
            </div>

          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Services Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Berikut hal-hal yang akan dilakukan mahasiswa pada website ini</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-bounding-box-circles"></i>
              </div>
              <a class="stretched-link">
                <h3>Input Nilai Mata Kuliah</h3>
              </a>
              <p>Mahasiswa akan mengisi nilai mata kuliah tertentu yang berhubungan dengan peminatan.</p>
              <a class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-calendar4-week"></i>
              </div>
              <a class="stretched-link">
                <h3>Input Kuesioner</h3>
              </a>
              <p>Mahasiswa akan mengisi beberapa kuesioner yang berhubungan dengan peminatan.</p>
              <a class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-chat-square-text"></i>
              </div>
              <a class="stretched-link">
                <h3>Minat Mahasiswa</h3>
              </a>
              <p>Mahasiswa akan mengisi beberapa minat mahasiswa.</p>
              <a class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->
  </main>

  <footer id="footer" class="footer light-background">

    <div class="copyright text-center">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Sirena</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('landing_page/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{asset('landing_page/assets/js/main.js')}}"></script>

</body>

</html>
