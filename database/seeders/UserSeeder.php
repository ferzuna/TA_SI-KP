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
            'status' => '1',
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
            'status' => '1',
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
        $mahasiswa1 = User::create([
            'NIM' => '21120119150002',
            'name' => 'mahasiswa1',
            'semester' => '8',
            'no_telp' => '983385',
            'username' => 'mahasiswa1',
            'sks' => '144',
            'alamat' => 'jl banjarsari no 51',
            'email' => 'mahasiswa1@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1
        ]);
        $mahasiswa1->assignRole('mahasiswa');
        $mahasiswa2 = User::create([
            'NIM' => '21120119150003',
            'name' => 'mahasiswa2',
            'semester' => '8',
            'no_telp' => '983385',
            'username' => 'mahasiswa2',
            'sks' => '144',
            'alamat' => 'jl banjarsari no 51',
            'email' => 'mahasiswa2@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1
        ]);
        $mahasiswa2->assignRole('mahasiswa');
        $mahasiswa3 = User::create([
            'NIM' => '21120119150004',
            'name' => 'mahasiswa3',
            'semester' => '8',
            'no_telp' => '983385',
            'username' => 'mahasiswa3',
            'sks' => '144',
            'alamat' => 'jl banjarsari no 51',
            'email' => 'mahasiswa3@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1
        ]);
        $mahasiswa3->assignRole('mahasiswa');
        
        
    }
}
