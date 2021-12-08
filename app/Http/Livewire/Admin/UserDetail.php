<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Http\Traits\Stats;
use App\Http\Traits\Alerts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NameChangedNotification;
use App\Notifications\PasswordResetNotification;
use App\Notifications\InactiveReminderNotification;

class UserDetail extends Component
{
    use Stats, Alerts;

    protected $listeners = ['delete'];

    public $user;
    public $data = [];
    public $role = 2;
    public $name;
    public $email;

    public function resetPassword()
    {
        $this->user->password = Hash::make('password');
        $this->user->save();

        $this->user->resets()->create([
            'email'      => $this->user->email,
            'created_at' => now(),
        ]);

        $this->user->notify(new PasswordResetNotification());
        $this->dispatchBrowserEvent('user-updated', [
            'title' => 'User updated successfully!',
            'icon'  => 'success',
        ]);
    }


    public function updateUserInfo()
    {
        $this->validate([
            'name'  => 'required|max:255',
        ]);

        if ($this->name !== $this->user->name) {
            $this->user->notify(new NameChangedNotification($this->name));
            $this->user->name = $this->name;
        }

        if (in_array($this->role, [0, 1, 2])) {
            $this->user->role = $this->role;
        }

        $this->user->save();

        $this->user->refresh();

        return $this->dispatchBrowserEvent('user-updated', [
            'title' => 'User updated successfully!',
            'icon'  => 'success',
        ]);
    }

    public function remind()
    {
        $this->user->notify(new InactiveReminderNotification());
        $this->dispatchBrowserEvent('user-notified', [
            'title' => 'Email sent successfully',
            'icon'  => 'success',
        ]);
    }

    public function deleteConfirmation()
    {
        $this->alert('delete', 'user');
    }

    public function delete()
    {
        $this->user->delete();
        return redirect()->route('admin.users', ['lang' => app()->getLocale()]);
    }

    public function mount($id)
    {
        $this->user = User::find($id);
        if (!$this->user) {
            return redirect()->route('admin.users', ['lang' => app()->getLocale()]);
        }

        $this->name  = $this->user->name;

        // Load stats data of requested user
        $this->data = [
            'wordsPerYear' => DB::table('words')
                ->select(DB::raw('month(created_at) as month_name, count(*) as words_count'))
                ->where('user_id', '=', $this->user->id)
                ->groupBy(DB::raw('month_name'))
                ->orderBy('month_name')
                ->pluck('words_count', 'month_name')->all(),
            'commentsPerYear' => DB::table('comments')
                ->select(DB::raw('month(created_at) as month_name, count(*) as comments_count'))
                ->where('user_id', '=', $this->user->id)
                ->groupBy(DB::raw('month_name'))
                ->orderBy('month_name')
                ->pluck('comments_count', 'month_name')->all(),
            'likesPerYear' => DB::table('likes')
                ->select(DB::raw('month(created_at) as month_name, count(*) as likes_count'))
                ->where('user_id', '=', $this->user->id)
                ->groupBy(DB::raw('month_name'))
                ->orderBy('month_name')
                ->pluck('likes_count', 'month_name')->all(),
            'dislikesPerYear' => DB::table('dislikes')
                ->select(DB::raw('month(created_at) as month_name, count(*) as dislikes_count'))
                ->where('user_id', '=', $this->user->id)
                ->groupBy(DB::raw('month_name'))
                ->orderBy('month_name')
                ->pluck('dislikes_count', 'month_name')->all(),
            'postsPerYear' => DB::table('posts')
                ->select(DB::raw('month(created_at) as month_name, count(*) as posts_count'))
                ->where('user_id', '=', $this->user->id)
                ->groupBy(DB::raw('month_name'))
                ->orderBy('month_name')
                ->pluck('posts_count', 'month_name')->all(),

        ];
    }

    public function render()
    {
        return view('livewire.admin.user-detail', [
            'wordsPerYear'    => array_values($this->makeStats($this->data['wordsPerYear'])),
            'commentsPerYear' => array_values($this->makeStats($this->data['commentsPerYear'])),
            'likesPerYear'    => array_values($this->makeStats($this->data['likesPerYear'])),
            'dislikesPerYear' => array_values($this->makeStats($this->data['dislikesPerYear'])),
            'postsPerYear'    => array_values($this->makeStats($this->data['postsPerYear'])),
            'wordsCount'      => $this->user->words->count(),
            'commentsCount'   => $this->user->comments->count(),
            'likesCount'      => $this->user->likes->count(),
            'dislikesCount'   => $this->user->dislikes->count(),
            'postsCount'      => $this->user->posts->count()
        ])
            ->extends('admin.layout')
            ->section('content');
    }
}
