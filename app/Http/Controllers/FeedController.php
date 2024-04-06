<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = auth() -> user();

        $followingUserIds = $user -> following() -> pluck('user_id');

        $ideas = Idea::whereIn('user_id', $followingUserIds) -> latest();

        if (request() -> has('search')) {
            $ideas = $ideas -> search(request('search', ''));
        }

        return view('dashboard', ['ideas' => $ideas -> paginate(5)]);
    }
}
