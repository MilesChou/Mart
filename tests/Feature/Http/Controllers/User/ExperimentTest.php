<?php

namespace Tests\Feature\Http\Controllers\User;

use App\Features\Experiment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Pennant\Feature;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ExperimentTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function seeExperimentSectionWhenFlagOn()
    {
        Feature::activate(Experiment::class);

        $this->get('/')
            ->assertSee("Find Your Match");
    }

    #[Test]
    public function dontSeeExperimentSectionWhenFlagOff()
    {
        Feature::deactivate(Experiment::class);

        $this->get('/')
            ->assertDontSee("Find Your Match");
    }
}
