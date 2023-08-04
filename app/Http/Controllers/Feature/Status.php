<?php

namespace App\Http\Controllers\Feature;

use Laravel\Pennant\FeatureManager;

class Status
{
    public function __invoke(FeatureManager $feature, string $for, string $name): array
    {
        return [
            'active' => $feature->for($for)->active($name),
        ];
    }
}
