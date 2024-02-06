<p class="subtitular">"Comments by this users".</p>


@if ($user->comments->count() > 0)
    @foreach ($user->comments as $comment)
        @include('comments', ['comment' => $comment])
    @endforeach
    @include('modals.delete_comment')
    @include('modals.edit_comment')
@else
    <p>No comments available.</p>
@endif
