<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                @foreach($columns as $column)
                    <th>{{ $column  }}</th>
                @endforeach
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($columns as $column)
            <td>
                        <div>
                            {{ $fila->$columna }}
                        </div>
                    </td>
                @endforeach
        </tbody>
