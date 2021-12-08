<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\Word;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Notifications\FavouriteNotification;

class Favourite extends Component
{
    public $amount = 5;
    public $countFav;
    public $latestWords;
    public $user;

    protected $listeners = ['favouriteAdded' => 'render', 'render'];

    public function loadMore()
    {
        $this->amount += 2;
    }

    public function unfav($id)
    {
        User::find(Auth::id())->favourites()->detach($id);
        User::find(Auth::id())->notify(new FavouriteNotification('FavouriteRemoved'));
        $this->emit('render');
    }

    public function fetchLatestWords()
    {
        $this->latestWords = Word::latest()->where('published', 1)->take(5)->get(); // TODO: ki yabda null treteha
    }

    public function mount()
    {
        $this->user = auth()->user();
        $this->fetchLatestWords();
    }

    public function render()
    {
        $this->countFav = $this->user->favourites->count();
        $favs = User::find(Auth::id())->favourites()->take($this->amount)->get();
        return view('livewire.user.favourite', ['favs' => $favs])
            ->extends('user.layout')
            ->section('content');
    }
}
