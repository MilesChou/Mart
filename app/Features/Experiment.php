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
        return match (true) {
            $user === null => false,
            default => Lottery::odds(50 / 100),
        };
    }
}
