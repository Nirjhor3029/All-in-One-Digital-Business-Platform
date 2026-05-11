<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServicePlan extends Model
{
    protected $fillable = [
        'service_id', 'name', 'slug', 'description',
        'price', 'delivery_time', 'features', 'sort_order',
        'is_active', 'is_popular', 'is_subscription',
        'billing_interval', 'trial_days',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'features' => 'array',
            'is_active' => 'boolean',
            'is_popular' => 'boolean',
            'is_subscription' => 'boolean',
        ];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(ServicePurchase::class);
    }
}
