<x-mail::message>
# Payment Due

Hi {{ $subscription->user?->name }},

Your subscription for **{{ $subscription->servicePlan?->service?->title }}** ({{ $subscription->servicePlan?->name }}) is due for payment.

- **Amount:** ${{ number_format($subscription->servicePlan?->price ?? 0, 2) }}
- **Due Date:** {{ $subscription->current_period_end?->format('M d, Y') }}
- **Plan:** {{ ucfirst($subscription->servicePlan?->billing_interval ?? 'monthly') }}

Please make your payment to avoid any interruption of service.

<x-mail::button :url="route('subscriptions.my-subscriptions')">
View Subscriptions
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
