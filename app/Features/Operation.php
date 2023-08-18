<?php

namespace App\Features;

class Operation
{
    public readonly string $name;

    public function __construct()
    {
        $this->name = 'operation';
    }

    public function resolve(): bool
    {
        return true;
    }
}
