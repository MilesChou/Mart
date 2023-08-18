<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Laravel\Pennant\Feature;

class VipStatus extends Command
{
    protected $signature = 'app:vip:status {emails*}';

    protected $description = 'Inspect VIP status';

    public function handle(User $userModel): int
    {
        $emails = $this->argument('emails');

        $users = $userModel->newQuery()
            ->select('id', 'email')
            ->whereIn('email', $emails)
            ->get();

        Feature::for($users)->load('vip');

        $status = $users->map(function (User $user) {
            $user['vip'] = $user->features()->active('vip') ? 'ON' : 'OFF';

            return $user->toArray();
        });

        $this->table(['ID', 'Email', 'status'], $status->toArray());

        return self::SUCCESS;
    }
}
