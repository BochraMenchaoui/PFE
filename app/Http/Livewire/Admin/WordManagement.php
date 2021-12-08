<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\Word;
use Livewire\Component;
use App\Http\Traits\Alerts;
use App\Exports\WordsExport;
use App\Imports\WordsImport;
use App\Models\Synonyms;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\SubmittedWordProgressNotification;

class WordManagement extends Component
{
    use WithPagination, WithFileUploads, Alerts;

    protected $listeners = ['delete'];

    protected $paginationTheme = 'bootstrap';
    public    $paginationCount = 10;
    public    $sort            = [0, 1];
    public $searchQuery;
    public $document;
    public $selected;
    public $targetWord;
    public $owner;

    public function sortBy()
    {
        if ($this->selected == 2) {
            $this->sort = [0, 1];
            return;
        }
        $this->sort = [$this->selected];
    }

    public function deleteConfirmation($id)
    {
        $this->targetWord = $id;

        $this->alert('delete', 'word');
    }

    public function updatedDocument()
    {
        $this->validate([
            'document' => 'max:4096|mimes:xlsx',
        ]);

        File::delete(public_path('imports/words.xlsx'));

        $this->document->storeAs('imports', 'words.xlsx');

        try {
            Excel::import(new WordsImport, storage_path('app/imports/words.xlsx'));
            $this->dispatchBrowserEvent('documented-imported', [
                'title' => 'File imported successfully',
                'icon'  => 'success',
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            session()->flash('message', 'Make sure you don\'t have any duplicates.');
        }
    }

    public function publish($id)
    {
        $word = Word::find($id);
        if (is_null($word)) {
            return;
        }
        $word->published = 1;
        $word->save();

        $word->user->notify(new SubmittedWordProgressNotification('Accepted', 'Your word got accepted!'));

        $this->dispatchBrowserEvent('word-published', [
            'title' => 'Word Published',
            'icon'  => 'success',
        ]);
    }

    public function delete()
    {
        $word = Word::find($this->targetWord);
        if (is_null($word)) {
            return;
        }

        Synonyms::where('syn', $word->id)->delete();

        if ($word->user->role !== 0) {
            $word->user?->notify(new SubmittedWordProgressNotification('Rejected', 'Kelmtek tfaskhet/mat9bletech'));
        }

        Word::destroy([$this->targetWord]);
    }

    public function updatedPaginationCount()
    {
        $this->resetPage();
    }

    public function updatePaginationCount($count)
    {
        $this->paginationCount = $count;
    }

    // Exports all words as CSV
    public function exportWordsCSV()
    {
        return Excel::download(new WordsExport, 'words.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    // EXports all words as PDF
    public function exportWordsPDF()
    {
        return Excel::download(new WordsExport, 'words.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function render()
    {
        $this->owner = User::where('name', 'like', '%' . $this->searchQuery . '%')->first();
        $words       = Word::query();
        $words->whereIn('published', $this->sort)
            ->where(function ($query) {
                $query->where('word_ar', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('word_lt', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('user_id', $this->owner->id ?? '');
            });

        return view('livewire.admin.word-management', [
            'words' => $words->paginate($this->paginationCount),
        ])
            ->extends('admin.layout')
            ->section('content');
    }
}
