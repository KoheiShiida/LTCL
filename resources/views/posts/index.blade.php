<x-app-layout>
    <head>
        <x-slot name="header">
            【投稿一覧】
         </x-slot>
    </head>
    <body>
       <p class="text-2xl ...">アレンジレシピ掲示板</p>
        <button class="bg-sky-500/50 ..."><a href='/posts/create'>[投稿する]</a></button>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6 xl:gap-8">
            @foreach ($posts as $post)
                <div class=>
                    <h2 class='title'>
                        <p class="text-2xl ..."><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></p>
                        
                    </h2>
                    <p class="text-xl ...">{{ $post->body }}</p>
                    <h3>評価点（１００点満点中）</h3>
                    <p class="text-sky-400">{{$post->review}}点/100点</p>
                    <p class="underline decoration-4 ..."><a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a></p>
                    
                    <div>
                        <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
                    </div>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">削除する</button> 
                    </form>
                
                @auth
                <!-- Post.phpに作ったisLikedByメソッドをここで使用 -->
                @if (!$post->isLikedBy(Auth::user()))
                    <span class="likes">
                        <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                    <span class="like-counter">{{$post->likes_count}}</span>
                    </span><!-- /.likes -->
                @else
                    <span class="likes">
                        <i class="fas fa-heart heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
                    <span class="like-counter">{{$post->likes_count}}</span>
                    </span><!-- /.likes -->
                @endif
                @endauth
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
        
        <script>
            function deletePost(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
   ログインユーザー： {{ Auth::user()->name }}
    </x-app-layout>