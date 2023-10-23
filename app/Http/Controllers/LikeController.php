<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Like;
use Auth;

class LikeController extends Controller
{
    public function index(Like $like)
    {
        //ユーザーに紐づくいいねを取得。
        $likes=Auth::user()->likes;
        //データを保管する用の空の配列（コレクション）を用意。
        $posts=collect();
        //いいね一つ一つからいいねに紐づく投稿を取り出して、空の配列に入れる。
        foreach($likes as $like) {
            $posts->push($like->post); 
        }
        return view('likes.index')->with(['posts' => $posts]);
        
    }
}
