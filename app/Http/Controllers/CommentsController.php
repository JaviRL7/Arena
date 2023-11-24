<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, Game $game)
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

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user_id = $request->user_id;
        $comment->game_id = $game->id;
        
        //los nulos / repasar
        $comment->player_id = $request->player_id;
        $comment->team_id = $request->team_id;
        $comment->save();
        return back();
    }
    public function like(Comment $comment)
    {
        $comment->likes += 1;
        $comment->save();

        return back();
    }
}
