<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->isModer()) {
            return view('home', [
                'logs' => \App\Log::orderBy('created_at','desc')->paginate(30)
            ]);
        }
        else 
            return redirect('/client/show');
    }

    public function help()
    {
        return view('help');
    }
}
