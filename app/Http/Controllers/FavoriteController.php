<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store($postId) {
        $user = \Auth::user();
        if (!$user->is_favorite($articleId)) {
            $user->favorite_posts()->attach($postId);
        }
        return back();
    }
    public function destroy($postId) {
        $user = \Auth::user();
        if ($user->is_favorite($postId)) {
            $user->favorite_posts()->detach($postId);
        }
        return back();
    }
}
