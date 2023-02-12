<?php

namespace App\Repositories\Contracts;

interface CompanyRepositoryContract
{
    public function addBalance(int $amount): void;
    public function debitBalance(int $amount): void;
    public function checkBalance(int $amountRequired): bool;
}