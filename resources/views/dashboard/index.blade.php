@extends('layouts.dashboard')

@section('title', 'Dashboard - ' . config('app.name'))

@section('content')
{{-- <div class="flex items-center justify-between mb-8">
    <h1 class="font-display text-3xl font-bold">Dashboard</h1>
</div> --}}

<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-card shadow-card p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-muted">Enrolled Courses</p>
                <p class="text-2xl font-bold mt-1">{{ $stats['enrolled_courses'] }}</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-muted mt-2">{{ $stats['completed_courses'] }} completed</p>
    </div>

    <div class="bg-white rounded-card shadow-card p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-muted">Certificates</p>
                <p class="text-2xl font-bold mt-1">{{ $stats['certificates'] }}</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-success/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-muted mt-2">Earned on course completion</p>
    </div>

    <div class="bg-white rounded-card shadow-card p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-muted">Orders</p>
                <p class="text-2xl font-bold mt-1">{{ $stats['orders'] }}</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-warning/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-muted mt-2">{{ $stats['paid_orders'] }} paid</p>
    </div>

    <div class="bg-white rounded-card shadow-card p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-muted">Subscriptions</p>
                <p class="text-2xl font-bold mt-1">{{ $stats['active_subscriptions'] }}</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </div>
        </div>
        <p class="text-xs text-muted mt-2">{{ $stats['purchased_services'] }} services</p>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-card shadow-card p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold">Recent Enrollments</h3>
            <a href="{{ route('courses.my-courses') }}" class="text-xs text-accent hover:text-accent-hover">View All</a>
        </div>
        @if($recentEnrollments->isEmpty())
            <p class="text-sm text-muted text-center py-6">No enrollments yet.</p>
        @else
            <div class="space-y-3">
                @foreach($recentEnrollments as $enrollment)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden shrink-0">
                            @if($enrollment->course->thumbnail)
                                <img src="{{ $enrollment->course->thumbnail_url }}" alt="" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium truncate">{{ $enrollment->course->title }}</p>
                            <p class="text-xs text-muted">{{ $enrollment->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="bg-white rounded-card shadow-card p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold">Recent Orders</h3>
            <a href="{{ route('orders.index') }}" class="text-xs text-accent hover:text-accent-hover">View All</a>
        </div>
        @if($recentOrders->isEmpty())
            <p class="text-sm text-muted text-center py-6">No orders yet.</p>
        @else
            <div class="space-y-3">
                @foreach($recentOrders as $order)
                    <a href="{{ route('orders.show', $order) }}" class="flex items-center justify-between group">
                        <div>
                            <p class="text-sm font-medium">Order #{{ $order->order_number }}</p>
                            <p class="text-xs text-muted">{{ $order->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="text-xs font-medium capitalize
                            {{ $order->payment_status === 'paid' ? 'text-success' : ($order->payment_status === 'unpaid' ? 'text-warning' : 'text-red-500') }}">
                            {{ $order->payment_status }}
                        </span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>

@if($enrolledCourses->isNotEmpty())
    <div class="mt-6 bg-white rounded-card shadow-card p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold">My Courses</h3>
            <a href="{{ route('courses.my-courses') }}" class="text-xs text-accent hover:text-accent-hover">View All</a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($enrolledCourses as $enrollment)
                @php $firstLecture = $enrollment->course->sections->first()?->lectures->first(); @endphp
                <div class="border border-gray-100 rounded-card p-4 hover:shadow-card-hover transition-shadow">
                    <p class="text-sm font-medium truncate">{{ $enrollment->course->title }}</p>
                    <div class="mt-2 flex items-center gap-2 text-xs text-muted">
                        <div class="flex-1 bg-gray-100 rounded-full h-1.5">
                            <div class="bg-accent h-1.5 rounded-full" style="width: {{ $enrollment->progress }}%"></div>
                        </div>
                        <span>{{ $enrollment->progress }}%</span>
                    </div>
                    @if($firstLecture)
                        <a href="{{ route('learn.player', [$enrollment->course, $firstLecture]) }}"
                           class="mt-3 block text-center text-sm text-accent hover:text-accent-hover font-medium">
                            {{ $enrollment->progress > 0 ? 'Continue' : 'Start' }}
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif
@endsection
