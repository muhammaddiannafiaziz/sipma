@extends('master.master-admin')

@section('title')
    Ma'had
@endsection

@section('header')
@endsection

@section('navbar')
    @parent
@endsection

@section('menunya')
Detail Pendaftaran
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
            </li>
            <li>
                <a href="{{route('data-registration')}}">
                    <i class="fa fa-book"></i>
                    <span class="nav-text">Pendaftaran </span>                    
                </a>
            </li>
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
                @if ($viewData->status_pendaftaran == "Selesai")
                <li><a href="../view-announcement/{{$viewData->id_pendaftaran}}" aria-expanded="false">
                    <i class="fa fa-file"></i>
                    <span class="nav-text">Pengumuman</span>
                </a>
                @endif
            </li>
            @endif
        </ul>
    @endauth
@endsection

@section('content')
    <div class="row">
        {{ csrf_field() }}
        <div class="col-xl-12">
            <div class="custom-accordion">
                @if (auth()->user()->role == 'Administrator')
                <div class="row my-4">
                    <div class="col">
                        <div class="text-end mt-2 mt-sm-0">
                            <a href="../data-registration"><button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close </button></a>
                            @if ($viewData->status_pendaftaran =='Belum Terverifikasi')
                            <a href="../verified-registration/{{$viewData->id_pendaftaran}}"><button type="button" class="btn btn-primary">Verified</button></a>
                            @endif
                            <a href="../card-registration/{{$viewData->id_pendaftaran}}"><button type="button" class="btn btn-primary">View Card </button></a>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row-->
                @elseif(auth()->user()->role == 'Calon Santri')
                @if ($viewData->status_pendaftaran=="Belum Terverifikasi")
                <div class="alert alert-success alert-dismissible fade show">
                    <svg viewbox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                    <strong>Sukses!</strong> Data pendaftaranmu terkirim. Sebelum melakukan tes wawancara, tunggu administrator memverifikasi datamu ya.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div>
                @elseif ($viewData->status_pendaftaran=="Terverifikasi" && $viewDataPembayaran->status !="Gratis" && $viewDataPembayaran->status !="Dibayar")
                {{-- <div class="alert alert-info alert-dismissible fade show">
                    <svg viewbox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    <strong>Informasi!</strong> Segera lakukan pembayaran.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div> --}}
                @endif
                {{-- <div class="text-end">
                    <a href="../card-registration/{{$viewData->id}}"><button type="button" class="btn btn-primary">Lihat Kartu Pendaftaran </button></a>
                </div> --}}
                @endif

                <div class="card card-body">
                    <div class="card-header">
                        <h4 class="card-title">Data Pendaftaran</h4>
                        <!-- center modal -->
                        <div>
                            @if ($viewData->status_pendaftaran == "Belum Terverifikasi")
                            <button class="btn btn-warning mb-4" style="margin-bottom: 1rem;" disabled>Belum Terverifikasi</button>
                            @elseif ($viewData->status_pendaftaran == "Terverifikasi")
                                {{-- @if ($viewDataPembayaran->status !="Gratis" && $viewDataPembayaran->status !="Dibayar")
                                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target=".upload"
                                style="margin-bottom: 1rem;"><i class="mdi mdi-plus me-1"></i>Upload Pembayaran  </button>    
                                @endif --}}
                            {{-- <a href="https://chat.whatsapp.com/DEb9ZkYkzQ7KGbeHeU80T0"><button type="button" style="margin-bottom: 1rem;" class="btn btn-primary mb-4">Masuk Grup Whatsapp </button></a> --}}
                            <a href="https://wa.me/628558600091?text=Assalamualaikum%2C%0A%0ASaya%20{{$viewNamaLengkap}}%2C%20mahasiswa%20baru%20Program%20Studi%20{{$viewProgramStudi}}.%20Saya%20ingin%20konfirmasi%20untuk%20mengikuti%20tes%20wawancara%20Ma'had%20Al-Jami'ah.%20Dokumen%20persyaratan%20sudah%20saya%20lengkapi.%20Terima%20kasih."><button type="button" style="margin-bottom: 1rem;" class="btn btn-primary mb-4">Konfirmasi Tes Wawancara</button></a>
                            <button class="btn btn-success mb-4" style="margin-bottom: 1rem;" disabled>Terverifikasi</button>
                            @elseif ($viewData->status_pendaftaran == "Selesai")
                            <button class="btn btn-primary mb-4" style="margin-bottom: 1rem;" disabled>Selesai</button>
                            @else
                            <span class="badge badge-danger">Data Tidak Sah</span>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="modal fade upload" tabindex="-1" role="dialog"
                        aria-labelledby="mySmallModalLabel" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Kirim bukti pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('upload-payment')}}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="userid" value="{{ auth()->user()->id}}">
                                        <div class="form-group">
                                            <input type="hidden" name="id_pendaftaran" id="nama" class="form-control"
                                            value="{{ $viewData->id_pendaftaran }}">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <label for="iduser">Pilih Dokumen</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Upload</span>
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input form-control"
                                                                        name="pem" >
                                                                    <input type="hidden" class="form-file-input form-control"
                                                                        name="pathnya">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top-0 d-flex">
                                            <button type="button" class="btn btn-danger light"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" name="add"
                                                class="btn btn-primary">Perbaharui
                                                Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal --> --}}
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row mb-2">
                                    <div class="pt-4 border-bottom-1 pb-3">
                                        <h4 class="text-primary"><b>PROFIL MAHASISWA</b></h4>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="pt-2 border-bottom-1 pb-3">
                                            <img src="{{ asset($viewData->pas_foto) }}" height="300" alt="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">ID Pendaftaran</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewData->id_pendaftaran }}</h5>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">Nama</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewData->nama_siswa }}</h5>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">NIM</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewData->nim }}</h5>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">Program Studi</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewData->prodi }}</h5>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">Jenis Kelamin</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewDataProfil->gender }}</h5>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">TTL</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewData->tempat_lahir }}, {{ $viewData->tanggal_lahir }}</h5>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">Agama</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewDataProfil->agama }}</h5>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">Alamat</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewDataProfil->jalan }}, {{ $viewDataProfil->kelurahan }}, {{ $viewDataProfil->kecamatan }}, {{ $viewDataProfil->kabupaten }}, {{ $viewDataProfil->provinsi }}</h5>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">Email</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewDataProfil->email }}</h5>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">Telepon/WhatsApp</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewDataProfil->no_hp }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4 border-bottom-1 pb-3">
                            <h4 class="text-primary"><b>ORANG TUA / WALI</b></h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">Nama Lengkap</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewDataProfil->nama_ortu }}</h5>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">Pekerjaan</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewDataProfil->pekerjaan_ortu }}</h5>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">Pendidikan</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewDataProfil->pendidikan_ortu }}</h5>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">No Handphone</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewDataProfil->nohp_ortu }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-bottom-1 pb-3">
                            <h4 class="text-primary"><b>PENDIDIKAN</b></h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">Asal Sekolah</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewData->asal_sekolah }}</h5>
                                    </div>
                                    @if( $viewData->pernah_mondok == 'pernah' )
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">Nama Pesantren</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewData->nama_pondok }}</h5>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">Lama</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewData->lama }}</h5>
                                    </div>
                                    @endif
                                    @if( $viewData->prestasi !== null )
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-400">Prestasi</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <h5 class="f-w-500">: {{ $viewData->prestasi }}</h5>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-6 col-6">
                                @if ($viewData->berkas_siswa != null)
                                    <div class="pt-4 border-bottom-1 pb-3">
                                        <h4 class="text-primary"><b>BERKAS PENDAFTARAN</b></h4>
                                    </div>
                                    <div class="col-sm-9 col-7">
                                        <a href="{{ asset($viewData->berkas_siswa) }}"> <i class="fa fa-file-pdf" style="font-size:48px;color:red"></i></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row-->
            </div>
        </div>
        <!-- end row -->
    @endsection

    @section('footer')
    @endsection