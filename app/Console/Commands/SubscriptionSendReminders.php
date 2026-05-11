<?php

namespace App\Console\Commands;

use App\Mail\SubscriptionPaymentDue;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SubscriptionSendReminders extends Command
{
    protected $signature = 'subscription:send-reminders';
    protected $description = 'Send payment reminders for subscriptions nearing their due date';

    public function handle(): void
    {
        $reminders = Subscription::whereIn('status', ['active', 'trial'])
            ->where('current_period_end', '<=', now()->addDays(3))
            ->where('current_period_end', '>', now())
            ->get();

        $sent = 0;

        foreach ($reminders as $sub) {
            if ($sub->user?->email) {
                Mail::to($sub->user->email)->queue(new SubscriptionPaymentDue($sub));
                $sent++;
            }
        }

        $this->info("Queued {$sent} payment reminder email(s).");
    }
}
