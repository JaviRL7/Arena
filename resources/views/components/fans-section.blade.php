<div class="fans-container">
    @if ($fans->isEmpty())
        <p class="comentarios">This player doesn't have any fans yet.</p>
    @else
        @foreach ($fans as $fan)
            <a href="{{ route('profile.index', $fan) }}" class="fan-link" style="text-decoration: none; color: inherit;">
                <div class="fan-item">
                    <img src="{{ asset($fan->user_photo) }}" alt="{{ $fan->nick }}" class="user-photo">
                    <div class="fan-info">
                        <h5 class="titular">{{ $fan->name }}</h5>
                        <div class="fan-name-bio">
                            <h6 class="subtitular">{{ $fan->nick }}</h6>
                            <p class="comentarios">{{ Str::limit($fan->bio, 100) }}</p>
                        </div>
                    </div>
                </div>
            </a>
            <hr class="custom-hr2">
        @endforeach
    @endif
</div>
