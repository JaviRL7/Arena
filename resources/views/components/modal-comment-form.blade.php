<div class="form-group" style="margin: 10px;">
    <div class="d-flex flex-start w-100">
        <img class="user-photo" src="{{ asset(Auth::user()->user_photo) }}" alt="avatar" />
        <textarea class="form-control" name="review" id="review" rows="4" style="background: #fffbfb; width: 100%;" placeholder="Write a review...">
            {{ $reviews[$game->id][$player->id][Auth::user()->id] ?? '' }}
        </textarea>

    </div>
    <label class="form-label" for="review"></label>
</div>

