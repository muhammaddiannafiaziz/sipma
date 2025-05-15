<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class GelombangController extends Controller
{
    // Menampilkan daftar gelombang
    public function datagelombang()
    {
        $gelombangs = Gelombang::all();
        $tahunakademik = TahunAkademik::all();
        $tahunaktif = TahunAkademik::where('status', 'open')->get();
        return view('gelombang.gelombang-admin', compact('gelombangs', 'tahunakademik', 'tahunaktif'));
    }

    // Menyimpan data gelombang baru
    public function simpangelombang(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nomor_gelombang' => 'required|string|max:255',
            'tahun_akademik_id' => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|in:open,closed',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data tidak valid.')->persistent('Tutup');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data
        Gelombang::create([
            'nomor_gelombang' => $request->nomor_gelombang,
            'tahun_akademik_id' => $request->tahun_akademik_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
        ]);

        Alert::success('Berhasil', 'Gelombang berhasil ditambahkan.')->persistent('Tutup');
        return redirect()->route('gelombang');
    }

    // Update status menjadi open
    public function bukagelombang($id)
    {
        $gelombang = Gelombang::findOrFail($id);
        $gelombang->update(['status' => 'open']);

        Alert::success('Berhasil', 'Gelombang berhasil dibuka.')->persistent('Tutup');
        return redirect()->route('gelombang');
    }

    // Update status menjadi closed
    public function tutupgelombang($id)
    {
        $gelombang = Gelombang::findOrFail($id);
        $gelombang->update(['status' => 'closed']);

        Alert::success('Berhasil', 'Gelombang berhasil ditutup.')->persistent('Tutup');
        return redirect()->route('gelombang');
    }

    // Menghapus gelombang
    public function hapusgelombang($id)
    {
        $gelombang = Gelombang::findOrFail($id);
        $gelombang->delete();

        Alert::success('Berhasil', 'Gelombang berhasil dihapus.')->persistent('Tutup');
        return redirect()->route('gelombang');
    }
}
