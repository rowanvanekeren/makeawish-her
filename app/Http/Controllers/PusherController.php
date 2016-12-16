<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PusherController extends Controller
{

    public function pushWish($name = "noname"){
        var_dump("test");
        $pusherChannel = "blow_a_wish";
        $pusherEvent = "send_wish";
        $pusherName = $name ;

        $pusher = App::make('pusher');

        $pusher->trigger( $pusherChannel,
            $pusherEvent,
         "test"
        );
      /*  array('state' => 'on',
            'name' =>  $pusherName
        )*/
        return view('wish');
    }
}
