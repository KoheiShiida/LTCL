<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Cloudinary;
use DB;


class PostController extends Controller
{
    public function index(Post $post)
    {
        
        $user = auth()->user();
        $posts = Post::withCount('likes')->orderByDesc('updated_at')->get();
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
        return view('posts.index', [
            'posts' => $posts,
            'like' => $like,
        ]);
        
        
        $likes = Like::withCount('posts')->take(5)->get();
        
        
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->paginate(10);
        return view('posts.show')->with(['post' => $post, 'comments'=>$comments]);
        
    }

    public function store(Post $post, PostRequest $request)
    {
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        //dd($image_url);
        {
            $input = $request['post'];
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input += ['image_url' => $image_url];
            $post->fill($input)->save();
            return redirect('/posts/' . $post->id);
        }
        $input = $request['post'];
        $post=new Post();
        
        $inputs=request()->validate([
            'title'=>'required|max:255',
            'body'=>'required|max:255',
            'image'=>'image'
        ]);
        
        // 画像ファイルの保存場所指定
        if(request('image')){
            $filename=request()->file('image')->getClientOriginalName();
            $inputs['image']=request('image')->storeAs('public/images', $filename);
        }
 
        // postを保存
        $post->create($inputs);
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
    
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function create(Category $category,Request $request )
    {
        return view('posts.create')->with(['categories' => $category->get()]);
    }
    
    public function like(Request $request)
    {
        $user_id = Auth::user()->id; // ログインしているユーザーのidを取得
        $post_id = $request->post_id; // 投稿のidを取得
    
        // すでにいいねがされているか判定するためにlikesテーブルから1件取得
        $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); 
    
        if (!$already_liked) { 
            $like = new Like; // Likeクラスのインスタンスを作成
            $like->post_id = $post_id;
            $like->user_id = $user_id;
            $like->save();
        } else {
            // 既にいいねしてたらdelete 
            Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
        // 投稿のいいね数を取得
        $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
        $param = [
            'post_likes_count' => $post_likes_count,
        ];
        return response()->json($param); // JSONデータをjQueryに返す
    }
    
    public function comment()
    {
        return view('posts.comment');
    }
    
    
    public function post()
    {
        $products = Product::withCount('likes')->orderBy('likes_count', 'desc')->paginate();
        return $products;
    }
}