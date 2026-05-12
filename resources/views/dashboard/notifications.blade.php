@extends('layouts.dashboard')

@section('title', 'Notifications - ' . config('app.name'))

@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="font-display text-3xl font-bold">Notifications</h1>
    @if(auth()->user()->unreadNotifications->isNotEmpty())
        <form method="POST" action="{{ route('dashboard.notifications.mark-all-read') }}">
            @csrf
            <button type="submit" class="text-sm text-accent hover:text-accent-hover font-medium">
                Mark All as Read
            </button>
        </form>
    @endif
</div>

@if($notifications->isEmpty())
    <div class="text-center py-16">
        <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        <h2 class="text-xl font-display font-semibold text-gray-400 mb-2">No notifications</h2>
        <p class="text-muted">You're all caught up!</p>
    </div>
@else
    <div class="bg-white rounded-card shadow-card divide-y divide-gray-100">
        @foreach($notifications as $notification)
            <div class="flex items-start gap-4 p-4 {{ $notification->read_at ? '' : 'bg-accent/5' }}">
                <div class="w-8 h-8 rounded-full {{ $notification->read_at ? 'bg-gray-100' : 'bg-accent/10' }} flex items-center justify-center shrink-0 mt-1">
                    <svg class="w-4 h-4 {{ $notification->read_at ? 'text-gray-400' : 'text-accent' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium">{{ $notification->data['title'] ?? 'Notification' }}</p>
                    <p class="text-xs text-muted mt-0.5">{{ $notification->data['body'] ?? '' }}</p>
                    <p class="text-xs text-muted mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                </div>
                @if(!$notification->read_at)
                    <form method="POST" action="{{ route('dashboard.notifications.mark-read', $notification->id) }}">
                        @csrf
                        <button type="submit" class="text-xs text-accent hover:text-accent-hover shrink-0 mt-1">
                            Mark Read
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
@endif
@endsection
