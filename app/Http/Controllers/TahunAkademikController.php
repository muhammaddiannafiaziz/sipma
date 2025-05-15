<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use SweetAlert;

class TahunAkademikController extends Controller
{
    public function datatahunakademik()
    {
        $data = TahunAkademik :: all();
        return view ('tahun_akademik.tahun-akademik-admin', compact('data'));
    }

    public function edittahunakademik($ta_id)
    {
        $tahunAkademik = TahunAkademik::findOrFail($ta_id);
        return view('tahun_akademik.edit-tahun-akademik', compact('tahunAkademik'));
    }

    public function bukatahunakademik($ta_id){
        //$dataUser = ProfileUsers::all();
        TahunAkademik::where("id", "$ta_id")->update([
            'status' => "open"
        ]);
        return redirect('tahun-akademik');
    }

    public function tutuptahunakademik($ta_id){
        //$dataUser = ProfileUsers::all();
        TahunAkademik::where("id", "$ta_id")->update([
            'status' => "closed"
        ]);
        Gelombang::where("tahun_akademik_id", "$ta_id")->update([
            'status' => "closed"
        ]);
        return redirect('tahun-akademik');
    }

    public function simpantahunakademik(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'tahun' => 'required|string|max:10',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:open,closed'
        ]);

        if ($request->id) {
            // Update data jika id ada (edit)
            $tahun = TahunAkademik::findOrFail($request->id);
            $tahun->update([
                'tahun' => $request->tahun,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'status' => $request->status,
            ]);
            
            Alert::success('Berhasil', "Data tahun akademik berhasil diperbarui");
            
        } else {
            // Simpan data baru
            TahunAkademik::create([
                'tahun' => $request->tahun,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' =>  $request->tanggal_selesai,
                'status'=>  $request -> status 
             ]);
             
             Alert::success('Berhasil', "Data tahun akademik berhasil disimpan");
         }
         
         return redirect()->route('tahun-akademik');
   }

   public function hapustahunakademik($ta_id)
   {
    try{
        TahunAkademik :: findOrFail($ta_id)->delete();
        Alert :: success ('Berhasil','Data berhasil dihapus');
    } catch (\Exception$e){
        Alert :: error ('Gagal','Terjadi kesalahan saat menghapus data');
    }
    
    return redirect() -> route ('tahun-akademik');
   }
}
