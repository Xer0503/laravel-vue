<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory, Notifiable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reactions(){
        return $this->hasMany(Reaction::class);
    }

    protected $fillable = [
        'title',
        'user_id',
        'body',
        'image',
        'visibility',
    ];
}
