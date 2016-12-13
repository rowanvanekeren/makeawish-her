<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusherController extends Controller
{

    public function pushWish($name){

        $pusherChannel = "blow_a_wish";
        $pusherEvent = "send_wish";
        $pusherName = $name;

        $pusher = App::make('pusher');

        $pusher->trigger( $pusherChannel,
            $pusherEvent,
            array('state' => 'on',
            'name' =>  $pusherName
                )
        );

        return view('wish');
    }
}
