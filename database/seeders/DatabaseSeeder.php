<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'user@truckersmp.com',
             'password' => Hash::make('password')
         ]);

        $Admin = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@truckersmp.com',
            'password' => Hash::make('password')
        ]);

        //Create roles & assign permissions - This allows admins to manage suggestions
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'manage suggestions']);

        $Admin->assignRole($role);
        $Admin->givePermissionTo($permission);

        //Once users are created, create a few test suggestions
        $this->call([
            SuggestionSeeder::class
        ]);
    }
}
