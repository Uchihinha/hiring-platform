<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Repositories\CompanyRepository;
use App\Services\CompanyService;
use Illuminate\Support\Collection;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\LegacyMockInterface;

class CompanyServiceTest extends MockeryTestCase
{
    private CompanyRepository|LegacyMockInterface $repository;

    private CompanyService $service;

    protected function setUp(): void
    {
        $this->repository = Mockery::mock(CompanyRepository::class);
        $this->service = new CompanyService($this->repository);
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testGetBalance()
    {
        $company = new Company();
        $balance = 1000;

        $this->repository
            ->shouldReceive('setModel')
            ->once()
            ->with($company);

        $this->repository
            ->shouldReceive('getBalance')
            ->once()
            ->andReturn($balance);

        $result = $this->service->getBalance($company);
        $this->assertEquals($balance, $result);
    }

    public function testGetCandidates()
    {
        $company = new Company();
        $candidates = new Collection();

        $this->repository
            ->shouldReceive('setModel')
            ->once()
            ->with($company);

        $this->repository
            ->shouldReceive('getCandidates')
            ->once()
            ->andReturn($candidates);

        $result = $this->service->getCandidates($company);
        $this->assertEquals($candidates, $result);
    }
}
