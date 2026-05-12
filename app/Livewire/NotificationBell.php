<?php

namespace App\Livewire;

use Livewire\Component;

class NotificationBell extends Component
{
    public int $unreadCount = 0;

    protected $listeners = ['notificationReceived' => '$refresh'];

    public function mount()
    {
        $this->unreadCount = auth()->user()->unreadNotifications->count();
    }

    public function markAsRead(string $id)
    {
        auth()->user()->notifications()->where('id', $id)->first()?->markAsRead();
        $this->unreadCount = auth()->user()->unreadNotifications->count();
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->unreadCount = 0;
    }

    public function render()
    {
        $this->unreadCount = auth()->user()->unreadNotifications->count();
        $recentNotifications = auth()->user()->notifications()->latest()->take(5)->get();

        return view('livewire.notification-bell', [
            'recentNotifications' => $recentNotifications,
        ]);
    }
}
