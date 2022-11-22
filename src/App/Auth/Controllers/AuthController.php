<?php

namespace App\Auth\Controllers;

use App\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (auth()->guard()->attempt($request->only('email', 'password'))) {
            return redirect()->intended();
        }

        throw new \Exception('There was some error while trying to log you in');
    }
}
