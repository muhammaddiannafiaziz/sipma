<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileUsers;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use App\Models\Pengumuman;
use App\Models\Timeline;

use File;
use Alert;

class PembayaranController extends Controller
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


    //data pembayaran komplit
    public function datapembayaran(){
        $dataUser = ProfileUsers::all();
        $data = Pembayaran::all();
        $dataid = Pendaftaran::all();
        $dataPengumuman = Pengumuman::all();
        return view ('pembayaran.data-pembayaran-admin',['viewDataUser' => $dataUser,
                                                        'viewData' => $data,
                                                        'viewIdPendaftaran' => $dataid,
                                                        'viewPengumuman'=>$dataPengumuman
                                                    ]);
    }

    public function simpanpembayaran(Request $a)
    {
        try{
        $nimmahasiswa = Auth::user()->username;
        //$dataUser = ProfileUsers::all();
        $kode = Pembayaran::id();
        $file = $a->file('bukti');
        $kodependaftaran = $a->id_pendaftaran;
        $nama_file = "payment-".time() . "-" . $file->getClientOriginalName();
        $namaFolder = 'data pendaftar/'.$nimmahasiswa;
        $file->move($namaFolder,$nama_file);
        $pathBukti = $namaFolder."/".$nama_file;
        Pembayaran::create([
            'id_pembayaran' => $kode,
            'bukti_pembayaran' => $pathBukti,
            'status'=> $a->status,
            'id_pendaftaran' =>$a->id_pendaftaran
        ]);
        return redirect('/data-payment')->with('success', 'Data Tersimpan!!');
    } catch (\Exception $e){
        return redirect()->back()->with('error', 'Data Tidak Berhasil Disimpan!');
    }
    }

    public function updatepembayaran(Request $a, $id_pembayaran){
        //$dataUser = ProfileUsers::all();
        try{
            $file = $a->file('bukti');
            if(file_exists($file)){
                $kodependaftaran = $a->id_pendaftaran;
                $nimmahasiswa = Auth::user()->username;

                $nama_file = "payment-".time() . "-" . $file->getClientOriginalName();
                $namaFolder = 'data pendaftar/'.$nimmahasiswa;
                $file->move($namaFolder,$nama_file);
                $pathBukti = $namaFolder."/".$nama_file;
            } else {
                $pathBukti = $a->pathnya;
            }
            
            Pembayaran::where("id_pembayaran", $id_pembayaran)->update([
                'bukti_pembayaran' => $pathBukti,
                'status'=> $a->status
            ]);
            return redirect('/data-payment')->with('success', 'Data Terubah!!');
        

        } catch (\Exception $e){
            //echo $e;
            return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }
    public function updatebuktipembayaran(Request $a){
        $message = [
            'pem.required' => 'Harap unggah foto.',
            'pem.image' => 'File yang diunggah harus berupa gambar.',
            'pem.mimes' => 'Hanya file dengan ekstensi jpg dan png yang diperbolehkan.',
            'pem.max' => 'Ukuran foto tidak boleh lebih dari 300KB.',
            
        ];

        $a->validate([
            'pem' => ['required', 'image', 'mimes:jpg,png', 'max:300'], // 300 KB
        ], $message);
        //$dataUser = ProfileUsers::all();
        try{
            $file = $a->file('pem');
            if(file_exists($file)){
                $kodependaftaran = $a->id_pendaftaran;
                $nimmahasiswa = Auth::user()->username;

                $nama_file = "payment-".time()."-".$file->getClientOriginalName();
                $namaFolder = 'data pendaftar/'.$nimmahasiswa;
                $file->move($namaFolder,$nama_file);
                $pathBukti = $namaFolder."/".$nama_file;
            } else {
               $pathBukti = null;
            }
            $id= Pendaftaran::where("id_pendaftaran", $a->id_pendaftaran)->first();
                    Pembayaran::where("id_pendaftaran", $id->id_pendaftaran)->update([
                        'bukti_pembayaran' => $pathBukti,
                        'status'=> "Dibayar",
                    ]);
            
            return redirect('/view-announcement'.'/'.$a->id_pendaftaran)->with('success', 'Data Terubah!!');

        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!' );
        }
    }

    public function hapuspembayaran($id_pembayaran){
        //$dataUser = ProfileUsers::all();
        try{
            $dataPembayaran = Pembayaran::where("id_pembayaran",$id_pembayaran)->first();
            $dataPembayaran->delete();
            return redirect('/data-payment')->with('success', 'Data Terhapus!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
        }
    }

    public function verifikasipembayaran($id_pembayaran){
        //$dataUser = ProfileUsers::all();
        Pembayaran::where("id_pembayaran", "$id_pembayaran")->update([
            'status' => "Dibayar",
            'verifikasi' => 1,
        ]);

        return redirect('/data-payment');
    }

    public function belumbayar($id_pembayaran){
        //$dataUser = ProfileUsers::all();
        Pembayaran::where("id_pembayaran", "$id_pembayaran")->update([
            'status' => "Belum Bayar"
        ]);
        return redirect('/data-payment');
    }

    public function invalidbayar($id_pembayaran){
        //$dataUser = ProfileUsers::all();
        Pembayaran::where("id_pembayaran", "$id_pembayaran")->update([
            'status' => "Tidak Sah"
        ]);

        Timeline::create([
            'user_id' => Auth::user()->id,
            'status' => "Pembayaran",    
            'pesan' => 'Memperbaharui Status Pembayaran (Tidak Sah)',
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/data-payment');
    }
}
