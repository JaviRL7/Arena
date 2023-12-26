@extends('layouts.plantilla')
@section('title', 'Create a new series')

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/admin/logos.js') }}"></script>
    <style>
        .form-group {
            margin-bottom: 2rem; /* Aumenta la separación entre los inputs y select options */
            font-size: 1.25rem;
        }
        .form-control {
            border-color: red;
            width: 80%; /* Ajusta el ancho de los select options */
        }
        .wrapper {
            border: 2px solid red;
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .row {
            width: 80%;  /* Ajusta este valor según tus necesidades */
            min-width: 300px;  /* Ajusta este valor según tus necesidades */
        }
    </style>
@endsection

@section('content')
<div class="wrapper">
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <h2>Create a new series</h2>
            <form action="{{ route('admin.series.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="competition">Competition</label>
                    <select id="competition" name="competition" class="form-control">
                        @foreach ($competitions as $competition)
                            <option value="{{ $competition->id }}" data-logo="{{ asset($competition->logo)}}">{{ $competition->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="team_1_id">Team 1</label>
                    <select id="team_1_id" name="team_1_id" class="form-control team-select">
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}" data-logo="{{ asset($team->logo) }}">
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="team_2_id">Team 2</label>
                    <select id="team_2_id" name="team_2_id" class="form-control team-select">
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}" data-logo="{{ asset($team->logo) }}">
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="series_type">Series Type</label>
                    <select id="series_type" name="series_type" class="form-control">
                        <option value="bo1">BO1</option>
                        <option value="bo3">BO3</option>
                        <option value="bo5">BO5</option>
                    </select>
                </div>
                <div class="form-group" id="games_group" style="display: none;">
                    <label for="games">Games</label>
                    <input type="number" id="games" name="games" class="form-control">
                </div>
                <!-- Más campos del formulario aquí -->
                <button type="submit" class="btn btn-primary">Create Series</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    // ...

    // Función para comprobar la fecha y el tipo de serie
    function checkDateAndSeriesType() {
        var date = new Date($('#date').val());
        var today = new Date();
        today.setHours(0, 0, 0, 0); // Asegúrate de que la hora no afecta a la comparación

        var seriesType = $('#series_type').val();

        if (date < today && seriesType !== 'bo1') {
            // Si la fecha es anterior al día de hoy y el tipo de serie no es 'bo1', muestra el campo de número de partidos
            $('#games_group').show();

            // Establece el valor mínimo y máximo del campo de número de partidos basándose en el tipo de serie
            if (seriesType === 'bo3') {
                $('#games').attr('min', 2);
                $('#games').attr('max', 3);
            } else if (seriesType === 'bo5') {
                $('#games').attr('min', 3);
                $('#games').attr('max', 5);
            }
        } else {
            // Si la fecha no es anterior al día de hoy o el tipo de serie es 'bo1', oculta el campo de número de partidos
            $('#games_group').hide();
        }
    }

    // Comprueba la fecha y el tipo de serie cuando se cambia la fecha o el tipo de serie
    $('#date, #series_type').change(checkDateAndSeriesType);

    // Comprueba la fecha y el tipo de serie al cargar la página
    checkDateAndSeriesType();
});

});
</script>
@endsection
