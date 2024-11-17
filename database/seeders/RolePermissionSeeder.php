<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create Roles
        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);
        $guestRole = Role::create(['name' => 'Guest']);

        // Create Permissions
        $permissions = ['manage users', 'edit content', 'view content'];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign Permissions to Roles
        $adminRole->givePermissionTo(Permission::all());
        $userRole->givePermissionTo(['view content']);
        $guestRole->givePermissionTo([]);

        // Assign Admin Role to Default User
        $adminUser = User::where('email', 'admin@example.com')->first();
        if ($adminUser) {
            $adminUser->assignRole('Admin');
        }
    }
}

