@extends('layouts.plantilla')
@section('title', 'Create a new series')

@section('content')

    <div class="col-md-12">
        <h2>Create a new series</h2>
        <form action="{{ route('admin.series.store') }}" method="POST">
            @csrf
            <div class="">
                <label for="competition">Competition</label>
                <select id="competition" name="competition" class="">
                    <!-- Aquí van las opciones de competición -->
                </select>
            </div>
            <div class="">
                <label for="series_type">Series Type</label>
                <select id="series_type" name="series_type" class="">
                    <option value="bo1">BO1</option>
                    <option value="bo3">BO3</option>
                    <option value="bo5">BO5</option>
                </select>
            </div>
            <div class="">
                <label for="name">Name</label>
                <select id="name" name="name" class="">
                    <option value="regular_season">Regular Season</option>
                    <option value="quarter_finals">Quarter Finals</option>
                    <option value="semi_final">Semi Final</option>
                    <option value="final">Final</option>
                </select>
            </div>
            <div class="">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" class="">
            </div>
            <div class="" id="" style="display: none;">
                <label for="total_games">Total Games</label>
                <input type="number" id="total_games_input" name="total_games" class="">
            </div>
            <button type="submit" class="btn btn-primary">Create Series</button>
        </form>
    </div>

<script>
    document.getElementById('date').addEventListener('change', function() {
    var selectedDate = new Date(this.value);
    var today = new Date();
    today.setHours(0, 0, 0, 0);
    if (selectedDate < today) {
        document.getElementById('total_games').style.display = 'block';
    } else {
        document.getElementById('total_games').style.display = 'none';
    }
});
</script>
@endsection
