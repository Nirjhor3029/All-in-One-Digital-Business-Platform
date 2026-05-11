<?php

namespace App\Mail;

use App\Models\PaymentRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionPaymentConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public PaymentRecord $paymentRecord;

    public function __construct(PaymentRecord $paymentRecord)
    {
        $this->paymentRecord = $paymentRecord;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Confirmed — ' . ($this->paymentRecord->subscription?->servicePlan?->service?->title ?? 'Subscription'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.subscriptions.payment-confirm',
        );
    }
}
