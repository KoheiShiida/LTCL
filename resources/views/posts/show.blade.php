<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>投稿</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 class="title">
            {{ $post->title }}
        </h1>
        <div class="content">
            <div class="content_post">
                <h3>本文</h3>
                <p>{{ $post->body }}</p>
                <h3>評価点（１００点満点）</h3>
                <p class='review'>{{$post->review}}点/100点</p>
                <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
            </div>
             <div>
                <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
            </div>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <div class="edit"><a href="/posts/{{ $post->id }}/edit">編集する</a></div>
        
        
        
        <form class="mb-4" method="POST" action="{{ route('comment.store') }}">
    @csrf
 
    <input
        name="post_id"
        type="hidden"
        value="{{ $post->id }}"
    >
 
    <div class="form-group">
        <label for="subject">
        名前
        </label>
 
		<input
            id="name"
            name="name"
            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
            value="{{ old('name') }}"
            type="text"
        >
        @if ($errors->has('name'))
        	<div class="invalid-feedback">
        		{{ $errors->first('name') }}
        	</div>
        @endif
    </div>
 
    <div class="form-group">
	    <label for="body">
		    本文
	    </label>
 
        <textarea
            id="comment"
            name="comment"
            class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}"
            rows="4"
        >{{ old('comment') }}</textarea>
        @if ($errors->has('comment'))
        	<div class="invalid-feedback">
        		{{ $errors->first('comment') }}
        	</div>
        @endif
    </div>
 
    <div class="mt-4">
	    <button type="submit" class="btn btn-primary">
		    コメントする
	    </button>
    </div>
</form>
 
@if (session('commenttatus'))
    <div class="alert alert-success mt-4 mb-4">
    	{{ session('commenttatus') }}
    </div>
@endif

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <body>
        <h1>Blog Name</h1>
        <div class='comments'>
            @foreach ($comments as $comment)
                <div class='comment'>
                    <h2 class='name'>{{ $comment->name }}</h2>
                    <p class='body'>{{ $comment->comment }}</p>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $comments->links() }}
        </div>
    </body>
</html>

    </body>
</html>