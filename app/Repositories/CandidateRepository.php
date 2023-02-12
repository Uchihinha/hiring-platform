<?php

namespace App\Repositories;

use App\Models\Candidate;
use App\Repositories\Contracts\CandidateRepositoryContract;

class CandidateRepository implements CandidateRepositoryContract
{
    private Candidate $candidate;

    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }
    
    public function canBeHired(int $id): bool
    {
        return false;
    }

    public function hire(int $id): void
    {
        return;
    }

    public function canBeContacted(int $id): bool
    {
        return false;
    }

    public function contact(int $id): void
    {
        return;
    }
}