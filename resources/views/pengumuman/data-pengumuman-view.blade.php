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
    Hasil Pengumuman
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
                <li><a href="../data-registration" aria-expanded="false">
                    <i class="fa fa-database"></i>
                    <span class="nav-text">Pendaftaran</span>
                    </a>
                </li>
                {{-- @foreach($viewIdPendaftaran as $x)
                @if (auth()->user()->id == $x->user_id) --}}
                <li><a href="{{$viewIdPendaftaran->id_pendaftaran}}" aria-expanded="false">
                        <i class="fa fa-file"></i>
                        <span class="nav-text">Pengumuman</span>
                    </a>
                </li>
                {{-- @endif
                @endforeach --}}
            @endif
        </ul>
    @endauth
@endsection

@section('content')
    <!--ADMIN-->
    <div class="row">
        <div class="col-xl-12">
            <div class="text-end mt-2 mt-sm-0">
                @if ($viewID->hasil_seleksi == "Belum Seleksi")
                <button class="btn btn-primary mb-4" style="margin-bottom: 1rem;" disabled>Menunggu Pengumuman</button>
                @else
                    @if ($viewDataPembayaran->status == "Belum Bayar" && $viewID->hasil_seleksi == "LULUS")
                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target=".upload"
                    style="margin-bottom: 1rem;"><i class="mdi mdi-plus me-1"></i>Upload Pembayaran  </button>
                    @elseif($viewDataPembayaran->status =="Dibayar" && $viewDataPembayaran->verifikasi === 1)    
                    <button class="btn btn-info waves-effect waves-light mb-4" onclick="printDiv('cetak')"><i
                        class="fa fa-print"> </i></button>
                    @elseif($viewDataPembayaran->status =="Dibayar" && $viewDataPembayaran->verifikasi === 0)
                    <button class="btn btn-primary mb-4" style="margin-bottom: 1rem;" disabled>Menunggu Verifikasi</button>
                    {{-- @elseif ($viewDataPembayaran->status == "Belum Bayar")
                    <div>Belum Membayar</div> --}}
                    @endif
                @endif
            </div>
            <div class="modal fade upload" tabindex="-1" role="dialog"
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
                                    value="{{ $viewIdPendaftaran->id_pendaftaran }}">
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
            </div><!-- /.modal -->
            <div class="card"  id="cetak">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="mb-3">
                            <h4 class="fs-24 font-w700">Pengumuman <br>Pendaftaran Mahasantri Baru</h4>
                            {{-- <span>didaftarkan oleh <strong>{{ auth()->user()->name }}</strong> pada
                                {{ $viewIdPendaftaran->tgl_pendaftaran }}</span> --}}
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-4 pb-3 justify-content-end flex-wrap">
                                <div class="me-3">
                                    <h4 class="fs-18 font-w600">Ma'had Al-Jami'ah</h4>
                                    <span>UIN Raden Mas Said Surakarta</span>
                                </div>
                                <div class="me-3">
                                    <img src="{{ asset('sipenmaru/images/logo.png') }}" alt="" width="50px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <br>
                        <div class="border-top">
                            <table class="table mb-0">

                                <thead class="table-light col-lg-12">
                                    <tr>
                                        <td colspan="2">Data Pendaftar</td>
                                    </tr>
                                </thead>
                                <tbody border="5">
                                    
                                    <tr border="5">
                                        <td scope="row" width="70%">
                                            <table>
                                                <tr border="5">
                                                    <th scope="row" width="50%">No Pendafataran</th>
                                                    <td  width="50%">{{ $viewIdPendaftaran->id_pendaftaran }}</td>
                                                </tr>
                                                <tr border="5">
                                                    <th scope="row"  width="50%">Nama</th>
                                                    <td  width="50%">{{ $viewIdPendaftaran->nama_siswa }}</td>
                                                </tr>
                                                <tr border="5">
                                                    <th scope="row"  width="50%">NIM</th>
                                                    <td width="50%">{{ $viewIdPendaftaran->nim }}</td>
                                                </tr>
                                                <tr border="5">
                                                    <th scope="row"  width="50%">Program Studi</th>
                                                    <td width="50%">{{ $viewIdPendaftaran->prodi }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td colspan="4"><img src="{{ url('/'.$viewIdPendaftaran->pas_foto) }}" alt="" width="180px" height=""></td>
                                    <tr>
                                    
                                    <tr border="5">
                                        <th colspan="3" scope="row">
                                            <br>
                                            @foreach ($viewData as $x)
                                                    @if($x->hasil_seleksi == 'TIDAK LULUS' && $x->id_pendaftaran== $viewIdPendaftaran->id_pendaftaran)
                                                    <div class="alert alert-danger solid alert-rounded" style="border-radius: 0%">
                                                        <strong>Mohon maaf.</strong> Anda TIDAK LULUS seleksi Penerimaan
                                                        Santri Baru.
                                                    </div>
                                                    @elseif ($x->hasil_seleksi == 'LULUS' && $x->id_pendaftaran== $viewIdPendaftaran->id_pendaftaran)
                                                        <div class="alert alert-success solid" style="border-radius: 0%">
                                                            <strong>Selamat!</strong> Anda dinyatakan <strong>LULUS</strong>  seleksi
                                                            Penerimaan Santri Baru
                                                        </div>
                                                        {{-- <div class="alert alert-outline-success alert-dismissible fade show" style="border-radius: 0%; margin-top:-1rem">
                                                            <table>
                                                                <tr>
                                                                    <th scope="row">Program Studi Penerima <b>{{$x->prodi->nama_prodi}}</b></th>
                                                                </tr>
                                                            </table>
                                                        </div> --}}
                                                    @endif
                                        @endforeach
                                    </th>
                                </tr>
                                {{-- @if ($viewDataPembayaran->status !="Gratis" && $viewDataPembayaran->status !="Dibayar" && $viewID->hasil_seleksi == "LULUS")
                                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target=".upload"
                                    style="margin-bottom: 1rem;"><i class="mdi mdi-plus me-1"></i>Tatacara </button>
                                @endif
                                @foreach ($viewData as $x)
                                    @if ($x->hasil_seleksi == 'LULUS' && $x->id_pendaftaran== $viewIdPendaftaran->id_pendaftaran)
                                    <tr>
                                        <td scope="row" style="margin-top:-50px"><small>* Bawa Bukti Penerimaan Saat Melakukan Daftar Ulang</small></td>
                                    </tr>
                                    @endif
                                @endforeach --}}
                                @if($viewDataPembayaran->status =="Dibayar")    
                                <tr>
                                    <td scope="row" style="margin-top:-50px"><small>* Bawa Bukti Penerimaan Saat Melakukan Daftar Ulang</small></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('footer')
@endsection
