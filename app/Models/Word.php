<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Synonyms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Word extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'word_ar',
        'word_lt',
        'ar',
        'fr',
        'en',
        'description',
        'origin',
        'region',
        'vocal',
        'published',
        'user_id',
        'views_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'likes', 'word_id', 'user_id');
    }

    public function dislikedBy()
    {
        return $this->belongsToMany(User::class, 'dislikes', 'word_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function synonyms()
    {
        return $this->hasMany(Synonyms::class);
    }
}
