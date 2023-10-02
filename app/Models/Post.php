<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'title',
    'body',
    'category_id',
    'review_id',
    'user_id',
    'image_url',
];
    public function getByLimit(int $limit_count = 10)
    {
       return $this::with('category')->withCount('likes')->orderBy('updated_at', 'DESC')->paginate($limit_count);
       
    }

    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this::with('category')->withCount('likes')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
    
    public function isLikedBy($user): bool {
    return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
}