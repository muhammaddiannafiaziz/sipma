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
        return view ('profil');
    }

    //
    public function editprofil(Request $a){
            $message = [
                'nama.required' => 'Nama tidak boleh kosong',
                'tempat.required' => 'Tempat lahir tidak boleh kosong',
                'tanggal.required' => 'Tanggal lahir tidak boleh kosong',
                'jk.required' => 'Jenis Kelamin harus dipilih',
                'hp.required' => 'Family card cannot be empty',
                'alamat.required' => 'School name must be filled',
            ];

            $cekValidasi = $a->validate([
                'nama' => 'required',
                'tempat' => 'required',
                'tanggal' => 'required',
                'jk' => 'required',
                'hp' => 'required',
                'alamat' => 'required',
            ], $message);

            $file = $a->file('foto');
            if(file_exists($file)){
                $nama_file = time() . "-" . $file->getClientOriginalName();
                $namaFolder = 'foto profil';
                $file->move($namaFolder,$nama_file);
                $pathFoto = $namaFolder."/".$nama_file;
            } else {
                $pathFoto = $a->pathFoto;
            }

            $fileftprestasi = $a->file('ftprestasi');
            if(file_exists($fileftprestasi)){
                $nama_fileftprestasi = "Prestasi".time() . "-" . $fileftprestasi->getClientOriginalName();
                $namaFolderftprestasi = 'data pendaftar/'.$a->username;
                $fileftprestasi->move($namaFolderftprestasi,$nama_fileftprestasi);
                $pathPrestasi = $namaFolderftprestasi."/".$nama_fileftprestasi;
            } else {
                $pathPrestasi = null;
            }

            ProfileUsers::where("user_id", Auth::user()->id)->update([
                'nama' => $a->nama,
                'username' => $a->username,
                'foto' => $pathFoto,
                'prodi' => $a->prodi,
                'email' => $a->email,
                'tempat_lahir' => $a->tempat,
                'tanggal_lahir' => $a->tanggal,
                'gender' => $a->jk,
                'agama' => $a->agama,
                'no_hp' => $a->hp,
                'alamat' => $a->alamat,
                'jalan' => $a->jalan,
                'kelurahan' => $a->kelurahan,
                'kecamatan' => $a->kecamatan,
                'kabupaten' => $a->kabupaten,
                'provinsi' => $a->provinsi,
                'kode_pos' => $a->kode_pos,
                'nama_ayah' => $a->ayah,
                'pekerjaan_ayah' => $a->pekerjaanayah,
                'pendidikan_ayah' => $a->pendidikanayah,
                'nohp_ayah' => $a->noayah,
                'nama_ibu' => $a->ibu,
                'pekerjaan_ibu' => $a->pekerjaanibu,
                'pendidikan_ibu' => $a->pendidikanibu,
                'nohp_ibu' => $a->noibu,
                'sekolah_sma' => $a->asalsekolah,
                'prestasi' => $pathPrestasi
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
