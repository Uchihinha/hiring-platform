<?php

namespace App\Services;

use App\Repositories\CandidateRepository;

class CandidateService
{
    private CandidateRepository $repository;

    public function __construct(CandidateRepository $repository)
    {
        $this->repository = $repository;
    }
}