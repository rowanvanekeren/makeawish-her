<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Wish;
use Illuminate\Support\Facades\Input;

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
        $dirname = "images/insta-bg/";
        $images =glob($dirname."*.{jpg,png,jpeg}", GLOB_BRACE);



        return view('wish', ['bg_images' => $images]);
    }
    public function saveImage(Request $request){

        $imgFolder =  "/public/images/insta/";
        $relativeFolder = "/images/insta/";
        $destinationPath =  base_path() . $imgFolder;
        /*define('UPLOAD_DIR',$destinationPath);*/
        $img = $request->image;
        $unique_code=  "insta-" . uniqid() . '.jpg';
        $file = $destinationPath . $unique_code;
        $success = $img->move($destinationPath, $file);
        return json_encode($relativeFolder . $unique_code);
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
