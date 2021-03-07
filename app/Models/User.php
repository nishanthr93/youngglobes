<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Post;
use App\Models\Friend;
use App\Models\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'dob',
        'designation',
        'country',
        'fav_color',
        'fav_actor',
        'gender',
        'avatar',
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

    public function posts()
    {
        return $this->hasMany(Post::Class);
    }

    public function likes()
    {
        return $this->hasMany(Like::Class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::Class);
    }

    public function recevied()
    {
        return $this->hasManyThrough(Like::Class, Post::Class);
    }

    public function friends()
    {
    //    return $this->hasMany(Friend::Class);
        return $this->hasMany(Friend::Class, 'userid_1', 'user_id');
    }

    public function friendAdded(User $user)
    {
        return Friend::where('userid_2', '=', $user->id)->first();

    }
}
