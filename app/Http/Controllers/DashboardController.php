<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Enrollment;
use App\Models\LectureProgress;
use App\Models\Order;
use App\Models\ServicePurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'enrolled_courses' => Enrollment::where('user_id', $user->id)->count(),
            'completed_courses' => Enrollment::where('user_id', $user->id)->whereNotNull('completed_at')->count(),
            'certificates' => Certificate::where('user_id', $user->id)->count(),
            'orders' => Order::where('user_id', $user->id)->count(),
            'paid_orders' => Order::where('user_id', $user->id)->where('payment_status', 'paid')->count(),
            'active_subscriptions' => $user->subscriptions()->whereIn('status', ['active', 'trial'])->count(),
            'purchased_services' => ServicePurchase::where('user_id', $user->id)->count(),
        ];

        $recentEnrollments = Enrollment::with('course')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $recentOrders = Order::with('items')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $completedIds = LectureProgress::where('user_id', $user->id)
            ->where('completed', true)
            ->pluck('lecture_id');

        $enrolledCourses = Enrollment::with('course.sections.lectures')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($enrollment) use ($completedIds) {
                $allLectures = $enrollment->course->sections->flatMap->lectures;
                $total = $allLectures->count();
                $completed = $allLectures->filter(fn ($l) => $completedIds->contains($l->id))->count();
                $enrollment->progress = $total > 0 ? round(($completed / $total) * 100) : 0;
                return $enrollment;
            });

        return view('dashboard.index', compact(
            'stats',
            'recentEnrollments',
            'recentOrders',
            'enrolledCourses',
            'completedIds'
        ));
    }

    public function notifications()
    {
        $notifications = auth()->user()->notifications()->latest()->paginate(20);
        return view('dashboard.notifications', compact('notifications'));
    }

    public function markNotification(string $id)
    {
        auth()->user()->notifications()->where('id', $id)->first()?->markAsRead();
        return back();
    }

    public function markAllRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'All notifications marked as read.');
    }
}
