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
        $this->company->wallet->coins += $amount;
        $this->company->wallet->save();
    }

    public function debitBalance(int $amount): void
    {
        $this->company->wallet->coins -= $amount;
        $this->company->wallet->save();
    }

    public function checkBalance(int $requiredAmount): bool
    {
        return $this->company->wallet->coins >= $requiredAmount;
    }

    public function getBalance(): int
    {
        return $this->company->wallet->coins ?? 0;
    }
}
