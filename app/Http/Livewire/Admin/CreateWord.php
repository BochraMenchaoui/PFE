<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\Word;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class CreateWord extends Component
{
    /*
    TODO: momken naaml option tounes lkol, mshken wileya mo3ayna
    */
    public $derja = '';
    public $latin;
    public $french;
    public $english;
    public $arabic;
    public $origin;
    public $description;
    public $region         = 'Ariana';
    public $frenchToggled  = false;
    public $englishToggled = false;
    public $arabicToggled  = false;
    public $searchQuery;
    public $synonyms = [];

    protected function rules()
    {
        return [
            'derja'       => 'required|min:3|max:50',
            'latin'       => 'required|min:3|max:50',
            'french'      => $this->frenchToggled ? '' : 'required|min:3|max:50',
            'english'     => $this->englishToggled ? '' : 'required|min:3|max:50',
            'arabic'      => $this->arabicToggled ? '' : 'required|min:3|max:50',
            'origin'      => 'required|min:3|max:50',
            'description' => 'required|min:100|max:1024',
            'region'      => 'required',
        ];
    }

    public function translate($word, $source, $target)
    {
        return (Http::withHeaders([
            "x-rapidapi-key"  => Config::get('services.my_memory.rapid_key'),
            "x-rapidapi-host" => Config::get('services.my_memory.rapid_host'),
            "useQueryString"  => true,
        ])->get(Config::get('services.my_memory.host'), [
            'q'        => $word,
            'langpair' => $source . '|' . $target,
        ])->json())['matches'][0]['translation'];
    }

    public function toggleDisable($lang)
    {
        if ($lang === 'fr') {
            if ($this->frenchToggled) {
                $this->frenchToggled = false;
                $this->resetValidation('french');
                $this->resetErrorBag('french');
                return;
            }

            $this->frenchToggled = true;
            $this->french        = null;
            $this->resetValidation('french');
            $this->resetErrorBag('french');
            return;
        }

        if ($lang === 'en') {
            if ($this->englishToggled) {
                $this->englishToggled = false;
                $this->resetValidation('english');
                $this->resetErrorBag('english');
                return;
            }

            $this->englishToggled = true;
            $this->english        = null;
            $this->resetValidation('english');
            $this->resetErrorBag('english');
            return;
        }

        if ($lang === 'ar') {
            if ($this->arabicToggled) {
                $this->arabicToggled = false;
                $this->resetValidation('arabic');
                $this->resetErrorBag('arabic');
                return;
            }

            $this->arabicToggled = true;
            $this->arabic        = null;
            $this->resetValidation('arabic');
            $this->resetErrorBag('arabic');
            return;
        }
    }

    public function translateFrom($lang)
    {

        if ($lang === 'en' && $this->englishToggled === false) {
            if (strlen($this->english) >= 3) {
                $this->french = $this->translate($this->english, 'en', 'fr');
                $this->arabic = $this->translate($this->english, 'en', 'ar');
                return $this->reset(['frenchToggled', 'arabicToggled']);
            }
            return $this->addError('english', 'At least 3 characters to use this feature.');
        }

        if ($lang === 'fr' && $this->frenchToggled === false) {
            if (strlen($this->french) >= 3) {
                $this->english = $this->translate($this->french, 'fr', 'en');
                $this->arabic  = $this->translate($this->french, 'fr', 'ar');
                return $this->reset(['englishToggled', 'arabicToggled']);
            }
            return $this->addError('french', 'At least 3 characters to use this feature.');
        }

        if ($lang === 'ar' && $this->arabicToggled === false) {
            if (strlen($this->arabic) >= 3) {
                $this->english = $this->translate($this->arabic, 'ar', 'en');
                $this->french  = $this->translate($this->arabic, 'ar', 'fr');
                return $this->reset(['englishToggled', 'frenchToggled']);
            }
            return $this->addError('arabic', 'At least 3 characters to use this feature.');
        }
    }

    public function store()
    {
        $this->validate();

        $admin = User::find(Auth::id());

        $word = $admin->words()->create([
            'word_ar'     => $this->derja,
            'word_lt'     => $this->latin,
            'ar'          => $this->arabic,
            'fr'          => $this->french,
            'en'          => $this->english,
            'description' => $this->description,
            'origin'      => $this->origin,
            'region'      => $this->region,
            'published'   => 1,
        ]);

        if ($this->synonyms) {
            foreach ($this->synonyms as $syn) {
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

        $this->reset();

        $this->dispatchBrowserEvent('word-created', [
            'title' => 'Word created successfully.',
            'icon'  => 'success',
        ]);
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
            $results = Word::where('word_lt', 'like', '%' . $this->searchQuery . '%')
                ->orWhere('word_ar', 'like', '%' . $this->searchQuery . '%')
                ->get();
        }

        return view('livewire.admin.create-word', ['results' => $results ?? null])
            ->extends('admin.layout')
            ->section('content');
    }
}
