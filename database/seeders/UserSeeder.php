<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('admin');
        
        $dosen = User::create([
            'name' => 'dosen',
            'email' => 'dosen@gmail.com',
            'password' => bcrypt('password')
        ]);
        $dosen->assignRole('dosen');
        
        $koor = User::create([
            'name' => 'koor',
            'email' => 'koor@gmail.com',
            'password' => bcrypt('password')
        ]);
        $koor->assignRole('koor');

        $mahasiswa = User::create([
            'name' => 'mahasiswa',
            'email' => 'mahasiswa@gmail.com',
            'password' => bcrypt('password')
        ]);
        $mahasiswa->assignRole('mahasiswa');
    }
}
