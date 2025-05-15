<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    use HasFactory;

    protected $table = 'gelombang';

    protected $fillable = [
        'nomor_gelombang',
        'tahun_akademik_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class);
    }
}
