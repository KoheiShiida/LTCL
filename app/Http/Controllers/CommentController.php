<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;	
use App\Models\Comment;

class CommentController extends Controller
{
     public function store(CommentRequest $request)
    {
        $savedata = [
            'post_id' => $request->post_id,
            'name' => $request->name,
            'comment' => $request->comment,
        ];
 
        $comment = new Comment;
        $comment->fill($savedata)->save();
 
        return redirect()->route('show', [$savedata['post_id']])->with(['comment'=>$comment ->getPaginateByLimit()]);
    }
}
