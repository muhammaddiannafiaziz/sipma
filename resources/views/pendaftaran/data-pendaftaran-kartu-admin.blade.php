@extends('master.master-admin')

@section('title')
    Kartu Peserta
@endsection

@section('header')
@endsection

@section('navbar')
    @parent
@endsection

@section('menunya')
    Kartu Pendaftaran
@endsection

@section('menu')
@auth
<ul class="metismenu" id="menu">
    <li><a href="{{route('dashboard')}}">
            <i class="fas fa-home"></i>
            <span class="nav-text">Beranda</span>
        </a>
    </li>
    @if (auth()->user()->role == 'Administrator')
    <li><a href="{{route('data-user')}}">
        <i class="fa fa-users"></i>
        <span class="nav-text">Data User </span>
    </a>
        {{-- <a class="has-arrow" href="javascript:void()" aria-expanded="false">
            <i class="fa fa-book"></i>
            <span class="nav-text">Data Master </span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{route('data-user')}}">Pengguna</a></li>
            <li><a href="{{route('data-sekolah')}}">Sekolah</a></li>
            <li><a href="{{route('data-prodi')}}">Program Studi</a></li>
            <li><a href="{{route('data-jadwal')}}">Jadwal Kegiatan</a></li>
        </ul> --}}
    </li>
    <li>
        <a href="{{route('data-registration')}}">
            <i class="fa fa-book"></i>
            <span class="nav-text">Pendaftaran </span>                    
        </a>
    </li>
    {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
        <i class="fa fa-database"></i>
        <span class="nav-text">Data Transaksi</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{route('data-registration')}}">Pendaftaran</a></li>
            <li><a href="{{route('data-pembayaran')}}">Pembayaran</a></li>
        </ul>
    </li> --}}
    <li><a href="{{route('data-pengumuman')}}" aria-expanded="false">
            <i class="fa fa-file"></i>
            <span class="nav-text">Pengumuman</span>
        </a>
    </li>
    <li>
        <a href="{{route('data-pembayaran')}}">
            <i class="fa fa-wallet"></i>
            <span class="nav-text">Pembayaran</span>
        </a>
    </li>
    @else
    <li class="mm-active"><a href="{{route('data-registration')}}" aria-expanded="false">
        <i class="fa fa-database"></i>
            <span class="nav-text">Pendaftaran</span>
        </a>
    </li>
    @endif
</ul>
@endauth
@endsection

@section('content')
    <div class="row">
        <form action="/update-registration/{{ $viewData->id_pendaftaran }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="col-xl-12">
                <div class="card card-body" id="cetak" style="margin-bottom: -1rem">
                    <div class="p-2">
                        <div class="d-flex">
                            <div class="col-lg-3 mr-2" style="text-align: center; margin-right:25px; margin-left:25px;">
                                <img width="110px" src="{{ asset('sipenmaru/images/logo.png') }}" alt="">
                            </div>
                            <div class="col-lg-6">
                                <center>
                                    <label class="form-label" style="margin-top: -0.5rem"><strong class="d-block">KARTU
                                            PESERTA</strong></label>
                                    <h5 style="margin-top: -0.5rem"> <strong class="d-block">SELEKSI PENERIMAAN SANTRI</strong></h4>
                                        <h4 style="margin-top: -0.5rem"><strong class="d-block">MA'HAD AL-JAMI'AH</strong></h3>
                                        <h4 style="margin-top: -0.5rem"><strong class="d-block">UIN RADEN MAS SAID SURAKARTA</strong></h3>
                                            {{-- <p style="margin-top: -0.5rem"><strong class="d-block">Kembangkuning, Kec. Jatiluhur, Kabupaten
                                                Purwakarta, Jawa Barat <br> 41152</strong></p> --}}
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="margin-bottom: -4rem;">
                        <div class="p-4" style="border-top: 2px solid black!important; margin-top:-2.5rem;">
                            <div class="d-flex">
                                <div class="col-lg-4" style="text-align: center; margin-right:25px;">
                                    <img src="{{ asset($viewData->pas_foto) }}" width="210px" height="280" alt="">
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 mb-4">
                                        <h4><strong>DATA PESERTA</strong></h4><br>
                                        <strong>NOMOR PESERTA</strong><br>
                                        <h5 style="text-indent: 0.5in"><strong>{{ $viewData->id_pendaftaran }}</strong>
                                        </h5>
                                        <strong>NIM</strong><br>
                                        <h5 style="text-indent: 0.5in"><strong>{{ $viewData->nim }}</strong></h5>
                                        <strong>NAMA PESERTA</strong><br>
                                        <h5 style="text-indent: 0.5in"><strong>{{ $viewData->nama_siswa }}</strong></h5>
                                        <strong>TANGGAL LAHIR</strong><br>
                                        <h5 style="text-indent: 0.5in"><strong>{{ $viewData->tanggal_lahir }}</strong>
                                        </h5>
                                        <strong>ASAL SEKOLAH</strong><br>
                                        <h5 style="text-indent: 0.5in"><strong>{{ $viewDataProfil->sekolah_sma }}</strong></h5>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="mb-4">
                                <h4><strong>PERNYATAAN</strong></h4>
                                <h5 style="text-indent: 0.5in;text-align: justify;">Saya yang menyatakan bahwa data yang
                                    saya isikan dalam formulir pendaftaran penerimaan santri Ma'had Al-Jami'ah UIN Raden Mas Said 
                                    Surakarta tahun 2024 adalah benar dan saya bersedia menerima ketentuan yang berlaku. Saya
                                    bersedia menerima sanksi pembatalan penerimaan apabila melanggar pernyataan ini.</h5>
                            </div>
                            <div class="d-flex">
                                <div class="col-lg-6" style="width:50%; text-align: right; margin:15px;">
                                    {{-- <img width="150px" src="{{ asset('sipenmaru/images/qr.png') }}" alt=""> --}}
                                </div>
                                <div class="col-lg-6" style="width:50%;">
                                    <br>
                                    <center>
                                        <h5><label class="form-label"><strong
                                                    class="d-block">...............................,2024</strong></label>
                                        </h5>
                                        <br>
                                        <p style="color: rgb(156, 156, 156)">ttd</p>
                                        <br>
                                        <h5><strong class="d-block">{{ $viewData->nama_siswa }}</strong></h5>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col">
                    <div class="text-end mt-2 mt-sm-0">
                        <button class="btn btn-success waves-effect waves-light me-1" onclick="printDiv('cetak')"><i
                                class="fa fa-print"> </i></button>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row-->
        </form>
    </div>
    <!-- end row -->
@endsection

@section('footer')
@endsection
