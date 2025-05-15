<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProfileUsers;
use App\Models\Timeline;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Rules\UsernameRule;
use Illuminate\Support\Facades\Http;
use Alert;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        // Pesan khusus untuk validasi
        $message = [
            'username.max' => 'Harap isi NIM dengan benar.',
            'name.required' => 'Nama harus diisi.',
            'username.required' => 'NIM harus diisi.',
            'username.string' => 'NIM harus berupa teks.',
            'username.unique' => 'NIM sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.confirmed' => 'Password tidak sesuai dengan konfirmasi.',
        ];

        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:9', 'unique:users,username', new UsernameRule()],
            'password' => ['required', 'confirmed'],
        ], $message);

        try {
            // Melakukan request ke API dengan token dan parameter
            $response = Http::post('https://api.uinsaid.ac.id/api-siakad/siakaduin.php', [
                'info' => 'mhs',
                'nim' => $request->username,
                'user_token' => '4eayXGstJk7KQWlADVxGk1DsK02GyEfmH03REihfVp'
            ]);

            // Memeriksa apakah request berhasil
            if ($response->successful()) {
                $data = $response->json();
                $upperNama = strtoupper($request->name);
                // Ambil nama mahasiswa saja
                $namaMhs = $data['data'][0]['nama_mhs'] ?? null;
                $nimMhs = $data['data'][0]['nim'] ?? null;
                $prodiMhs = $data['data'][0]['nama_prodi'] ?? null;
                $tmpMhs = $data['data'][0]['tmp_lahir'] ?? null;
                $tglMhs = $data['data'][0]['tgl_lahir'] ?? null;
                $emailMhs = $data['data'][0]['email'] ?? null;

                if ($upperNama === $namaMhs) {
                    $user = User::create([
                        'name' => $namaMhs,
                        'username' => $nimMhs,
                        'role' => "Calon Santri",
                        'password' => Hash::make($request->password),
                        'created_at' => now()
                    ]);
                    $usersid  = User::orderBy('id', 'DESC')->first();
                    ProfileUsers::create([
                        'user_id' => $usersid->id,
                        'nama' => $namaMhs,
                        'username' => $nimMhs,
                        'prodi' => $prodiMhs,
                        'tempat_lahir' => $tmpMhs,
                        'tanggal_lahir' => $tglMhs,
                        'email' => $emailMhs,
                        'created_at' => now()
                    ]);
                    event(new Registered($user));
            
                    Auth::login($user);
            
                    return redirect(RouteServiceProvider::HOME)->with('success', 'Data Tersimpan!');
                }else{
                    return redirect()->back()->withErrors(['namamhs' => 'Masukkan nama lengkap sesuai dengan data siakad']);
                }
            } else {
                // Mengembalikan pesan error jika request gagal
                return response()->json(['error' => 'Gagal mengambil data dari SIAKAD.'], $response->status());
            }
        } catch (\Exception $e) {
            // Menangani exception dari HTTP client
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data dari API: ' . $e->getMessage()], 500);
        }
    }

    public function insertRegis(Request $a){
        try{
            $checkuser = User::where('username',$a->username)->first();
            if($checkuser){
                return redirect()->back()->with('warning', 'NIM Telah Terdaftar!');
            }
            User::create([
                'name' => $a->nama,
                'username' => $a->username,
                'password' => Hash::make($a->password),
                'role' => $a->level,
                'created_at' => now()
            ]);
            $usersid  = User::orderBy('id', 'DESC')->first();
            ProfileUsers::create([
                'user_id' => $usersid->id,
                'nama' => $a->nama,
                'username' => $a->username,
                'created_at' => now()
            ]);
        return redirect('/login')->with('success', 'Berhasil Register!');
    }catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Tersimpan!');
    }
    }
}

