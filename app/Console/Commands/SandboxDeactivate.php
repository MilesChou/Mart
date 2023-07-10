<?php

namespace App\Console\Commands;

use App\Features\Sandbox;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Laravel\Pennant\FeatureManager;

class SandboxDeactivate extends Command
{
    protected $signature = 'app:sandbox:deactivate {--for=*}';

    protected $description = 'Deactivate Sandbox feature';

    public function handle(FeatureManager $feature): int
    {
        $scopes = $this->option('for');

        if (!empty($scopes)) {
            $feature->for($scopes)->deactivate(Sandbox::class);
        }

        $this->table(['Scope', 'status'], Sandbox::toList($scopes)->toArray());

        return self::SUCCESS;
    }
}
