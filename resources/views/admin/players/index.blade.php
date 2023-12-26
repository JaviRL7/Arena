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
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($players as $player)
                    <tr class="row-color">
                        <td>
                            <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="w-36 h-36 object-cover rounded-full">
                        </td>
                        <td>
                            <p>{{ $player->nick }}</p>
                        </td>
                        <td>
                            <p>{{ $player->name }} {{ $player->lastname1 }}</p>
                        </td>
                        <td>
                            <p>{{ $player->role->name }}</p>
                        </td>
                        <td>
                            <p>{{ $player->teams()->where('start_date', '<=', $today)->where('contract_expiration_date', '>=', $today)->first()->name }}</p>
                        </td>
                        <td>
                            <p>{{ $player->currentTeam()->pivot->contract_expiration_date }}</p>
                        </td>
                        <td>
                            <a href="{{ route('admin.players.edit', ['player' => $player]) }}" class="text-blue">Modificate</a> <br>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $player->id }}">Delete</button>
                        </td>
                    </tr>

                    <!-- Modal -->
                    @include('modals.delete')

                @endforeach
            </tbody>
        </table>
        <div style="display: flex; justify-content: left;">
            {{ $players->links() }}
        </div>
    </div>
</div>
@endsection
