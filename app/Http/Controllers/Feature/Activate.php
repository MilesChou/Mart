<?php

namespace App\Http\Controllers\Feature;

use Laravel\Pennant\FeatureManager;

class Activate
{
    public function __invoke(FeatureManager $feature, string $for, string $name): array
    {
        $feature->for($for)->activate($name);

        return [
            'active' => $feature->for($for)->active($name),
        ];
    }
}
