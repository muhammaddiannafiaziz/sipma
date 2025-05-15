
<div class="row page-titles" style="border-radius: 0%">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" style="color: var(--primary)"><a href="dashboard" class="fs-18 font-w600 mb-5 text-nowrap"
                style="color: var(--primary)">Beranda</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)" class="fs-18 mb-5 text-nowrap">Pendaftaran Mahad</a></li>
    </ol>
</div>
<!-- <div class="row">
    <div class="col-xl-8">
        <div class="card transparent-card">
            <div class="bootstrap-carousel">
                <div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('sipenmaru/images/banner1.jpeg') }}"
                                alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('sipenmaru/images/banner2.jpeg') }}"
                                alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('sipenmaru/images/banner3.jpeg') }}"
                                alt="Second slide">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button"
                        data-bs-target="#carouselExampleIndicators2" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button"
                        data-bs-target="#carouselExampleIndicators2" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> -->
@if (auth()->user()->profile->alamat === null)
<div class="row">
    <div class="col text-center pt-3">
        <div class="dropdown-divider"></div>
        <p>Sebelum memulai pendaftaran, silakan melengkapi data profil terlebih dahulu.</p>
        <a href="{{route('profile')}}" class="btn btn-sm btn-primary btn-rounded fs-18">Lengkapi Profil</a>
    </div>
</div>
@endif
@php
$currentUsername = auth()->user()->username;
$isRegistered = $pendaftar->contains('nim', $currentUsername);
@endphp

@if (!$isRegistered && auth()->user()->profile->alamat !== null)
    <div class="alert alert-warning">Anda belum mendaftar.</div>
    <div class="pt-3">
        <a href="{{route('data-registration')}}" class="btn btn-sm btn-primary btn-rounded fs-18">Mulai Pendaftaran</a>
    </div>
@endif
@foreach ($pendaftar as $x)
    @if (auth()->user()->username == $x->nim)
        <div>
            @if ($x->status_pendaftaran == "Belum Terverifikasi")
            <!-- <button class="btn btn-warning mb-4" style="margin-bottom: 1rem;" disabled>Belum Terverifikasi</button> -->
            @elseif ($x->status_pendaftaran == "Terverifikasi")
                {{-- @if ($viewDataPembayaran->status !="Gratis" && $viewDataPembayaran->status !="Dibayar")
                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target=".upload"
                style="margin-bottom: 1rem;"><i class="mdi mdi-plus me-1"></i>Upload Pembayaran  </button>    
                @endif --}}
            {{-- <a href="https://chat.whatsapp.com/DEb9ZkYkzQ7KGbeHeU80T0"><button type="button" style="margin-bottom: 1rem;" class="btn btn-primary mb-4">Masuk Grup Whatsapp </button></a> --}}
            <div class="row">
                <div class="col text-center pt-3">
                    <div class="dropdown-divider"></div>
                    <p>Pendaftaran telah terverifikasi. Langkah selanjutnya adalah tes wawancara. Klik tombol di bawah untuk konfirmasi tes wawancara.</p>
                    <a href="https://wa.me/62818780801?text=Assalamualaikum%2C%0A%0ASaya%20{{$x->nama_siswa}}%2C%20mahasiswa%20baru%20Program%20Studi%20{{$x->prodi}}.%20Saya%20ingin%20konfirmasi%20untuk%20mengikuti%20tes%20wawancara%20Ma'had%20Al-Jami'ah.%20Dokumen%20persyaratan%20sudah%20saya%20lengkapi.%20Terima%20kasih."><button type="button" style="margin-bottom: 1rem;" class="btn btn-primary mb-4">Konfirmasi Tes Wawancara</button></a>
                </div>
            </div>
                        <!-- <button class="btn btn-success mb-4" style="margin-bottom: 1rem;" disabled>Terverifikasi</button> -->
            @elseif ($x->status_pendaftaran == "Selesai")
            <button class="btn btn-primary mb-4" style="margin-bottom: 1rem;" disabled>Selesai</button>
            @else
            <span class="badge badge-danger">Data Tidak Sah</span>
            @endif
        </div>
    @endif
@endforeach