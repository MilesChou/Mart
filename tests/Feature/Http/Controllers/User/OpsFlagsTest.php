<?php

namespace Tests\Feature\Http\Controllers\User;

use App\Features\Operation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Pennant\Feature;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OpsFlagsTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function seeLoginItemWhenOperationFeatureOn()
    {
        Feature::activate(Operation::class);

        $this->get('/catalog')
            ->assertSeeText('Track my order')
            ->assertSeeText('Login')
            ->assertSeeText('Sign up');
    }

    #[Test]
    public function dontSeeLoginItemWhenOperationFeatureOff()
    {
        Feature::deactivate(Operation::class);

        $this->get('/catalog')
            ->assertDontSeeText('Track my order')
            ->assertDontSeeText('Login')
            ->assertDontSeeText('Sign up');
    }
}
