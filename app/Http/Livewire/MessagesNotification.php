<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MessagesNotification extends Component
{
    public $count;
    public $currentRouteName;

    protected $listeners = ['messageNotification' => 'render', 'messageSeen' => 'render', 'render'];

    public function markAsRead()
    {
        foreach (auth()->user()->unreadNotifications->where('type', 'App\Notifications\MessageNotification') as $notification) {
            $notification->markAsRead();
        }
    }
    public function redirectToMessages()
    {
        $this->markAsRead();
        $this->emit('messageSeen');

        return redirect()->route('admin.messages', ['lang' => app()->getLocale()]);
    }

    public function getUnreadMessagesCount()
    {
        $this->count = auth()->user()->unreadNotifications->where('type', 'App\Notifications\MessageNotification')->count();
    }

    public function mount()
    {
        $this->currentRouteName = \Route::currentRouteName();
    }

    public function render()
    {
        if ($this->currentRouteName !== 'admin.messages') {
            $this->getUnreadMessagesCount();
        } else {
            $this->markAsRead();
        }

        return view('livewire.messages-notification');
    }
}
