@if ($game->{'ban1_blue'}()->exists())
    <div class="ban-container">
        <h1 class="titulo" style="text-align-last: center">Ban phase</h1>
        <div class="serie-show-table">
            <!-- Primera fila -->
            <div class="row">
                @foreach (range(1, 3) as $ban)
                    @if ($game->{'ban' . $ban . '_blue'}()->exists())
                        <div class="cell">
                            <img src="{{ asset($game->{'ban' . $ban . '_blue'}()->first()->square) }}"
                                 style="width: 50px!important; height:50px !important"
                                 class="img-fluid ban-img">
                        </div>
                    @endif
                    @if ($game->{'ban' . $ban . '_red'}()->exists())
                        <div class="cell">
                            <img src="{{ asset($game->{'ban' . $ban . '_red'}()->first()->square) }}"
                                 style="width: 50px!important; height:50px !important"
                                 class="img-fluid ban-img">
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- Segunda fila -->
            <div class="row">
                @foreach (range(4, 5) as $ban)
                    @if ($game->{'ban' . $ban . '_blue'}()->exists())
                        <div class="cell">
                            <img src="{{ asset($game->{'ban' . $ban . '_blue'}()->first()->square) }}"
                                 style="width: 50px!important; height:50px !important"
                                 class="img-fluid ban-img">
                        </div>
                    @endif
                    @if ($game->{'ban' . $ban . '_red'}()->exists())
                        <div class="cell">
                            <img src="{{ asset($game->{'ban' . $ban . '_red'}()->first()->square) }}"
                                 style="width: 50px!important; height:50px !important"
                                 class="img-fluid ban-img">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
