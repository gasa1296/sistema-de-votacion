<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $election_id
 * @property string $filename
 * @property int $total_rows
 * @property int $imported
 * @property int $failed
 * @property array|null $errors
 * @property int $imported_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['election_id', 'filename', 'total_rows', 'imported', 'failed', 'errors', 'imported_by'])]
#[Hidden(['errors'])]
class VoterImport extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'total_rows' => 'integer',
            'imported' => 'integer',
            'failed' => 'integer',
            'errors' => 'array',
        ];
    }

    public function election(): BelongsTo
    {
        return $this->belongsTo(Election::class);
    }

    public function importedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'imported_by');
    }
}
