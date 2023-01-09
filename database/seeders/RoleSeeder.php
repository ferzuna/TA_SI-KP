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
            'guard_name' => 'dosen'

        ]);

        Role::create([
            'name' => 'admin',
            'guard_name' => 'admin'

        ]);

        Role::create([
            'name' => 'koor',
            'guard_name' => 'koor'

        ]);
        // app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Permission::create(['name' => 'view posts']);
        // Permission::create(['name' => 'create posts']);
        // Permission::create(['name' => 'edit posts']);
        // Permission::create(['name' => 'delete posts']);
        // Permission::create(['name' => 'publish posts']);
        // Permission::create(['name' => 'unpublish posts']);


        // $writerRole = Role::create(['name' => 'writer']);
        // $writerRole->givePermissionTo('view posts');
        // $writerRole->givePermissionTo('create posts');
        // $writerRole->givePermissionTo('edit posts');
        // $writerRole->givePermissionTo('delete posts');

        // $adminRole = Role::create(['name' => 'admin']);
        // $adminRole->givePermissionTo('view posts');
        // $adminRole->givePermissionTo('create posts');
        // $adminRole->givePermissionTo('edit posts');
        // $adminRole->givePermissionTo('delete posts');
        // $adminRole->givePermissionTo('publish posts');
        // $adminRole->givePermissionTo('unpublish posts');

        // $superadminRole = Role::create(['name' => 'super-admin']);

        // $mahasiswa = Mahasiswa::factory()->create([
        //     'NIM' => '67233',
        //     'nama' => 'writer@qadrlabs.com',
        //     'angkatan' => bcrypt('12345678'),
        //     'no_telp' => 'f',
        //     'username' => 'dkd',
        //     'password' => 'dkhs'
        // ]);

        // $mahasiswa->assignRole($writerRole);


        // $dosen = Dosen::factory()->create([
        //     'name' => 'Example admin user',
        //     'email' => 'admin@qadrlabs.com',
        //     'password' => bcrypt('12345678')
        // ]);

        // $dosen->assignRole($adminRole);

        // $admin = Admin::factory()->create([
        //     'name' => 'Example superadmin user',
        //     'email' => 'superadmin@qadrlabs.com',
        //     'password' => bcrypt('12345678')
        // ]);
        // $admin->assignRole($superadminRole);
    }
}
