<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Create roles
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Academic Head']);
        Role::create(['name' => 'Teacher']);
        Role::create(['name' => 'Student']);
    
        // Create permissions
        Permission::create(['name' => 'manage courses']);
        Permission::create(['name' => 'manage modules']);
    
        // Assign permissions to roles
        Role::findByName('Admin')->givePermissionTo(['manage courses', 'manage modules']);
        Role::findByName('Academic Head')->givePermissionTo(['manage courses']);
    }
    
}



