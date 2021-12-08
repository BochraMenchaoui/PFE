<?php

namespace App\Http\Livewire\Dict;

use App\Models\Word;
use Livewire\Component;

class Search extends Component
{
    public $searchTerm;
    public $words;
    public $amount = 3;

    /*
        TODO: 
            1. Fixi amount bellehy 9adeh twater, shouf condition l etat intial w search
            2. momken 7toha pagination wakhw
    */
    public function loadMore()
    {
        $this->amount += 5;
    }

    public function render()
    {
        $this->words = Word::where('published', 1)
            ->where(function ($query) {
                $query->where('word_ar', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('word_lt', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
            })
            ->take($this->amount)
            ->get();

        return view('livewire.dict.search')
            ->extends('user.layout')
            ->section('content');
    }
}
