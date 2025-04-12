<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'userss'; // Nome da tabela personalizado

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }


    // public function following()
    // {
    //     return $this->belongsToMany(
    //         User::class,
    //         'follows',
    //         'follower_id',
    //         'followed_id'
    //     )->withTimestamps()->using(Follow::class);
    // }

    // public function followers()
    // {
    //     return $this->belongsToMany(
    //         User::class,
    //         'follows',
    //         'followed_id',
    //         'follower_id'
    //     )->withTimestamps()->using(Follow::class);
    // }
}