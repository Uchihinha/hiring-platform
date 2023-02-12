<?php

namespace Tests\Feature;

use App\Events\SendContactingEmail;
use App\Events\SendHiringEmail;
use App\Models\Candidate;
use App\Repositories\CandidateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CandidateRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private Candidate $candidate;
    private CandidateRepository $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->candidate = Candidate::factory()->create();
        $this->repository = app(CandidateRepository::class);
    }

    public function testCanBeHiredShouldBeFalse(): void
    {
        $this->assertFalse($this->repository->canBeHired($this->candidate->id));
    }

    public function testCanBeHiredShouldBeTrue(): void
    {
        $this->candidate->status = Candidate::CONTACTED;
        $this->candidate->save();
        $this->candidate->refresh();

        $this->assertTrue($this->repository->canBeHired($this->candidate->id));
    }

    public function testHire(): void
    {
        Event::fake();

        $this->candidate->status = Candidate::CONTACTED;
        $this->candidate->save();

        $this->repository->hire($this->candidate->id);
        
        $this->candidate->refresh();
        
        Event::assertDispatched(SendHiringEmail::class);
        $this->assertTrue($this->candidate->status == Candidate::HIRED);
    }

    public function testContact(): void
    {
        Event::fake();

        $this->repository->contact($this->candidate->id);
        
        $this->candidate->refresh();
        
        Event::assertDispatched(SendContactingEmail::class);
        $this->assertTrue($this->candidate->status == Candidate::CONTACTED);
    }
}

