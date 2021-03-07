<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(Type $var = null)
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'dob' => 'required',
            'designation' => 'required',
            'country' => 'required',
            'fav_color' => 'required',
            'fav_actor' => 'required',
            'gender' => 'required',
            'avatar' => 'required|mimes:jpg,png',
        ]);

        $insert = User::Create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => Carbon::parse($request->dob)->format('Y-m-d H:i'),
            'designation' => $request->designation,
            'country' => $request->country,
            'fav_color' => $request->fav_color,
            'fav_actor' => $request->fav_actor,
            'gender' => $request->gender,
            'avatar' => $request->avatar,
        ]);

        if ($request->has('avatar')) {
            $insert->update([
                'avatar' => $request->file('avatar')->store('avatar', 'public'),
            ]);
        }

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('home')->with('status', 'Logged Successfully');
    }

}
