<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileUsers;
use App\Models\ProgramStudi;
use App\Models\Sekolah;
use App\Models\Pengumuman;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Models\Timeline;
use Alert;

class PengumumanController extends Controller
{
    //
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

    //data pengumuman kompliit
    public function datapengumuman()
    {
        $dataUser = ProfileUsers::all();
        $data = Pengumuman::with('pendaftaran')->get();
        $dataid = Pendaftaran::all();
        return view ('pengumuman.data-pengumuman-admin',['viewDataUser' => $dataUser,
                                                            'viewData' => $data,
                                                            'viewIdPendaftaran' => $dataid
                                                        ]);
    }

    public function lihatpengumuman(Request $a)
    {
        $dataUser = ProfileUsers::all();
        $dataditemukan = Pengumuman::where("id_pendaftaran", $a->id_pendaftaran)->first();
        $data = Pengumuman::all();
        $dataid = Pendaftaran::where("id_pendaftaran", $a->id_pendaftaran)->first();
        $datPembayaran = Pembayaran::where("id_pendaftaran",$dataid->id_pendaftaran)->first();
        return view ('pengumuman.data-pengumuman-view',['viewDataUser' => $dataUser,
                                                        'viewData' => $data,
                                                        'viewIdPendaftaran' => $dataid,
                                                        'viewDataPembayaran' => $datPembayaran,
                                                        'viewID' => $dataditemukan
                                                    ]);
    }


    public function simpanpengumuman(Request $a)
    {
        try{
        //$dataUser = ProfileUsers::all();
            $kode = Pengumuman::id();
            Pengumuman::create([
                'id_pengumuman' => $kode,
                'id_pendaftaran' => $a->id_pendaftaran,
                'hasil_seleksi' => $a->hasil,
                'prodi_penerima' => $a->penerima,
                'nilai_interview' => $a->interview,
                // 'nilai_test' => $a->test
            ]);
            return redirect('/data-announcement')->with('success', 'Data Tersimpan!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Disimpan!');
        }
    }

    public function updatepengumuman(Request $a, $id_pengumuman){
        //$dataUser = ProfileUsers::all();
        try{
           
            Pengumuman::where("id_pengumuman", $id_pengumuman)->update([
                'id_pendaftaran' => $a->id_pendaftaran,
                'hasil_seleksi' => $a->hasil,
                'nilai_interview' => $a->interview,
                // 'nilai_test' => $a->test,
            ]);
            if($a->hasil =="LULUS" || $a->hasil =="TIDAK LULUS"){
                Pendaftaran::where("id_pendaftaran", "$a->id_pendaftaran")->update([
                    "status_pendaftaran"=>"Selesai"
                ]);
            }
            return redirect('/data-announcement')->with('success', 'Data Terubah!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }
    

    public function hapuspengumuman($id_pengumuman){
        //$dataUser = ProfileUsers::all();
        try {
            $data = Pengumuman::find($id_pengumuman);
            $dataPengumuman = Pengumuman::where("id_pengumuman",$id_pengumuman)->first();
    
            if ($dataPengumuman) {
                $dataPengumuman->delete();
                return redirect('/data-announcement')->with('success', 'Data Terhapus!!');
            } else {
                return redirect()->back()->with('error', 'Data tidak ditemukan!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
        }
    }
}
