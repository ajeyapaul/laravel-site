<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Create permissions
        $userPermissions = [
            'create user',
            'read user',
            'update user',
            'delete user'
        ];

        $postPermissions = [
            'create post',
            'read post',
            'update post',
            'delete post'
        ];

        foreach ($userPermissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

        foreach ($postPermissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

        // Assign permissions to roles
        $adminRole->givePermissionTo(array_merge($userPermissions, $postPermissions));
        $userRole->givePermissionTo($postPermissions);
    }
}
