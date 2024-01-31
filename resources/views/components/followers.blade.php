<div>

    <ul>
        @foreach ($followers as $follower)
            <li class="follower-item">
                <img src="{{ asset($follower->user_photo) }}" alt="{{ $follower->name }}" class="rounded-circle shadow-1-strong user-photo">
                <div class="follower-info">
                    <h5 class="titular">{{ $follower->name }}</h5>
                    <p class="subtitular">{{ '@' . $follower->nick }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</div>
