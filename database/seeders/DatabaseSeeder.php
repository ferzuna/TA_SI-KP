<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\KoorSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\DosenSeeder;
use Database\Seeders\MahasiswaSeeder;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(DosenSeeder::class);
        // $this->call(MahasiswaSeeder::class);

    }
}
