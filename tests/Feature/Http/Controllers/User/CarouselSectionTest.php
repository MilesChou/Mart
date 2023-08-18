<?php

namespace Tests\Feature\Http\Controllers\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Pennant\Feature;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CarouselSectionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function seeCarouselSectionWhenFeatureOn()
    {
        Artisan::call('db:seed');

        Feature::activate('carousel');

        $this->get('/')
            ->assertSee('mainBanner');
    }

    #[Test]
    public function dontSeeCarouselSectionWhenFeatureOff()
    {
        Artisan::call('db:seed');

        Feature::deactivate('carousel');

        $this->get('/')
            ->assertDontSee('mainBanner');
    }
}
