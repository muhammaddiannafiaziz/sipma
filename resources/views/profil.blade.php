@extends('master.master-admin')

@section('title')
    Profil
@endsection

@section('header')
@endsection

@section('navbar')
    @parent
@endsection

@section('menunya')
    Profil Pengguna
@endsection

@section('menu')
    @auth
    @auth
    <ul class="metismenu" id="menu">
        <li><a href="dashboard">
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
            <li><a href="{{route('data-registration')}}" aria-expanded="false">
                <i class="fa fa-database"></i>
                    <span class="nav-text">Pendaftaran</span>
                </a>
            </li>
        @endif
        
        <!--<li><a href="#" aria-expanded="false">
                <i class="fa fa-download"></i>
                <span class="nav-text">Pusat Unduhan</span>
            </a>
        </li>-->
    </ul>
@endauth
    @endauth
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <div class="clearfix"></div>
                    <div>
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
                    </div>
                    <h5 class="mt-3 mb-1">
                        {{ auth()->user()->profile->nama }}
                    </h5>
                </div>
                <hr class="my-4">
                <div class="text-muted">
                    <div class="table-responsive mt-4">
                        @auth
                            <div>
                                <p class="mb-1">Nama :</p>
                                <h5 class="font-size-16">
                                    {{ auth()->user()->profile->nama }}
                                </h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">No Hp :</p>
                                <h5 class="font-size-16">
                                            {{ auth()->user()->profile->no_hp }}
                                </h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">E-mail :</p>
                                <h5 class="font-size-16">{{ auth()->user()->profile->email }}</h5>
                            </div>
                        @endauth
                    </div>
                </div>
                @if(auth()->user()->profile->alamat !== NULL)
                <div class="pt-3">
                    <a href="{{route('data-registration')}}" class="btn btn-sm btn-primary btn-rounded fs-18">Mulai Pendaftaran</a>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="card">
        <div class="card-body">
    <div class="profile-tab">
        <div class="custom-tab-1">
            <h3>Pengaturan</h3>
            <form action="edit-profile" method="POST" enctype="multipart/form-data">
                <h4 class="text-success">Profil</h4>
                @csrf
                <input type="hidden" name="userid" value="{{ auth()->user()->id}}">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" value="{{ auth()->user()->profile->nama }}"
                        class="form-control" name="nama">
                        @error('nama')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peringatan</strong>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">NIM</label>
                        <input type="text" value="{{ auth()->user()->profile->username }}"
                            class="form-control" name="username" readonly>
                    </div>
                </div>
                <input type="hidden" name="id" class="form-control-file"
                    value="{{ auth()->user()->profile->user_id }}">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Program Studi</label>
                        {{-- <input type="text" value="{{ auth()->user()->profile->prodi }}"
                        class="form-control" name="nama"> --}}
                        <input class="form-control" list="datalistOptionsProdi"
                            id="exampleDataList" placeholder="Masukkan Program Studi ..."
                            name="prodi" value="{{ auth()->user()->profile->prodi }}" required>
                        <datalist id="datalistOptionsProdi">
                            <option value="Bahasa dan Sastra Arab"></option>
                            <option value="Pendidikan Bahasa Inggris"></option>
                            <option value="Sastra Inggris"></option>
                            <option value="Sejarah Peradaban Islam"></option>
                            <option value="Tadris Bahasa Indonesia"></option>
                            <option value="Ilmu Perpustakaan dan Informasi Islam"></option>
                            <option value="Akuntansi Syariah"></option>
                            <option value="Manajemen Bisnis Syariah"></option>
                            <option value="Perbankan Syariah"></option>
                            <option value="Ekonomi Syariah"></option>
                            <option value="Aqidah dan Filsafat Islam"></option>
                            <option value="Bimbingan dan Konseling Islam"></option>
                            <option value="Ilmu Al-Qur'an dan Tafsir"></option>
                            <option value="Komunikasi dan Penyiaran Islam"></option>
                            <option value="Manajemen Dakwah"></option>
                            <option value="Psikologi Islam"></option>
                            <option value="Tasawuf dan Psikoterapi"></option>
                            <option value="Pemikiran Politik Islam"></option>
                            <option value="Hukum Ekonomi Syariah "></option>
                            <option value="Hukum Keluarga Islam "></option>
                            <option value="Hukum Pidana Islam"></option>
                            <option value="Manajemen Zakat dan Wakaf"></option>
                            <option value="Pendidikan Agama Islam"></option>
                            <option value="Pendidikan Bahasa Arab"></option>
                            <option value="Pendidikan Guru Madrasah Ibtidaiyah"></option>
                            <option value="Pendidikan Islam Anak Usia Dini"></option>
                            <option value="Manajemen Pendidikan Islam"></option>
                            <option value="Tadris Matematika"></option>
                            <option value="Tadris Biologi"></option>
                            <option value="Ilmu Lingkungan"></option>
                            <option value="Teknologi Pangan"></option>
                            <option value="Sains Data"></option>
                            <option value="Bioteknologi"></option>
                        </datalist>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" value="{{ auth()->user()->profile->email }}" class="form-control" name="email" required>
                    </div> 
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Jenis Kelamin</label>
                        @if (auth()->user()->profile->gender != null)
                        @if (auth()->user()->profile->gender == 'Perempuan')
                            <select class="form-control wide" name="jk"
                                value="{{ old('jk') }}">
                                <option value="{{ auth()->user()->profile->gender }}" selected>
                                    {{ auth()->user()->profile->gender }}</option>
                                <option value="Laki-laki">Laki-laki</option>
                            </select>
                        @else
                            <select class="form-control wide" name="jk"
                                value="{{ old('jk') }}">
                                <option value="{{ auth()->user()->profile->gender }}" selected>
                                    {{ auth()->user()->profile->gender }}</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        @endif
                        @else
                        <select class="form-control wide" name="jk"
                            value="{{ old('jk') }}">
                            <option value="{{ old('jk') }}" disabled selected>Pilih
                                Jenis Kelamin </option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @endif
                    </div>
                    
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="personal-data">Agama</label>
                        <select class="form-control wide" name="agama"
                            value="{{ auth()->user()->profile->agama }}">
                            @if(auth()->user()->profile->agama = NULL)
                            <option value="{{ auth()->user()->profile->agama }}" disabled selected>Pilih agama
                            </option>
                            @endif
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="Kong Hu Chu ">Kong Hu Chu</option>
                            <option value="Lainnya">Etc</option>
                        </select>
                        @error('agama')
                            <div class="alert alert-danger" role="alert">
                                <strong>Peringatan!</strong>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" value="{{ auth()->user()->profile->tempat_lahir }}" value="{{ old('tempat') }}"
                                class="form-control" name="tempat">
                            @error('tempat')
                            <div class="alert alert-danger" role="alert">
                                <strong>Warning!</strong>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" value="{{ auth()->user()->profile->tanggal_lahir }}" value="{{ old('tanggal') }}"
                                class="form-control" name="tanggal">
                            @error('tanggal')
                                <div class="alert alert-danger" role="alert">
                                    <strong>Warning!</strong>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">No HP</label>
                            <input type="text" value="{{ auth()->user()->profile->no_hp }}" value="{{ old('hp') }}"
                                class="form-control" name="hp">
                                @error('hp')
                                <div class="alert alert-danger" role="alert">
                                    <strong>Warning!</strong>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="profile-about-me">
                        <div class="pt-4 border-bottom-1 pb-3">
                            <h4 class="text-success">Alamat Lengkap</h4>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Jalan / Dusun</label>
                                <input type="text" value="{{ auth()->user()->profile->jalan }}" value="{{ old('jalan') }}"
                                    class="form-control" name="jalan">
                                @error('jalan')
                                <div class="alert alert-danger" role="alert">
                                    <strong>Peringatan</strong>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Desa / Kelurahan</label>
                                <input type="text" value="{{ auth()->user()->profile->kelurahan }}" value="{{ old('kelurahan') }}"
                                    class="form-control" name="kelurahan" required>
                                @error('kelurahan')
                                <div class="alert alert-danger" role="alert">
                                    <strong>Peringatan</strong>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>   
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" value="{{ auth()->user()->profile->kecamatan }}" value="{{ old('kecamatan') }}"
                                    class="form-control" name="kecamatan" required>
                                @error('kecamatan')
                                <div class="alert alert-danger" role="alert">
                                    <strong>Peringatan</strong>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Kabupaten / Kota</label>
                                <input type="text" value="{{ auth()->user()->profile->kabupaten }}" value="{{ old('kabupaten') }}"
                                    class="form-control" name="kabupaten" required>
                                @error('kabupaten')
                                <div class="alert alert-danger" role="alert">
                                    <strong>Peringatan</strong>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>   
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Provinsi</label>
                                <input type="text" value="{{ auth()->user()->profile->provinsi }}" value="{{ old('provinsi') }}"
                                    class="form-control" name="provinsi" required>
                                @error('provinsi')
                                <div class="alert alert-danger" role="alert">
                                    <strong>Peringatan</strong>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" value="{{ auth()->user()->profile->kode_pos }}" value="{{ old('kode_pos') }}"
                                    class="form-control" name="kode_pos" required>
                                @error('kode_pos')
                                <div class="alert alert-danger" role="alert">
                                    <strong>Peringatan</strong>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>   
                        </div>
                    </div>
                    <div class="profile-about-me">
                        <div class="pt-4 border-bottom-1 pb-3">
                            <h4 class="text-success">Data Orang Tua / Wali</h4>
                            <p>Ayah / Ibu (Pilih salah satu)</p>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="personal-data-name">Nama
                                    Lengkap</label>
                                <input type="text" class="form-control" id="personal-data-name"
                                    name="ortu"
                                    value="{{ auth()->user()->profile->nama_ortu }}" value="{{ old('ortu') }}" required>
                                @error('ortu')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Peringatan!</strong>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" value="{{ auth()->user()->profile->pekerjaan_ortu }}"
                                class="form-control" name="pekerjaanortu">
                                @error('pekerjaanortu')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Peringatan</strong>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Pendidikan</label>
                                <input type="text" value="{{ auth()->user()->profile->pendidikan_ortu }}"
                                class="form-control" name="pendidikanortu">
                                @error('pendidikanortu')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Peringatan</strong>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">No HP</label>
                                <input type="number" value="{{ auth()->user()->profile->nohp_ortu }}"
                                class="form-control" name="noortu" id="personal-data-no">
                                @error('noortu')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Peringatan</strong>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                @if(auth()->user()->profile->alamat == NULL)
                <button class="btn btn-success shadow" type="button" data-bs-toggle="modal" data-bs-target="#updateModal">
                    Perbaharui Data
                </button>
                <!-- Modal Konfirmasi Perbaharui Data -->
                <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel">Konfirmasi Perubahan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <i class="fa fa-check-circle"></i><br>
                                Apakah data yang Anda masukkan sudah benar?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                                <button class="btn btn-success" type="submit">Ya, Perbaharui Data!</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </form>
            
        </div>
    </div>
</div>
        </div>
    </div>
</div>

<script>
    document.getElementById('confirmUpdate').addEventListener('click', function() {
        // Submit form jika user mengklik "Ya, Perbaharui Data!"
        document.getElementById('editProfileForm').submit();
    });
</script>
<!-- end row -->
@endsection

@section('footer')
@endsection


