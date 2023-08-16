<?php

namespace App\Features;

use App\Models\User;
use Illuminate\Support\Lottery;

class Experiment
{
    public string $name = 'experiment';

    /**
     * Resolve the feature's initial value.
     */
    public function resolve(User | null $user): mixed
    {
        $default = env('FEATURE_FLAGS_EXPERIMENT_DEFAULT');
        $default = true;

        return match (true) {
            $user === null => $default ?? false,
            default => $default ?? Lottery::odds(50 / 100),
        };
    }
}
