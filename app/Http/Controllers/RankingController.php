<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class RankingController extends Controller
{
     public function index()
    {
        $rankings = Post::withCount('likes')->orderBy('likes_count', 'desc')->get();
        return view('posts.ranking', compact('rankings'));
    }
}
