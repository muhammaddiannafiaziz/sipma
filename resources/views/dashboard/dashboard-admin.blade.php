
<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card tryal-gradient">
                            <div class="card-body tryal row">
                                <div class="col-xl-7 col-sm-6">
                                    <h2>Selamat Datang, @auth
                                            {{ auth()->user()->name }}
                                        @endauth</h2>
                                    <a href="{{route('data-registration')}}" class="btn btn-rounded  fs-18 font-w500">Lihat
                                        pendaftar</a>
                                </div>
                                <div class="col-xl-5 col-sm-6">
                                    <img src="{{ asset('sipenmaru/images/chart.png') }}" alt=""
                                        class="sd-shape">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="items">
                                            <h4 class="fs-20 font-w700 mb-4">Data Progress <br> Penerimaan Mahasiswa
                                                Baru</h4>
                                            <span class="fs-14 font-w400">Data yang baru masuk dan telah
                                                diverifikasi oleh admin akan dapat melanjutkan kegiatan
                                                penerimaan</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 redial col-sm-6">
                                        
                                        @php
                                            $aa = 0;
                                            $bb = 0;
                                        @endphp
                                        @foreach ($viewTotal as $x)
                                            @if (!$x->status_pendaftaran)
                                                @php
                                                    $aa = $x->jumlah;
                                                @endphp
                                            @elseif ($x->status_pendaftaran )
                                                @php
                                                    $bb = $x->jumlah;
                                                @endphp
                                            @endif
                                        @endforeach
                                        {{-- @php
                                            $hsl = $aa + $bb;
                                            $hslpersenanbaru = ($hsl * 100) / $jmlpendaftar;
                                        @endphp --}}

                                        <div id="redial"></div>
                                        {{-- <span class="text-center d-block fs-18 font-w600">Sedang berlangsung
                                            <small class="text-orange"><span
                                                    id="progressnya">{{ $hslpersenanbaru }}</span>
                                                %</small></span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-6 col-sm-6">
                                <div class="card">
                                    <div class="card-body px-4 pb-0">
                                        <h4 class="fs-18 font-w600 mb-5 text-nowrap">Hasil Seleksi Pendaftar</h4>
                                        <div class="progress default-progress">

                                            @php
                                            $a = 0;
                                            $b = 0;
                                            @endphp
                                            @foreach ($jmlpengumuman as $x)
                                                @if ($x->hasil_seleksi == 'LULUS')
                                                    @php
                                                        $a = $x->jumlah;
                                                    @endphp
                                                @elseif ($x->hasil_seleksi == 'TIDAK LULUS')
                                                    @php
                                                        $b = $x->jumlah;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            {{-- @php
                                                $hasil = $a + $b;
                                                $hasilpersenan = ($hasil * 100) / $jmlpendaftar;
                                            @endphp --}}
                                            {{-- <div class="progress-bar bg-gradient1 progress-animated"
                                                style="width: {{ $hasilpersenan }}%; height:10px;"
                                                role="progressbar">
                                            </div> --}}

                                        </div>
                                        {{-- <div class="d-flex align-items-end mt-2 pb-3 justify-content-between">
                                            <span>{{ $hasil }} yang telah diberi <br> pengumuman</span>
                                            <h4 class="mb-0">{{ $hasil }}/{{ $jmlpendaftar }}</h4>
                                        </div> --}}

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-6">
                                <div class="card">
                                    <div class="card-body d-flex px-4  justify-content-between">
                                        <div>
                                            <div class="">
                                                <h4 class="fs-32 font-w700">{{ $jmluser }}</h4>
                                                <span class="fs-18 font-w500 d-block">Total
                                                    Pengguna</span></span>
                                            </div>
                                        </div>
                                        <div id="NewCustomers"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-6">
                                <div class="card">
                                    <div class="card-body d-flex px-4  justify-content-between">
                                        <div>
                                            <div class="">
                                                <p style="margin: 0%"><b>Rp</b></p>
                                                <h5 class="fs-32 font-w700">{{ number_format($jmlbayar * 150000, 0, 0, '.') }}</h5>
                                                <span class="fs-18 font-w500 d-block">Jumlah Pembayaran</span>
                                            </div>
                                        </div>
                                        <div id="NewCustomers1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Pendaftaran</h4>
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
                            @foreach ($pendaftar as $x)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $x->id_pendaftaran }}</td>
                                    <td>{{ $x->nama_siswa }}</td>
                                    <td>{{ $x->jenis_kelamin }}</td>
                                    <td><strong>{{ $x->tgl_pendaftaran }}</strong></a></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if ($x->status_pendaftaran)
                                                    <span class="badge badge-success">Terverifikasi<span
                                                            class="ms-1 fa fa-check"></span>
                                                    @elseif($x->status_pendaftaran == false)
                                                        <span class="badge badge-warning">Belum Terverifikasi<span
                                                                class="ms-1 fas fa-stream"></span>
                                                        @elseif($x->status_pendaftaran == null)
                                                            <span class="badge badge-info">Tidak Sesuai<span
                                                                    class="ms-1 fa fa-ban"></span>
                                                            @else
                                                                <span class="badge badge-danger">Not Found<span
                                                                        class="ms-1 fa fa-search"></span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="dropdown text-sans-serif"><button
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
                                                        <div class="py-2"><a class="dropdown-item"
                                                                href="/verified-registration/{{ $x->id_pendaftaran }}">Terverifikasi</a><a
                                                                class="dropdown-item"
                                                                href="/notverified-registration/{{ $x->id_pendaftaran }}">Belum
                                                                Terverifikasi</a>
                                                            <div class="dropdown-divider"></div><a
                                                                class="dropdown-item text-danger"
                                                                href="/invalid-registration/{{ $x->id_pendaftaran }}">Tidak
                                                                Sah</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-light shadow btn-xs sharp me-1"
                                                title="Detail Registration"
                                                href="detail-registration/{{ $x->id_pendaftaran }}"><i
                                                    class="fa fa-file-alt"></i></a>
                                            <a class="btn btn-primary shadow btn-xs sharp me-1" title="Edit"
                                                href="edit-registration/{{ $x->id_pendaftaran }}"><i
                                                    class="fa fa-pencil-alt"></i></a>
                                            <a class="btn btn-danger shadow btn-xs sharp"><i
                                                    class="fa fa-trash" data-bs-toggle="modal"
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
                                                            menghapus data ini?{{ $x->id_pendaftaran }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger light"
                                                                data-bs-dismiss="modal">Tidak</button>
                                                            <a
                                                                href="delete-registration/{{ $x->id_pendaftaran }}">
                                                                <button type="submit"
                                                                    class="btn btn-danger shadow">
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