<?php

namespace App\Http\Livewire\Lang;

use Livewire\Component;

class LanguageSwitcher extends Component
{
    public $currentRouteName;
    public $currentParams;

    public function changeLang($lang)
    {
        return redirect()->route($this->currentRouteName, [
            'id'   => array_key_exists('id', $this->currentParams) ? $this->currentParams['id'] : null,
            'lang' => $lang
        ]);
    }

    public function mount()
    {
        $this->currentRouteName = \Route::currentRouteName();
        $this->currentParams    = \Route::current()->parameters();
    }

    public function render()
    {
        return view('livewire.lang.language-switcher');
    }
}
