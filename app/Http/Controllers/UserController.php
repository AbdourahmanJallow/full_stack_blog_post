<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function register(Request $request): RedirectResponse
    {
        // $validator = $request->validate(['   name' => 'bail|required|max:20', 'email' => 'bail|required|email|unique', 'password' => 'bail|required']);

        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => $request->password]);

        if (!$user) {
            return redirect()->back()->with('error', 'Registration failed');
        }

        return redirect()->route('welcome')->with('success', 'Registration Success');
    }

    public function registerForm(Request $request)
    {
        return view('register');
    }
    public function login(Request $request)
    {
    }
    public function loginForm(Request $request)
    {
    }
    public function logout(Request $request)
    {
    }
}
