<x-app-layout>
    <p class="text-2xl ...">いいね数ランキング</p>
    <p class="text-2xl ...">
        <ul>
            @foreach($rankings as $post)
                <li>
                    <strong>{{ $post->title }}</strong>
                    <span>{{ $post->likes_count}} いいね</span>
                </li>
            @endforeach
        </ul>
    </p>
     <img src=https://res.cloudinary.com/ds8a8x3ed/image/upload/v1698741840/ranking_wrpprl.jpg />
</x-app-layout>