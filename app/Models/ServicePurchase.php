<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicePurchase extends Model
{
    protected $fillable = [
        'user_id',
        'service_plan_id',
        'order_id',
        'status',
        'download_url',
        'credentials',
        'admin_notes',
        'delivered_at',
        'delivered_by',
    ];

    protected function casts(): array
    {
        return [
            'delivered_at' => 'datetime',
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

    public function deliveredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'delivered_by');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeDelivered($query)
    {
        return $query->whereNotNull('delivered_at');
    }

    public function scopePending($query)
    {
        return $query->whereNull('delivered_at');
    }

    public function getIsDeliveredAttribute(): bool
    {
        return ! is_null($this->delivered_at);
    }
}
