<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

//use Illuminate\Support\Carbon

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view("auth.login");
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {

            return back()->with('status', 'Invalid Login Request');
        }

        return redirect()->route('home')->with('status', 'Logged Successfully');
    }

    // Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google callback
    public function handleGoogleCallback()
    {
        $data = Socialite::driver('google')->user();

        $user = User::firstOrNew(['email' => $data->email]);

        if (!$user->exists) {
            $user->name = $data->name;
            $user->username = $data->name;
            $user->email = $data->email;
            $user->google_id = $data->id;
            $user->avatar = $data->avatar;
            $user->email_verified_at = now();
            $user->save();
        }
        if (empty($user->password)) {
            return redirect()->route('login.password', [
                'user' => $user,
            ]);
        }

        Auth::login($user);

        return redirect()->route('posts.index');
    }

    public function passwordCreater(User $user)
    {
        return view('auth.password', [
            'user' => $user,
        ]);
    }

    public function UpdatePassword(Request $request,User $user)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        auth()->login($user);

        return redirect()->route('posts.index');
    }
}
