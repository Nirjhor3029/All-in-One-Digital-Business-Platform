<x-mail::message>
# Suspension Warning

Hi {{ $subscription->user?->name }},

Your subscription for **{{ $subscription->servicePlan?->service?->title }}** is now overdue by **{{ $subscription->days_overdue }} days**.

If payment is not made within the next few days, your access may be suspended.

- **Amount Due:** ${{ number_format($subscription->servicePlan?->price ?? 0, 2) }}
- **Overdue Since:** {{ $subscription->current_period_end?->format('M d, Y') }}

<x-mail::button :url="route('subscriptions.my-subscriptions')">
Pay Now
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
