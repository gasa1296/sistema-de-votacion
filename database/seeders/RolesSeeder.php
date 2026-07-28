<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'manage_elections',
            'manage_candidates',
            'manage_voters',
            'view_results',
            'export_results',
            'cast_vote',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions([
            'manage_elections',
            'manage_candidates',
            'manage_voters',
            'view_results',
            'export_results',
        ]);

        $voter = Role::firstOrCreate(['name' => 'voter', 'guard_name' => 'web']);
        $voter->syncPermissions(['cast_vote']);
    }
}
