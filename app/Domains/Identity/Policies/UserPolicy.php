<?php

namespace App\Domains\Identity\Policies;

use App\Domains\Identity\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view a list of model.
     */
    public function view(User $user): bool
    {
        return $user->can('view any users');
    }
}