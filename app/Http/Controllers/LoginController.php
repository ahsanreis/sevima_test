<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validation('register');

        $user = new \App\Models\User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $this->validation('login');
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = $request->user();
            $token = $user->createToken('WebClientToken', ['*'])->plainTextToken;
            return redirect()->intended('dashboard')->withCookie(
                cookie('api_token', $token)
            ); // Cookie valid until browser is closed
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->withCookie(Cookie::forget('api_token'));
    }

    private function validation($page)
    {
        if ($page == 'login') {
            return request()->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);
        } elseif ($page == 'register') {
            return request()->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|same:password_confirmation',
                'password_confirmation' => 'required|min:6|same:password',
            ]);
        }
    }
}
