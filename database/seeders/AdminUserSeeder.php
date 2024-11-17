<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // Create the 'admin' role (use lowercase name)
            $adminRole = Role::firstOrCreate(['name' => 'Admin']); // Use lowercase here
            $userRole = Role::firstOrCreate(['name' => 'User']); // Use lowercase here
            // Create some permissions (if they don't exist)
                $viewUsersPermission = Permission::firstOrCreate(['name' => 'view users']);
                $createUsersPermission = Permission::firstOrCreate(['name' => 'create users']);
                $editUsersPermission = Permission::firstOrCreate(['name' => 'edit users']);
                $deleteUsersPermission = Permission::firstOrCreate(['name' => 'delete users']);
      
            // Assign permissions to the 'admin' role
                $adminRole->givePermissionTo([
                    $viewUsersPermission, 
                    $createUsersPermission, 
                    $editUsersPermission, 
                    $deleteUsersPermission
                ]);

    // Create the admin user (if one doesn't already exist)
    $adminUser = User::firstOrCreate(
        ['email' => 'admin@example.com'], // Ensure only one admin user
        [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Hash the password
        ]
    );

    // Assign the 'admin' role to this user (use lowercase role name)
    $adminUser->assignRole('admin'); // Use lowercase here
    }
}
