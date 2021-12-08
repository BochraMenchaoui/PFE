<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\Alerts;
use App\Models\User;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class CommentManagement extends Component
{
    use WithPagination, Alerts;

    public $searchQuery      = '';
    public $selectedComments = [];
    public $allChecked       = false;

    protected $listeners = ['deleteSelected'];

    public function selectAll()
    {
        if (!$this->allChecked) {
            $this->selectedComments = Comment::pluck('id');
            $this->allChecked = true;
            $this->dispatchBrowserEvent('selected-comment', ['id' => $this->selectedComments]);
            return;
        }
        $this->selectedComments = [];
        $this->allChecked = false;
    }

    public function deleteConfirmation()
    {
        if (count($this->selectedComments) > 0) {
            $this->alert('delete-comment', 'selected comment(s)');
        }
    }

    public function updatedSelectedComments()
    {
        $this->dispatchBrowserEvent('selected-comment', ['id' => $this->selectedComments]);
    }

    public function deleteSelected()
    {
        Comment::query()
            ->whereIn('id', $this->selectedComments)
            ->delete();

        $this->selectedComments = [];
        $this->allChecked       = false;
    }

    public function render()
    {

        $comments = Comment::query();
        $user     = User::where('name', 'like', '%' . $this->searchQuery . '%')->first();
        $comments->where('body', 'like', '%' . $this->searchQuery . '%')->orWhere('user_id', '=', $user ? $user->id : '');

        return view('livewire.admin.comment-management', [
            'comments' => $comments->paginate(10),
        ])
            ->extends('admin.layout')
            ->section('content');
    }
}
