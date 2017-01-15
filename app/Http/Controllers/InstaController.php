<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstaController extends Controller
{
    public function getInstaPage()
    {
        return view('insta');
    }

    public function postInsta($img = null)
    {
        sleep(2);
       $path = base_path() . "/public/images/insta/". $img ;
/*        $path = base_path() . "/public/images/insta/testinsta.jpg";*/

        $caption = 'this is a test';
        require("../vendor/autoload.php");
        $instagram = new \Instagram\Instagram();
        $instagram->login("instablowawish", "blowblowitaway");
        $instagram->postPhoto($path, $caption);
    }
    public function saveInstaImage(Request $request){
        $destinationPath =  base_path() . "/public/images/insta/";
        define('UPLOAD_DIR',$destinationPath);
        $img = $request->image;
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $unique_code=  "insta-" . uniqid() . '.jpg';
        $file = $destinationPath . $unique_code  ;
        $success = file_put_contents($file, $data);
        if($success){

          $save =  $this->postInsta($unique_code);
            return $unique_code;
        }else{
            return 'error';
        }
    }
}
