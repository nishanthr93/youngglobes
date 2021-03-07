<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'post_id',
        'comments'
    ];

    public function post()
    {
        return $this->belongsTo(Post::Class);
    }

    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function commentss()
    {
       return $this->belongsTo(User::Class,'user_id');
    }

}
