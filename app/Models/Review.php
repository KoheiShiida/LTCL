<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    public function posts()   
    {
        return $this->hasMany(Post::class);  
    }
    
    public function review()
    {
        return $this->belongsTo(Review::class);
    }
    
    public function getByReview(int $limit_count = 5)
    {
        return $this->posts()->with('review')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
