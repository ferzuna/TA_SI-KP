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
            'NIM' => '2112',
            'name' => 'mahasiswa',
            'semester' => '2019',
            'no_telp' => '983385',
            'username' => 'mahasiswa',
            'email' => 'mahasiswa@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1
        ]);
        $mahasiswa->assignRole('mahasiswa');

        $mahasiswa9 = User::create([
            'NIM' => '21120119130070',
            'name' => 'Indriawan Muhammad Akbar',
            'semester' => '2019',
            'no_telp' => '081317382813',
            'username' => 'imakbar',
            'email' => 'bolehngasal@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1
        ]);
        $mahasiswa9->assignRole('mahasiswa');
        
        $mahasiswa1 = User::create([
            'NIM' => '21120119130056',
            'name' => 'Fadzil Ferdiawan',
            'semester' => '2019',
            'no_telp' => '081317382813',
            'username' => 'imakbar',
            'email' => 'ferzuna1@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1 
        ]);
        $mahasiswa1->assignRole('mahasiswa');
        
        $mahasiswa2 = User::create([
            'NIM' => '21120119130114',
            'name' => 'Muhammad Ilham Wicaksono',
            'semester' => '2019',
            'no_telp' => '081317382813',
            'username' => 'imakbar',
            'email' => 'wickkedua@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1 
        ]);
        $mahasiswa2->assignRole('mahasiswa');
        
        $mahasiswa3 = User::create([
            'NIM' => '21120119130072',
            'name' => 'Dimas Rafi',
            'semester' => '2019',
            'no_telp' => '081317382813',
            'username' => 'imakbar',
            'email' => 'dime@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1 
        ]);
        $mahasiswa3->assignRole('mahasiswa');
        
        $mahasiswa4 = User::create([
            'NIM' => '21120119130078',
            'name' => 'Alif Nabil Musyaffa',
            'semester' => '2019',
            'no_telp' => '081317382813',
            'username' => 'imakbar',
            'email' => 'theshield@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1 
        ]);
        $mahasiswa4->assignRole('mahasiswa');


        $dosen6 = User::create([
            'NIP' => '0093',
            'name' => 'fadzil ferdiawan',
            'alamat' => 'batam',
            'bobot_bimbingan' => 0,
            'kuota_bimbingan' => 25,
            'email' => 'ferzuna@gmail.com',
            'username' => 'ferzuna',
            'role_id' => 4,
            'password' => bcrypt('password') 
        ]);
        $dosen6->assignRole('dosen');

        $dosen11 = User::create([
            'NIP' => '0092',
            'name' => 'muhammad ilham wicaksono',
            'alamat' => 'bekasi',
            'bobot_bimbingan' => 0,
            'kuota_bimbingan' => 25,
            'email' => 'wicak@gmail.com',
            'username' => 'wicak',
            'role_id' => 4,
            'password' => bcrypt('password') 
        ]);
        $dosen11->assignRole('dosen');

        $dosen21 = User::create([
            'NIP' => '0091',
            'name' => 'indriawan muhammad akbar',
            'alamat' => 'jakarta',
            'bobot_bimbingan' => 0,
            'kuota_bimbingan' => 25,
            'email' => 'kibar@gmail.com',
            'username' => 'kibar',
            'role_id' => 4,
            'password' => bcrypt('password') 
        ]);
        $dosen21->assignRole('dosen');

        $dosen3 = User::create([
            'NIP' => '0090',
            'name' => 'murjito',
            'alamat' => 'bintara',
            'bobot_bimbingan' => 0,
            'kuota_bimbingan' => 25,
            'email' => 'jito@gmail.com',
            'username' => 'jito',
            'role_id' => 4,
            'password' => bcrypt('password') 
        ]);
        $dosen3->assignRole('dosen');

        $dosen4 = User::create([
            'NIP' => '0099',
            'name' => 'joko warsono',
            'alamat' => 'bintara',
            'bobot_bimbingan' => 0,
            'kuota_bimbingan' => 25,
            'email' => 'djoko@gmail.com',
            'username' => 'djoko',
            'role_id' => 4,
            'password' => bcrypt('password') 
        ]);
        $dosen4->assignRole('dosen');
    }
}
