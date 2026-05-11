<x-mail::message>
# Payment Confirmed

Hi {{ $paymentRecord->subscription?->user?->name }},

Your payment of **${{ number_format($paymentRecord->amount, 2) }}** for **{{ $paymentRecord->subscription?->servicePlan?->service?->title }}** has been confirmed.

- **Plan:** {{ $paymentRecord->subscription?->servicePlan?->name }}
- **Amount:** ${{ number_format($paymentRecord->amount, 2) }}
- **Next Billing:** {{ $paymentRecord->period_end?->format('M d, Y') }}

<x-mail::button :url="route('subscriptions.my-subscriptions')">
View Subscription
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
