<?php

namespace App\Http\Livewire\User;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EditPost extends Component
{
    use WithFileUploads;
    public $title;
    public $body;
    public $thumbnail;
    public $post;
    public $userTag;
    public $tags = [];

    public function tags()
    {
        if (strlen($this->userTag) >= 3 && sizeof($this->tags) < 5) {
            $this->tags[] = $this->userTag;
            return $this->reset('userTag');
        }
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

    public function updateCover()
    {
        $this->validate([
            'thumbnail' => 'required|image',
        ]);

        if ($this->post->thumbnail !== 'default.png') {
            File::delete(public_path('thumbnails/' . $this->post->thumbnail));
        }

        $filename = Str::random(30) . '.' . $this->thumbnail->extension();

        $this->post->thumbnail = $filename;
        $this->thumbnail->storeAs('thumbnails', $filename);
        $this->post->save();

        return $this->dispatchBrowserEvent('success', [
            'title' => 'Cbn l coverture tbadelet',
            'icon'  => 'success',
        ]);
    }

    public function updatePost()
    {
        $this->validate([
            'title'     => 'required|min:5',
            'body'      => 'required',
        ]);

        $this->post->title = $this->title;
        $this->post->body  = $this->body;
        $this->post->tags  = $this->tags ? implode(',', $this->tags) : 'générale';
        $this->post->save();

        return $this->dispatchBrowserEvent('success', [
            'title' => 'Cbn l\'article tbadel',
            'icon'  => 'success',
        ]);
    }

    public function mount($id)
    {
        $this->post  = Post::find($id);
        if (is_null($this->post) || !auth()->user()->ownsArticle($this->post->id)) {
            return redirect()->route('user.posts');
        }

        $this->fill([
            'title' => $this->post->title,
            'body'  => $this->post->body,
            'tags'  => explode(',', $this->post->tags),
        ]);
    }

    public function render()
    {
        return view('livewire.user.edit-post')
            ->extends('user.layout')
            ->section('content');
    }
}
