<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>アレンジレシピ掲示板</title>
    </head>
    <body>
        <h1>アレンジレシピ掲示板</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="title">
                <h2>投稿画面</h2>
                <input type="text" name="post[title]" placeholder="タイトルを入力してください。" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>本文</h2>
                <textarea name="post[body]" placeholder="おすすめポイントを書いてください。">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <input type="submit" value="投稿する"/>
        <div class="category">
            <h2>料理カテゴリー一覧</h2>
            <select name="post[category_id]">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input id="image" type="file" name="image">
        </div>
        </form>
        <div class="back">[<a href="/">戻る</a>]</div>
</html>