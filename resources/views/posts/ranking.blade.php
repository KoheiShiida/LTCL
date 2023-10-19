<x-app-layout>
    <h1>いいね数ランキング</h1>
    <ul>
        @foreach($rankings as $post)
            <li>
                <strong>{{ $post->title }}</strong>
                <span>{{ $post->likes_count}} いいね</span>
            </li>
        @endforeach
    </ul>
</x-app-layout>