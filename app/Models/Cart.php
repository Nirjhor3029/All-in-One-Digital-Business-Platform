<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $fillable = ['user_id', 'coupon_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function subtotal(): float
    {
        return $this->items->sum('price');
    }

    public function discount(): float
    {
        if (! $this->coupon || ! $this->coupon->isValid()) return 0;
        return $this->coupon->applyDiscount($this->subtotal());
    }

    public function total(): float
    {
        return max(0, $this->subtotal() - $this->discount());
    }
}
