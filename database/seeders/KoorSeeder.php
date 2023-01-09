<?php

namespace Database\Seeders;

use App\Models\Koor;
use Illuminate\Database\Seeder;

class KoorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $koor = Koor::create([
            'username' => 'burisma123',
            'password' => bcrypt('password') 
        ]);

        $koor->assignRole('koor');
    }
}
