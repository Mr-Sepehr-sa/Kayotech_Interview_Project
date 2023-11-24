<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view-users']);
        Permission::create(['name' => 'deactivate-users']);

        // create roles and assign created permissions
        $adminRole = Role::create(['name' => 'Admin']);
        $MidAdminRole = Role::create(['name' => 'MidLevelAdmin']);
        $userRole = Role::create(['name' => 'user']);

        $adminRole->givePermissionTo(Permission::all());

        $MidAdminRole->givePermissionTo([
            'view-users',
        ]);

    }

}
