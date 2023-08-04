<?php

namespace App\Http\Controllers\Feature;

use Laravel\Pennant\FeatureManager;

class Deactivate
{
    public function __invoke(FeatureManager $feature, string $for, string $name): array
    {
        $feature->for($for)->deactivate($name);

        return [
            'active' => $feature->for($for)->active($name),
        ];
    }
}
