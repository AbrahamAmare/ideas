<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show(User $user){
        $ideas = $user -> ideas() -> paginate(5);
        return view('pages.users.show', ['user' => $user, 'ideas' => $ideas]);
    }

    public function edit(User $user){
        $editing = true;
        $ideas = $user -> ideas() -> paginate(5);
        return view('pages.users.edit', ['user' => $user, 'editing' => $editing, 'ideas' => $ideas]);
    }

    public function update(UpdateUserRequest $request, User $user){

        $validated = $request -> validated();

        if ($request -> has('image')) {
            $imagePath = request() -> file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            Storage::disk('public') -> delete($user -> image ?? '');
        }

        $user -> update($validated);

        return redirect() -> route('profile');
    }

    public function profile(){
        return $this -> show(auth() -> user());
    }
}
