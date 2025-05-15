<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ProfileUsers;
use App\Models\Timeline;
use File;
use Alert;


class LogAkunController extends Controller
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
            
            if (session('warning')) {
                Alert::warning(session('warning'));
            }
            return $next($request);
        });
    }

    //profil
    public function dataprofil(){
        $nim = Auth::user()->username;
        $dataProfil = ProfileUsers::where("username", $nim)->first();
        return view ('profil',["viewDataProfil"=>$dataProfil]);
    }

    //
    public function editprofil(Request $a){
            $message = [
                'nama.required' => 'Nama tidak boleh kosong',
                'tempat.required' => 'Tempat lahir tidak boleh kosong',
                'tanggal.required' => 'Tanggal lahir tidak boleh kosong',
                'jk.required' => 'Jenis Kelamin harus dipilih',
                'hp.required' => 'Nomor handphone tidak boleh kosong'
            ];
            
            $cekValidasi = $a->validate([
                'nama' => 'required',
                'tempat' => 'required',
                'tanggal' => 'required',
                'jk' => 'required',
                'hp' => 'required',
            ], $message);

            $fileftprestasi = $a->file('ftprestasi');
            if(file_exists($fileftprestasi)){
                $nama_fileftprestasi = "berkas".$a->username."-".time() . "-" . $fileftprestasi->getClientOriginalName();
                $namaFolderftprestasi = 'data pendaftar/'.$a->username;
                $fileftprestasi->move($namaFolderftprestasi,$nama_fileftprestasi);
                $pathPrestasi = $namaFolderftprestasi."/".$nama_fileftprestasi;
            } else {
                $pathPrestasi = null;
            }

            $alamat = $a->jalan.", ".$a->kelurahan.", Kec. ".$a->kecamatan.", Kab. ".$a->kabupaten.", Prov. ".$a->provinsi." - Kode Pos : ".$a->kode_pos;

            ProfileUsers::where("user_id", Auth::user()->id)->update([
                'nama' => $a->nama,
                'username' => $a->username,
                'prodi' => $a->prodi,
                'email' => $a->email,
                'tempat_lahir' => $a->tempat,
                'tanggal_lahir' => $a->tanggal,
                'gender' => $a->jk,
                'agama' => $a->agama,
                'no_hp' => $a->hp,
                'alamat' => $alamat,
                'jalan' => $a->jalan,
                'kelurahan' => $a->kelurahan,
                'kecamatan' => $a->kecamatan,
                'kabupaten' => $a->kabupaten,
                'provinsi' => $a->provinsi,
                'kode_pos' => $a->kode_pos,
                'nama_ortu' => $a->ortu,
                'pekerjaan_ortu' => $a->pekerjaanortu,
                'pendidikan_ortu' => $a->pendidikanortu,
                'nohp_ortu' => $a->noortu,
                'created_at' => now()
            ]);
            User::where("id", Auth::user()->id)->update([
                'name' => $a->nama,
            ]);
            return redirect('/profile')->with('success', 'Profil Akun Terubah!');
    }
 
    public function editakun(Request $a){
        $dataUser = ProfileUsers::all();
        $message = [
            'password.required' => 'Password tidak boleh kosong',
            'passwordbaru.required' => 'Password baru tidak boleh kosong',
            'passwordbaru2.required' => 'Ulangi password baru harus sama dan tidak boleh kosong',
        ];

        $cekValidasi = $a->validate([
            'password' => 'required',
            'passwordbaru' => 'required|min:6|max:255',
            'passwordbaru2' => 'required|min:6|max:255'
        ], $message);

        if (Hash::check($a->password,  Auth::user()->password)) {
            $id = Auth::user()->id;
            User::where("id", $id)->update([
                'password' => bcrypt($a->passwordbaru),
            ]);

        }

        return redirect('/profile')->with('success', 'Kata Sandi Akun Terubah!');
    }
}
