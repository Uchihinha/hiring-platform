<?php

namespace App\Repositories\Contracts;

interface CandidateRepositoryContract
{
    public function canBeHired(int $id): bool;
    public function hire(int $id): void;
    public function canBeContacted(int $id): bool;
    public function contact(int $id): void;
}