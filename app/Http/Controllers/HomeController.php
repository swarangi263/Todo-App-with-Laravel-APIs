<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Creates a token for the user and returns it to the blade file
        $user = User::find(auth()->id());

        $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;

        return view('/dashboard', [
            'token' => $token,
            'user' => $user
        ]);
    }
}
