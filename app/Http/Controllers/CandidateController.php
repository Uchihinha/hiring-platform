<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Company;
use App\Services\CandidateService;
use Illuminate\Http\JsonResponse;

class CandidateController extends Controller
{
    private CandidateService $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function index()
    {
        $candidates = Candidate::all();
        $coins = Company::find(1)->coins;
        return view('candidates.index', compact('candidates', 'coins'));
    }

    public function contact(Company $company, Candidate $candidate): JsonResponse
    {
        $this->candidateService->contact($company, $candidate);

        return response()->json([
            'message' => 'Candidate contacted!'
        ]);
    }

    public function hire()
    {
        // @todo
        // Your code goes here...
    }
}
