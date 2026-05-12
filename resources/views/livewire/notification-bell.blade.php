<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" @click.away="open = false"
            class="relative p-2 text-gray-500 hover:text-accent transition" title="Notifications">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        @if($unreadCount > 0)
            <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center min-w-[18px] min-h-[18px] px-1 leading-none">
                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
            </span>
        @endif
    </button>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 mt-2 w-80 bg-white rounded-card shadow-lg border border-gray-100 z-50"
         @click.away="open = false">
        <div class="p-3 border-b border-gray-100 flex items-center justify-between">
            <span class="text-sm font-semibold">Notifications</span>
            @if($unreadCount > 0)
                <button wire:click="markAllAsRead" class="text-xs text-accent hover:text-accent-hover">Mark all read</button>
            @endif
        </div>

        <div class="max-h-72 overflow-y-auto">
            @forelse($recentNotifications as $notification)
                <div class="flex items-start gap-3 px-3 py-3 hover:bg-gray-50 transition {{ $notification->read_at ? '' : 'bg-accent/5' }}">
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-medium {{ $notification->read_at ? 'text-muted' : 'text-primary' }}">
                            {{ $notification->data['title'] ?? 'Notification' }}
                        </p>
                        <p class="text-xs text-muted mt-0.5 line-clamp-2">{{ $notification->data['body'] ?? '' }}</p>
                        <p class="text-[10px] text-muted mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                    @if(!$notification->read_at)
                        <button wire:click="markAsRead('{{ $notification->id }}')" class="text-xs text-accent hover:text-accent-hover shrink-0 mt-0.5">
                            Read
                        </button>
                    @endif
                </div>
            @empty
                <div class="text-center py-8 px-3">
                    <svg class="w-8 h-8 text-gray-200 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <p class="text-xs text-muted">No notifications yet</p>
                </div>
            @endforelse
        </div>

        @if(auth()->user()->notifications()->count() > 5)
            <a href="{{ route('dashboard.notifications') }}"
               class="block text-center text-xs text-accent hover:text-accent-hover py-2.5 border-t border-gray-100 font-medium">
                View All Notifications
            </a>
        @endif
    </div>
</div>
