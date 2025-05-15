<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Pendaftaran">
    <meta name="author" content="Ma'had Al-Jami'ah">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ma'had Al-Jami'ah UIN Raden Mas Said Surkarta">
    <meta property="og:title" content="Pendaftaran Ma'had Al-Jami'ah">
    <meta property="og:description" content="Ma'had Al-Jami'ah UIN Raden Mas Said Surkarta">
    <title>SIPMA</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">

    <link href="{{ asset('sipenmaru/css/welcome.css') }}" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('sipenmaru/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      .custom-btn {
        background-color:rgb(37, 102, 68); /* hijau gelap */
        border: 2px solid #d4af37; /* warna emas */
        border-radius: 30px; /* sudut membulat */
        color:rgb(211, 255, 224); /* biru muda */
        font-weight: 600;
        padding: 5px 25px;
        font-size: 1.1rem;
        text-decoration: none;
        display: inline-block;
        transition: 0.3s;
      }
      .custom-btn:hover {
        background-color:rgb(48, 121, 82); /* hijau lebih gelap saat hover */
        color:rgb(255, 255, 255); /* biru muda lebih terang saat hover */
        text-decoration: none;
        font-size: 1.2rem;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <header class="mb-auto">
        <div class="justify-content-center">
          <img src="{{ asset('sipenmaru/images/logoatas.png')}}" alt="Cover" style="max-width: 20rem;">
        </div>
      </header>

      <main class="px-3">
        <div class="mb-2 pb-2">
            <h1>Selamat Datang</h1>
            <p class="lead">Sistem Informasi Penerimaan Santri Baru <br><b> Ma'had Al-Jami'ah (Pesantren Mahasiswa) Ronggowarsito <br>UIN Raden Mass Said Surakarta</b></p>
        </div>
        
        <div class="mt-2">
          <a href="login" class="btn btn-lg btn-outline-success fw-bold  text-white ">Masuk</a>
          <a href="https://s.id/KlikPendaftaranMahadUINSurakarta" class="btn btn-lg btn-outline-success text-white fw-bold  bg-success">Daftar</a>
        </div>
      </main>
      <div class="container mt-auto">
        <div class="row ">
          <div class="col-12 mb-2">Silakan unduh booklet dan brosur untuk mengatahui informasi lebih lanjut.</div>
          <div class="d-flex justify-content-center">
            <a href="https://s.id/PSBMahadUINSurakarta" class="btn custom-btn" target="_blank">
              s.id/PSBMahadUINSurakarta
            </a>
          </div>
        </div>
      </div>

      <footer class="mt-auto text-white-50">
        <p>&copy;2024 <a href="https://mahad.uinsaid.ac.id" class="text-white">UPT Ma'had Al-Jami'ah</a>.</p>
      </footer>
    </div>
  </body>
</html>
