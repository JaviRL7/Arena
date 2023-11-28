<form action="" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    @foreach($columns as $column)
        <div class="form-player">
            {{-- LABEL --}}

                <label for={{ $column }}>{{ ucfirst($column) }}</label>
            {{-- STRING --}}

            @if (Schema::getColumnType($table, $column) == 'string')
                <input type="text" name="{{ $column }}" value="{{ $player->$column }}">
            {{-- FILE IMAGE --}}
            @elseif ($column == 'photo' || $column == 'logo')
                <input type="file" name="{{ $column }}" value="{{ $player->$column }}" accept="image/*">
            @endif
            </div>
    @endforeach
    <br>
    <div>
        <button type="submit" class="btn btn-outline-success">Enviar</button>
    </div>

  </form>
