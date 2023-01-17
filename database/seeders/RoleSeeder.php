<?php

namespace Database\Seeders;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Koor;
use App\Models\Mahasiswa;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds. 
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'mahasiswa',
            'guard_name' => 'web'

        ]);

        Role::create([
            'name' => 'dosen',
            'guard_name' => 'web'

        ]);

        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'

        ]);

        Role::create([
            'name' => 'koor',
            'guard_name' => 'web'

        ]);
            }
}
