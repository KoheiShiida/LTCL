<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    public function getLists()
    {
        $reviiews = Review::orderBy('id','asc')->pluck('name', 'id');
     
        return $reviews;
    }
}
