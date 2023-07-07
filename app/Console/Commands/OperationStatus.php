<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Pennant\FeatureManager;

class OperationStatus extends Command
{
    protected $signature = 'app:operation:status';

    protected $description = 'Check operation status';

    public function handle(FeatureManager $feature): int
    {
        $status = $feature->when('operation', fn() => 'Active', fn() => 'Inactive');

        $this->line($status);

        return self::SUCCESS;
    }
}
