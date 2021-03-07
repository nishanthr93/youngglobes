<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid_1',
        'userid_2'
    ];

    public function user1()
    {
        return $this->belongsTo(User::class, 'userid_1');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'userid_2');
    }
}
