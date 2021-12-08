<?php

namespace App\Http\Livewire\User;

use App\Models\Post;
use Livewire\Component;

class ListPosts extends Component
{
    public $posts;
    public $amount = 7;

    public function fetchPosts()
    {
        $this->posts = Post::latest()->take($this->amount)->get();
    }

    public function loadMore()
    {
        $this->amount += 3;
    }

    public function render()
    {
        $this->fetchPosts();
        return view('livewire.user.list-posts')
            ->extends('user.layout')
            ->section('content');
    }
}
