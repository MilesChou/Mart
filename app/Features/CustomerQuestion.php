<?php

namespace App\Features;

use App\Models\User;

class CustomerQuestion
{
    public string $name = 'customer_question';

    public function resolve(User|null $user): mixed
    {
        return match (true) {
            $user === null => false,
            $user->roles->where('name', 'admin')->isNotEmpty() => true,
            default => false,
        };
    }
}
