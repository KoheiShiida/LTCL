<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;
    
    protected $table = 'likes';
    
     public static function getRanking()
    {
        return static::orderBy('likes', 'desc')->get();
    }
}
