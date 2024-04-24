<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RolePermissionSeeder::class,
        ]);

        $adminRole = Role::findByName('admin');
        $userRole = Role::findByName('user');

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole($adminRole);

        User::factory(10)->create()->each(function ($user) use ($userRole) {
            if ($userRole) {
                $user->assignRole($userRole);
            } else {
                // Handle case where role doesn't exist (optional)
            }
        });

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole($userRole);
    }
}
