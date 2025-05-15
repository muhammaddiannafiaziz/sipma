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
    Tahun Akademik
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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Kelola Tahun Akademik</h4>
                    </div>
                    <div class="card-body" id="cetak">
                        <div class="table-responsive">
                            {{ csrf_field() }}
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tahun Akademik</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $ta)
                                    <tr>
                                        <td>{{ $ta->id }}</td>
                                        <td><strong>{{ $ta->tahun }}</strong></td>
                                        <td>{{ $ta->tanggal_mulai }}</td>
                                        <td>{{ $ta->tanggal_selesai }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if ($ta->status == 'open')
                                                    <span class="badge badge-primary">Dibuka<span
                                                            class="ms-1 fa fa-check"></span>
                                                    @elseif($ta->status == 'closed')
                                                        <span class="badge badge-danger">Ditutup<span
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
                                                                href="/sipma/open-tahun-akademik/{{ $ta->id }}">Dibuka</a>
                                                            <a class="dropdown-item"
                                                            href="/sipma/close-tahun-akademik/{{ $ta->id }}">Ditutup</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{{ route('delete-tahun-akademik', $ta->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus tahun akademik ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                    <form action="{{ route('save-tahun-akademik') }}" method="POST">
                                    @csrf
                                        <td>ID</td>
                                        <td>
                                            <input type="text" class="form-control" id="tahun" name="tahun" required>
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
        </div>
    @endif
    @endauth
@endsection