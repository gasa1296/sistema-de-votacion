<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        $election = Election::create([
            'name' => 'Elección de Prueba',
            'description' => 'Elección generada por TestSeeder para pruebas.',
            'status' => 'open',
            'opens_at' => now(),
        ]);

        $candidates = [
            ['name' => 'María', 'last_name' => 'García', 'position' => 'Presidente', 'display_order' => 0],
            ['name' => 'Carlos', 'last_name' => 'López', 'position' => 'Presidente', 'display_order' => 1],
            ['name' => 'Ana', 'last_name' => 'Martínez', 'position' => 'Presidente', 'display_order' => 2],
        ];

        foreach ($candidates as $data) {
            Candidate::factory()->create(array_merge($data, [
                'election_id' => $election->id,
            ]));
        }
        for ($i = 0; $i < 20; $i++) {
            $user = User::factory()->voter()->create([
                'name' => "Votante $i",
                'last_name' => "Apellido $i",
                'email' => "votante$i@example.com",
            ]);
            $user->elections()->attach($election->id);
            $user->assignRole('voter');
        }
    }
}
