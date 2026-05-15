<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'color',
        'tech_stack',
        'icon_path',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    public function getTechStackAttribute($value): array
    {
        return is_string($value) ? json_decode($value, true) ?? [] : ($value ?? []);
    }
}
