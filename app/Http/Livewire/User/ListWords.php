<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\Word;
use Livewire\Component;
use App\Exports\WordsExport;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\AskForWordReview;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SubmittedWordProgressNotification;

class ListWords extends Component
{
    use WithPagination, WithFileUploads;

    /*
        TODO:
            1. n testi l import
            2. momken nbadilha el progress b haja khir
    */

    public $detailled_word;
    public $sort = [0, 1];
    public $selected;
    public $document;
    public $targetWord;

    protected $listeners = [
        'wordAccepted' => 'render', 'delete', 'render'
    ];

    /*
        TODO:
        1. add fi sorting mte kelma, sorting bil user wala recherche bil user.
    */

    public function askForWordReview($id)
    {
        $users = User::whereIn('role', [0, 1])->get();
        Notification::send($users, new AskForWordReview(auth()->user()->name, auth()->user()->avatar, $id));

        $this->dispatchBrowserEvent('success', [
            'title' => 'Cbn bathna demande ll admin.',
            'icon'  => 'success',
        ]);
    }

    public function sortBy()
    {
        if ($this->selected == 2) {
            $this->sort = [0, 1];
            return;
        }
        $this->sort = [$this->selected];
    }

    public function mount()
    {
        if (auth()->user()->role == 0) { // the admin has he own management system, he shall be redirected.
            return redirect()->route('admin.words');
        }
    }

    public function moreDetail($id)
    {
        $this->detailled_word = Word::find($id);
    }

    public function getWords()
    {
        if (auth()->user()->role == 1) // a collaborator shall see all words, and decided to accept or not.
            return Word::whereIn('published', $this->sort)->paginate(10);
        return Word::where('user_id', auth()->user()->id)->whereIn('published', $this->sort)->paginate(10);
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

    public function deleteConfirmation($id)
    {
        $this->targetWord = $id;

        $this->dispatchBrowserEvent('delete', [
            'title'             => __('Met2ked?'),
            'text'              => __('Sur t7eb tfaskh?'),
            'icon'              => 'error',
            'confirmButtonText' => __('Ey, Faskh'),
            'cancelButtonText'  => __('Le'),
        ]);
    }

    public function delete()
    {
        $word = Word::find($this->targetWord);

        if (auth()->user()->role === 1) {
            $word->user?->notify(new SubmittedWordProgressNotification('Rejected', 'Kelmtek mat9ebletesh!'));
        }

        $word->delete();
        $this->reset('detailled_word');
    }

    public function publish($id)
    {
        $word = Word::find($id);
        if (is_null($word)) {
            return;
        }

        $word->published = 1;
        $word->save();

        $word->user->notify(new SubmittedWordProgressNotification('Accepted', 'Kelmtek t9eblet!'));

        $this->dispatchBrowserEvent('word-published', [
            'title' => 'El kelma t9eblet',
            'icon'  => 'success',
        ]);
    }

    public function render()
    {
        return view('livewire.user.list-words', ['words' => $this->getWords()])
            ->extends('user.layout')
            ->section('content');
    }
}
