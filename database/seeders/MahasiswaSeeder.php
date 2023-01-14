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

        // $mahasiswa->assignRole('mahasiswa');
    }
}
