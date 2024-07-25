<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = "pembayaran";
    protected $fillable = [
        "id_pembayaran",
        "bukti_pembayaran",
        "status",
        "verifikasi",
        "tgl_pembayaran",
        "id_pendaftaran"
    ];
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = "id";

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
    }

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
        $kodeBaru = $kodetb . Carbon::now()->format('y') . $addNol . $kode;

        return $kodeBaru;
    }
}
