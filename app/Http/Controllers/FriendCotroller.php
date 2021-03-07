<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FriendCotroller extends Controller
{

    public function store(User $user, Request $request)
    {
        $insert = Friend::Create([
            'userid_1' => auth()->user()->id,
            'userid_2' => $user->id,
        ]);

        return back()->with('friend_added', $user->name . ' added as friend successfully ');
    }
    public function search(Request $request)
    {
        $request->validate([
            'Search' => 'required|max:255'
        ]);

        if (($request->filter != "") ) {

            if ($request->Search == 'female') {
                $request->Search = 2;
            }

            if ($request->Search == 'male') {
                $request->Search = 1;
            }

            $friends = DB::table('friends')
                   ->select('userid_2')
                   ->where('userid_1' , '=' , auth()->user()->id)
                    ->get()
                    ->toArray();

            $fr = [0];
            foreach ( $friends as $key => $value) {
                $fr[] = $value->userid_2;
            }

            $user = User::where($request->filter, 'like', '%' . $request->Search . '%')
                    ->with('friends')
                    ->whereBetween('id', $fr)
                    ->get();
        }

        return view('search', [
            'user' => $user,
            'tittle' => 'Search'
        ]);
    }
    public function match()
    {

        $current_user = auth()->user();


        $users = User::where('id', '!=' , $current_user->id)
                    ->orWhere('gender', 'like', '%' . $current_user->gender . '%')
                    ->orWhere('country', 'like', '%' . $current_user->country . '%')
                    ->orWhere('fav_color', 'like', '%' . $current_user->fav_color . '%')
                    ->orWhere('fav_actor', 'like', '%' . $current_user->fav_actor . '%')
                    ->orWhere('dob', 'like', '%' . $current_user->dob . '%')

                    ->get();


        return view('search', [
            'user' => $users,
            'tittle' => 'Match your Friend'
        ]);

    }
}
