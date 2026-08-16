<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Attributes\Scope;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $status
 * @property Carbon|null $opens_at
 * @property Carbon|null $closes_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['name', 'description', 'opens_at', 'closes_at'])]
#[Hidden([])]
class Election extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'opens_at' => 'datetime',
            'closes_at' => 'datetime',
        ];
    }

    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('has_voted', 'voted_at')
            ->withTimestamps();
    }

    public function voterImports(): HasMany
    {
        return $this->hasMany(VoterImport::class);
    }

    #[Scope]
    protected function pending(Builder $query): Builder
    {
        return $query->where(fn (Builder $q) => $q
            ->whereNull('opens_at')
            ->orWhere('opens_at', '>', now()));
    }

    #[Scope]
    protected function open(Builder $query): Builder
    {
        return $query
            ->whereNotNull('opens_at')
            ->where('opens_at', '<=', now())
            ->where(fn (Builder $q) => $q
                ->whereNull('closes_at')
                ->orWhere('closes_at', '>', now()));
    }

    #[Scope]
    protected function closed(Builder $query): Builder
    {
        return $query
            ->whereNotNull('closes_at')
            ->where('closes_at', '<=', now());
    }

    public function getStatusAttribute(): string
    {
        if ($this->isClosed()) {
            return 'closed';
        }

        if ($this->isOpen()) {
            return 'open';
        }

        return 'pending';
    }

    public function isOpen(): bool
    {
        return $this->opens_at !== null
            && $this->opens_at->lte(now())
            && ($this->closes_at === null || $this->closes_at->gt(now()));
    }

    public function isClosed(): bool
    {
        return $this->closes_at !== null && $this->closes_at->lte(now());
    }

    public function isPending(): bool
    {
        return ! $this->isOpen() && ! $this->isClosed();
    }
}
