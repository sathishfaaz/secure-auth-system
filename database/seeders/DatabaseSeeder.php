<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AdminUserSeeder::class,  // Example: Seeder for admin user
            RoleSeeder::class,       // Seeder for roles
            // Add other seeders as needed
        ]);

    }
}
