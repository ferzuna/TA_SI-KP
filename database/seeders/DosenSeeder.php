<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;


class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosen = Dosen::create([
            'NIP' => '0093',
            'nama' => 'fadzil ferdiawan',
            'alamat' => 'batam',
            'email' => 'ferzuna@gmail.com',
            'username' => 'ferzuna',
            'password' => bcrypt('password') 
        ]);

        $dosen->assignRole('dosen');
    }
}
