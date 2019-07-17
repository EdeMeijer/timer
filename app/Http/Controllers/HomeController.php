<?php

namespace App\Http\Controllers;

use App\TimerEntry;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $entries = TimerEntry::where('user_id', $user->id)->get();

        return view('home', ['entries' => $entries]);
    }
}
