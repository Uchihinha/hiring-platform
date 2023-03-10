<?php

namespace App\Services;

use App\Models\Candidate;
use App\Models\Company;
use App\Repositories\CandidateRepository;
use App\Repositories\CompanyRepository;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CandidateService
{
    public const CONTACT_COST = 5;

    private CandidateRepository $repository;

    private CompanyRepository $companyRepository;

    public function __construct(
        CandidateRepository $repository,
        CompanyRepository $companyRepository
    ) {
        $this->repository = $repository;
        $this->companyRepository = $companyRepository;
    }

    public function contact(Company $company, Candidate $candidate): void
    {
        $this->repository->setModel($candidate);
        $this->companyRepository->setModel($company);

        $canBeContacted = $this->repository->canBeContacted();

        if (! $canBeContacted) {
            throw new BadRequestHttpException('This candidate is already contacted!');
        }

        $isCompanyBalanceEnough = $this->companyRepository->checkBalance($this::CONTACT_COST);

        if (! $isCompanyBalanceEnough) {
            throw new BadRequestHttpException("Insufficient funds!");
        }

        DB::beginTransaction();

        $this->repository->contact();
        $this->companyRepository->debitBalance($this::CONTACT_COST);
        
        DB::commit();
    }

    public function hire(Company $company, Candidate $candidate): void
    {
        $this->repository->setModel($candidate);
        $this->companyRepository->setModel($company);

        $canBeHired = $this->repository->canBeHired();

        if (! $canBeHired) {
            throw new BadRequestHttpException("This candidate cannot be hired, remember to contact it first if you didn't!");
        }

        DB::beginTransaction();

        $this->repository->hire();
        $this->companyRepository->addBalance($this::CONTACT_COST);

        DB::commit();
    }
}