<?php

namespace App\Console\Commands;

use App\Features\Sandbox;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Laravel\Pennant\FeatureManager;

class SandboxStatus extends Command
{
    protected $signature = 'app:sandbox:status {--for=*}';

    protected $description = 'Inspect status of Sandbox feature';

    public function handle(FeatureManager $feature): int
    {
        $scopes = $this->option('for');

        $feature->for($scopes)->load(Sandbox::class);

        $this->table(['Scope', 'status'], Sandbox::toList($scopes)->toArray());

        return self::SUCCESS;
    }
}
