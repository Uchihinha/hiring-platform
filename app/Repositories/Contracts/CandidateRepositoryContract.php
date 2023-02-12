<?php

namespace App\Repositories\Contracts;

interface CandidateRepositoryContract
{
    public function canBeHired(): bool;
    public function hire(): void;
    public function canBeContacted(): bool;
    public function contact(): void;
}