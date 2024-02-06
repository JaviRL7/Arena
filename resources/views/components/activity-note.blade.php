@if (isset($note))
    <div class="d-flex align-items-center">
        <div class="rounded p-2 bg-primary">
            <h5 class="text-white mb-0"><strong>{{ $note }}</strong></h5>
        </div>
        <h5 class="mb-0 ms-3 titular"><strong>{{ $playerNick }}</strong></h5>

    </div>
@endif
