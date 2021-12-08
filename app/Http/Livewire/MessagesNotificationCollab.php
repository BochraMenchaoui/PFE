<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MessagesNotificationCollab extends Component
{
    public $count;
    public $currentRouteName;

    protected $listeners = ['messageNotification' => 'render', 'messageSeen' => 'render', 'render'];

    public function markAsRead()
    {
        foreach (auth()->user()->unreadNotifications->where('type', 'App\Notifications\NotifyCollabMessageSent') as $notification) {
            $notification->markAsRead();
        }
    }
    public function redirectToMessages()
    {
        $this->markAsRead();
        $this->emit('messageSeen');

        return redirect()->route('messages');
    }

    public function getUnreadMessagesCount()
    {
        $this->count = auth()->user()->unreadNotifications->where('type', 'App\Notifications\NotifyCollabMessageSent')->count();
    }

    public function mount()
    {
        $this->currentRouteName = \Route::currentRouteName();
    }

    public function render()
    {
        if ($this->currentRouteName !== 'messages') {
            $this->getUnreadMessagesCount();
        } else {
            $this->markAsRead();
        }

        return view('livewire.messages-notification-collab');
    }
}
