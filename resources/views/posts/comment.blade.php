<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>アレンジレシピ掲示板</title>
    </head>
    <body>
        <h1>アレンジレシピ掲示板</h1>
        <form action="/posts" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>ニックネーム</h2>
                <input type="text" name="post[title]" placeholder="ニックネームを入力してください。" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>コメント</h2>
                <textarea name="post[body]" placeholder="コメントを書いてください。">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
        </form>
        <div class="back">[<a href="/">戻る</a>]</div>
</html>