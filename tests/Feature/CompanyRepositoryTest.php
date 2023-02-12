<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private Company $company;
    private CompanyRepository $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->company = Company::factory()->hasWallets(1)->create();
        $this->repository = new CompanyRepository($this->company);
    }

    public function testAddBalance(): void
    {
        $this->repository->addBalance(5);

        $this->assertEquals(25, $this->company->wallet->coins);
    }

    public function testDebitBalance(): void
    {
        $this->repository->debitBalance(5);

        $this->assertEquals(15, $this->company->wallet->coins);
    }

    public function testCheckBalanceShoudBeFalse(): void
    {
        $this->assertFalse($this->repository->checkBalance(21));
    }

    public function testCheckBalanceShoudBeTrue(): void
    {
        $this->assertTrue($this->repository->checkBalance(20));
    }
}
