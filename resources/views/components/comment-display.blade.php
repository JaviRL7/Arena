<div class="comments-container">
    <h4 class="mb-0 titular">Comments</h4>
    <p class="subtitular">"The latest comments from the users".</p>

    @if ($comments->count() > 0)
        @foreach ($comments as $comment)
        <div class="comment-container"> <!-- Añade esta clase -->

            @include('comments', ['comment' => $comment])
        </div>
        @endforeach
        @include('modals.delete_comment')
        @include('modals.edit_comment')
        @include('modals.admin-comments')

    @else
        <p>No comments available.</p>
    @endif
</div>
