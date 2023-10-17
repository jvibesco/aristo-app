<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $atttributes = $request->validate([
            'nik' => ['required'],
            'password' => ['required'],
        ]);

        if (auth::attempt($atttributes)) {
            return redirect('/')->with('success', 'You are now logged in');
        }

        throw ValidationException::withMessages([
            'nik' => 'Your provide credentials does not match our records.',
        ]);
    }
}
