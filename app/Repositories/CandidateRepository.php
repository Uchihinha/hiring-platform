<?php

namespace App\Repositories;

use App\Events\SendContactingEmail;
use App\Events\SendHiringEmail;
use App\Models\Candidate;
use App\Repositories\Contracts\CandidateRepositoryContract;
use Illuminate\Support\Facades\DB;

class CandidateRepository implements CandidateRepositoryContract
{
    private Candidate $candidate;

    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }

    public function setModel(Candidate $candidate): void
    {
        $this->candidate = $candidate;
    }
    
    public function canBeHired(int $id): bool
    {
        return $this->candidate->find($id)->status == $this->candidate::CONTACTED;
    }

    public function hire(int $id): void
    {
        DB::transaction(function () use($id) {
            $candidate = $this->candidate->find($id);
    
            $candidate->status = Candidate::HIRED;
            $candidate->save();
    
            $event = new SendHiringEmail($candidate);
            event($event);
        });
    }

    public function canBeContacted(): bool
    {
        return $this->candidate->status == $this->candidate::INITIAL;
    }

    public function contact(): void
    {
        DB::transaction(function () {
            $this->candidate->status = Candidate::CONTACTED;
            $this->candidate->save();
    
            $event = new SendContactingEmail($this->candidate);
            event($event);
        });
    }
}
