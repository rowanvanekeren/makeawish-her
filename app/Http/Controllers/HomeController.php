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
        $wishes = Wish::whereNotNull('image')->orderBy('created_at','desc')->take(15)->get();

        return view('index', ['wishes' => $wishes]);
    }

    public function bridge() {

    }


}
