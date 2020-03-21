<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function profile($id = null)
    {
        if ($id == null) {
            $user = User::FindOrFail(Auth::user()->id);
        }
        else{
            $user = User::FindOrFail($id);
        }

        return view('profile', compact('user'));
    }
}
