<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class SuggestWord extends Component
{
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
    public $width          = 0;
    public $total          = 0;
    public $updatesCount   = [];
    /*
    TODO: kharejhom fi trait bsh yabdesh code maawed barsha, zid fazet progressbar, shouf fekra okhra w detail sghir yobher
        mathlan quotes wala ay haja lhassel, mohem haja tobher chwya w tched el yetfarj w el mokh mteeo, 
    */
    protected $listeners = ['updated'];

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
                $this->emitSelf('updated', 'french');
                return;
            }

            $this->frenchToggled = true;
            $this->french        = null;
            $this->emitSelf('updated', 'french');
            return;
        }

        if ($lang === 'en') {
            if ($this->englishToggled) {
                $this->englishToggled = false;
                $this->emitSelf('updated', 'english');
                return;
            }

            $this->englishToggled = true;
            $this->english        = null;
            $this->emitSelf('updated', 'english');
            return;
        }

        if ($lang === 'ar') {
            if ($this->arabicToggled) {
                $this->arabicToggled = false;
                $this->emitSelf('updated', 'arabic');
                return;
            }

            $this->arabicToggled = true;
            $this->arabic        = null;
            $this->emitSelf('updated', 'arabic');
            return;
        }
    }

    public function checkIfExist(array $updatesCount, string $propertyName)
    {
        foreach ($updatesCount as $key => $item) {
            if (array_key_exists($propertyName, $item)) {
                return [
                    $key,
                    $propertyName,
                ];
            }
        }
        return false;
    }

    public function updated($propertyName)
    {
        if (!$this->checkIfExist($this->updatesCount, $propertyName)) {
            $this->updatesCount[] = [
                $propertyName => 1,
            ];
            $this->total += 1;
            return $this->progressBarWidth();
            return $this->dispatchBrowserEvent('animate', ['width' => $this->width]);
        }
        if (empty($this->$propertyName) || is_null($this->$propertyName)) {
            $data = $this->checkIfExist($this->updatesCount, $propertyName);
            unset($this->updatesCount[$data[0]][$data[1]]);
            $this->total -= 1;
            return $this->progressBarWidth();
            return $this->dispatchBrowserEvent('animate', ['width' => $this->width]);
        }
    }

    public function progressBarWidth()
    {
        $this->width = ($this->total / 7) * 100;
    }

    public function translateFrom($lang)
    {

        if ($lang === 'en' && $this->englishToggled === false) {
            if (strlen($this->english) >= 3) {
                $this->french = $this->translate($this->english, 'en', 'fr');
                $this->arabic = $this->translate($this->english, 'en', 'ar');

                $this->resetErrorBag();
                $this->resetValidation();

                return $this->reset(['frenchToggled', 'arabicToggled']);
            }
            return $this->addError('english', 'At least 3 characters to use this feature.');
        }

        if ($lang === 'fr' && $this->frenchToggled === false) {
            if (strlen($this->french) >= 3) {
                $this->english = $this->translate($this->french, 'fr', 'en');
                $this->arabic  = $this->translate($this->french, 'fr', 'ar');

                $this->resetErrorBag();
                $this->resetValidation();

                return $this->reset(['englishToggled', 'arabicToggled']);
            }

            return $this->addError('french', 'At least 3 characters to use this feature.');
        }

        if ($lang === 'ar' && $this->arabicToggled === false) {
            if (strlen($this->arabic) >= 3) {
                $this->english = $this->translate($this->arabic, 'ar', 'en');
                $this->french  = $this->translate($this->arabic, 'ar', 'fr');

                $this->resetErrorBag();
                $this->resetValidation();

                return $this->reset(['englishToggled', 'frenchToggled']);
            }
            return $this->addError('arabic', 'At least 3 characters to use this feature.');
        }
    }

    public function store()
    {
        $this->validate();

        $user = User::find(Auth::id());

        $user->words()->create([
            'word_ar'     => $this->derja,
            'word_lt'     => $this->latin,
            'ar'          => $this->arabic,
            'fr'          => $this->french,
            'en'          => $this->english,
            'description' => $this->description,
            'origin'      => $this->origin,
            'region'      => $this->region,
            'published'   => ($user->role === 1) ? 1 : 0,
        ]);

        $this->reset();

        $this->dispatchBrowserEvent('word-created', [
            'title' => 'Word created successfully.',
            'icon'  => 'success',
        ]);
    }

    public function mount()
    {
        if (auth()->user()->role === 0) {
            return redirect()->route('admin.word.create', ['lang' => app()->getLocale()]);
        }
    }

    public function render()
    {
        return view('livewire.user.suggest-word')
            ->extends('user.layout')
            ->section('content');
    }
}
