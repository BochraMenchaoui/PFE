<?php

namespace App\Http\Livewire\Dict;

use App\Models\Post;
use App\Models\Word;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use LanguageDetection\Language;

class TranslateWord extends Component
{
    /*
        TODO: 1. nadhef code + kharj les commun fil 2 pathes ala rwehom + asemi les variables
                2. hadher des example
                3. published
                4. Review witAPI behaviour + re-test regex
    */
    const  FRENCH_REGEX  = '/^f(r|ir)(a?|e?).*/';
    const  ENGLISH_REGEX = '/^[a|e]n?g?.*/';
    const  ARABIC_REGEX  = '/(d[a|e]r[g|j]a)|(b?e?[t]{0,2}ounsi)/';
    public $searchTerm;
    public $flag;
    public $lang;
    public $title;
    public $data;
    public $rslt;
    public $pic;
    public $link;
    public $meaning;

    public function setDetectedLanguage()
    {
        $dl = new Language(['en', 'fr']);
        return array_key_first($dl->detect($this->data['word'])->close());
    }

    public function foreignToTunisian()
    {
        $word = Word::where('fr', 'like', $this->data['word'])
            ->orWhere('en', 'like', $this->data['word'])
            ->first();

        if (is_null($word)) {
            return false;
        }

        return $word;
    }

    public function generateThumbNail($word)
    {
        $this->pic = (Http::withHeaders([
            "x-rapidapi-key"  => env('BING_IMG_KEY'),
            "x-rapidapi-host" => Config::get('links.bing'),
            "useQueryString"  => true,
        ])->get(Config::get('links.bingImg'), [
            'q' => $word,
        ])->json())['value'][0]['thumbnailUrl'];
    }

    public function determineTargetLanguage($word)
    {
        if (preg_match(self::ENGLISH_REGEX, $word)) {
            return 'en';
        }

        if (preg_match(self::FRENCH_REGEX, $word)) {
            return 'fr';
        }

        if (preg_match(self::ARABIC_REGEX, $word)) {
            return 'tn';
        }

        return false;
    }

    public function tunisianToForeign($lang)
    {
        $searchquery = '%' . $this->data['word'] . '%';

        $this->rslt = Word::where('word_lt', 'like', $searchquery)->first();

        if (is_null($this->rslt)) {
            return false;
        }

        if ($lang === 'en')
            return $this->rslt->en;

        return $this->rslt->fr;
    }

    public function neuralProcessing()
    {
        $data = Http::withHeaders([
            "Authorization" => env('WIT_API_KEY'),
        ])->get(Config::get('links.wit') . $this->searchTerm)->json();

        if (
            array_key_exists('error', $data)
            || is_null($data)
            || !array_key_exists('target:target', $data['entities'])
            || !array_key_exists('source:source', $data['entities'])
        ) {
            return false;
        }

        return [
            'target' => $data['entities']['target:target'][0]['value'],
            'word'   => $data['entities']['source:source'][0]['value'],
        ];
    }

    public function search()
    {
        if (strlen($this->searchTerm) < 5) {
            $this->reset('searchTerm');
            return $this->addError('translate', 'ikteb, ken t7eb tawed 🥺🥺🥺');
        }

        if (!$this->data = $this->neuralProcessing()) {
            $this->reset('searchTerm');
            return $this->addError('translate', 'mafhmtekesh, ken t7eb tawed 🥺🥺🥺');
        }

        if (!($this->lang = $this->determineTargetLanguage($this->data['target']))) {
            $this->reset('searchTerm');
            return $this->addError('translate', 'mahish supporté language hedhi raw 🙄🙄🙄');
        };

        // PART 1
        if ($this->lang === 'tn') {

            if (!$word = $this->foreignToTunisian()) {
                $this->reset('searchTerm');
                return $this->addError('translate', 'Mazelt manrfhesh, Hata yekber e dict chwya 🥺🥺🥺');
            }

            $this->flag = $this->setDetectedLanguage();
            $this->meaning = $word->description;
            $this->title   = $word->word_lt;
            if ($article = Post::where('title', 'like', '%' . $word->lt . '%')->first()) {
                $this->link = route('article.details', ['id' => $article->id]);
            }

            $this->generateThumbNail($this->data['word']);
            // return session()->flash('success', 'Fhmnek tahki bil ' . ($language == 'en' ? 'Anglais' : 'Francais') . ' 🤓🤓🤓');
            return $this->reset('searchTerm');
        }


        // PART 2
        if (!$word = $this->tunisianToForeign($this->lang)) {
            return $this->addError('translate', 'Mazelt manrfhesh, Hata yekber e dict chwya 🥺🥺🥺');
        }

        $this->generateThumbNail($word);

        $this->title = $word;

        $this->link = 'https://en.wikipedia.org/?curid=' . key((Http::get(Config::get('links.wikipedia') . $word)->json())['query']['pages']);

        $this->meaning = (Http::get(Config::get('links.dict') . $this->lang . '/' . $word)->json()[0]['meanings'][0]['definitions'][0]['definition']);

        $this->flag = $this->lang;

        $this->reset('searchTerm');
    }

    public function toggle()
    {
        $this->toggle ? $this->toggle = false : $this->toggle = true;
    }

    public function render()
    {
        return view('livewire.dict.translate-word')
            ->extends('user.layout')
            ->section('content');
    }
}
