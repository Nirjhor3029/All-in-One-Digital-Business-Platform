<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('site_settings'));
        static::deleted(fn () => Cache::forget('site_settings'));
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return static::getAll()->get($key, $default);
    }

    public static function getAll(): \Illuminate\Support\Collection
    {
        return Cache::rememberForever('site_settings', function () {
            return static::pluck('value', 'key');
        });
    }

    public static function getByGroup(string $group): \Illuminate\Support\Collection
    {
        return static::where('group', $group)->pluck('value', 'key');
    }
}
