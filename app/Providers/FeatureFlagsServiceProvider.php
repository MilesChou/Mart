<?php

namespace App\Providers;

use App\Features\Operation;
use Illuminate\Support\ServiceProvider;
use Laravel\Pennant\Feature;

class FeatureFlagsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Feature::define(Operation::class);
    }
}
