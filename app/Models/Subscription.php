<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'service_plan_id',
        'order_id',
        'status',
        'trial_ends_at',
        'current_period_start',
        'current_period_end',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'trial_ends_at' => 'datetime',
            'current_period_start' => 'datetime',
            'current_period_end' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function servicePlan(): BelongsTo
    {
        return $this->belongsTo(ServicePlan::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function paymentRecords(): HasMany
    {
        return $this->hasMany(PaymentRecord::class);
    }

    public function suspensionLogs(): HasMany
    {
        return $this->hasMany(SuspensionLog::class);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['trial', 'active']);
    }

    public function scopeOverdue($query)
    {
        return $query->whereIn('status', ['active', 'trial'])
            ->where('current_period_end', '<', now())
            ->whereNull('cancelled_at');
    }

    public function getIsActiveAttribute(): bool
    {
        return in_array($this->status, ['trial', 'active']);
    }

    public function getIsOnTrialAttribute(): bool
    {
        return $this->status === 'trial'
            && $this->trial_ends_at
            && $this->trial_ends_at->isFuture();
    }

    public function getDaysOverdueAttribute(): int
    {
        if (! $this->current_period_end || $this->current_period_end->isFuture()) {
            return 0;
        }
        return (int) $this->current_period_end->diffInDays(now(), false);
    }

    public function getBillingAmountAttribute(): string
    {
        return number_format($this->servicePlan?->price ?? 0, 2);
    }

    public function getBillingIntervalLabelAttribute(): string
    {
        return ucfirst($this->servicePlan?->billing_interval ?? 'monthly');
    }
}
