@extends('master.master-admin')

@section('title')
    Pendaftaran Mahad
@endsection

@section('header')
@endsection

@section('navbar')
    @parent
@endsection


@section('menunya')
    Beranda
@endsection

@section('menu')
    @auth
        <ul class="metismenu" id="menu">
            <li class="mm-active"><a href="dashboard">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Beranda</span>
                </a>
            </li>
            @if (auth()->user()->role == 'Administrator')
            <li><a href="{{route('data-user')}}">
                <i class="fa fa-users"></i>
                <span class="nav-text">Data User </span>
            </a>
            </li>
            <li>
                <a href="{{route('data-registration')}}">
                    <i class="fa fa-book"></i>
                    <span class="nav-text">Pendaftaran </span>                    
                </a>
            </li>
            <li>
                <a href="{{ route('tahun-akademik') }}">
                    <i class="fas fa-calendar-alt"></i> 
                    <span class="nav-text">Tahun Akademik</span>
                </a>
            </li>
            <li>
                <a href="{{ route('gelombang') }}">
                    <i class="fas fa-layer-group"></i> 
                    <span class="nav-text">Gelombang</span>
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
                <li><a href="{{route('data-registration')}}" aria-expanded="false">
                    <i class="fa fa-database"></i>
                        <span class="nav-text">Pendaftaran</span>
                    </a>
                </li>
                @foreach($pendaftar as $x)
                @if (auth()->user()->username == $x->nim)
                @if ($x->status_pendaftaran == "Selesai")
                <li><a href="view-announcement/{{ $x->id_pendaftaran }}" aria-expanded="false">
                        <i class="fa fa-file"></i>
                        <span class="nav-text">Pengumuman</span>
                    </a>
                </li>
                @endif
                @endif
                @endforeach
            @endif
            <!--<li><a href="#" aria-expanded="false">
                    <i class="fa fa-download"></i>
                    <span class="nav-text">Pusat Unduhan</span>
                </a>
            </li>-->
        </ul>
    @endauth
@endsection

@section('content')
    @auth
        @if (auth()->user()->role == 'Administrator')
            @include('dashboard.dashboard-admin')
        @elseif(auth()->user()->role == 'Calon Santri')
            @include('dashboard.dashboard-user')
        @endif
    @endauth
@endsection

@section('footer')
@endsection
