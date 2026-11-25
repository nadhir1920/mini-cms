<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function changeRole(User $authUser, User $targetUser): bool
    {
        return $authUser->isAdmin() && $authUser->id !== $targetUser->id;
    }
}
