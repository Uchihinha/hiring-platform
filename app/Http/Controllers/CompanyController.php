<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function getBalance(Company $company): JsonResponse
    {
        $balance = $this->companyService->getBalance($company);

        return response()->json($balance);
    }

    public function getCandidates(Company $company): JsonResponse
    {
        $candidates = $this->companyService->getCandidates($company);

        return response()->json($candidates);
    }
}
