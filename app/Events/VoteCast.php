<?php

namespace App\Events;

use App\Models\Vote;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoteCast
{
    use Dispatchable, SerializesModels;

    public function __construct(public Vote $vote) {}
}
