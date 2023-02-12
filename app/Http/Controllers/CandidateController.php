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
        return view('candidates.index');
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
