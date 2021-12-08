<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class PostDetail extends Component
{
    public $post;
    public $currentRouteName;
    public $currentParams;
    public $color = [
        'warning',
        'success',
        'gray',
        'info',
        'tertiary',
        'danger'
    ];

    public function mount($id)
    {
        $this->post = Post::find($id);
        if (is_null($this->post)) {
            return redirect()->route('user.posts');
        }

        $this->currentRouteName = \Route::currentRouteName();
        $this->currentParams    = \Route::current()->parameters();
    }

    public function render()
    {
        return view('livewire.post.post-detail')
            ->extends('user.layout')
            ->section('content');
    }
}
