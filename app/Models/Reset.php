<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reset extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $dates = [
        'created_at',
    ];

    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
