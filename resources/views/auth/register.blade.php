<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PSB Ma'had Al-Jami'ah">
    <meta property="og:title" content="PSB Ma'had Al-Jami'ah">
    <meta property="og:description" content="PSB Ma'had Al-Jami'ah">

    <!-- PAGE TITLE HERE -->
    <title>Daftar</title>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('sipenmaru/images/logo.png') }}">
    <link href="{{ asset('sipenmaru/vendor/login/style.css') }}" rel="stylesheet">

</head>

<body>
    @include('sweetalert::alert')
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">              
                <form method="POST" action="/register" class="sign-up-form">
                    @csrf
                    @if (session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <svg viewbox="0 -6 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                            <strong>Peringatan!</strong> {{session('loginError')}}
                        </div>
                    @endif
                    @error('name')
                        <div class="alert alert-warning alert-dismissible fade show">
                            <svg viewbox="0 -6 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                            <strong>Peringatan!</strong> {{ $message }}
                        </div>
                    @enderror
                    @error('email')
                        <div class="alert alert-warning alert-dismissible fade show">
                            <svg viewbox="0 -6 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                            <strong>Peringatan!</strong> {{ $message }}
                        </div>
                    @enderror
                    @error('password')
                        <div class="alert alert-warning alert-dismissible fade show">
                            <svg viewbox="0 -6 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                            <strong>Peringatan!</strong> {{ $message }}
                        </div>
                    @enderror
                    @error('password_confirmation')
                        <div class="alert alert-warning alert-dismissible fade show">
                            <svg viewbox="0 -6 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                            <strong>Peringatan!</strong> {{ $message }}
                        </div>
                    @enderror
                    <h2 class="title">Daftar</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nama Lengkap" name="name" value="{{ old('name') }}" autocomplete='off' />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete='off'/>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Kata Sandi" name="password" autocomplete='off' />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Ulangi Kata Sandi" name="password_confirmation" autocomplete='off' />
                    </div>
                    <input type="submit" class="btn" value="DAFTAR" />
                
                </form>      
            </div>
        </div>
    </div>
    <!--<script src="{{ asset('sipenmaru/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('sipenmaru/vendor/login/appjs') }}"></script>
    <script src="{{ asset('sipenmaru/js/custom.min.js') }}"></script>
    <script src="{{ asset('sipenmaru/js/dlabnav-init.js') }}"></script>-->
 <script src="{{ asset('sipenmaru/js/styleSwitcher.js') }}"></script>
    <script src="{{ asset('sipenmaru/vendor/login/app.js') }}"></script>
</body>

</html>
