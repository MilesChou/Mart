<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Pennant\FeatureManager;

class OperationDeactivate extends Command
{
    protected $signature = 'app:operation:deactivate';

    protected $description = 'Deactivate operation';

    public function handle(FeatureManager $feature): int
    {
        $feature->deactivate('operation');

        $this->line('Deactivated');

        return self::SUCCESS;
    }
}
