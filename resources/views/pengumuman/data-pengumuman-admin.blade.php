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
Pengumuman
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
                    <li><a href="data-registration" aria-expanded="false">
                            <i class="fa fa-database"></i>
                            <span class="nav-text">Pendaftaran</span>
                        </a>
                    </li>
            @endif
        </ul>
    @endauth
@endsection

@section('content')
    <!--ADMIN-->
    @auth
        @if(auth()->user()->role == 'Administrator')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Pengumuman</h4>
    
    
                        <div>
                            <button class="btn btn-info waves-effect waves-light mb-4" onclick="printDiv('cetak')"><i class="fa fa-print"> </i></button>
                            
                        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target=".modal"
                        style="margin-bottom: 1rem;"><i class="mdi mdi-plus me-1"></i>Tambah Pengumuman</button>
                        </div>
                        <!-- center modal -->
    
                        <div class="modal fade modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Pengumuman</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="save-announcement" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="userid" value="{{ auth()->user()->id}}">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <label for="iduser">ID Pendaftaran</label>
                                                        <select class="default-select form-control wide" title="id_pendaftaran"
                                                            name="id_pendaftaran" required>
                                                            <option value="-">Pilih ID</option>
                                                            @foreach ($viewIdPendaftaran as $y)
                                                                <option value="{{ $y->id_pendaftaran }}">
                                                                    {{ $y->id_pendaftaran }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <label for="iduser">Hasil</label>
                                                        <select class="default-select form-control wide" title="hasil"
                                                            name="hasil" required>
                                                            <option value="Belum Tersedia">Pilih Hasil</option>
                                                            <option value="LULUS">Lulus</option>
                                                            <option value="TIDAK LULUS">Tidak Lulus</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <label for="iduser">Nilai Interview</label>
                                                        <input type="number" class="form-control" 
                                                            placeholder="Masukkan Nilai Interview" name="interview" required>
                                                    </div>
                                                    {{-- <div class="col-xl-6">
                                                        <label for="iduser">Nilai Test</label>
                                                        <input type="number" class="form-control" 
                                                            placeholder="Masukkan Nilai Test" name="test" required>
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <div class="modal-footer border-top-0 d-flex">
                                                <button type="button" class="btn btn-danger light"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" name="add" class="btn btn-primary">Tambah Data</button>
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                    <div class="card-body" id="cetak">
                        <div class="table-responsive">
                            {{ csrf_field() }}
    
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Pendaftaran</th>
                                        <th>Nama</th>
                                        <th>Hasil</th>
                                        <th>Nilai Interview</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($viewData as $x)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td><a href="detail-registration/{{ $x->id_pendaftaran }}">{{ $x->id_pendaftaran }}</a></td>
                                            @foreach($viewIdPendaftaran as $y)
                                            @if($x->id_pendaftaran == $y->id_pendaftaran)
                                            <td>{{ $y->nama_siswa }}</td>
                                            @endif
                                            @endforeach
                                            {{-- @php
                                            dd($viewIdPendaftaran)
                                            @endphp --}}
                                            <td>
                                                @if ($x->hasil_seleksi == "LULUS" || $x->hasil_seleksi == "Lulus" || $x->hasil_seleksi == "lulus")
                                                    <span class="badge light badge-success">
                                                        <i class="fa fa-circle text-success me-1"></i>
                                                        LULUS
                                                    </span>
                                                @else
                                                    <span class="badge light badge-danger">
                                                        <i class="fa fa-circle text-danger me-1"></i>
                                                        TIDAK LULUS
                                                    </span>
                                                @endif
                                            <td><strong>{{ $x->nilai_interview }}</strong></a></td>
                                            {{-- <td><strong>{{ $x->nilai_test }}</strong></a></td> --}}
                                            <td>
                                                <div class="d-flex">
                                                    <a class="btn btn-secondary shadow btn-xs sharp me-1"
                                                            title="Detail Registration"
                                                            href="view-announcement/{{ $x->id_pendaftaran }}"><i
                                                                class="fa fa-file-alt"></i></a>
                                                    <a class="btn btn-primary shadow btn-xs sharp me-1" title="Edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target=".edit{{ $x->id_pengumuman }}"><i
                                                            class="fa fa-pencil-alt"></i></a>
                                                    <a class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"
                                                            data-bs-toggle="modal"
                                                            data-bs-target=".delete{{ $x->id_pengumuman }}"></i></a>
                                                    <div class="modal fade delete{{ $x->id_pengumuman }}" tabindex="-1"
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
                                                                        class="fa fa-trash"></i><br> Apakah anda yakin ingn menghapus data ini? <br>{{ $x->id_pengumuman }}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger light"
                                                                        data-bs-dismiss="modal">Hapus</button>
                                                                    <a href="delete-announcement/{{ $x->id_pengumuman }}">
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
    
                                        <div class="modal fade edit{{ $x->id_pengumuman }}" tabindex="-1" role="dialog"
                                            aria-labelledby="mySmallModalLabel" aria-hidden="true">
    
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Sunting Pengumuman</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="update-announcement/{{ $x->id_pengumuman }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="userid" value="{{ auth()->user()->id}}">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xl-6">
                                                                        <label for="iduser">ID Pendaftaran</label>
                                                                        <select class="default-select form-control wide"
                                                                            title="id_pendaftaran" name="id_pendaftaran"
                                                                            required>
                                                                            <option value="{{ $x->id_pendaftaran }}">
                                                                                {{ $x->id_pendaftaran }}</option>
                                                                        </select>
    
                                                                    </div>
                                                                    <div class="col-xl-6">
                                                                        <label for="iduser">Hasil</label>
                                                                        <select class="default-select form-control wide"
                                                                            title="Result" name="hasil" required>
                                                                            <option value="{{ $x->hasil_seleksi }}" selected>{{ $x->hasil_seleksi }}</option>
                                                                            <option value="LULUS">LULUS</option>
                                                                            <option value="TIDAK LULUS">TIDAK LULUS</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xl-6">
                                                                        <label for="iduser">Nilai Interview</label>
                                                                        <input type="number" class="form-control" id="nama"
                                                                            value="{{ $x->nilai_interview }}"
                                                                            name="interview" required>
                                                                    </div>
                                                                    {{-- <div class="col-xl-6">
                                                                        <label for="iduser">Nilai Tes</label>
                                                                        <input type="number" class="form-control" id="nama"
                                                                            value="{{ $x->nilai_test }}" name="test"
                                                                            required>
                                                                    </div> --}}
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer border-top-0 d-flex">
                                                                <button type="button" class="btn btn-danger light"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" name="add"
                                                                    class="btn btn-primary">Perbaharui Data</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif(auth()->user()->role == 'Calon Mahasiswa')
<!--USER-->
<div class="row" style="min-height: 500px">
    <div class="col-lg-12">
        <div class="card card-body" >
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-sm-8">
                        <h4 class="card-title">Lihat Hasil Seleksimu, {{auth()->user()->name}} !</h4>
                        <h5 class="card-title">Pengumuman Seleksi Penerimaan Mahasiswa Baru </h5> <br>
                        <form action="view-announcement/" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label>No Pendaftaran</label>
                                        <input type="text" class="form-control" name="id_pendaftaran">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary  fs-18 font-w500" type="submit">Lihat Hasil Seleksi</button>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <img src="{{ asset('sipenmaru/images/chart.png') }}" alt="" class="sd-shape">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
        @endif
    @endauth
    
    
    
@endsection

@section('footer')
@endsection
