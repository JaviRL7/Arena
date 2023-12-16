<div class="comment">
    <div class="comment-header">
        <img src="{{ $comment->user->user_photo }}" class="user-photo" />
        <div class="user-info">
            <p class="user-name"><strong>{{ $comment->user->name }}</strong></p>
            <p class="user-nick">@{{ $comment->user->nick }}</p>
        </div>
        <span class="comment-date">{{ $comment->date }}</span>
    </div>
    <p class="comment-body">{{ $comment->body }}</p>
</div>
