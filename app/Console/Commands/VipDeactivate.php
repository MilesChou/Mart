<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Laravel\Pennant\FeatureManager;

class VipDeactivate extends Command
{
    protected $signature = 'app:vip:deactivate {emails*}';

    protected $description = 'Deactivate VIP permission';

    public function handle(User $userModel, FeatureManager $feature): int
    {
        $users = $userModel->newQuery()
            ->select('id', 'email')
            ->whereIn('email', $this->argument('emails'))
            ->get();

        $feature->for($users)->deactivate('vip');

        return self::SUCCESS;
    }
}
