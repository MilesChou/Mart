<?php

namespace App\Console\Commands;

use App\Features\Experiment;
use App\Models\User;
use Illuminate\Console\Command;
use Laravel\Pennant\Feature;

class ExperimentActivate extends Command
{
    protected $signature = 'app:experiment:activate {--user=*}';

    public function handle(): int
    {
        $scopes = $this->option('user');

        $users = User::find($scopes);

        if (!empty($users)) {
            Feature::for($users)->activate(Experiment::class);
        }

        return self::SUCCESS;
    }
}
