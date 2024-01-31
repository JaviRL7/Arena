<div>

    <ul>
        @foreach ($following as $followedUser)
            <li class="following-item">
                <img src="{{ asset($followedUser->user_photo) }}" alt="{{ $followedUser->name }}" class="rounded-circle shadow-1-strong user-photo">
                <div class="following-info">
                    <h5 class="titular">{{ $followedUser->name }}</h5>
                    <p class="subtitular">{{ '@' . $followedUser->nick }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</div>
