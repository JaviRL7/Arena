<div class="modal fade modal-serie" id="editSerieModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar serie</h5>
                <button type="button" class="btn-close btn-light" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body modal-serie-form">
                <form action="{{ route('admin.series.update', ['serie' => $serie]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="label-style">Name of the series</label>
                        <select id="name" name="name" class="input-style">
                            <option value="finale">Finale</option>
                            <option value="semi finals">Semi Finals</option>
                            <option value="quarterfinals">Quarterfinals</option>
                            <option value="playoff">Playoff</option>
                            <option value="regular split">Regular Split</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="team_1_id" class="label-style">Firts team</label>
                        <select id="team_1_id" name="team_1_id" class="input-style">
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="team_2_id" class="label-style">Second team</label>
                        <select id="team_2_id" name="team_2_id" class="input-style">
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="label-style">Type of series</label>
                        <select id="type" name="type" class="input-style">
                            <option value="bo1">BO1</option>
                            <option value="bo3">BO3</option>
                            <option value="bo5">BO5</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="label-style">Date</label>
                        <input type="date" class="input-style" id="date" name="date" value="{{ $serie->date }}">
                    </div>

                    <div class="mb-3">
                        <label for="competition_id" class="label-style">Competition</label>
                        <select id="competition_id" name="competition_id" class="input-style">
                            @foreach ($competitions as $competition)
                                <option value="{{ $competition->id }}">{{ $competition->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>


    </div>
</div>
