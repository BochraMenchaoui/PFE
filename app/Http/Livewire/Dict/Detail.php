<?php

namespace App\Http\Livewire\Dict;

use App\Models\User;
use App\Models\Word;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use App\Notifications\RealTimeNotification;
use App\Notifications\FavouriteNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WordLikedCommentedNotification;

class Detail extends Component
{
    public $comments;
    public $word;
    public $body;
    public $likes;
    public $dislikes;
    public $views;
    public $lang;
    public $liked;
    public $disliked;
    public $fav;
    public $user;
    public $synonyms;
    public $remainings = 1000;
    public $amount     = 5;

    protected $listeners = ['renderComponent' => 'render', 'favouriteRemoved' => 'unfav'];

    /*
    TODO: 
        1. fixi load more kil aada :(
        2. tansesh el favouri
        3. el messaget b tounsi!!!
    */
    protected $rules = [
        'body' => 'required|string|max:1000|min:10',
    ];

    public function notifyOnlineUsers()
    {
        $users = Cache::get('online-users');
        foreach ((array) $users as $user) {
            Notification::send(User::find($user['id']), new RealTimeNotification());
        }
    }

    public function comment()
    {
        $this->validate();

        $this->word->comments()->create([
            'body'    => $this->body,
            'user_id' => auth()->user()->id,
        ]);

        // Checking if the ower has not been soft deleted
        if ($this->word->user) {
            // we are notifing the owner his word got a comment
            if ($this->word->user->id !== $this->user->id) {
                $user = User::find($this->word->user->id);
                $user->notify(new WordLikedCommentedNotification($this->user->name, $this->user->avatar, 'Someone commented your word'));
            }
        }
        // we are notifing all the online users
        $this->notifyOnlineUsers();

        $this->reset(['body', 'remainings']);
    }

    public function like()
    {
        if (!$this->user->hasLiked($this->word->id)) {
            // Change the css so the user doesnt feel any delay
            $this->liked    = true;
            $this->disliked = false;

            // we are liking the word
            $this->user->likes()->attach($this->word->id);

            // Removing the dislike if exists
            if ($this->user->hasDisliked($this->word->id)) {
                $this->user->dislikes()->detach($this->word->id);
            }

            // Checking if the ower has not been soft deleted
            if ($this->word->user) {
                // we are notifing the owner his word got a like
                if ($this->word->user->id !== $this->user->id) {
                    $user = User::find($this->word->user->id);
                    $user->notify(new WordLikedCommentedNotification($this->user->name, $this->user->avatar, 'someone liked your word'));
                }
            }

            // we are notifing all the online users
            $this->notifyOnlineUsers();
        }
    }

    public function dislike()
    {
        if (!$this->user->hasDisliked($this->word->id)) {
            $this->disliked = true;
            $this->liked    = false;

            $this->user->dislikes()->attach($this->word->id); // we are disliking the word

            if ($this->user->hasliked($this->word->id)) {
                $this->user->likes()->detach($this->word->id);
            }

            // we are notifing all the online users
            $this->notifyOnlineUsers();
        }
    }

    public function destroy($id)
    {
        Comment::find($id)->delete();
        $this->notifyOnlineUsers();
        $this->emit('RenderComponent');
    }

    public function updatedBody()
    {
        $this->remainings = 1000 - strlen($this->body);
    }

    public function mount($id)
    {
        $this->word = Word::find($id);
        if (is_null($this->word)) {
            return redirect()->route('search');
        }

        if ($this->word->published === 0 && auth()->user()->role === 2) {
            return redirect()->route('search');
        }

        $this->lang = $this->word->word_lt;

        $this->user = auth()->user();

        $this->user->hasFavourite($this->word->id) ? $this->fav = true : $this->fav = false;
        $this->user->hasLiked($this->word->id) ? $this->liked = true : $this->liked = false;
        $this->user->hasDisliked($this->word->id) ? $this->disliked = true :  $this->disliked = false;
    }

    public function changeWordLanguage($lang)
    {
        if ($lang == 'fr') {
            $this->lang = $this->word->fr;
            return;
        }
        if ($lang == 'en') {
            $this->lang = $this->word->en;
            return;
        }
        if ($lang == 'ar') {
            $this->lang = $this->word->ar;
            return;
        }
        $this->lang = $this->word->word_lt;
    }

    public function load()
    {
        $this->amount += 10;
    }

    public function fav()
    {
        if (!$this->user->hasFavourite($this->word->id)) {
            $this->user->favourites()->attach($this->word->id);
            $this->dispatchBrowserEvent('added');
            $this->fav = true;
            $this->user->notify(new FavouriteNotification('FavouriteAdded'));
            return;
        }
        $this->user->favourites()->detach($this->word->id);
        $this->dispatchBrowserEvent('removed');
        $this->fav = false;
        $this->user->notify(new FavouriteNotification('FavouriteAdded'));
    }

    public function unfav()
    {
        $this->fav = false;
    }

    public function render()
    {
        $this->likes    = $this->word->likedBy->count();
        $this->dislikes = $this->word->dislikedBy->count();
        $this->views    = $this->word->views_count;
        $this->synonyms = $this->word->synonyms;
        $this->comments = $this->word->comments->take($this->amount);
        return view('livewire.dict.detail')->extends('user.layout')->section('content');
    }
}
































// namespace App\Http\Livewire\Dict;

// use App\Models\User;
// use App\Models\Word;
// use App\Models\Comment;
// use Livewire\Component;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Cache;
// use App\Notifications\RealTimeNotification;
// use App\Notifications\FavouriteNotification;
// use Illuminate\Support\Facades\Notification;
// use App\Notifications\WordLikedCommentedNotification;

// class Detail extends Component
// {
//     public $word;
//     public $comments;
//     public $commentBody = '';
//     public $liked;
//     public $disliked;
//     public $fav;
//     public $amount = 3;
//     public $user;
//     public $likes;
//     public $dislikes;

//     protected $listeners = ['renderComponent' => 'render', 'favouriteRemoved' => 'unfav'];

//     protected $rules = [
//         'commentBody' => 'string|max:2048',
//     ];

//     public function notifyOnlineUsers()
//     {
//         $users = Cache::get('online-users');
//         foreach ($users as $user) {
//             Notification::send(User::find($user['id']), new RealTimeNotification());
//         }
//     }

//     public function comment()
//     {
//         $this->validate();

//         $this->word->comments()->create([
//             'body'    => $this->commentBody,
//             'user_id' => Auth::id(),
//         ]);

//         // Checking if the ower has not been soft deleted
//         if ($this->word->user) {
//             // we are notifing the owner his word got a comment
//             if ($this->word->user->id !== $this->user->id) {
//                 $user = User::find($this->word->user->id);
//                 $user->notify(new WordLikedCommentedNotification($this->user->name, $this->user->avatar, 'Someone commented your word'));
//             }
//         }
//         // we are notifing all the online users
//         $this->notifyOnlineUsers();

//         $this->commentBody = '';
//     }


//     public function like()
//     {
//         if (!$this->user->hasLiked($this->word->id)) {
//             // Change the css so the user doesnt feel any delay
//             $this->liked    = true;
//             $this->disliked = false;

//             // we are liking the word
//             $this->user->likes()->attach($this->word->id);

//             // Removing the dislike if exists
//             if ($this->user->hasDisliked($this->word->id)) {
//                 $this->user->dislikes()->detach($this->word->id);
//             }

//             // Checking if the ower has not been soft deleted
//             if ($this->word->user) {
//                 // we are notifing the owner his word got a like
//                 if ($this->word->user->id !== $this->user->id) {
//                     $user = User::find($this->word->user->id);
//                     $user->notify(new WordLikedCommentedNotification($this->user->name, $this->user->avatar, 'someone liked your word'));
//                 }
//             }

//             // we are notifing all the online users
//             $this->notifyOnlineUsers();
//         }
//     }

//     public function dislike()
//     {
//         if (!$this->user->hasDisliked($this->word->id)) {
//             $this->disliked = true;
//             $this->liked    = false;

//             $this->user->dislikes()->attach($this->word->id); // we are disliking the word

//             if ($this->user->hasliked($this->word->id)) {
//                 $this->user->likes()->detach($this->word->id);
//             }

//             // we are notifing all the online users
//             $this->notifyOnlineUsers();
//         }
//     }

//     public function unfav()
//     {
//         $this->fav = false;
//     }

//     public function fav()
//     {
//         if (!$this->user->hasFavourite($this->word->id)) {
//             $this->user->favourites()->attach($this->word->id);
//             $this->dispatchBrowserEvent('added');
//             $this->fav = true;
//             $this->user->notify(new FavouriteNotification('FavouriteAdded'));
//             return;
//         }
//         $this->user->favourites()->detach($this->word->id);
//         $this->dispatchBrowserEvent('removed');
//         $this->fav = false;
//         $this->user->notify(new FavouriteNotification('FavouriteAdded'));
//     }

//     public function mount($id)
//     {
//         $this->word = Word::find($id);
//         if (is_null($this->word) || $this->word->published === 0) {
//             if (auth()->user()->role !== 0) {
//                 return redirect()->route('search');
//             }
//         }

//         $this->user = User::find(Auth::id());

//         $this->user->hasFavourite($this->word->id) ? $this->fav = true : $this->fav = false;
//         $this->user->hasLiked($this->word->id) ? $this->liked = true : $this->liked = false;
//         $this->user->hasDisliked($this->word->id) ? $this->disliked = true :  $this->disliked = false;
//     }

//     public function loadMore()
//     {
//         $this->amount += 3;
//     }

//     public function loadLess()
//     {
//         $this->amount = 3;
//     }

//     public function destroy($id)
//     {
//         Comment::find($id)->delete();
//         $this->notifyOnlineUsers();
//         $this->emit('RenderComponent');
//     }

//     public function render()
//     {
//         $this->likes    = $this->word->likedBy->count();
//         $this->dislikes = $this->word->dislikedBy->count();
//         $this->comments = $this->word->comments->take($this->amount);
//         return view('livewire.dict.detail')->extends('layout.nav')->section('content');
//     }
// }
