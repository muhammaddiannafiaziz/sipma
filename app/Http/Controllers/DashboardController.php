<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Models\Pengumuman;
use App\Models\TahunAkademik;
use App\Models\Gelombang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Support\Facades\Hash;
Use Illuminate\Support\Carbon;
use File;
use Alert;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request,$next){
            if (session('success')) {
                Alert::success(session('success'));
            }

            if (session('error')) {
                Alert::error(session('error'));
            }

            return $next($request);
        });
    }
    public function dashboard(){
        // $dataPendaftar = Pendaftaran::select( DB::raw('count(*) as jmlpendaftar'),'tahun_masuk')
        // ->groupBy('tahun_masuk')->get();
        $data = Pendaftaran::select('status_pendaftaran', DB::raw('count(*) as jumlah'),)
        ->groupBy('status_pendaftaran')->get();
        $pendaftar = Pendaftaran::all();
        $jmlpendaftar = Pendaftaran::all()->count();
        $dataUser = User::all();
        $jmluser = User::all()->count();
        $jmlbayar = Pembayaran::where('status',true)->count();
        $jmlpengumuman =  Pengumuman::select('hasil_seleksi', DB::raw('count(*) as jumlah'),)
        ->groupBy('hasil_seleksi')->get();
        // $datPembayaran = Pembayaran::where("id_pendaftaran",$pendaftar->id)->first();
        return view ('dashboard',['viewDataUser' => $dataUser,
                                    'viewTotal'=>$data,
                                    'pendaftar'=>$pendaftar,
                                    'jmlpengumuman'=>$jmlpengumuman,
                                    'jmlpendaftar'=>$jmlpendaftar,
                                    'jmluser'=>$jmluser,
                                    'jmlbayar'=>$jmlbayar,]);
    }
}
