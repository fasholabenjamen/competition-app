<?php

namespace App\Domains\Competition\Contracts;

use App\Infrastructure\Contracts\BaseRepository;

interface CompetitionRepository extends BaseRepository
{
    public function setNewEmailTokenConfirmation($userId);
}