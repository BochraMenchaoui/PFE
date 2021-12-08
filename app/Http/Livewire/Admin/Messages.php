<?php

namespace App\Http\Livewire\Admin;


use App\Models\User;
use Livewire\Component;
use App\Http\Traits\Chat;
use App\Events\RealTimeMessage;
use Illuminate\Support\Facades\Cache;
use App\Notifications\NotifyCollabMessageSent;
use Illuminate\Support\Facades\Notification;

class Messages extends Component
{
    use Chat;

    protected $listeners = ['typing', 'resetTyping', 'fetchMessages'];

    public function saveMessage()
    {
        $this->validate([
            'body' => 'required|min:1',
        ]);

        $this->user->messages()->create([
            'body' => $this->body,
        ]);

        $this->reset('body');

        event(new RealTimeMessage());

        $users = Cache::get('online-users');

        foreach ((array)$users as $user) {
            if (($user['role'] === 0 || $user['role'] === 1) && $user['id'] !== auth()->user()->id) {
                Notification::send(User::find($user['id']), new NotifyCollabMessageSent('AdminSent'));
            }
        }
    }

    public function mount()
    {
        $this->user = auth()->user();
        $this->fetchMessages();
    }

    public function render()
    {
        return view('livewire.admin.messages')
            ->extends('admin.layout')
            ->section('content');
    }
}
