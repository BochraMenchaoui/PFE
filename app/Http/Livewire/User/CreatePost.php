<?php

namespace App\Http\Livewire\User;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $tags = [];
    public $userTag;
    public $title;
    public $body;
    public $thumbnail;

    public function tags()
    {
        if (strlen($this->userTag) >= 3 && sizeof($this->tags) < 5) {
            $this->tags[] = $this->userTag;
            return $this->reset('userTag');
        }
    }

    public function savePost()
    {
        $this->validate([
            'title'     => 'required|min:5',
            'body'      => 'required',
            'thumbnail' => 'required|image',
        ]);

        $filname = Str::random(30) . '.' . $this->thumbnail->extension();

        $this->thumbnail->storeAs('thumbnails', $filname);

        auth()->user()->posts()->create([
            'title'     => $this->title,
            'body'      => $this->body,
            'tags'      => $this->tags ? implode(',',  $this->tags) : 'générale',
            'thumbnail' => $filname,
        ]);

        $this->reset('title', 'body', 'tags', 'thumbnail');

        return $this->dispatchBrowserEvent('success', [
            'title' => 'Cbn habetna l article',
            'icon'  => 'success',
        ]);
    }

    public function removeTag($id)
    {
        unset($this->tags[$id]);
        $temp = $this->tags;
        $this->reset('tags');
        foreach ($temp as $tag) {
            $this->tags[] = $tag;
        }
    }

    public function render()
    {
        return view('livewire.user.create-post')
            ->extends('user.layout')
            ->section('content');
    }
}
