<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
    	return view('index');
    }

    public function bridge() {
    	$pusher = App::make('pusher');

	    $pusher->trigger( 'test_channel',
	                      'my_event', 
	                      array('text' => 'Preparing the Pusher Laracon.eu workshop!'));

	    return view('index');
    }
}
