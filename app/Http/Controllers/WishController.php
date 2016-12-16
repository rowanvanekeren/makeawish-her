<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Wish;

class WishController extends Controller
{
    public function getWishes(){
        $wishes = Wish::paginate(3);
        return view('overview', ['wishes' => $wishes]);
    }

    public function getBlowAWishPage(){
        return view('wish');
    }
    public function saveWish(Request $request){

       $wish = new Wish(
            [
                'name' => $request->name,
                'wish' => $request->wish
            ]
        );

        $wish->save();

        return('wish');
    }
}
