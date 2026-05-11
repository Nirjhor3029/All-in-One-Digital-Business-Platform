<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    public function handle(Request $request, Closure $next, ...$servicePlanIds): Response
    {
        $user = $request->user();
        if (! $user) {
            abort(401);
        }

        $hasActive = Subscription::where('user_id', $user->id)
            ->whereIn('service_plan_id', $servicePlanIds)
            ->whereIn('status', ['active', 'trial'])
            ->exists();

        if (! $hasActive) {
            abort(403, 'An active subscription is required to access this resource.');
        }

        return $next($request);
    }
}
