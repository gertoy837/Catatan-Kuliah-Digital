<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Catat.in - Solusi Cerdas untuk Catatan Kuliah Anda</title>
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/logo_1.png">

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href="{{ asset('template/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('template/assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('assets/img/logo_1.png') }}" alt="">
                <h1 class="sitename">Catat.in</h1>
            </a>

            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a href="{{ url('/catatan') }}" class="btn-getstarted">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-getstarted">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                style="border: 2px solid #f97316; color: #f97316; padding: 6px 15px; border-radius: 4px; font-weight: 500; text-decoration: none;"
                                onmouseover="this.style.backgroundColor='#f97316'; this.style.color='white'"
                                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#f97316'"
                                class="ms-3">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    {{-- <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo.png" alt="">
        <h1 class="sitename">FlexStart</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#team">Team</a></li>
          <li><a href="blog.html">Blog</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
          <li class="listing-dropdown"><a href="#"><span>Listing Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li>
                <a href="#">Column 1 link 1</a>
                <a href="#">Column 1 link 2</a>
                <a href="#">Column 1 link 3</a>
              </li>
              <li>
                <a href="#">Column 2 link 1</a>
                <a href="#">Column 2 link 2</a>
                <a href="#">Column 3 link 3</a>
              </li>
              <li>
                <a href="#">Column 3 link 1</a>
                <a href="#">Column 3 link 2</a>
                <a href="#">Column 3 link 3</a>
              </li>
              <li>
                <a href="#">Column 4 link 1</a>
                <a href="#">Column 4 link 2</a>
                <a href="#">Column 4 link 3</a>
              </li>
              <li>
                <a href="#">Column 5 link 1</a>
                <a href="#">Column 5 link 2</a>
                <a href="#">Column 5 link 3</a>
              </li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted flex-md-shrink-0" href="index.html#about">Get Started</a>

    </div>
  </header> --}}


    <main class="main">

        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1 data-aos="fade-up">Solusi Cerdas untuk Catatan Kuliah yang Terorganisir</h1>
                        <p data-aos="fade-up" data-aos-delay="100">Dengan Catat.in, kelola semua materi, tugas, dan ide
                            di satu tempat yang aman, terstruktur, dan mudah diakses.</p>
                        <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                            <a href="{{ route('login') }}" class="btn-get-started">Mulai Sekarang <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                        <img src="{{ asset('template/assets/img/hero-img.png') }}" class="img-fluid animated"
                            alt="">
                    </div>
                </div>
            </div>

        </section>

        <section id="stats" class="stats section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item d-flex align-items-center w-100 h-100">
                            <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="1250"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Pengguna Terdaftar</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item d-flex align-items-center w-100 h-100">
                            <i class="bi bi-journal-richtext color-orange flex-shrink-0"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="25432"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Catatan Dibuat</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item d-flex align-items-center w-100 h-100">
                            <i class="bi bi-book color-green flex-shrink-0"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="312"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Mata Kuliah Dikelola</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item d-flex align-items-center w-100 h-100">
                            <i class="bi bi-tags color-pink flex-shrink-0"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="1587"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Tag Digunakan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="features" class="features section">

            <div class="container section-title" data-aos="fade-up">
                <h2>Keunggulan</h2>
                <p>Mengapa Memilih Catat.in?<br></p>
            </div>
            <div class="container">
                <div class="row gy-5">
                    <div class="col-xl-6" data-aos="zoom-out" data-aos-delay="100">
                        <img src="{{ asset('template/assets/img/features.png') }}" class="img-fluid" alt="">
                    </div>

                    <div class="col-xl-6 d-flex">
                        <div class="row align-self-center gy-4">
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Struktur Hierarkis</h3>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Editor Teks Canggih</h3>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Pencarian Cepat via Tag</h3>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Kolaborasi & Diskusi</h3>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Aman & Personal</h3>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="700">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Akses Kapan Saja</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="about" class="alt-features section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Fitur Utama</h2>
                <p>Semua yang Anda butuhkan untuk sukses dalam studi.</p>
            </div>

            <div class="container">
                <div class="row gy-5">
                    <div class="col-xl-7 d-flex order-2 order-xl-1" data-aos="fade-up" data-aos-delay="200">
                        <div class="row align-self-center gy-5">

                            <div class="col-md-6 icon-box">
                                <i class="bi bi-shield-check"></i>
                                <div>
                                    <h4>Manajemen Pengguna & Autentikasi</h4>
                                    <p>Gerbang masuk yang aman dengan registrasi, login, dan profil personal untuk
                                        menjaga privasi catatan Anda.</p>
                                </div>
                            </div>
                            <div class="col-md-6 icon-box">
                                <i class="bi bi-journals"></i>
                                <div>
                                    <h4>Organisasi Catatan Hierarkis</h4>
                                    <p>Buat "rak buku" untuk tiap mata kuliah, lalu atur "bab" dan "topik". Materi
                                        kuliah jadi super rapi.</p>
                                </div>
                            </div>
                            <div class="col-md-6 icon-box">
                                <i class="bi bi-file-earmark-richtext"></i>
                                <div>
                                    <h4>Pembuatan Catatan Digital (Rich Text)</h4>
                                    <p>Tuangkan ide dengan editor modern. Format teks, sisipkan gambar, dan buat tautan
                                        untuk catatan yang informatif.</p>
                                </div>
                            </div>
                            <div class="col-md-6 icon-box">
                                <i class="bi bi-tags"></i>
                                <div>
                                    <h4>Pengelompokan & Pencarian Cepat</h4>
                                    <p>Labeli catatan dengan tag seperti #rumus atau #ujian. Temukan kembali informasi
                                        spesifik dalam hitungan detik.</p>
                                </div>
                            </div>
                            <div class="col-md-6 icon-box">
                                <i class="bi bi-chat-dots"></i>
                                <div>
                                    <h4>Diskusi dan Interaksi via Komentar</h4>
                                    <p>Tinggalkan komentar di bawah catatan untuk bertanya atau berdiskusi. Belajar jadi
                                        lebih interaktif dan kolaboratif.</p>
                                </div>
                            </div>
                            <div class="col-md-6 icon-box">
                                <i class="bi bi-person-bounding-box"></i>
                                <div>
                                    <h4>Profil Pengguna Personal</h4>
                                    <p>Setiap pengguna memiliki halaman profil sendiri untuk mengelola akun dan melihat
                                        ringkasan aktivitas mereka.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5 d-flex align-items-center order-1 order-xl-2" data-aos="fade-up"
                        data-aos-delay="100">
                        <img src="{{ asset('template/assets/img/alt-features.png') }}" class="img-fluid"
                            alt="">
                    </div>
                </div>
            </div>
        </section>
        <section id="team" class="team section">

            <div class="container section-title" data-aos="fade-up">
                <h2>Tim Kami</h2>
                <p>Tim solid di balik pengembangan Catat.in</p>
            </div>
            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('template/assets/img/team/dika.jpg') }}" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Mahardika</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('template/assets/img/team/team-3.jpg') }}" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Hanif</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('template/assets/img/team/eko.jpg') }}" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Eko</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('template/assets/img/team/faisa.jpg') }}" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Faisal</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('template/assets/img/team/lestari.jpg') }}" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Lestari</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('template/assets/img/team/azkia.png') }}" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Azkia</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('template/assets/img/team/dania.jpg') }}" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Dania</h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>
    </main>

    <footer id="footer" class="footer">

        <div class="container footer-top text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="d-flex flex-column align-items-center mb-3">
                        <img src="{{ asset('assets/img/logo_1.png') }}" alt="Catat.in" style="width: 60px;">
                        <span class="sitename fs-4 fw-bold mt-2">Catat.in</span>
                    </div>

                    <div class="social-links d-flex justify-content-center gap-3 mt-3">
                        <a href="#"><i class="bi bi-twitter-x fs-5"></i></a>
                        <a href="#"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#"><i class="bi bi-linkedin fs-5"></i></a>
                    </div>
                </div>
            </div>
        </div>


        <div class="copyright text-center text-sm text-muted mt-3">
            ©
            <script>
                document.write(new Date().getFullYear())
            </script>,
            made with <i class="fa fa-heart"></i> by
            <a href="{{ route('welcome') }}" class="font-weight-bold" target="_blank">Catat.in</a>
            for Nothing is impossible if you fight for it!.
        </div>

    </footer>

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('template/assets/js/main.js') }}"></script>
</body>

</html>
