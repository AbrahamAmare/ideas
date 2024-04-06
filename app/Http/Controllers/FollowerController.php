<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function follow(User $user){
        $follower = auth() -> user();

        $follower -> following() -> attach($user);
        return redirect() -> route('users.show', $user -> id);
    }

    public function unfollow(User $user){
        $follower = auth() -> user();

        $follower -> following() -> detach($user);
        return redirect() -> route('users.show', $user -> id);
    }
}
