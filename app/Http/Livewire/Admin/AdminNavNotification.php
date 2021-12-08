<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminNavNotification extends Component
{
    public $count;
    public $notifications;

    protected $listeners = [
        'notificationAdded' => 'render',
        'markedAsRead'      => 'render',
    ];

    public function markAsRead()
    {
        foreach (auth()->user()->unreadNotifications->where('type', 'App\Notifications\AskForWordReview')->take(5) as $notification) {
            $notification->markAsRead();
        }
        $this->notifications = null;
        $this->emit('markedAsRead');
    }

    public function render()
    {
        $this->count = auth()->user()->unreadNotifications->where('type', 'App\Notifications\AskForWordReview')->count();
        if ($this->count != 0) {
            $this->notifications = auth()->user()->unreadNotifications->where('type', 'App\Notifications\AskForWordReview')->take(5);
        }
        return view('livewire.admin.admin-nav-notification');
    }
}
