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
            'bobot_bimbingan' => 0,
            'kuota_bimbingan' => 0,
            'email' => 'ferzuna@gmail.com',
            'username' => 'ferzuna',
            'password' => bcrypt('password') 
        ]);

        $dosen1 = Dosen::create([
            'NIP' => '0092',
            'nama' => 'muhammad ilham wicaksono',
            'alamat' => 'bekasi',
            'bobot_bimbingan' => 0,
            'kuota_bimbingan' => 0,
            'email' => 'wicak@gmail.com',
            'username' => 'wicak',
            'password' => bcrypt('password') 
        ]);
        $dosen2 = Dosen::create([
            'NIP' => '0091',
            'nama' => 'indriawan muhammad akbar',
            'alamat' => 'jakarta',
            'bobot_bimbingan' => 0,
            'kuota_bimbingan' => 0,
            'email' => 'kibar@gmail.com',
            'username' => 'kibar',
            'password' => bcrypt('password') 
        ]);
        $dosen3 = Dosen::create([
            'NIP' => '0090',
            'nama' => 'murjito',
            'alamat' => 'bintara',
            'bobot_bimbingan' => 0,
            'kuota_bimbingan' => 0,
            'email' => 'jito@gmail.com',
            'username' => 'jito',
            'password' => bcrypt('password') 
        ]);
        $dosen4 = Dosen::create([
            'NIP' => '0099',
            'nama' => 'joko warsono',
            'alamat' => 'bintara',
            'bobot_bimbingan' => 0,
            'kuota_bimbingan' => 0,
            'email' => 'djoko@gmail.com',
            'username' => 'djoko',
            'password' => bcrypt('password') 
        ]);


        // $dosen->assignRole('dosen');
    }
}
