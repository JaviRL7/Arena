<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Game;
use App\Models\Score;
use App\Models\Comment;
use App\Models\Player;
use App\Models\Serie;
use App\Models\Team;
use App\Models\Champion;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(User $user)
    {
        auth()->user()->followings()->attach($user->id);
        return back();
    }

    public function destroy(User $user)
    {
        auth()->user()->followings()->detach($user->id);
        return back();
    }
}
