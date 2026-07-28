<?php

namespace App\Policies;

use App\Models\User;

class VoterPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, User $voter): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, User $voter): bool
    {
        return false;
    }

    public function delete(User $user, User $voter): bool
    {
        return $user->isAdmin();
    }
}
