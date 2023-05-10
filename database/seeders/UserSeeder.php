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
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 3
        ]);
        $admin->assignRole('admin');
        
        $dosen = User::create([
            'NIP' => '8927',
            'name' => 'pajil',
            'username' => 'pajil',
            'email' => 'dosen@gmail.com',
            'alamat' => 'jawa tengah',
            'password' => bcrypt('password'),
            'role_id' => 4,
            'kuota_bimbingan' => 4,
            'bobot_bimbingan' => 0,
        ]);
        $dosen->assignRole('dosen');
        
        $dosen1 = User::create([
            'NIP' => '8924',
            'name' => 'wicak',
            'username' => 'wicak',
            'email' => 'dosen1@gmail.com',
            'alamat' => 'jawa tengah',
            'password' => bcrypt('password'),
            'role_id' => 4,
            'kuota_bimbingan' => 4,
            'bobot_bimbingan' => 0,
        ]);
        $dosen1->assignRole('dosen');
        
        $dosen2 = User::create([
            'NIP' => '8925',
            'name' => 'akbar',
            'username' => 'akbar',
            'email' => 'dosen2@gmail.com',
            'alamat' => 'jawa tengah',
            'password' => bcrypt('password'),
            'role_id' => 4,
            'kuota_bimbingan' => 4,
            'bobot_bimbingan' => 0,
            'status' => '1',
        ]);
        $dosen2->assignRole('dosen');
        
        $koor = User::create([
            'name' => 'koor',
            'username' => 'koor',
            'email' => 'koor@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 2
        ]);
        $koor->assignRole('koor');

        $mahasiswa = User::create([
            'NIM' => '21120119150001',
            'name' => 'mahasiswa',
            'semester' => '8',
            'no_telp' => '983385',
            'username' => 'mahasiswa',
            'sks' => '144',
            'alamat' => 'jl banjarsari no 51',
            'email' => 'mahasiswa@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1
        ]);
        $mahasiswa->assignRole('mahasiswa');

        
    }
}
