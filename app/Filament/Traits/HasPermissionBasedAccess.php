<?php

namespace App\Filament\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasPermissionBasedAccess
{
    protected static function getPermissionBase(): string
    {
        return str(class_basename(static::class))
            ->before('Resource')
            ->lower()
            ->value();
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();
        if (! $user) return false;
        if ($user->hasRole('Super Admin')) return true;
        return $user->can(static::getPermissionBase() . '.list');
    }

    public static function canCreate(): bool
    {
        $user = auth()->user();
        if (! $user) return false;
        if ($user->hasRole('Super Admin')) return true;
        return $user->can(static::getPermissionBase() . '.create');
    }

    public static function canEdit(Model $record): bool
    {
        $user = auth()->user();
        if (! $user) return false;
        if ($user->hasRole('Super Admin')) return true;
        return $user->can(static::getPermissionBase() . '.edit');
    }

    public static function canDelete(Model $record): bool
    {
        $user = auth()->user();
        if (! $user) return false;
        if ($user->hasRole('Super Admin')) return true;
        return $user->can(static::getPermissionBase() . '.delete');
    }

    public static function canDeleteAny(): bool
    {
        return static::canDelete(new static::$model);
    }
}
