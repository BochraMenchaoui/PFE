<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PageTitle extends Component
{
    public $count;
    public $user;

    protected $listeners = [
        'wordAccepted' => 'render',
        'markedAsRead' => 'render'
    ];

    public function render()
    {
        $this->user = User::find(Auth::id());
        if ($this->user->role !== 0)
            $this->count = count($this->user->unreadNotifications->where('type', '!=', 'App\Notifications\NotifyCollabMessageSent'));
        return view('livewire.page-title');
    }
}
