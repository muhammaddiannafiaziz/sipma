
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:title" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:image" content="https:/fillow.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>@yield('title')</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('sipenmaru/images/logo.png') }}">

    <!-- Datatable -->
    <link href="{{ asset('sipenmaru/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!-- Print Datatable -->
    <link href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css" rel="stylesheet">

    <!-- Daterange picker -->
    <link href="{{ asset('sipenmaru/vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- Clockpicker -->
    <link href="{{ asset('sipenmaru/vendor/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
    <!-- asColorpicker -->
    <link href="{{ asset('sipenmaru/vendor/jquery-asColorPicker/css/asColorPicker.min.css') }}" rel="stylesheet">
    <!-- Material color picker -->
    <link
        href="{{ asset('sipenmaru/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"
        rel="stylesheet">

    <!-- Pick date -->
    <link rel="stylesheet" href="{{ asset('sipenmaru/vendor/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('sipenmaru/vendor/pickadate/themes/default.date.css') }}">
    <link href="../icon.css?family=Material+Icons" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ asset('sipenmaru/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sipenmaru/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('sipenmaru/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('sipenmaru/vendor/nouislider/nouislider.min.css') }}">
    <!-- SweeatAlert css -->
    <link href="{{ asset('sipenmaru/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('sipenmaru/vendor/toastr/css/toastr.min.css') }}">

    <link href="{{ asset('sipenmaru/css/style.css') }}" rel="stylesheet">

</head>

<body>
@include('sweetalert::alert')
    <!--*******************
        Preloader start
    ********************
 <div id="preloader">
  <div class="lds-ripple">
   <div></div>
   <div></div>
  </div>
 </div>-->
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{route('dashboard')}}" class="brand-logo">
                <img alt="image" width="25" src="{{ asset('sipenmaru/images/logo.png') }}">
                <div class="brand-title">
                    <h2 class="">Ma'had</h2>
                </div>
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span
                        class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header border-bottom">
            <div class="header-content">

                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                @yield('menunya')
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item d-flex align-items-center">
                                @php
                                use Carbon\Carbon;
                                $date = Carbon::now()->translatedFormat('l, d F Y');
                                    // $date = date('l, d F Y ');
                                    //$date = date('l, Y-m-d ');
                                @endphp
                                <strong>{{ $date }} &nbsp;
                                    <span id="jamServer">
                                        @php
                                            date_default_timezone_set('Asia/Jakarta');
                                            $datenow = Carbon::now()->format('H:i:s');
                                        @endphp
                                        <h6> <strong> {{ $datenow }}</strong></h6>
                                    </span>
                                </strong>

                            </li>

                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button"
                                    data-bs-toggle="dropdown">
                                    @if(auth()->user()->profile->gender == "Perempuan")
                                    <img class="avatar-lg rounded-circle img-thumbnail"
                                    src="{{ asset('sipenmaru/images/mahasantri02.png') }}" alt=""
                                        width="75px" />
                                    @elseif(auth()->user()->profile->gender == "Laki-laki")
                                    <img class="avatar-lg rounded-circle img-thumbnail"
                                    src="{{ asset('sipenmaru/images/mahasantri01.png') }}" alt=""
                                        width="75px" />
                                    @else
                                    <img class="avatar-lg rounded-circle img-thumbnail"
                                        src="{{ asset('sipenmaru/images/ava.png') }}" alt=""
                                            width="75px" />
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{route('profile')}}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                            width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ms-2">Profil </span>
                                    </a>
                                    <a href="{{route('logout')}}" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                            width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        <span class="ms-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->

        <div class="dlabnav">

            <div class="dlabnav-scroll">
                @auth
                    <div class="sidebar-user text-center">

                        <a href="{{route('profile')}}">
                                
                            @if(auth()->user()->profile->gender == "Perempuan")
                            <img class="avatar-lg rounded-circle img-thumbnail"
                            src="{{ asset('sipenmaru/images/mahasantri02.png') }}" alt=""
                                width="75px" />
                            @elseif(auth()->user()->profile->gender == "Laki-laki")
                            <img class="avatar-lg rounded-circle img-thumbnail"
                            src="{{ asset('sipenmaru/images/mahasantri01.png') }}" alt=""
                                width="75px" />
                            @else
                            <img class="avatar-lg rounded-circle img-thumbnail"
                                src="{{ asset('sipenmaru/images/ava.png') }}" alt=""
                                    width="75px" />
                            @endif
                        <div class="badge-bottom"><span class="badge badge-primary">@if (auth()->user()->role =="Administrator")
                            {{ auth()->user()->role }}
                        @else
                            Calon Santri
                        @endif
                            </span>
                        </div>
                            <h6 class="mt-3 f-14 f-w-600">

                                {{ auth()->user()->name }}

                            </h6>
                        </a>
                    </div>
                @endauth
                @section('menu')@show

                

                <div class="copyright">
                    <p><strong>Ma'had Al-Jamiah </strong> ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> All Rights Reserved</p>
                    {{-- <p class="fs-12">Made with <span class="heart"></span> by Luthfiyah Sakinah</p> --}}
                </div>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                @section('content')@show
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->




        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> <br>
                    {{-- Designed &amp; Developed by <a href="https://www.instagram.com/piaaasan/" target="_blank">Luthfiyah
                        Sakinah</a> --}}
                </p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('sipenmaru/vendor/global/global.min.js') }}"></script>

    <script src="{{ asset('sipenmaru/js/custom.min.js') }}"></script>
    <script src="{{ asset('sipenmaru/js/dlabnav-init.js') }}"></script>
    <script>
        function cardsCenter() {

            /*  testimonial one function by = owl.carousel.js */



            jQuery('.card-slider').owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                //center:true,
                slideSpeed: 3000,
                paginationSpeed: 3000,
                dots: true,
                navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 1
                    },
                    800: {
                        items: 1
                    },
                    991: {
                        items: 1
                    },
                    1200: {
                        items: 1
                    },
                    1600: {
                        items: 1
                    }
                }
            })
        }

        jQuery(window).on('load', function() {
            setTimeout(function() {
                cardsCenter();
            }, 1000);
        });

        $(document).ready(function() {
            $('.mdb-select').materialSelect();
        });
    </script>

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>

    <script>
        var serverClock = jQuery("#jamServer");
        if (serverClock.length > 0) {
            showServerTime(serverClock, serverClock.text());
        }

        function showServerTime(obj, time) {
            var parts = time.split(":"),
                newTime = new Date();

            newTime.setHours(parseInt(parts[0], 10));
            newTime.setMinutes(parseInt(parts[1], 10));
            newTime.setSeconds(parseInt(parts[2], 10));

            var timeDifference = new Date().getTime() - newTime.getTime();
            var methods = {
                displayTime: function() {
                    var now = new Date(new Date().getTime() - timeDifference);
                    obj.text([
                        methods.leadZeros(now.getHours(), 2),
                        methods.leadZeros(now.getMinutes(), 2),
                        methods.leadZeros(now.getSeconds(), 2)
                    ].join(":"));
                    setTimeout(methods.displayTime, 500);
                },

                leadZeros: function(time, width) {
                    while (String(time).length < width) {
                        time = "0" + time;
                    }
                    return time;
                }
            }
            methods.displayTime();
        }
    </script>

<script>
    $(document).on('click', '#btn-delete', function (e) {
        e.preventDefault();
        var link = $(this).attr('href');

        Swal.fire({
            title: 'Apakah Kamu Yakin Untuk Menghapus Data Tersebut?',
            text: "Kamu tidak bisa mengembalikan data ini!",
            icon: 'warning',
            showCancelButton: true,
            //confirmButtonColor: '#3085d6',
            //cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus itu!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = link;
            }
        })
    })

    $(document).on('click', '#btn-update', function (e) {
        e.preventDefault();
        var link = $(this).attr('method');

        Swal.fire({
            title: 'Do you want to save the changes?',
            icon: 'info',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.location = link;
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    })
</script>

</body>

</html>
