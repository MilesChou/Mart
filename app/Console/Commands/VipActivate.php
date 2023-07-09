<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Laravel\Pennant\FeatureManager;

class VipActivate extends Command
{
    protected $signature = 'app:vip:activate {emails*}';

    protected $description = 'Activate VIP permission';

    public function handle(User $userModel, FeatureManager $feature): int
    {
        $users = $userModel->newQuery()
            ->select('id', 'email')
            ->whereIn('email', $this->argument('emails'))
            ->get();

        $feature->for($users)->activate('vip');

        return self::SUCCESS;
    }
}
