<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswa = Mahasiswa::create([
            'NIM' => '21120119130070',
            'nama' => 'Indriawan Muhammad Akbar',
            'angkatan' => '2019',
            'no_telp' => '081317382813',
            'username' => 'imakbar',
            'password' => bcrypt('password') 
        ]);
        
        $mahasiswa1 = Mahasiswa::create([
            'NIM' => '21120119130056',
            'nama' => 'Fadzil Ferdiawan',
            'angkatan' => '2019',
            'no_telp' => '081317382813',
            'username' => 'imakbar',
            'password' => bcrypt('password') 
        ]);
        
        $mahasiswa2 = Mahasiswa::create([
            'NIM' => '21120119130114',
            'nama' => 'Muhammad Ilham Wicaksono',
            'angkatan' => '2019',
            'no_telp' => '081317382813',
            'username' => 'imakbar',
            'password' => bcrypt('password') 
        ]);
        
        $mahasiswa3 = Mahasiswa::create([
            'NIM' => '21120119130072',
            'nama' => 'Dimas Rafi',
            'angkatan' => '2019',
            'no_telp' => '081317382813',
            'username' => 'imakbar',
            'password' => bcrypt('password') 
        ]);
        
        $mahasiswa4 = Mahasiswa::create([
            'NIM' => '21120119130078',
            'nama' => 'Alif Nabil Musyaffa',
            'angkatan' => '2019',
            'no_telp' => '081317382813',
            'username' => 'imakbar',
            'password' => bcrypt('password') 
        ]);
            

        // $mahasiswa->assignRole('mahasiswa');
    }
}
