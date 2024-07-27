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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            //'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => "Calon Santri",
            'password' => Hash::make($request->password),
            'created_at' => now()
        ]);
        $usersid  = User::orderBy('id', 'DESC')->first();
        ProfileUsers::create([
            'user_id' => $usersid->id,
            'nama' => $request->name,
            'username' => $request->username,
            'created_at' => now()
        ]);
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('success', 'Data Tersimpan!');
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

