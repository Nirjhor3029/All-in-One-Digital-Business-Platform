<?php

namespace App\Mail;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionSuspensionWarning extends Mailable
{
    use Queueable, SerializesModels;

    public Subscription $subscription;

    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Subscription Suspension Warning — ' . ($this->subscription->servicePlan?->service?->title ?? 'Service'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.subscriptions.suspension-warning',
        );
    }
}
