<?php

namespace App\Http\Controllers;
use App\Models\User;

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
