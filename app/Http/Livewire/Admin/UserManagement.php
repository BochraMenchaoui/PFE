<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Exports\UsersExport;
use App\Http\Traits\Alerts;
use App\Imports\UsersImport;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class UserManagement extends Component
{
    use WithPagination, WithFileUploads, Alerts;

    /*
        TODO: zid button feha example mte import
    */

    protected $listeners = ['delete'];

    protected $paginationTheme = 'bootstrap';
    public    $paginationCount = 10;
    public    $searchQuery     = '';
    public    $sortField       = 'id';
    public    $sortOrder       = 'asc';
    public    $selected        = 'id';
    public $targetUser;
    public $document;


    public function sortBy()
    {
        $this->sortField = $this->selected;
        $this->sortOrder = ($this->sortOrder == "asc") ? "desc" : "asc";
    }

    public function updatedDocument()
    {
        $this->validate([
            'document' => 'max:4096|mimes:xlsx',
        ]);

        File::delete(public_path('imports/users.xlsx'));

        $this->document->storeAs('imports', 'users.xlsx');

        try {
            Excel::import(new UsersImport, storage_path('app/imports/users.xlsx'));
            $this->dispatchBrowserEvent('documented-imported', [
                'title' => 'File imported successfully',
                'icon'  => 'success',
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            session()->flash('message', 'Make sure you don\'t have any duplicates.');
        }
    }

    public function deleteConfirmation($id)
    {
        $this->targetUser = $id;

        $this->alert('delete', 'user');
    }

    public function updatedPaginationCount()
    {
        $this->resetPage();
    }

    public function delete()
    {
        User::destroy([$this->targetUser]);
    }

    public function updatePaginationCount($count)
    {
        $this->paginationCount = $count;
    }

    // Exports all users as CSV
    public function exportUsersCSV()
    {
        return Excel::download(new UsersExport, 'users.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    // EXports all users as PDF
    public function exportUsersPDF()
    {
        return Excel::download(new UsersExport, 'users.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function render()
    {
        $users = User::query();
        $users->where('name', 'like', '%' . $this->searchQuery . '%');
        $users->orderBy($this->sortField, $this->sortOrder);

        return view('livewire.admin.user-management', [
            'users' => $users->paginate($this->paginationCount),
        ])
            ->extends('admin.layout')
            ->section('content');
    }
}
