<?php

namespace Tests\Feature\Http\Controllers\User;

use App\Features\Operation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Pennant\Feature;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CatalogPageTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function seeBasicItem()
    {
        $this->get('/catalog')
            ->assertSeeText('Categories')
            ->assertSeeText('Price');
    }

    #[Test]
    public function seeCartItemWhenFeatureOn()
    {
        Artisan::call('db:seed');

        Feature::activate(Operation::class);

        $this->get('/catalog')
            ->assertSeeText('Add to cart');
    }

    #[Test]
    public function dontSeeCartItemWhenFeatureOff()
    {
        Artisan::call('db:seed');

        Feature::deactivate(Operation::class);

        $this->get('/catalog')
            ->assertDontSeeText('Add to cart');
    }
}
