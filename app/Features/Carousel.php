<?php

namespace App\Features;

use App\Models\User;

class Carousel
{
    public string $name = 'carousel';

    public function resolve(User|null $user): mixed
    {
        return match (true) {
            $user === null => false,
            $user->roles->where('name', 'admin')->isNotEmpty() => true,
            default => false,
        };
    }
}
