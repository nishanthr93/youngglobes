<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'file_type',
        'file_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function likes()
    {
       return $this->hasMany(Like::Class);
    }

    public function likedby(User $user)
    {
        return $this->likes->contains('user_id',$user->id);
    }

    /**
     * Check user like his same post
     */
    public function whoLliked(User $user)
    {
       return $user->id == $this->user_id;
    }

    public function comments()
    {
       return $this->hasMany(Comment::Class);
    }

    public function commenter()
    {
       return $this->hasManyThrough(User::Class,Comment::Class,'user_id','id');
    }

}

