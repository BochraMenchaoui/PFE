<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Word;
use App\Models\Reset;
use App\Models\Comment;
use App\Models\Message;
use App\Models\PasswordSecurity;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'provider',
        'provider_id',
        'avatar',
        'last_login',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function resets()
    {
        return $this->hasMany(Reset::class)->latest();
    }

    // 2FA section
    public function password_security()
    {
        return $this->hasOne(PasswordSecurity::class);
    }

    public function generateTwoFactorCode()
    {
        $this->password_security->is_enabled            = 1;
        $this->password_security->two_factor_code       = rand(10000, 99999);
        $this->password_security->two_factor_expires_at = now()->addMinutes(60);
        $this->password_security->save();
    }

    public function resetTwoFactorCode()
    {
        $this->password_security->two_factor_code       = null;
        $this->password_security->two_factor_expires_at = null;
        $this->password_security->save();
    }

    // Comment section
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function owns($id)
    {
        foreach ($this->comments as $comment) {
            if ($comment->id === $id) {
                return true;
            }
        }
        return false;
    }

    public function ownsArticle($id)
    {
        foreach ($this->posts as $post) {
            if ($post->id === $id) {
                return true;
            }
        }
        return false;
    }

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    // Favourite Section
    public function favourites()
    {
        return $this->belongsToMany(Word::class, 'favourites', 'user_id', 'word_id');
    }

    public function hasFavourite($id)
    {
        foreach ($this->favourites as $fav) {
            if ($fav['pivot']->word_id == $id) {
                return true;
            }
        }
        return false;
    }

    // Likes Section
    public function likes()
    {
        return $this->belongsToMany(Word::class, 'likes', 'user_id', 'word_id')->withTimestamps();
    }

    public function hasLiked($id)
    {
        foreach ($this->likes as $like) {
            if ($like['pivot']->word_id == $id) {
                return true;
            }
        }
        return false;
    }

    // Dislikes Section
    public function dislikes()
    {
        return $this->belongsToMany(Word::class, 'dislikes', 'user_id', 'word_id')->withTimestamps();
    }

    public function hasDisliked($id)
    {
        foreach ($this->dislikes as $dilike) {
            if ($dilike['pivot']->word_id == $id) {
                return true;
            }
        }
        return false;
    }

    // Check if User online
    public function isOnline()
    {
        $users = Cache::get('online-users');
        foreach ((array)$users as $user) {
            if ($this->id === $user['id']) {
                return true;
            }
        }
        return false;
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }
}
