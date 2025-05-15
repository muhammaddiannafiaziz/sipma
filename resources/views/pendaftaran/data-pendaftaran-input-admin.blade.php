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
    Form Pendaftaran
@endsection

@section('menu')
    @auth
        <ul class="metismenu" id="menu">
            <li><a href="{{ route('dashboard') }}">
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
                <li class="mm-active"><a href="{{ route('data-registration') }}" aria-expanded="false">
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
        <form action="save-registration" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="userid" value="{{ auth()->user()->id }}">
            <div class="col-xl-12">
                <div class="custom-accordion">
                    <div class="card">
                        <a href="#personal-data" class="text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">BIODATA</h5>
                                    </div>
                                    <div class="flex-shrink-0"> <i
                                        class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div id="personal-data" class="collapse show">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nim">NIM</label>
                                            <input type="text" class="form-control" id="personal-data-nim"
                                                name="nim" placeholder="{{ auth()->user()->username }}" value="{{ auth()->user()->username }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-prodi">Program Studi</label>
                                            <input type="text" class="form-control" id="personal-data-prodi" name="prodi"
                                                placeholder="{{ auth()->user()->profile->prodi }}" value="{{ auth()->user()->profile->prodi }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-name">Nama</label>

                                            @if ( auth()->user()->profile->nama  != null)
                                                <input type="text" class="form-control" id="basicpill" name="nama"
                                                    placeholder="Masukkan Nama Lengkap" value="{{ auth()->user()->profile->nama }}" readonly>
                                            @else
                                                <input type="text" class="form-control" id="personal-data-name"
                                                    name="nama" placeholder="Masukkan Nama Lengkap"
                                                    value="{{ old('nama') }}" required>
                                            @endif
                                            @error('nama')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-gender">Jenis
                                                Kelamin</label>
                                            <input type="text" class="form-control" id="basicpill" name="jk"
                                                placeholder="{{ auth()->user()->profile->gender }}" value="{{ auth()->user()->profile->gender }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4 mb-lg-0">
                                            <label class="form-label">Tempat lahir</label>
                                            @if (auth()->user()->profile->tempat_lahir != null)
                                                <input type="text" class="form-control" id="basicpill"
                                                    name="tempatlahir" placeholder="Masukkan Tempat Lahir"
                                                    value="{{ auth()->user()->profile->tempat_lahir }}" readonly>
                                            @else
                                                <input type="text" class="form-control" id="basicpill"
                                                    name="tempatlahir" placeholder="Masukkan Tempat Lahir"
                                                    value="{{ old('tempatlahir') }}" required>
                                            @endif
                                            @error('tempatlahir')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4 mb-lg-0">
                                            <label class="form-label" for="billing-city">Tanggal lahir</label>
                                            @if (auth()->user()->profile->tanggal_lahir != null)
                                                <input type="date" class="form-control" id="basicpill"
                                                    name="tanggallahir" placeholder="Masukkan Tanggal Lahir"
                                                    value="{{ auth()->user()->profile->tanggal_lahir }}" readonly>
                                            @else
                                                <input type="date" class="form-control" id="basicpill"
                                                    name="tanggallahir" placeholder="Masukkan Tanggal Lahir"
                                                    value="{{ old('tanggallahir') }}" required>
                                            @endif
                                            @error('tanggallahir')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <!--<input name="tanggallahir" class="datepicker-default form-control" id="datepicker" >-->
                                        </div>
                                    </div>
                                    <div class="mb-4 mt-3">
                                        <label class="form-label" for="billing-address">Alamat</label>

                                        @if (auth()->user()->profile->alamat != null)
                                            <textarea class="form-control" id="billing-address" rows="3" name="alamat" readonly
                                                placeholder="Masukkan alamat lengkap">{{ auth()->user()->profile->alamat }}</textarea>
                                        @else
                                            <textarea class="form-control" id="billing-address" rows="3" name="alamat" required
                                                placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                        @endif
                                        @error('alamat')
                                            <div class="alert alert-warning" role="alert">
                                                <strong>Peringatan!</strong>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top"></div>
                        <a href="#pendidikan" class="text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">PENDIDIKAN</h5>
                                    </div>
                                    <div class="flex-shrink-0"> <i
                                        class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="collapse show" id="pendidikan">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Asal Sekolah</label>
                                            <input type="text" placeholder="Masukkan Asal Sekolah"
                                            class="form-control" name="asalsekolah" required>
                                            @error('asalsekolah')
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Peringatan</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 col-md-12">
                                        <div class="form-group">
                                            <label>Pernah Mondok?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pernah_mondok" id="pernah_mondok_pernah" value="pernah" required>
                                                <label class="form-check-label" for="pernah_mondok_pernah">
                                                    Pernah
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pernah_mondok" id="pernah_mondok_tidak_pernah" value="tidakpernah" required>
                                                <label class="form-check-label" for="pernah_mondok_tidak_pernah">
                                                    Tidak Pernah
                                                </label>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Nama Pesantren</label>
                                            <input type="text" placeholder="Jika tidak pernah boleh dikosongkan"
                                            class="form-control" name="nama_pondok">
                                            @error('nama_pondok')
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Peringatan</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Lama</label>
                                            <input type="text" placeholder="Contoh : 1 Tahun"
                                            class="form-control" name="lama">
                                            @error('lama')
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Peringatan</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3 col-md-12">
                                            <label for="daftar-prestasi" class="form-label">Prestasi</label>
                                            <textarea name="prestasi" id="daftar-prestasi" class="form-control"
                                                placeholder="Isian dapat diisi dengan beberapa pilihan yang dipisahkan oleh tanda koma (,).">{{ old('prestasi')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top"></div>
                        <a href="#berkas" class="text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">BERKAS PENDAFTARAN</h5>
                                    </div>
                                    <div class="flex-shrink-0"> <i
                                        class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="collapse show" id="berkas">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label text-success" for="billing-address">Berkas Pendaftaran</label>
                        
                                            <div class="input-group">
                                                <span class="input-group-text">Upload</span>
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control"
                                                        name="berkas_siswa" value="{{ old('berkas_siswa') }}" accept="application/pdf" required>
                                                </div>
                                            </div>
                                            @error('berkas_siswa')
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="zip-code">Pas Photo</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Upload</span>
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control"
                                                        name="foto" value="{{ old('foto') }}" accept="image/png, image/jpg, image/jpeg" required>
                                                </div>
                                            </div>
                                            @error('foto')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 col-mb-12">
                                            @foreach($tahunaktif as $tak)
                                            <input type="hidden" class="form-control" name="tahun_masuk" value="{{$tak->tahun}}" readonly>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 col-mb-12">
                                            @foreach($gelombangaktif as $gel)
                                            <input type="hidden" class="form-control" name="gelombang" value="{{$gel->nomor_gelombang}}" readonly>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col">
                            <div class="text-end mt-2 mt-sm-0">
                                <button type="submit" name="add" class="btn btn-primary">Buat Pendaftaran</button>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row-->
                </div>
        </form>
    </div>
    <!-- end row -->
@endsection

@section('footer')
@endsection
