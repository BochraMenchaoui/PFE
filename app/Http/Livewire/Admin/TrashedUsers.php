<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TrashedUsers extends Component
{
    use WithPagination;

    public $paginationCount = 10;
    public $searchQuery = '';

    public function updatePaginationCount($count)
    {
        $this->paginationCount = $count;
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->where('id', $id);
        $user->restore();
    }

    public function render()
    {
        $trashedUsers = User::query();
        $trashedUsers->where('name', 'like', '%' . $this->searchQuery . '%');

        return view('livewire.admin.trashed-users', [
            'trashedUsers' => $trashedUsers->onlyTrashed()->paginate($this->paginationCount),
        ])
            ->extends('admin.layout')
            ->section('content');
    }
}
