<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        $this->call(PermissionSeeder::class);
        $this->call(MahasiswaSeeder::class);
        $this->call(DosenSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(KoorSeeder::class);

    }
}
