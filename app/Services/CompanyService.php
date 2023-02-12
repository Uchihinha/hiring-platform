<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\CompanyRepository;

class CompanyService
{
    private CompanyRepository $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getBalance(Company $company): int
    {
        $this->repository->setModel($company);

        return $this->repository->getBalance();
    }
}