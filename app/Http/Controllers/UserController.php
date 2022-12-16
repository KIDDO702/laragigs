<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // SHOW CREATE FORM
    public function create()
    {
        return view('users.register');
    }

    // CREATE A NEW USER 
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'min:5'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:8'
        ]);

        // Hashed password
        $fields['password'] = bcrypt($fields['password']);

        // Create the user
        $user = User::create($fields);

        // log in the user
        auth()->login($user);
        return redirect('/')->with('message', 'Signed and Logged in successfully');
    }

    // LOGOUT USER 
    public function logout(Request $request) 
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'Logged out successfully');

    }

    // SHOW LOG IN FORM 
    public function login()
    {
        return view('users.login');
    }

    // AUTHENTICATE USER
    public function authenticate(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($fields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'Logged In successfully');
        }
        return back()->withErrors(['email' => 'Invalid details'])->onlyInput('email');
    }
}
