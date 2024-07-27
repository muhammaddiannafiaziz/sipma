<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = "pengumuman";
    protected $fillable = [
        "id_pengumuman",
        "id_pendaftaran",
        "user_id",
        "hasil_seleksi",
        "prodi_penerima",
        "nilai_interview",
        // "nilai_test",
        "status"
    ];
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = "id";

    public static function id()
    {
        $data = DB::table('pembayaran')->orderby('id_pendaftaran', 'DESC')->first();
        
        // Penanganan jika tidak ada data
        if ($data === null) {
            $kodeku = 0;
        } else {
            $kodeakhir5 = substr($data->id_pendaftaran, -3);
            $kodeku = (int)$kodeakhir5;
        }

        $addNol = '';
        $kodetb = 'TAG';
        $kode = $kodeku + 1;

        if (strlen($kode) == 1) {
            $addNol = "000";
        } elseif (strlen($kode) == 2) {
            $addNol = "00";
        } elseif (strlen($kode) == 3) {
            $addNol = "0";
        }

        // Menggunakan Carbon untuk mendapatkan tahun dalam format 'y'
        $kodeBaru = 'ANN' . Carbon::now()->format('y') . $addNol . $kode;

        return $kodeBaru;
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran', 'id_pendaftaran');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}