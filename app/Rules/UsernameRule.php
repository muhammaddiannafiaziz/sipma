<?php

namespace App\Rules;

use App\Models\Gelombang;
use App\Models\TahunAkademik;
use Illuminate\Contracts\Validation\Rule;

class UsernameRule implements Rule
{
    private $errorMessage;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->errorMessage = 'Username tidak valid.';
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Ambil tahun akademik dan gelombang yang statusnya 'open'
        $tahunAktif = TahunAkademik::where('status', 'open')->first();
        $gelombangAktif = Gelombang::where('status', 'open')->first();

        // Jika tahun akademik atau gelombang aktif tidak ditemukan
        if (!$tahunAktif || !$gelombangAktif) {
            $this->errorMessage = 'Pendaftaran Ditutup';
            return false;
        }

        // Ambil 2 digit terakhir dari tahun akademik (pastikan string)
        $tahunAkhir = substr((string) $tahunAktif->tahun, -2);

        // Ambil 2 digit pertama dari username
        $awalNim = substr($value, 0, 2);

        // Cek apakah 2 digit awal username sama dengan 2 digit terakhir tahun akademik aktif
        if ($awalNim !== $tahunAkhir) {
            $this->errorMessage = 'Hanya mahasiswa baru yang dapat melakukan proses registrasi';
            return false;
        }

        // Validasi format username: harus tepat 9 digit angka (2 digit tahun + 7 digit angka)
        
         if (!preg_match('/^\d{9}$/', $value)) {
             $this->errorMessage = 'Username harus terdiri dari tepat 9 digit angka.';
             return false;
         }

         return true;  
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errorMessage;
    }
}
