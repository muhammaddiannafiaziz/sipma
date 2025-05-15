<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use Illuminate\Http\Request;
use App\Models\ProfileUsers;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Models\Pengumuman;
use App\Models\TahunAkademik;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Support\Facades\Hash;
Use Illuminate\Support\Carbon;
use File;
use Alert;

class PendaftaranController extends Controller
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

    //data pendaftaran kompliit
    public function datapendaftaran(){
        $dataUser = ProfileUsers::all();
        $data = Pendaftaran::all();
        $datapembayaran = Pembayaran::all();
        return view ('pendaftaran.data-pendaftaran-admin',['viewDataPembayaran' => $datapembayaran,
                                                            'viewDataUser' => $dataUser,
                                                            'viewData' => $data
                                                        ]);
    }

    public function inputpendaftaran(){
        $tahunaktif = TahunAkademik::where('status', 'open')->get();
        $gelombangaktif = Gelombang::where('status', 'open')->get();
        return view ('pendaftaran.data-pendaftaran-input-admin', compact('tahunaktif','gelombangaktif'));
    }

    public function simpanpendaftaran(Request $a)
    {
        try{
        $dataUser = ProfileUsers::all();

        $kodependaftaran = Pendaftaran::id();
        
        // Validasi unggah foto
        $message = [
            'foto.required' => 'Harap unggah foto.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Hanya file dengan ekstensi jpg dan png yang diperbolehkan.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 300KB.',
            'berkas_siswa.mimes' => 'Berkas Pendaftaran harus berupa file PDF',
            'berkas_siswa.max' => 'Berkas Pendaftaran maksimal berukuran 2 MB',
            
        ];

        $a->validate([
            'foto' => ['required', 'image', 'mimes:jpg,png', 'max:300'], // 300 KB
            'berkas_siswa' => 'mimes:pdf|max:2000',
        ], $message);

        // Proses unggah foto
        $file = $a->file('foto');
        $nama_file = "Pasfoto-".uniqid()."-".$file->getClientOriginalName();
        $nimmahasiswa = Auth::user()->username;
        $namaFolder = 'data pendaftar/'.$nimmahasiswa;

        $file->move($namaFolder,$nama_file);
        $pathFoto = $namaFolder."/".$nama_file;

        $fileberkas_siswa = $a->file('berkas_siswa');
        if(file_exists($fileberkas_siswa)){
            $nama_fileberkas_siswa = "Berkas".time() . "-" . $fileberkas_siswa->getClientOriginalName();
            $namaFolderberkas_siswa = 'data pendaftar/'.$nimmahasiswa;
            $fileberkas_siswa->move($namaFolderberkas_siswa,$nama_fileberkas_siswa);
            $pathBerkas = $namaFolderberkas_siswa."/".$nama_fileberkas_siswa;
        } else {
            $pathBerkas = null;
        }

        Pendaftaran::create([
            'id_pendaftaran' => $kodependaftaran,
            'user_id' => Auth::user()->id,
            'nim' => $a->nim,
            'nama_siswa' => $a->nama,
            'prodi' => $a->prodi,
            'gender' => $a->jk,
            'tempat_lahir' => $a->tempatlahir,
            'tanggal_lahir' => $a->tanggallahir,
            
            'asal_sekolah' => $a->asalsekolah,
            'pernah_mondok' => $a->pernah_mondok,
            'nama_pondok' => $a->nama_pondok,
            'lama' => $a->lama,
            'prestasi' => $a->prestasi,

            'berkas_siswa' => $pathBerkas,
            'pas_foto' => $pathFoto,
            'status_pendaftaran' => 'Belum Terverifikasi',
            'tgl_pendaftaran' => now(),
            'tahun_masuk' => $a->tahun_masuk,
            'gelombang' => $a->gelombang,
            'created_at' => now()
        ]);
        // ProfileUsers::where("user_id", Auth::user()->id)->update([
        //     'sekolah_sma' => $a->asalsekolah,
        //     'prestasi' => $pathBerkas,
        //     'updated_at' => now()
        // ]);
        $pendaftaranbaru = Pendaftaran::orderBy('id','DESC')->first();
        // $id_pendaftaran = $pendaftaranbaru->id;
        // $id_pendaftaran = $pendaftaranbaru->id_pendaftaran;
        
        //tambah insert
        $kodepembayaran = Pembayaran::id();
        echo $kodepembayaran;
        Pembayaran::create([
            'id_pembayaran' => $kodepembayaran,
            //'bukti_pembayaran' => "NULL",
            'status'=> "Belum Bayar",
            'verifikasi'=> false,
            'jatuh_tempo'  => now()->addDays(7)->format('Y-m-d'),
            'tgl_pembayaran' => now(),
            'total_bayar'  => 1800000, 
            'id_pendaftaran' =>$kodependaftaran,
            'created_at' => now()
        ]);

        $kodepengumuman = Pengumuman::id();
        Pengumuman::create([
            'id_pengumuman' => $kodepengumuman,
            'id_pendaftaran' => $kodependaftaran,
            'hasil_seleksi' => "Belum Seleksi",
            'user_id' => Auth::user()->id,
            'status' => false,
        ]);
        
        return redirect('/data-registration')->with('success', 'Data Tersimpan!!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal, kembalikan ke halaman form dengan pesan kesalahan
            return redirect('/form-registration')
                ->withErrors($e->validator)
                ->withInput(); // Mengembalikan input sebelumnya
        } catch (\Exception $e) {
            // Tangani error lain
            return redirect('/form-registration')
                ->with('error', 'Terjadi kesalahan saat menyimpan pendaftaran: ' . $e->getMessage())
                ->withInput(); // Mengembalikan input sebelumnya
        }
    }

    public function verifikasistatuspendaftaran($id_pendaftaran){
        //$dataUser = ProfileUsers::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Terverifikasi"
        ]);
        return redirect('data-registration');
    }

    public function notverifikasistatuspendaftaran($id_pendaftaran){
        //$dataUser = ProfileUsers::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Belum Terverifikasi"
        ]);
        return redirect('data-registration');
    }

    public function invalidstatuspendaftaran($id_pendaftaran){
        //$dataUser = ProfileUsers::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Tidak Sah"
        ]);
        return redirect('/data-registration');
    }

    public function selesaistatuspendaftaran($id_pendaftaran){
        //$dataUser = ProfileUsers::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Selesai"
        ]);
        return redirect('/data-registration');
    }


    public function editpendaftaran($id_pendaftaran)
    {
        $dataUser = ProfileUsers::all();
        $datenow = date('Y-m-d'); 
        $data = Pendaftaran::where("id_pendaftaran",$id_pendaftaran)->first();
        $dataProfil = ProfileUsers::where("username", $data->nim)->first();
        return view('pendaftaran.data-pendaftaran-edit-admin', ['viewDataUser' => $dataUser,'viewDataProfil' => $dataProfil,'viewData' => $data]);
    }

    public function updatependaftaran(Request $a, $id_pendaftaran){

        try{

        $nimmahasiswa = $a->nim;

        $file = $a->file('foto');
        if(file_exists($file)){
            $nama_file = "Pasfoto-".uniqid()."-".$file->getClientOriginalName();
            $namaFolder = 'data pendaftar/'.$nimmahasiswa;
    
            $file->move($namaFolder,$nama_file);
            $pathFoto = $namaFolder."/".$nama_file;

            Pendaftaran::where("id_pendaftaran", $id_pendaftaran)->update([
                'pas_foto' => $pathFoto
            ]);
        }else{
            $pathFoto = $a->pathFoto;
        }

        $fileberkas_siswa = $a->file('berkas_siswa');
        if(file_exists($fileberkas_siswa)){
            $nama_fileberkas_siswa = "Berkas".time() . "-" . $fileberkas_siswa->getClientOriginalName();
            $namaFolderberkas_siswa = 'data pendaftar/'.$nimmahasiswa;
            $fileberkas_siswa->move($namaFolderberkas_siswa,$nama_fileberkas_siswa);
            $pathBerkas = $namaFolderberkas_siswa."/".$nama_fileberkas_siswa;

            Pendaftaran::where("id_pendaftaran", $id_pendaftaran)->update([
                'berkas_siswa' => $pathBerkas
            ]);
        } else {
            $pathBerkas = $a->pathBerkas;
        }

        Pendaftaran::where("id_pendaftaran", $id_pendaftaran)->update([
            'nama_siswa' => $a->nama
        ]);
        
        return redirect('/data-registration')->with('success', 'Data Terubah!!');
        } catch (\Exception $e){
            echo $e;
            //return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }

    public function hapuspendaftaran($id_pendaftaran){
        //$dataUser = ProfileUsers::all();
        try{
            // $data = Pendaftaran::find($id_pendaftaran);
            $dataPendaftaran = Pendaftaran::where("id_pendaftaran",$id_pendaftaran)->first();
            // $dataPembayaran = Pembayaran::where("id_pendaftaran",$id_pendaftaran)->first();
            // File::delete($dataPembayaran->bukti_pembayaran);
            $dataPendaftaran->delete();
            // $dataPembayaran->delete();
            return redirect('/data-registration')->with('success', 'Data Terhapus!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
        }
    }

    public function detailpendaftaran($id_pendaftaran)
    {
        $dataUser = ProfileUsers::all();
        $data = Pendaftaran::where("id_pendaftaran",$id_pendaftaran)->first();
        $dataProfil = ProfileUsers::where("username", $data->nim)->first();
        $datPembayaran = Pembayaran::where("id_pendaftaran",$data->id_pendaftaran)->first();
        $no=1;
        $namalengkap = urlencode(ucwords(strtolower($dataProfil->nama)));
        $programstudi = urlencode(ucwords(strtolower($dataProfil->prodi)));

        
        
        $datapembayaran = Pendaftaran::where("id_pendaftaran", $id_pendaftaran)->get();
        return view('pendaftaran.data-pendaftaran-detail', [
            'viewDataUser' => $dataUser,
            'viewDataProfil' => $dataProfil,
            'viewDataPembayaran' => $datPembayaran,
            'viewData' => $data,
            'viewNamaLengkap' => $namalengkap,
            'viewProgramStudi' => $programstudi
        ]);
    }

    public function kartupendaftaran($id_pendaftaran)
    {
        $dataUser = ProfileUsers::all();
        // $data = Pendaftaran::find($id_pendaftaran);
        $data = Pendaftaran::where("id_pendaftaran",$id_pendaftaran)->first();
        $dataProfil = ProfileUsers::where("username", $data->nim)->first();

        return view('pendaftaran.data-pendaftaran-kartu-admin', ['viewDataUser' => $dataUser,'viewDataProfil' => $dataProfil,'viewData' => $data]);
    }
}
