<?php

namespace App\Services;

use App\Repositories\CompanyRepository;

class CompanyService
{
    private CompanyRepository $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }
}