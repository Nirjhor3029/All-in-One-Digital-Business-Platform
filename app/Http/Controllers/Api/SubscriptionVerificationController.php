<?php

namespace App\Http\Controllers\Api;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SubscriptionVerificationController extends Controller
{
    public function verify(Request $request)
    {
        $token = $request->input('api_token');
        $servicePlanId = $request->input('service_plan_id');

        if (! $token || ! $servicePlanId) {
            return response()->json([
                'valid' => false,
                'message' => 'Missing api_token or service_plan_id.',
            ], 400);
        }

        $user = User::where('api_token', $token)->first();

        if (! $user) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid api_token.',
            ], 401);
        }

        $subscription = Subscription::where('user_id', $user->id)
            ->where('service_plan_id', $servicePlanId)
            ->whereIn('status', ['active', 'trial'])
            ->latest()
            ->first();

        if (! $subscription) {
            return response()->json([
                'valid' => false,
                'status' => 'inactive',
                'message' => 'No active subscription found for this service.',
            ]);
        }

        return response()->json([
            'valid' => true,
            'status' => $subscription->status,
            'plan' => $subscription->servicePlan?->name,
            'service' => $subscription->servicePlan?->service?->title,
            'current_period_end' => $subscription->current_period_end?->toIso8601String(),
            'is_on_trial' => $subscription->is_on_trial,
            'trial_ends_at' => $subscription->trial_ends_at?->toIso8601String(),
        ]);
    }
}
