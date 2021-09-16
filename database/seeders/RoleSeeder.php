<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'super-admin']);

        Role::create(['name' => 'admin']);

        Role::create(['name' => 'user']);

        Permission::create(['name' => 'All Access']);

        Permission::create(['name' => 'Monitor']);

        Permission::create(['name' => 'view only']);


    }
}
