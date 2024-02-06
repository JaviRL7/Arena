<div class="modal fade modal-serie" id="editSerieModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #e9ecef;">
                <h5 class="modal-title titular" id="exampleModalLabel">Edit Serie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="background-color: #ffffff;">
                <form action="{{ route('admin.series.update', ['serie' => $serie]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label titular">Name of the Series</label>
                        <select id="name" name="name" class="form-control rounded-lg">
                            <option value="finale">Finale</option>
                            <option value="semi finals">Semi Finals</option>
                            <option value="quarterfinals">Quarterfinals</option>
                            <option value="playoff">Playoff</option>
                            <option value="regular split">Regular Split</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="team_1_id" class="form-label titular">First Team</label>
                        <select id="team_1_id" name="team_1_id" class="form-control rounded-lg">
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="team_2_id" class="form-label titular">Second Team</label>
                        <select id="team_2_id" name="team_2_id" class="form-control rounded-lg">
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label titular">Type of Series</label>
                        <select id="type" name="type" class="form-control rounded-lg">
                            <option value="bo1">BO1</option>
                            <option value="bo3">BO3</option>
                            <option value="bo5">BO5</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label titular">Date</label>
                        <input type="date" class="form-control rounded-lg" id="date" name="date" value="{{ $serie->date }}">
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label titular">Hour</label>
                        <input type="time" class="form-control rounded-lg" id="time" name="hour" value="{{ $serie->hour }}">
                    </div>

                    <div class="mb-3">
                        <label for="competition_id" class="form-label titular">Competition</label>
                        <select id="competition_id" name="competition_id" class="form-control rounded-lg">
                            @foreach ($competitions as $competition)
                                <option value="{{ $competition->id }}">{{ $competition->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-boton7 mt-4">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
