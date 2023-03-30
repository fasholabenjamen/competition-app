<?php

namespace App\Domain\Users\Policies;

use App\Domains\Competition\Models\Competition;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompetitionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view a list of model.
     */
    public function view(Competition $competition): bool
    {
        return True;
    }
}