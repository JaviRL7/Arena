<div class="col-md-12">
    <!-- Separador Gris -->
    <div style="height: 2px; background-color: lightgrey; width: 60%; margin: 200px auto 0 auto;"></div>

    <div class="card-footer py-3 border-0"
        style="margin: 0 auto; width: 50%; border: 2px solid #000;">
        <div class="d-flex flex-start w-100">
            <img class="user-photo" src="{{ asset(Auth::user()->user_photo) }}" alt="avatar" />
            <div class="form-outline w-100">
                <form action="{{ route('comments.store', $serie) }}" method="POST" class="space-y-4">
                    @csrf
                    <a href="#" data-bs-toggle="modal" data-bs-target="#informationComments">
                        <i class="fas fa-info-circle"></i>
                    </a>
                    <div class="form-group">
                        <textarea class="form-control" name="body" id="body" rows="4" style="background: #fffbfb; width: 100%;"
                            placeholder="Write a comment..."></textarea>
                        <label class="form-labe" for="body"></label>
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="serie_id" value="{{ $serie->id }}">
                    <input type="hidden" name="player_id" id="player_id" value="">

                    <div class="float-end mt-2 pt-1">
                        <button type="submit" class="btn-boton7">Send</button>
                        <input type="hidden" id="serie" value="{{ $serie->id }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('modals.information_comments')
