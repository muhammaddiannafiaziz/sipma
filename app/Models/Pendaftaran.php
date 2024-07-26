<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Carbon;

class Pendaftaran extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;

    protected $table = 'pendaftaran';
    protected $primaryKey = "id";
    protected $fillable = [
        'id_pendaftaran',
        'user_id',
        'nim',
        'nama_siswa',
        'prodi',
        'gender',
        'pas_foto',
        'tempat_lahir',
        'tanggal_lahir',

        'status_pendaftaran',
        'tgl_pendaftaran',
        'created_at'
    ];
  
    public static function id()
    {
        $data = DB::table('pendaftaran')->orderby('id_pendaftaran', 'DESC')->first();

        // Penanganan jika tidak ada data di tabel
        if ($data === null) {
            $kodeku = 0;
        } else {
            $kodeakhir5 = substr($data->id_pendaftaran, -4);
            $kodeku = (int)$kodeakhir5;
        }

        $addNol = '';
        $kodetb = 'PENDPSB';
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

    public function user()
    {
         return $this->belongsTo(User::class, 'user_id');
    }

     public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class);
    }

    public function jadwal(){
        return $this->belongsTo(JadwalKegiatan::class,'gelombang');
    }

}
