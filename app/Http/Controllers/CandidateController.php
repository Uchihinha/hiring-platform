<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Company;
use App\Services\CandidateService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CandidateController extends Controller
{
    private CandidateService $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function index(): View
    {
        $company = Company::find(1);

        $candidates = Candidate::whereHas(
            'vacancy.company',
            fn($q) => $q->whereId($company->id)
        )
            ->get();

        return view('candidates.index', compact('candidates'));
    }

    public function contact(Company $company, Candidate $candidate): JsonResponse
    {
        $this->candidateService->contact($company, $candidate);

        return response()->json([
            'message' => 'Candidate contacted!'
        ]);
    }

    public function hire(Company $company, Candidate $candidate): JsonResponse
    {
        $this->candidateService->hire($company, $candidate);

        return response()->json([
            'message' => 'Candidate hired!'
        ]);
    }
}
