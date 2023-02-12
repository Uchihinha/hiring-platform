<?php

namespace App\Repositories\Contracts;

interface CandidateRepositoryContract
{
    public function canBeHired(int $id): bool;
    public function hire(int $id): void;
    public function canBeContacted(): bool;
    public function contact(): void;
}