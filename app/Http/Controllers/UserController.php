<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ProfileUsers;
use App\Models\Timeline;
use File;
use Alert;

class UserController extends Controller
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

    //data user
    public function datauser(){
        $dataUser = User::all();
        $kode = ProfileUsers::id();
        return view ('user.data-user-admin',compact('dataUser','kode'));
    }

    public function simpanuser(Request $a)
    {
        //dd('Regist Berhasil');
        //return redirect('/data-user')->with('berhasil','data berhasil disimpanI');
    try{
        $a->password = Hash::make($a->password);
        $checkuser = User::where('email',$a->email)->first();
        if($checkuser){
            return redirect()->back()->with('warning', 'Email Telah Terdaftar!');
        }
        User::create([
            'name' => $a->nama,
            'email' => $a->email,
            'password' => Hash::make($a->password),
            'role' => $a->level,
            'created_at' => now()
        ]);
        $usersid  = User::orderBy('id', 'DESC')->first();
    	$file = $a->file('foto');
            if(file_exists($file)){
                $nama_file = time() . "-" . $file->getClientOriginalName();
                $namaFolder = 'foto profil';
                $file->move($namaFolder,$nama_file);
                $pathFoto = $namaFolder."/".$nama_file;

                ProfileUsers::create([
                    'user_id' => $usersid->id,
                    'nama' => $a->nama,
                    'email' => $a->email,
                    'tanggal_lahir' => "2000-01-01",
                    'gender' => $a->gender,
                    'no_hp' => $a->nohp,
                    'foto' => $pathFoto
                ]);
            } else {
                ProfileUsers::create([
                    'user_id' => $usersid->id,
                    'nama' => $a->nama,
                    'email' => $a->email,
                    'tanggal_lahir' => "2000-01-01",
                    'gender' => $a->gender,
                    'no_hp' => $a->nohp,
                ]);
            }
        
        Timeline::create([
            'user_id' => $usersid->id,
            'status' => "Bergabung",
            'pesan' => 'Membuat Akun baru',
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/data-user')->with('success', 'Data Tersimpan!');
    }catch (\Exception $e){
        //echo $e;
        return redirect()->back()->with('error', 'Data Tidak Tersimpan, Periksa kembali inputan ada!');
    }
    }

    public function edituser($user_id)
    {
        $dataUser = ProfileUsers::all();
        $dataUserbyId = ProfileUsers::find($user_id);
        return view('user.data-user-detail',['viewDataUser' => $dataUser,'viewData'=>$dataUserbyId]);
    }


    public function updateuser($id,Request $a)
    {
     try{
        $dataUser = ProfileUsers::all();
            $message = [
                'tempat.required' => 'Tempat lahir tidak boleh kosong',
                'tanggal.required' => 'Tanggal lahir tidak boleh kosong',
                'jk.required' => 'Jenis Kelamin harus dipilih',
                'hp.required' => 'Family card cannot be empty',
            ];

            $cekValidasi = $a->validate([
                'tempat' => 'required',
                'tanggal' => 'required',
                'jk' => 'required',
                'hp' => 'required',
            ], $message);

            // $file = $a->file('foto');
            // if(file_exists($file)){
            //     $nama_file = time() . "-" . $file->getClientOriginalName();
            //     $namaFolder = 'foto profil';
            //     $file->move($namaFolder,$nama_file);
            //     $pathFoto = $namaFolder."/".$nama_file;
            // } else {
            //     $pathFoto = $a->pathFoto;
            // }
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


            ProfileUsers::where("id", $id)->update([
                'nama' => $a->nama,
                'username' => $a->username,
                // 'foto' => $pathFoto,
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
                'nama_ayah' => $a->ayah,
                'pekerjaan_ayah' => $a->pekerjaanayah,
                'pendidikan_ayah' => $a->pendidikanayah,
                'nohp_ayah' => $a->noayah,
                'nama_ibu' => $a->ibu,
                'pekerjaan_ibu' => $a->pekerjaanibu,
                'pendidikan_ibu' => $a->pendidikanibu,
                'nohp_ibu' => $a->noibu,
                'sekolah_sma' => $a->asalsekolah,
                'prestasi' => $pathPrestasi,
                'updated_at' => now()
            ]);
            return redirect('/edit-user/'.$id)->with("success",'Data Berhasil Diubah');
        }catch (\Exception $e){
            echo $e;
            //return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }

    public function hapususer($user_id){
        //$dataUser = ProfileUsers::all();
    try{
        $dataProfileUsers = ProfileUsers::find($user_id);
        $id=$dataProfileUsers['Email'];
        $dataUser = User::find($user_id);
        $dataProfileUsers->delete();
        $dataUser->delete();
        return redirect('/data-user')->with("success",'Data Berhasil Dihapus');
    }catch (\Exception $e){
        return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
    }
    }

    
    public function insertRegis(Request $a){
        try{
            $checkuser = User::where('email',$a->email)->first();
            if($checkuser){
                return redirect()->back()->with('warning', 'Email Telah Terdaftar!');
            }
            User::create([
                'name' => $a->name,
                'email' => $a->email,
                'password' => Hash::make($a->password),
                'role' => $a->level,
                'created_at' => now()
            ]);
            $usersid  = User::orderBy('id', 'DESC')->first();
            ProfileUsers::create([
                'user_id' => $usersid->id,
                'nama' => $a->name,
                'email' => $a->email,
                'created_at' => now()
            ]);
        return redirect('/')->with('success', 'Berhasil Register!');
    }catch (\Exception $e){
        return redirect()->back()->with('error', 'Data Tidak Tersimpan!');
    }
    }
}
