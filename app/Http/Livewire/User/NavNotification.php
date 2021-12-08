<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NavNotification extends Component
{
    public $count = 0;
    public $notifications = null;
    public $user;

    protected $listeners = [
        'notificationAdded' => 'render', // TODO: review this listener fana blassa mawjoud
        'markedAsRead'      => 'render',
        'wordAccepted'      => 'render',
    ];

    public function markAsRead()
    {
        foreach ($this->user->unreadNotifications->where('type', '!=', 'App\Notifications\NotifyCollabMessageSent')->take(5) as $notification) {
            $notification->markAsRead();
        }
        $this->notifications = null;
        $this->emit('markedAsRead');
    }

    public function render()
    {
        $this->user = User::find(Auth::id());
        $this->count = $this->user->unreadNotifications->where('type', '!=', 'App\Notifications\NotifyCollabMessageSent')->count();
        if ($this->count != 0) {
            $this->notifications = $this->user->unreadNotifications->where('type', '!=', 'App\Notifications\NotifyCollabMessageSent')->take(5);
        }
        return view('livewire.user.nav-notification', ['notifications' => $this->notifications]);
    }
}
