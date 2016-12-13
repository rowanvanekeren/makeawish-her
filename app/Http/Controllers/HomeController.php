<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function bridge() {
        $pusher = App::make('pusher');

        $pusher->trigger( 'test_channel',
                          'my_event', 
                          array('text' => 'Preparing the Pusher Laracon.eu workshop!'));

        return view('index');
    }
}
