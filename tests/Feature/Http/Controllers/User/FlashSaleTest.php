<?php

namespace Tests\Feature\Http\Controllers\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Pennant\Feature;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FlashSaleTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function seeFlashSaleSectionWhenFeatureOn()
    {
        Artisan::call('db:seed');

        Feature::activate('flash_sale');

        $this->get('/')
            ->assertSeeText('Flash sale');
    }

    #[Test]
    public function dontSeeFlashSaleSectionWhenFeatureOff()
    {
        Artisan::call('db:seed');

        Feature::deactivate('flash_sale');

        $this->get('/')
            ->assertDontSeeText('Flash sale');
    }
}
