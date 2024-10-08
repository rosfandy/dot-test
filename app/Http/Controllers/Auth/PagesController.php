<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class PagesController extends Controller
{
    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['message' => $validator->errors()->first()]);
        }

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return back()->withErrors(['message' => 'Login credentials are invalid.']);
            }
        } catch (JWTException $e) {
            return back()->withErrors(['message' => 'Could not create token. Please try again.']);
        }

        session(['jwt_token' => $token]);
        return redirect()->route('pages.dashboard');
    }


    public function adminLogout(Request $request)
    {
        session()->forget('jwt_token');
        return redirect()->route('login');
    }

    public function loginForm()
    {
        return view('auth.login');
    }
}
