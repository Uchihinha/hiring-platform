<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\Company;
use App\Models\Vacancy;
use App\Repositories\CompanyRepository;
use Illuminate\Foundation\Bootstrap\BootProviders;
use Illuminate\Foundation\Testing\DatabaseTransactions;
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

    public function testGetBalance(): void
    {
        $this->repository->setModel($this->company);

        $this->assertEquals(20, $this->repository->getBalance());
    }

    public function testGetCandidates(): void
    {
        $vacancy = Vacancy::factory()->create([
            'company_id' => $this->company->id
        ]);

        $candidates = Candidate::factory(3)->create([
            'vacancy_id' => $vacancy->id
        ]);

        $candidatesIds = $candidates->pluck('id');
        
        $this->repository->setModel($this->company);

        $candidatesFromRepo = $this->repository->getCandidates();

        $this->assertEquals($candidatesFromRepo->pluck('id'), $candidatesIds);
    }
}
