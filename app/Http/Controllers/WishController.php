<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Wish;

class WishController extends Controller
{
    public function getWishes(){
        $wishes = Wish::paginate(4);
        return view('overview', ['wishes' => $wishes]);
    }
    public function getEndPage($name = 'no name', $text = 'no wish') {
        return view('end',['wishName' => $name, 'wishText' => $text]);
    }
    public function getBlowAWishPage(){
        return view('wish');
    }
    public function saveWish(Request $request){
        if(isset($request->name) && isset($request->wish)){
       $wish = new Wish(
            [
                'name' => $request->name,
                'wish' => $request->wish
            ]
        );

        $wish->save();
            return(['succes' , $request->name, $request->wish]);
        }else{
            return(['error' , 'Alle velden moeten ingevuld worden!']);
        }


    }
}
