<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create Permissions
        $permission1 = Permission::create(['name' => 'view-about']);
        $permission2 = Permission::create(['name' => 'view-service']);
        $permission3 = Permission::create(['name' => 'Get in Touch btn']);
        $permission4 = Permission::create(['name' => 'view content']);
        $permission5 = Permission::create(['name' => 'view-contactform']);
       
        // Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'User']);

        // Assign permissions to the 'admin' role
        $adminRole->givePermissionTo([
            $permission4
        
        ]);

        // Assign limited permissions to the 'user' role
        $userRole->givePermissionTo([
            $permission1, 
            $permission2, 
            $permission3, 
            $permission5, 
        ]);
    }
}
