<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Http\Traits\Chat;
use App\Events\RealTimeMessage;
use Illuminate\Support\Facades\Auth;


class Messages extends Component
{
    use Chat;

    public $members;

    protected $listeners = [
        'typing',
        'resetTyping',
        'fetchMessages',
        'fetchTeamMembers',
        'render',
    ];
    /*
    TODO
        zid dynamic notifications ll messages
        zid list feha l admin w collabs lkol w ken online wala le, w ken haka meme en temps reelle, heki naaml fi poll w slm
        wala simply ay logging yaaml emit, bsh component tjib e jdod
    */

    public function fetchTeamMembers()
    {
        $this->members = User::whereIn('role', [0, 1])->get(); // TODO: momken aaml $refresh wakhw
        $this->emitSelf('render');
    }

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

        $this->notifyUsers();
    }

    public function mount()
    {
        if (auth()->user()->role !== 1) {
            return redirect()->route('search');
        }
        $this->user = auth()->user();
        $this->fetchMessages();
        $this->fetchTeamMembers();
    }


    public function render()
    {
        return view('livewire.user.messages')
            ->extends('user.layout')
            ->section('content');
    }
}
