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
    Pendaftaran
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
                    <!-- Menu Tahun Akademik -->
                <li>
                    <a href="{{ route('tahun-akademik') }}">
                        <i class="fas fa-calendar-alt"></i> 
                        <span class="nav-text">Tahun Akademik</span>
                    </a>
                </li>

                <!-- Menu Gelombang -->
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
                @foreach($viewData as $x)
                @if (auth()->user()->username == $x->nim)
                @if ($x->status_pendaftaran == 'Selesai')
                <li><a href="view-announcement/{{ $x->id_pendaftaran }}" aria-expanded="false">
                        <i class="fa fa-file"></i>
                        <span class="nav-text">Pengumuman</span>
                    </a>
                </li>
                @endif
                @endif
                @endforeach
            @endif
        </ul>
    @endauth
@endsection

@section('content')
    <!--ADMIn-->
    @auth
        @if (auth()->user()->role == 'Administrator')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Pendaftar</h4>

                            <!-- center modal -->
                            <div>
                                <button class="btn btn-info waves-effect waves-light mb-4" onclick="printDiv('cetak')"><i
                                        class="fa fa-print"> </i></button>
                                <a href="form-registration"><button type="button" class="btn btn-primary mb-4"
                                        style="margin-bottom: 1rem;"><i class="mdi mdi-plus me-1"></i>Tambah
                                        Pendaftaran</button></a>
                            </div>
                        </div>
                        <div class="card-body" id="cetak">
                            <div class="table-responsive">
                                {{ csrf_field() }}

                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Peserta</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($viewData as $x)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td><a href="detail-registration/{{ $x->id_pendaftaran }}">{{ $x->id_pendaftaran }}</a></td>
                                                <td>{{ $x->nama_siswa }}</td>
                                                <td>{{ $x->gender }}</td>
                                                <td><strong>{{ $x->tgl_pendaftaran }}</strong></a></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            @if ($x->status_pendaftaran == 'Terverifikasi')
                                                                <span class="badge badge-success">Terverifikasi<span
                                                                        class="ms-1 fa fa-check"></span>
                                                                @elseif($x->status_pendaftaran == 'Belum Terverifikasi')
                                                                    <span class="badge badge-warning">Belum <br> Terverifikasi
                                                                        <br><span class="ms-1 fas fa-stream"></span>
                                                                    @elseif($x->status_pendaftaran == 'Selesai')
                                                                        <span class="badge badge-primary">Selesai<span
                                                                                class="ms-1 fa fa-check"></span>
                                                                        @else
                                                                            <span class="badge badge-danger">Not Found<span
                                                                                    class="ms-1 fa fa-ban"></span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="dropdown text-sans-serif">
                                                                <button
                                                                    class="btn btn-primary tp-btn-light sharp" type="button"
                                                                    id="order-dropdown-7" data-bs-toggle="dropdown"
                                                                    data-boundary="viewport" aria-haspopup="true"
                                                                    aria-expanded="false"><span><svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            width="18px" height="18px" viewbox="0 0 24 24"
                                                                            version="1.1">
                                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                                fill-rule="evenodd">
                                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                                <circle fill="#000000" cx="5" cy="12" r="2">
                                                                                </circle>
                                                                                <circle fill="#000000" cx="12" cy="12" r="2">
                                                                                </circle>
                                                                                <circle fill="#000000" cx="19" cy="12" r="2">
                                                                                </circle>
                                                                            </g>
                                                                        </svg></span></button>
                                                                <div class="dropdown-menu dropdown-menu-end border py-0"
                                                                    aria-labelledby="order-dropdown-7">
                                                                    <div class="py-2">
                                                                        <a class="dropdown-item"
                                                                            href="/sipma/verified-registration/{{ $x->id_pendaftaran }}">Terverifikasi</a>
                                                                            <a class="dropdown-item"
                                                                            href="/sipma/notverified-registration/{{ $x->id_pendaftaran }}">Belum
                                                                            Terverifikasi</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a
                                                                            class="dropdown-item text-success"
                                                                            href="/sipma/finish-registration/{{ $x->id_pendaftaran }}">Selesai
                                                                            </a>
                                                                    </div>
                                                                        <div class="dropdown-divider"></div><a
                                                                            class="dropdown-item text-danger"
                                                                            href="/sipma/invalid-registration/{{ $x->id_pendaftaran }}">Tidak
                                                                            Sah</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a class="btn btn-secondary shadow btn-xs sharp me-1"
                                                            title="Detail Registration"
                                                            href="detail-registration/{{ $x->id_pendaftaran }}"><i
                                                                class="fa fa-file-alt"></i></a>
                                                        <a class="btn btn-primary shadow btn-xs sharp me-1" title="Edit"
                                                            href="edit-registration/{{ $x->id_pendaftaran }}"><i
                                                                class="fa fa-pencil-alt"></i></a>
                                                        <a class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".delete{{ $x->id_pendaftaran }}"></i></a>
                                                        <div class="modal fade delete{{ $x->id_pendaftaran }}" tabindex="-1"
                                                            role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Hapus Data</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center"><i
                                                                            class="fa fa-trash"></i><br> Anda yakin ingin
                                                                        menghapus data ini?<br>{{ $x->id_pendaftaran }}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger light"
                                                                            data-bs-dismiss="modal">Batalkan</button>
                                                                        <a
                                                                            href="delete-registration/{{ $x->id_pendaftaran }}">
                                                                            <button type="submit" class="btn btn-danger shadow">
                                                                                Ya, Hapus Data!
                                                                            </button></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(auth()->user()->role == 'Calon Santri')

            <div class="project-page d-flex justify-content-between align-items-center flex-wrap">
                <div class="project mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#AllStatus" role="tab">Semua Pendaftaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#OnProgress" role="tab">Sedang Berjalan</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Finish" role="tab">Selesai/Lihat
                                Pengumuman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Closed" role="tab">Dibatalkan</a>
                        </li>
                    </ul>
                </div>
                <div class="mb-4">
                    @php
                        $no = 0;
                        $user = auth()->user();
                        $profile = $user->profile;
                    @endphp
                
                    @foreach ($viewData as $x)
                        @if ($user->username == $x->nim)
                            @php
                                $no++;
                            @endphp
                        @endif
                    @endforeach
                
                    @if (is_null($profile->no_hp) || is_null($profile->tempat_lahir) || is_null($profile->gender))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                <line x1="12" y1="9" x2="12" y2="13"></line>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg>
                            <strong>Peringatan!</strong> Data belum lengkap. Silahkan lengkapi data profil sekarang.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                        </div>
                        <div class="row">
                            <div class="col text-center pt-3">
                                <div class="dropdown-divider"></div>
                                <p>Sebelum memulai pendaftaran, silakan melengkapi data profil terlebih dahulu.</p>
                                <a href="{{route('profile')}}" class="btn btn-sm btn-primary btn-rounded fs-18">Lengkapi Profil</a>
                            </div>
                        </div>
                    @elseif ($no == 0)
                        <a href="form-registration" class="btn btn-primary btn-rounded fs-18">Mulai Pendaftaran</a>
                    @endif
                </div>
                
            </div>
            @php
                $no = 0;
            @endphp
            @foreach ($viewData as $x)
                @if (auth()->user()->username == $x->nim)
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="AllStatus">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-xl-4  col-lg-6 col-sm-12 align-items-center mt-3 customers">
                                                    <span class="text-primary d-block fs-18 font-w500 mb-1"
                                                        style="margin-top: -1.5rem"><strong>{{ $x->id_pendaftaran }}</strong>
                                                    </span>
                                                    <span class="d-block mb-lg-0 mb-0 fs-16"><i
                                                            class="fas fa-calendar me-3"></i>Didaftarkan tanggal
                                                        {{ $x->tgl_pendaftaran }}</span>
                                                </div>
                                                <div class="col-xl-3  col-lg-3 col-sm-4  col-6 mb-3">
                                                    <div class="d-flex project-image">
                                                        <img src="{{ url('/' . $x->pas_foto) }}" alt="">
                                                        <div>
                                                            <small class="d-block fs-16 font-w400"
                                                                style="margin-top: -1rem"><strong>Pendaftar</strong></small>
                                                            <span class="fs-18 font-w500">{{ $x->nama_siswa }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2  col-lg-6 col-sm-4 mb-sm-3 mb-3 text-end">
                                                    <div class="d-flex justify-content-end project-btn">
                                                        @if ($x->status_pendaftaran == 'Belum Terverifikasi')
                                                            <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                class=" btn bgl-warning text-warning fs-16 font-w600">Belum <br>
                                                                Terverifikasi</a>
                                                        @elseif ($x->status_pendaftaran == 'Terverifikasi')
                                                            <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                class=" btn bgl-warning text-success fs-16 font-w600">Terverifikasi</a>
                                                        @elseif ($x->status_pendaftaran == 'Selesai')
                                                            <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                class=" btn bgl-warning text-success fs-16 font-w600">Selesai</a>
                                                        @else
                                                            <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                class=" btn bgl-warning text-danger fs-16 font-w600">Tidak
                                                                Sah</a>
                                                        @endif
                                                        <div class="dropdown ms-4  mt-auto mb-auto">
                                                            <div class="btn-link" data-bs-toggle="dropdown">
                                                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                        stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                    <path
                                                                        d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                        stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                    <path
                                                                        d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                        stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item"
                                                                    href="detail-registration/{{ $x->id_pendaftaran }}">Lihat
                                                                    Selengkapnya</a>
                                                                @if ($x->status_pendaftaran == 'Selesai')
                                                                    <a class="dropdown-item"
                                                                    href="view-announcement/{{ $x->id_pendaftaran }}">Lihat
                                                                    Pengumuman</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="OnProgress">
                                    @if ($x->status_pendaftaran == 'Belum Terverifikasi' || $x->status_pendaftaran == 'Terverifikasi')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-xl-4  col-lg-6 col-sm-12 align-items-center customers">
                                                        <span class="text-primary d-block fs-18 font-w500 mb-1"
                                                            style="margin-top: -1.5rem"><strong>{{ $x->id_pendaftaran }}</strong></span>
                                                        <span class="d-block mb-lg-0 mb-0 fs-16"><i
                                                                class="fas fa-calendar me-3"></i>Didaftarkan tanggal
                                                            {{ $x->tgl_pendaftaran }}</span>
                                                    </div>
                                                    <div class="col-xl-3  col-lg-3 col-sm-4  col-6 mb-3">
                                                        <div class="d-flex project-image">
                                                            <img src="{{ url('/' . $x->pas_foto) }}" alt="">
                                                            <div>
                                                                <small class="d-block fs-16 font-w400"
                                                                    style="margin-top: -1rem"><strong>Pendaftar</strong></small>
                                                                <span class="fs-18 font-w500">{{ $x->nama_siswa }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-2  col-lg-6 col-sm-4 mb-sm-3 mb-3 text-end">
                                                        <div class="d-flex justify-content-end project-btn">
                                                            @if ($x->status_pendaftaran == 'Belum Terverifikasi')
                                                                <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                    class=" btn bgl-warning text-warning fs-16 font-w600">Belum
                                                                    <br> Terverifikasi</a>
                                                            @elseif ($x->status_pendaftaran == 'Terverifikasi')
                                                                <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                    class=" btn bgl-warning text-success fs-16 font-w600">Terverifikasi</a>
                                                            @endif
                                                            <div class="dropdown ms-4  mt-auto mb-auto">
                                                                <div class="btn-link" data-bs-toggle="dropdown">
                                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                        href="detail-registration/{{ $x->id_pendaftaran }}">Lihat
                                                                        Selengkapnya</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endif

                                </div>
                                <div class="tab-pane fade" id="Finish">
                                    @if ($x->status_pendaftaran == 'Selesai')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-xl-4  col-lg-6 col-sm-12 align-items-center customers">
                                                        <span class="text-primary d-block fs-18 font-w500 mb-1"
                                                            style="margin-top: -1.5rem">{{ $x->id_pendaftaran }}</span>
                                                        <span class="d-block mb-lg-0 mb-0 fs-16"><i
                                                                class="fas fa-calendar me-3"></i>Didaftarkan tanggal
                                                            {{ $x->tgl_pendaftaran }}</span>
                                                    </div>
                                                    <div class="col-xl-3  col-lg-3 col-sm-4  col-6 mb-3">
                                                        <div class="d-flex project-image">
                                                            <img src="{{ url('/' . $x->pas_foto) }}" alt="">
                                                            <div>
                                                                <small class="d-block fs-16 font-w400"
                                                                    style="margin-top: -1rem">Pendaftar</small>
                                                                <span class="fs-18 font-w500">{{ $x->nama_siswa }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-2  col-lg-6 col-sm-4 mb-sm-3 mb-3 text-end">
                                                        <div class="d-flex justify-content-end project-btn">
                                                            <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                class=" btn bgl-warning text-success fs-16 font-w600">Selesai</a>
                                                            <div class="dropdown ms-4  mt-auto mb-auto">
                                                                <div class="btn-link" data-bs-toggle="dropdown">
                                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                        href="detail-registration/{{ $x->id_pendaftaran }}">Lihat
                                                                        Selengkapnya</a>
                                                                    <a class="dropdown-item"
                                                                        href="view-announcement/{{ $x->id_pendaftaran }}">Lihat
                                                                        Hasil Seleksi</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="Closed">
                                    @if ($x->status_pendaftaran == 'Tidak Sah')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-xl-4  col-lg-6 col-sm-12 align-items-center customers">
                                                        <span class="text-primary d-block fs-18 font-w500 mb-1"
                                                            style="margin-top: -1.5rem">{{ $x->id_pendaftaran }}</span>
                                                        <span class="d-block mb-lg-0 mb-0 fs-16"><i
                                                                class="fas fa-calendar me-3"></i>Didaftarkan tanggal
                                                            {{ $x->tgl_pendaftaran }}</span>
                                                    </div>
                                                    <div class="col-xl-3  col-lg-3 col-sm-4  col-6 mb-3">
                                                        <div class="d-flex project-image">
                                                            <img src="{{ url('/' . $x->pas_foto) }}" alt="">
                                                            <div>
                                                                <small class="d-block fs-16 font-w400"
                                                                    style="margin-top: -1rem">Pendaftar</small>
                                                                <span class="fs-18 font-w500">{{ $x->nama_siswa }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-2  col-lg-6 col-sm-4 mb-sm-3 mb-3 text-end">
                                                        <div class="d-flex justify-content-end project-btn">
                                                            <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                class=" btn bgl-warning text-danger fs-16 font-w600">Tidak
                                                                Sah</a>
                                                            <div class="dropdown ms-4  mt-auto mb-auto">
                                                                <div class="btn-link" data-bs-toggle="dropdown">
                                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                        href="detail-registration/{{ $x->id_pendaftaran }}">Lihat
                                                                        Selengkapnya</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                @php
                                    $no = $no + 1;
                                @endphp
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach
            @if ($no == 0)
            @if (auth()->user()->profile->no_hp == null || auth()->user()->profile->tempat_lahir == null || auth()->user()->profile->gender == null ||  auth()->user()->profile->prestasi == null)
            @else
                <div class="alert alert-primary alert-dismissible alert-alt fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                    <strong>Haii!</strong> Kamu belum melakukan pendaftaran silahkan daftar dan ikuti proses kegiatannya ya.
                </div>
            @endif
            @endif
        @endif
    @endauth
@endsection

@section('footer')
@endsection
