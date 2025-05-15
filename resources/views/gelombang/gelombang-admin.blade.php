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
    Gelombang
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
                @foreach($data as $x)
                @if (auth()->user()->username == $x->nim)
                @if ($x->status == 'Selesai')
                <li><a href="view-announcement/{{ $x->id }}" aria-expanded="false">
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
    @auth
    @if (auth()->user()->role == 'Administrator')
    <div class="row">
        <div class="col-12">
            <div class="container mt-4">
                <h2>Kelola Gelombang</h2>
                {{-- Pesan sukses atau error --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                
                <div class="table-responsive">
                    {{ csrf_field() }}
                    <!-- Tabel Daftar Gelombang -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tahun Akademik</th>
                                <th>Nomor Gelombang</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gelombangs as $gelombang)
                                <tr>
                                    <td>{{ $gelombang->id }}</td>
                                    <td>
                                        @foreach ($tahunakademik as $ta)
                                            @if ($ta->id == $gelombang->tahun_akademik_id)
                                                {{ $ta->tahun }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $gelombang->nomor_gelombang }}</td>
                                    <td>{{ $gelombang->tanggal_mulai }}</td>
                                    <td>{{ $gelombang->tanggal_selesai }}</td>
                                    <td>
                                        @if ($gelombang->status == 'open')
                                        <span class="badge badge-primary">Dibuka<span
                                                class="ms-1 fa fa-check"></span>
                                        @elseif($gelombang->status == 'closed')
                                            <span class="badge badge-danger">Ditutup<span
                                                class="ms-1 fa fa-check"></span>
                                        @else
                                            <span class="badge badge-danger">Not Found<span
                                                class="ms-1 fa fa-ban"></span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            @if($gelombang->status == 'closed')
                                            <a href="{{ route('open-gelombang', $gelombang->id) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-lock-open"></i> Buka
                                            </a>
                                            @else
                                            <a href="{{ route('close-gelombang', $gelombang->id) }}" class="btn btn-danger btn-sm">
                                                <i class="fas fa-lock"></i> Tutup
                                            </a>
                                            @endif
                                            <a href="{{ route('delete-gelombang', $gelombang->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus gelombang ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <form action="{{ route('save-gelombang') }}" method="POST">
                                @csrf
                                    <td>ID</td>
                                    <td>
                                        <select class="form-control" id="tahun_akademik_id" name="tahun_akademik_id" required>
                                            @foreach ($tahunaktif as $tak)
                                                <option value="{{$tak->id}}">{{$tak->tahun}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="nomor_gelombang" name="nomor_gelombang" required>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                                    </td>
                                    <td>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="open">Dibuka</option>
                                            <option value="closed">Ditutup</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endauth

@endsection