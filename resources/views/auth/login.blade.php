<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
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

  <title>Login</title>
  <style>
    body{
        overflow-x: hidden;
    }
      .bdg {
          background-position: center;
          background-size: cover;
          background-repeat: no-repeat;
          height: 100vh;
          background-image: url({{asset('landing_page/assets/img/bg.jpg')}});
      }
      .bg-gelap{
          width: 100vw;
          height: 100vh;
          position: absolute;
          background-color: rgba(0, 0, 0, .7)
      }
      a {
        text-decoration: none
      }
  </style>
</head>

@if( Session::has('danger') )
    <div class="alert alert-danger py-3" data-aos="fade-left" style="position:absolute;right:0;top:0">
        <i class=" fa fa-info-circle mr-1"></i>
        {{-- <button type="button" class="close" data-dismiss="alert" >&times;</button> --}}
        {{ Session::get('danger') }}
    </div>
@endif

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <h1 class="sitename">SIMAK-P</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/#hero">Home</a></li>
          <li><a href="/#about">About</a></li>
          <li><a href="/#services">Services</a></li>
          <a href="/login" class="btn d-xl-none" style="color: #ffffff; background-color: #3498db; border-radius: 0;">Login</a>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
          <a href="/login" class="btn d-none d-xl-block" style="color: #ffffff; background-color: #3498db; border-radius: 0;">Login</a>

    </div>
  </header>

  <main class="main bdg" data-aos="fade-up">
        <div class="bg-gelap"></div>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container" >
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg" style="background-color:rgba(255, 255, 255, .95);margin-top: 18vh;">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="login" method="POST">
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email" placeholder="name@example.com" name="email" required/>
                                                <label for="inputEmail">Email address</label>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control @error('password') is-invalid @enderror"" id="inputPassword" type="password" placeholder="Password" name="password"/>
                                                <label for="inputPassword">Password</label>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                                <button class="btn btn-primary" type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
          AOS.init();
        </script>

  </main>

  <footer id="footer" class="footer light-background">

    <div class="copyright text-center">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Simak-P</strong> <span>All Rights Reserved</span></p>
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
