<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $User = User::orderBy('created_at','desc')->paginate(5);

        return view('home',[
            'user' => $User
        ]);

    }

    public function searchFriend(User $user,Request $request)
    {

        $friends = DB::table('friends')
                   ->select('userid_2')
                   ->where('userid_1' , '=' , auth()->user()->id)
                   ->get()
                   ->toArray();

        $fr = [0];
        foreach ( $friends as $key => $value) {
            $fr[] = $value->userid_2;
        }
        if (!empty($fr)) {
            $User = User::orderBy('created_at','desc')
            ->whereBetween('id', $fr)
            ->with('friends')
            ->paginate(5);
        }else{
            $User = '';
        }


        return view('search',[
            'user' => $User,
            'tittle' => 'Search'
        ]);

    }

    public function show(User $user)
    {
       return view('users.show',[
           'user' => $user
       ]);
    }
}
