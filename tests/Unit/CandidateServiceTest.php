<?php

use App\Models\Candidate;
use App\Models\Company;
use App\Repositories\CandidateRepository;
use App\Repositories\CompanyRepository;
use App\Services\CandidateService;
use Illuminate\Support\Facades\DB;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\LegacyMockInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CandidateServiceTest extends MockeryTestCase
{
    private CandidateService|LegacyMockInterface $candidateService;
    private CandidateRepository|LegacyMockInterface $candidateRepository;
    private CompanyRepository|LegacyMockInterface $companyRepository;

    public function setUp(): void
    {
        $this->candidateRepository = Mockery::mock(CandidateRepository::class)->makePartial();
        $this->companyRepository = Mockery::mock(CompanyRepository::class)->makePartial();
        $this->candidateService = new CandidateService($this->candidateRepository, $this->companyRepository);

        parent::setUp();
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testContactSuccess(): void
    {
        $candidate = new Candidate();
        $company = new Company();

        $this->candidateRepository->shouldReceive('canBeContacted')->andReturn(true);
        $this->companyRepository
            ->shouldReceive('checkBalance')
            ->with($this->candidateService::CONTACT_COST)
            ->andReturn(true);

        $this->candidateRepository->shouldReceive('contact')->once();
        $this->companyRepository
            ->shouldReceive('debitBalance')
            ->with($this->candidateService::CONTACT_COST)
            ->once();

        DB::shouldReceive('beginTransaction');
        DB::shouldReceive('commit');

        $this->candidateService->contact($company, $candidate);
    }

    public function testCandidateAlreadyContacted(): void
    {
        $candidate = new Candidate();
        $company = new Company();

        $this->candidateRepository->shouldReceive('canBeContacted')->andReturn(false);

        $this->expectException(BadRequestHttpException::class);
        $this->expectExceptionMessage('This candidate is already contacted!');

        $this->candidateService->contact($company, $candidate);
    }

    public function testCompanyBalanceNotEnough(): void
    {
        $candidate = new Candidate();
        $company = new Company();

        $this->candidateRepository->shouldReceive('canBeContacted')->andReturn(true);
        $this->companyRepository->shouldReceive('checkBalance')->andReturn(false);

        $this->expectException(BadRequestHttpException::class);
        $this->expectExceptionMessage('Insufficient funds!');

        $this->candidateService->contact($company, $candidate);
    }

    public function testHire(): void
    {
        $this->candidateRepository->shouldReceive('canBeHired')->once()->andReturn(true);
        $this->candidateRepository->shouldReceive('hire')->once();

        $this->companyRepository->shouldReceive('setModel')->once();
        $this->companyRepository
            ->shouldReceive('addBalance')
            ->with($this->candidateService::CONTACT_COST)
            ->once();

        $this->candidateService->hire(Mockery::mock(Company::class), Mockery::mock(Candidate::class));
    }

    public function testHireThrowsException(): void
    {
        $this->candidateRepository->shouldReceive('setModel')->once();
        $this->candidateRepository->shouldReceive('canBeHired')->once()->andReturn(false);

        $this->companyRepository->shouldReceive('setModel')->once();

        $this->expectException(BadRequestHttpException::class);
        $this->candidateService->hire(Mockery::mock(Company::class), Mockery::mock(Candidate::class));
    }
}
