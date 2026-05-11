<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Models\SuspensionLog;
use Illuminate\Console\Command;

class SubscriptionCheckOverdue extends Command
{
    protected $signature = 'subscription:check-overdue';
    protected $description = 'Check for overdue subscriptions and log alerts for admin';

    public function handle(): void
    {
        $overdue = Subscription::overdue()->get();
        $count = 0;

        foreach ($overdue as $sub) {
            $days = $sub->days_overdue;

            if ($days >= 7) {
                SuspensionLog::firstOrCreate([
                    'subscription_id' => $sub->id,
                    'action' => 'overdue_alert',
                ], [
                    'reason' => "Payment overdue by {$days} days. Admin attention required.",
                ]);
                $count++;
            }
        }

        $this->info("Checked overdue subscriptions. {$count} alert(s) created for subscriptions overdue 7+ days.");
    }
}
