<?php

namespace App\Http\Controllers;
use App\Models\Serie;
use App\Models\Comment;
use App\Models\Player;

use App\Models\Team;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, Serie $serie)
{
    $request->merge([
        'player_id' => $request->player_id != '' ? $request->player_id : null,
        'team_id' => $request->team_id != '' ? $request->team_id : null,
    ]);

    $request->validate([
        'body' => 'required|max:250',
        'player_id' => 'nullable|exists:players,id',
        'team_id' => 'nullable|exists:teams,id',
    ]);

    // Buscar menciones a jugadores en el body
    if (preg_match('/@(\w+)/', $request->body, $matches)) {
        $playerNick = $matches[1];
        $player = Player::where('nick', $playerNick)->first();
        if ($player) {
            $request->player_id = $player->id;
        }
    }

    // Buscar menciones a equipos en el body
    if (preg_match('/#(\w+)/', $request->body, $matches)) {
        $teamName = $matches[1];
        $team = Team::where('name', $teamName)->first();
        if ($team) {
            $request->team_id = $team->id;
        }
    }

    $comment = new Comment;
    $comment->body = $request->body;
    $comment->user_id = $request->user_id;
    $comment->serie_id = $serie->id;

    //los nulos / repasar
    $comment->player_id = $request->player_id;
    $comment->team_id = $request->team_id;
    $comment->save();

    return back();
}

    public function storeModalComment(Request $request, Serie $serie){
    $request->merge([
        'player_id' => $request->player_id != '' ? $request->player_id : null,
        'team_id' => $request->team_id != '' ? $request->team_id : null,
    ]);

    $request->validate([
        'body' => 'required|max:250',
        'player_id' => 'nullable|exists:players,id',
        'team_id' => 'nullable|exists:teams,id',
    ]);

    $comment = new Comment;
    $comment->body = $request->body;
    $comment->user_id = $request->user_id;
    $comment->serie_id = $serie->id;

    //los nulos / repasar

    $comment->save();

    // Devuelve una respuesta JSON en lugar de redirigir
    return back();
}





public function like(Comment $comment)
{
    $like = $comment->likes()->where('user_id', auth()->id())->first();

    if (!$like) {
        $comment->likes()->attach(auth()->id());
    }

    // Recarga la relación para obtener el conteo actualizado
    $comment->load('likes');

    return response()->json([
        'success' => true,
        'likesCount' => $comment->getLikesCountAttribute(),
    ]);
}



    public function destroy($id)
{
    $comentario = Comment::find($id);

    // Comprobar si el comentario existe
    if (!$comentario) {
        return redirect()->back()->with('error', 'Comentario no encontrado.');
    }

    // Comprobar si el usuario actual es el propietario del comentario o un administrador
    if (auth()->user()->id != $comentario->user_id && !auth()->user()->admin) {
        return redirect()->back()->with('error', 'No tienes permiso para eliminar este comentario.');
    }

    $comentario->delete();

    return redirect()->back()->with('success', 'Comentario eliminado con éxito.');
}


    public function edit($id)
    {
        $comentario = Comment::find($id);
        return view('comentarios.edit', compact('comentario'));
    }

    public function update(Request $request)
    {
        $comment = Comment::findOrFail($request->comment_id);
        $comment->body = $request->comment_body;
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated successfully');
    }
}
