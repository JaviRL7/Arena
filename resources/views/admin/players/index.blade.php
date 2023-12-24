@extends('layouts.plantilla')
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
                            <span class="text-gray-500">{{ $player->name }} {{ $player->lastname1 }}</span>
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
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        </td>
                    </tr>

                    <!-- Ventana modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $player->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <h1> holaaaaaaaaaaaaaaaa </h1>


                            </div>
                        </div>
                    </div>
                @endforeach
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#simpleModal">
                    Open Modal
                  </button>

                  <!-- Ventana modal -->
                  <div class="modal" tabindex="-1" role="dialog" id="simpleModal">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Simple Modal</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>This is a simple modal!</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
            </tbody>
        </table>
    </div>
    <!-- Paginación -->
    {{ $players->links() }}
</div>
@endsection
