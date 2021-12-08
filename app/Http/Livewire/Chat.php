<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Events\RealTimeMessage;
use App\Notifications\MessageNotification;
use Illuminate\Support\Facades\Notification;

class Chat extends Component
{
    public $message;

    public function updatingMessage()
    {
        $this->dispatchBrowserEvent('typing', ['user' => auth()->user()->name]);
    }

    public function saveMessage()
    {
        auth()->user()->messages()->create([
            'body' => $this->message,
        ]);

        event(new RealTimeMessage());
        Notification::send(User::find(1), new MessageNotification());
    }


    public function render()
    {
        return view('livewire.chat');
    }
}
