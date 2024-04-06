<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaLikeController extends Controller
{
    public function like(Idea $idea){
        $user = auth() -> user();
        $user->likes()->attach($idea);

        return redirect() -> route('dashboard');
    }

    public function unlike(Idea $idea){
        $user = auth() -> user();
        $user->likes()->detach($idea);

        return redirect() -> route('dashboard');
    }
}
