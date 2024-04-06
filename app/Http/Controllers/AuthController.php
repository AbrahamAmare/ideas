<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //

    public function register(){
        return view('pages.auth.register');
    }

    public function store(){

        $validated = request() -> validate([
            'name' => 'required|min:2|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        Mail::to($user -> email) ->send(new WelcomeMail($user));

        return redirect() -> route('login') -> with('success', 'Account create successfully');
    }

    public function login(){
        return view('pages.auth.login');
    }

    public function authenticate(){
        $validated = request() -> validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
            );

        if (auth() -> attempt($validated)){
            request() -> session() -> regenerate();

            return redirect() -> route('dashboard') -> with('success', 'Logged in successfully');
        }

        return redirect() -> route('login') -> withErrors([
            'email' => "Invalid credentials",
            'password' => "Invalid credentials"
        ]);
    }

    public function logout(){
        auth() -> logout();

        request() -> session() -> invalidate();
        request() -> session() -> regenerateToken();

        return redirect() -> route('login');
    }
}
