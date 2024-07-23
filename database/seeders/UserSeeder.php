<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ProfileUsers;
use App\Models\Timeline;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create admin
        User::create([
            'name' => 'Iam Admin',
            'password' => Hash::make('admin@mahad2024'),
            'username' => 'Adminmahad',
            'role' => 'Administrator',
            'created_at' => now()
        ]);
        ProfileUsers::create([
            'user_id' => 1,
            'nama' => 'Iam Admin',
            'email' => 'mahad.aljamiah@uinsaid.ac.id',
            'created_at' => now()
        ]);
   
        User::create([
            'name' => 'User Satu',
            'password' => Hash::make('12345678'),
            'username' => '100000001',
            'role' => 'Calon Santri',
            'created_at' => now()
        ]);
        ProfileUsers::create([
            'user_id' => 2,
            'nama' => 'User Satu',
            'username' => '100000001',
            'email' => 'user1@gmail.com',
            'created_at' => now()
        ]);
   
        User::create([
            'name' => 'User Dua',
            'password' => Hash::make('12345678'),
            'username' => '100000002',
            'role' => 'Calon Santri',
            'created_at' => now()
        ]);
        ProfileUsers::create([
            'user_id' => 3,
            'nama' => 'User Dua',
            'username' => '100000002',
            'email' => 'user2@gmail.com',
            'created_at' => now()
        ]);
   
        User::create([
            'name' => 'User Tiga',
            'password' => Hash::make('12345678'),
            'username' => '100000003',
            'role' => 'Calon Santri',
            'created_at' => now()
        ]);
        ProfileUsers::create([
            'user_id' => 3,
            'nama' => 'User Tiga',
            'username' => '100000003',
            'email' => 'user2@gmail.com',
            'created_at' => now()
        ]);

    }
}
