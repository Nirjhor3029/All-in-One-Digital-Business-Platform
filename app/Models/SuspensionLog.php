<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuspensionLog extends Model
{
    protected $fillable = [
        'subscription_id',
        'action',
        'reason',
        'acted_by',
    ];

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    public function actedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'acted_by');
    }
}
