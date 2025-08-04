<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'post';

    protected $fillable = [
        'title',
        'user_id',
        'body',
        'image',
        'visibility',
    ];
}
