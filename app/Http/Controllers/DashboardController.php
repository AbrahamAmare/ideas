<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){
        //return new WelcomeMail(auth() -> user());


        $ideas =  Idea::with('user', 'comments.user') -> orderBy('created_at', 'DESC');

        // check if search query is set

        if (request() -> has('search')){
            # code...
            $ideas = $ideas -> search(request('search', ''));
        }

        // $ideas = Idea::when(request() -> has('search'), function($query){
        //     $query -> search(request('search', ''));
        // }) -> orderBy('created_at', 'DESC')->paginate(5);

        return view("dashboard", [
            'ideas' => $ideas -> paginate(5)
        ]);

        // $ideas = Idea::withCount('likes')->orderBy('created_at', 'DESC');

        // if (request() -> has('search')){
        //     $ideas = $ideas -> where('content', 'like', '%' . request() -> get('search', '') . '%');
        // }

        return view("dashboard", [
            'ideas' => $ideas -> paginate(5)
        ]);
    }
}
