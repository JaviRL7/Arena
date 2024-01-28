<div class="comments-container">
    <h4 class="mb-0 titular">Comments</h4>
    <p class="subtitular">"Latest Comments section by users".</p>

    @if ($comments->count() > 0)
        @foreach ($comments as $comment)
            @include('comments', ['comment' => $comment])
        @endforeach
        @include('modals.delete_comment')
        @include('modals.edit_comment')
    @else
        <p>No comments available.</p>
    @endif
</div>
