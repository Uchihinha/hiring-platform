<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryContract;

class CompanyRepository implements CompanyRepositoryContract
{
    private Company $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function setModel(Company $company): void
    {
        $this->company = $company;
    }

    public function addBalance(int $amount): void
    {
        return;
    }

    public function debitBalance(int $amount): void
    {
        return;
    }

    public function checkBalance(int $amountRequired): bool
    {
        return false;
    }
}