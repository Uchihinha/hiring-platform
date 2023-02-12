<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Support\Collection;

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

    public function getCandidates(Company $company): Collection
    {
        $this->repository->setModel($company);

        return $this->repository->getCandidates();
    }
}