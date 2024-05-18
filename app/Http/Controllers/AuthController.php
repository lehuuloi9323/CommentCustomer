<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user;


class AuthController extends Controller
{
    //

    public function login_admin(){
        return view('login_admin');
    }
    public function login_admin_action(Request $request){
// return $request->all();
        $request->validate([
            'id' => 'required|integer',
            'password' => 'required|string',
        ],
        [
            'required' => ':attribute not empty !',
        ]

    );

        $credentials = $request->only('id', 'password');

        if (Auth::attempt($credentials)) {
            // return redirect()->intended('dashboard');
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'id' => 'The provided credentials do not match our records.',
        ]);
    }



    public function showLoginForm(){
        return view('login');
    }
    public function login(Request $request)
    {
        // return $request->all();
        $request->validate([
            'id' => 'required|integer',
            'password' => 'required|string',
        ],
        [
            'required' => ':attribute not empty !',
        ]

    );

        $credentials = $request->only('id', 'password');

        if (Auth::attempt($credentials)) {
            // return redirect()->intended('dashboard');
            return redirect()->route('rate');
        }

        return back()->withErrors([
            'id' => 'The provided credentials do not match our records.',
        ]);
    }
}
