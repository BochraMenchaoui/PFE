<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasswordSecurity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $dates = [
        'two_factor_expires_at',
    ];

    protected $fillable = [
        'is_enabled',
        'two_factor_code',
        'two_factor_expires_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
