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
    'category_id'
];
    public function getByLimit(int $limit_count = 10)
    {
       return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}