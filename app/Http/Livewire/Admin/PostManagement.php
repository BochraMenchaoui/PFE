<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use App\Http\Traits\Alerts;

use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class PostManagement extends Component
{
    use WithPagination, Alerts;

    public $searchQuery      = '';
    public $selectedPosts    = [];
    public $allChecked       = false;
    public $postOrder = 0;

    protected $listeners = ['deleteSelected'];

    public function selectAll()
    {
        if (!$this->allChecked) {
            $this->selectedPosts = Post::pluck('id');
            $this->allChecked = true;
            $this->dispatchBrowserEvent('selected-post', ['id' => $this->selectedPosts]);
            return;
        }
        $this->selectedPosts = [];
        $this->allChecked = false;
    }

    public function deleteConfirmation()
    {
        if (count($this->selectedPosts) > 0) {
            $this->alert('delete-comment', 'selected post(s)');
        }
    }

    public function updatedSelectedPosts()
    {
        $this->dispatchBrowserEvent('selected-post', ['id' => $this->selectedPosts]);
    }

    public function orderPosts($id)
    {
        if (!in_array($id, [0, 1])) {
            return;
        }

        $this->postOrder = $id;
    }

    public function deleteSelected()
    {
        foreach ($this->selectedPosts as $id) {
            if (Post::find($id)->thumbnail !== 'default.png') {
                File::delete(public_path('thumbnails/' . Post::find($id)->thumbnail));
            }
        }

        Post::query()
            ->whereIn('id', $this->selectedPosts)
            ->delete();

        $this->selectedPosts    = [];
        $this->allChecked       = false;
    }

    public function render()
    {
        if ($this->postOrder == 0) {
            $posts = Post::query();
            $user  = User::where('name', 'like', '%' . $this->searchQuery . '%')->first();
            $posts
                ->where('body', 'like', '%' . $this->searchQuery . '%')
                ->orWhere('user_id', '=', $user ? $user->id : '')
                ->orWhere('title', 'like', '%' . $this->searchQuery . '%');
        } else {
            $posts = Post::where('user_id', auth()->user()->id);
        }

        return view('livewire.admin.post-management', [
            'posts' => $posts->paginate(10),
        ])
            ->extends('admin.layout')
            ->section('content');
    }
}
