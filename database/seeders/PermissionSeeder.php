<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  
    
        public function run()
        {
            $permissions = ['view articles', 'edit articles', 'delete articles', 'create articles'];
    
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
        }
    }
    
