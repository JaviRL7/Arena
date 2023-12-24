
@extends('layouts.plantilla_admin')
@section('title', 'Players index')

@section('content')

<div class="container-fluid edit-player-container">
    <div class="table-responsive">
        <table class="table_crud_admin">
            <thead>
                <th>Photo</th>
                <th>Nick</th>
                <th>Name</th>
                <th>Role</th>
                <th>Current team</th>
                <th>Contract expiration</th>
                <th>Actions</tr>
            </thead>
            <tbody>
                @foreach ($players as $player)
                <tr class="row-color">
                    <td>
                        <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}"
                            class="w-36 h-36 object-cover rounded-full">
                    </td>
                    <td>
                        <p>{{ $player->nick }}</p>
                    </td>
                    <td>
                        <span class="text-gray-500">{{ $player->name }}
                            {{ $player->lastname1 }}
                        </span>
                    </td>
                    <td>
                        <p>
                            {{ $player->role->name }}
                        </p>
                    </td>

                    <td>
                        <p>
                            {{ $player->teams()->where('start_date', '<=', $today)->where('contract_expiration_date', '>=', $today)->first()->name }}
                        </p>
                    </td>
                    <td>
                        <p>
                            {{$player->currentTeam()->pivot->contract_expiration_date;}}
                        </p>
                    </td>

                    <td>
                        <a href="{{ route('admin.players.edit', ['player' => $player]) }}" class="text-blue">Modificate</a> <br>
                        <form action="{{ route('admin.players.destroy', ['player' => $player]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="text-blue" onclick="return confirm('Are you sure to delete this player?')">                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Paginación -->
    {{ $players->links() }}
</div>
@endsection
