<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;

class Reaction extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'type',
    ];
    
    public function post() {
        return $this->belongsTo(Post::class);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }

}
