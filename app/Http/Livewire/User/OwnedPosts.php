<?php

namespace App\Http\Livewire\User;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\File;

class OwnedPosts extends Component
{
    protected $listeners = ['delete'];

    public $post;
    public $targetPost;
    public $amount = 5;

    public function loadMore()
    {
        $this->amount += 3;
    }

    public function deleteConfirmation($id)
    {
        $this->targetPost = $id;

        $this->dispatchBrowserEvent('delete', [
            'title'             => ('Met2ked?'),
            'text'              => ('Sur t7eb tfaskh?'),
            'icon'              => 'error',
            'confirmButtonText' => ('Ey, Faskh'),
            'cancelButtonText'  => ('Le'),
        ]);
    }

    public function delete()
    {
        $post = Post::find($this->targetPost);
        if ($post->thumbnail !== 'default.png') {
            File::delete(public_path('thumbnails/' . $post->thumbnail));
        }

        $post->delete();
    }

    public function mount()
    {
        if (auth()->user()->role == 0) {
            return redirect()->route('admin.posts');
        }
    }

    public function render()
    {
        return view('livewire.user.owned-posts', [
            'posts' => auth()->user()->posts->take($this->amount),
        ])
            ->extends('user.layout')
            ->section('content');
    }
}
