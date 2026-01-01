<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Joy & Bites</title>

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

    <link rel="stylesheet" href="{{ asset('page_login/login_pelanggan.css') }}" />
  </head>
  <body>

    @if( Session::has('danger') )
        <div class="alert alert-danger py-3" data-aos="fade-left" style="position:absolute;right:0;top:0">
            <i class=" fa fa-info-circle mr-1"></i>
            {{-- <button type="button" class="close" data-dismiss="alert" >&times;</button> --}}
            {{ Session::get('danger') }}
        </div>
    @endif

    <!-- Ini adalah header dengan navigasi -->
    <header class="main-header">
      <div class="container">
        <nav>
          <div class="logo">
            <img src="{{ asset('page_login/logo.png') }}" alt="Joy N Bites Logo" />
          </div>
          <ul class="nav-links">
            <li><a href="#promo">PROMO</a></li>
            <li><a href="#about">TENTANG KAMI</a></li>
            <li><a href="#testimonials">KATA PENGGUNA</a></li>
            <li><a href="#reservation">RESERVASI</a></li>
            <li><a href="#news">BERITA</a></li>
            <li><a href="#location">LOKASI</a></li>
            <li><a href="/login" class="btn btn-yellow">Login</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <!-- Ini adalah kartu login utama -->
    <div class="login-card">
      <!-- Ini adalah header kartu login -->
      <div class="login-header">
        <img src="{{ asset('page_login/logo.png') }}" alt="Joy & Bites Logo" class="login-logo" />
      </div>

      <!-- Ini adalah body kartu login dengan form -->
      <form class="login-body" action="login" method="POST">
        @csrf
        <h3>Masuk ke Joy & Bites</h3>

        <div class="input-group">
          <input class="@error('email') is-invalid @enderror" id="email" type="email" name="email" required/>
          <label for="email">Email</label>
          @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>

        <div class="input-group">
          <input type="password" id="password" name="password" class=" @error('password') is-invalid @enderror" required />
          <label for="password">Kata Sandi</label>
          <span class="toggle-password">
            <i class="fas fa-eye" id="toggleIcon"></i>
          </span>
          @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
         @enderror
        </div>

        <div class="options-row">
          <div class="remember-me">
            <input type="checkbox" id="remember" />
            <label for="remember">Ingat Saya</label>
          </div>
          <a href="#" class="forgot-password">Lupa Kata Sandi</a>
        </div>

        <button type="submit" class="btn btn-yellow">Masuk</button>
      </form>
    </div>

    <!-- Ini adalah script untuk toggle password -->
    <script>
      const togglePassword = document.querySelector(".toggle-password");
      const passwordInput = document.getElementById("password");
      const toggleIcon = document.getElementById("toggleIcon");

      togglePassword.addEventListener("click", function () {
        const type =
          passwordInput.getAttribute("type") === "password"
            ? "text"
            : "password";
        passwordInput.setAttribute("type", type);
        toggleIcon.classList.toggle("fa-eye");
        toggleIcon.classList.toggle("fa-eye-slash");
      });
    </script>
  </body>
</html>
