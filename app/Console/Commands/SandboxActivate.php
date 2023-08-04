<?php

namespace App\Console\Commands;

use App\Features\Sandbox;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Laravel\Pennant\FeatureManager;

class SandboxActivate extends Command
{
    protected $signature = 'app:sandbox:activate {--for=*}';

    protected $description = 'Activate Sandbox feature';

    public function handle(FeatureManager $feature): int
    {
        $scopes = $this->option('for');

        if (!empty($scopes)) {
            $feature->for($scopes)->activate(Sandbox::class);
        }

        $this->table(['Scope', 'status'], Sandbox::toList($scopes)->toArray());

        return self::SUCCESS;
    }
}
