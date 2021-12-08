<?php

namespace App\Http\Livewire\Admin;

use App\Models\Synonyms;
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
    public $searchQuery;
    public $synonyms = [];

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

    public function mount($id)
    {
        $word = Word::find($id);

        if (is_null($word)) {
            return redirect()->route('admin.words');
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

        $tmp = $word->synonyms;

        foreach ($tmp as $syn) {
            $this->synonyms[] = [
                'id' => $syn->syn,
                'word' => Word::find($syn->syn)->word_lt,
            ];
        }
    }

    public function deleteRelated($word)
    {
        foreach ($word->synonyms as $syn) {
            $toBeDeleted = Synonyms::where('word_id', $syn->syn)->get();
            foreach ($toBeDeleted as $item) {
                $item->delete();
            }
        }
        $word->synonyms()->delete();
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

        if ($word->synonyms->count() > count($this->synonyms)) {
            foreach ($this->synonyms as $synonym) {
                foreach ($word->synonyms as $item) {
                    if ($synonym['id'] != $item->syn) {
                        $missing[] = $item->syn;
                    }
                }
            }
            Synonyms::whereIn('word_id', $missing)->delete();
            Synonyms::whereIn('syn', $missing)->delete();

            return $this->dispatchBrowserEvent('word-created', [
                'title' => 'Word updated successfully.',
                'icon'  => 'success',
            ]);
        }

        if ($word->synonyms->isNotEmpty() && empty($this->synonyms)) {
            $this->deleteRelated($word);
            return $this->dispatchBrowserEvent('word-created', [
                'title' => 'Word updated successfully.',
                'icon'  => 'success',
            ]);
        }

        if ($this->synonyms) {
            foreach ($this->synonyms as $syn) {
                // PART 1
                if ($collectionOne = Word::find($syn['id'])->synonyms) {
                    foreach ($collectionOne as $item) {
                        if ($item->syn != $word->id) {
                            Word::find($item->syn)->synonyms()->updateOrCreate([
                                'syn' => $word->id
                            ]);
                        }
                    }
                }

                Word::find($syn['id'])->synonyms()->updateOrCreate([
                    'syn' => $word->id,
                ]);

                // PART 2
                if ($word->synonyms) {
                    foreach ($word->synonyms as $first_item) {
                        if ($first_item->syn != $syn['id']) {
                            foreach (Word::find($syn['id'])->synonyms as $second_item) {
                                Word::find($first_item->syn)->synonyms()->updateOrCreate([
                                    'syn' => $second_item->syn,
                                ]);

                                Word::find($second_item->syn)->synonyms()->updateOrCreate([
                                    'syn' => $first_item->syn,
                                ]);
                            }

                            Word::find($syn['id'])->synonyms()->updateOrCreate([
                                'syn' => $first_item->syn,
                            ]);

                            Word::find($first_item->syn)->synonyms()->updateOrCreate([
                                'syn' => $syn['id'],
                            ]);
                        }
                    }
                }

                // PART 3
                $word->synonyms()->updateOrCreate([
                    'syn' => $syn['id']
                ]);

                foreach (Word::find($syn['id'])->synonyms as $item) {
                    if ($item->syn != $word->id) {
                        $word->synonyms()->updateOrCreate([
                            'syn' => $item->syn
                        ]);
                    }
                }
            }
        }

        return $this->dispatchBrowserEvent('word-created', [
            'title' => 'Word updated successfully.',
            'icon'  => 'success',
        ]);
    }

    public function clearForm()
    {
        return $this->reset();
    }

    public function synExists($syns, $word, $id)
    {
        foreach ($syns as $syn) {
            if ($syn['id'] === $id && $syn['word'] === $word) {
                return true;
            }
        }
        return false;
    }

    public function addSyn($id, $word)
    {
        if (!$this->synExists($this->synonyms, $word, $id)) {
            $this->synonyms[] = [
                'id'   => $id,
                'word' => $word,
            ];
            $this->dispatchBrowserEvent('remove-tag', ['id' => $id]);
        }
    }

    public function removeSyn($id)
    {
        unset($this->synonyms[$id]);
        $temp = $this->synonyms;
        $this->reset('synonyms');
        foreach ($temp as $syn) {
            $this->synonyms[] = $syn;
        }
    }

    public function render()
    {
        if ($this->searchQuery) {
            $results = Word::where('id', '<>', $this->word_id)
                ->where(function ($query) {
                    $query
                        ->where('word_lt', 'like', '%' . $this->searchQuery . '%')
                        ->orWhere('word_ar', 'like', '%' . $this->searchQuery . '%');
                })
                ->get();
        }
        return view('livewire.admin.edit-word', ['results' => $results ?? null])
            ->extends('admin.layout')
            ->section('content');
    }
}
