<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wish;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastWishes = Wish::orderBy('created_at','DESC')->take(3)->get();

        return view('index', ['wishes' => $lastWishes]);
    }

    public function bridge() {

    }


}
