<?php

namespace App\Http\Livewire\User;

use App\Models\Word;
use Livewire\Component;

class EditWord extends Component
{
    public $word_id;
    public $derja;
    public $latin;
    public $french;
    public $arabic;
    public $english;
    public $description;
    public $origin;
    public $region;

    public function mount($id)
    {
        $user = auth()->user();

        if ($user->role === 0) {
            return redirect()->route('admin.word.edit', ['id' => $id]);
        }

        $word = Word::find($id);

        if (is_null($word)) {
            return redirect()->route('user.words');
        }

        if (!($word->user->id === $user->id || $user->role === 1)) {
            return redirect()->route('user.words');
        }

        $this->fill([
            'word_id'     => $word->id,
            'derja'       => $word->word_ar,
            'latin'       => $word->word_lt,
            'french'      => $word->fr,
            'english'     => $word->en,
            'arabic'      => $word->ar,
            'description' => $word->description,
            'origin'      => $word->origin,
            'region'      => $word->region,
        ]);
    }

    protected function rules()
    {
        return [
            'derja'       => $this->derja ? '' : 'required|min:3|max:50',
            'latin'       => $this->latin ? '' : 'required|min:3|max:50',
            'french'      => $this->french ? '' : 'required|min:3|max:50',
            'english'     => $this->english ? '' : 'required|min:3|max:50',
            'arabic'      => $this->arabic ? '' : 'required|min:3|max:50',
            'origin'      => $this->origin ? '' : 'required|min:3|max:50',
            'description' => $this->description ? '' : 'required|min:100|max:1024',
            'region'      => $this->region ? '' : 'required',
        ];
    }

    public function store()
    {
        $this->validate();

        $word = Word::find($this->word_id);

        $word->update([
            'word_ar'     => $this->derja,
            'word_lt'     => $this->latin,
            'fr'          => $this->french,
            'en'          => $this->english,
            'ar'          => $this->arabic,
            'description' => $this->description,
            'origin'      => $this->origin,
            'region'      => $this->region,
        ]);

        $word->save();

        $this->dispatchBrowserEvent('word-created', [
            'title' => 'Amlna el mise-a-jour!',
            'icon'  => 'success',
        ]);
    }

    public function clearForm()
    {
        return $this->reset();
    }

    public function render()
    {
        return view('livewire.user.edit-word')
            ->extends('user.layout')
            ->section('content');
    }
}
