<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(RolesSeeder::class);

        User::firstOrCreate(
            ['email' => 'admin@admin.test'],
            [
                'name' => 'Administrador',
                'last_name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'must_change_password' => false,
                'email_verified_at' => now(),
            ],
        )->assignRole('admin');

        if (config('app.debug')) {
            $this->call(TestSeeder::class);
        }
    }
}
