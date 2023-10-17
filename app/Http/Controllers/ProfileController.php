<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit () {
        return view('user.editProfile', [
            'user' => Auth::user(),
        ]);
    }
}
