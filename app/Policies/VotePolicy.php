<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vote;

class VotePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Vote $vote): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isVoter();
    }
}
