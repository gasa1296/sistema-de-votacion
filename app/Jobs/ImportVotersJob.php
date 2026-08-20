<?php

namespace App\Jobs;

use App\Mail\VoterCredentialsMail;
use App\Models\Election;
use App\Models\User;
use App\Models\VoterImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;

class ImportVotersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly string $filePath,
        private readonly Election $election,
        private readonly User $importedBy,
    ) {}

    public function handle(): void
    {
        $import = VoterImport::create([
            'election_id' => $this->election->id,
            'filename' => basename($this->filePath),
            'imported_by' => $this->importedBy->id,
            'total_rows' => 0,
            'imported' => 0,
            'failed' => 0,
            'errors' => [],
        ]);

        $rows = $this->readRows();
        $import->update(['total_rows' => count($rows)]);

        $imported = 0;
        $failed = 0;
        $errors = [];

        foreach ($rows as $index => $row) {
            try {
                $email = $row['email'] ?? null;
                $name = $row['nombre'] ?? null;
                $lastName = $row['apellido'] ?? null;

                if (! $email || ! $name) {
                    throw new \InvalidArgumentException('Fila '.($index + 1).': email y nombre son requeridos');
                }

                $voter = User::where('email', $email)->first();
                if (empty($voter)) {
                    $voterCode = Str::upper(Str::random(8));
                    $plainPassword = Str::random(10);

                    $voter = User::create(
                        [
                            'email' => $email,
                            'name' => $name,
                            'last_name' => $lastName,
                            'password' => Hash::make($plainPassword),
                            'role' => 'voter',
                            'email_verified_at' => now(),
                        ],
                    );
                    Mail::to($voter->email)->queue(new VoterCredentialsMail($voter, $plainPassword));
                }

                $voter->elections()->attach($this->election->id);

                $imported++;
            } catch (\Throwable $e) {
                $failed++;
                $errors[] = [
                    'row' => $index + 1,
                    'email' => $email ?? 'N/A',
                    'error' => $e->getMessage(),
                ];
            }
        }

        $import->update([
            'imported' => $imported,
            'failed' => $failed,
            'errors' => $errors,
        ]);
    }

    private function readRows(): array
    {
        $worksheetData = Excel::toArray(
            new class implements ToArray, WithHeadingRow
            {
                public function array(array $array): void {}
            },
            $this->filePath,
        );

        return $worksheetData[0] ?? [];
    }
}
