<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{
    //
    public function show(Idea $idea) {
        return view('pages.ideas.show', ['idea' => $idea]);
    }

    public function store(){
        // validation
        $validated = request() -> validate([
            'content' => 'required|min:5|max:240'
        ]);

        // create idea and persist
        // Idea::create([
        //     'content' => request() -> get('content', '')
        // ]);

        $validated['user_id'] = auth() -> user() -> id;

        Idea::create($validated);

        // redirect after success
        return redirect() -> route('dashboard') -> with('success', 'Idea shared successfully');
    }

    public function edit(Idea $idea) {
        // if (auth() -> id() !== $idea -> user_id) {
        //     abort("401", "Not Authorized To Edit");
        // }

        // if (Gate::denies('idea.update', $idea)) {
        //     abort(403, "You don't have permission to delete");
        // }


        $editing = true;
        return view('pages.ideas.show', ['idea' => $idea, 'editing' => $editing]);
        // return view('pages.ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea) {

        // if (auth() -> id() !== $idea -> user_id) {
        //     # code...
        //     abort("401", "Not Authorized To Update");
        // }

        if (Gate::denies('idea.delete', $idea)) {
            abort(403, "You don't have permission to delete");
        }


        $validated = request() -> validate([
            'content' => 'required|min:5|max:240'
        ]);

        // $idea -> content = request() -> get('content', '');
        // $idea -> save();

        $idea -> update($validated);

        return redirect() -> route('ideas.show', $idea -> id)
            -> with('session', 'Idea updated successfully');
    }

    public function destroy($idea) {
        // if (auth()->id() === $idea->user_id) {
        //     abort("401", "Not Authorized To Delete");
        // }

        if (Gate::denies('idea.delete', $idea)) {
            abort(403, "You don't have permission to delete");
        }

        $idea = Idea::where('id', $idea) -> firstOrFail();
        $idea -> delete();

        return redirect() -> route('dashboard')->with('success', "Idea removed successfully");
    }
}
