<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Pennant\FeatureManager;

class OperationActivate extends Command
{
    protected $signature = 'app:operation:activate';

    protected $description = 'Activate operation';

    public function handle(FeatureManager $feature): int
    {
        $feature->activate('operation');

        $this->line('Activated');

        return self::SUCCESS;
    }
}
