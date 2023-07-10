<?php

namespace App\Features;

use Illuminate\Support\Collection;
use Illuminate\Support\Lottery;
use Laravel\Pennant\Feature;

class Sandbox
{
    public readonly string $name;

    public function __construct()
    {
        $this->name = 'sandbox';
    }

    public function resolve(mixed $scope): Lottery
    {
        return Lottery::odds(1 / 2);
    }

    public static function toList($scopes): Collection
    {
        return Collection::make($scopes)->map(fn(string $scope) => [
            $scope,
            Feature::for($scope)->active('sandbox') ? 'ON' : 'OFF',
        ]);
    }
}
