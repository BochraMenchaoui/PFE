<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Cache;
use App\Notifications\MessageNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Message;

trait Chat
{
    public $typing = false;
    public $user;
    public $texts;
    public $name;
    public $body = '';
    public $amount = 5;

    public function typing($name)
    {
        $this->name   = $name;
        $this->typing = true;
        $this->emit('typing-remove');
        return;
    }

    public function notifyUsers()
    {
        $users = Cache::get('online-users');
        foreach ((array)$users as $user) {
            if (($user['role'] === 0 || $user['role'] === 1) && $user['id'] !== auth()->user()->id) {
                Notification::send(User::find($user['id']), new MessageNotification());
            }
        }
    }

    public function updatingBody()
    {
        $this->dispatchBrowserEvent('typing', ['user' => auth()->user()->name]);
    }

    public function resetTyping()
    {
        $this->reset('typing');
    }

    public function fetchMessages()
    {
        $this->texts = Message::latest()->take($this->amount)->get()->reverse();
    }

    public function loadOlderMessages()
    {
        if ($this->amount < Message::count()) {
            $this->amount   += 5;
            $this->fetchMessages();
        }
    }
}
