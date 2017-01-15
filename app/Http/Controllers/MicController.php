<?php

namespace App\Http\Controllers;
use App\Http\Helpers\general_errors;
use App\MicPreset;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use App\Http\Helpers\Auth_Errors;
class MicController extends Controller
{
    public function calibration(){

        $presets = MicPreset::paginate(10);


        return view('calibration', ['presets' => $presets, 'currCookie' => $this->getCurrentCookie()]);
    }

    public function savePreset(Request $request){
        $preset = new MicPreset([
            'name' => $request->preset_name,
            'max' => $request->preset_number
        ]);

        $preset->save();

        return redirect('calibration');
    }

    public function deletePreset(Request $request){

        $preset = MicPreset::find($request->delete_id);

        $preset->delete();
        return redirect('calibration');
    }
    public function choosePreset(Request $request){
        $day = 86400;
        $cookieName = 'micPreset';
        if(isset($_COOKIE[$cookieName])){
            setcookie($cookieName, "", time() - $day);
        }

        $value = $request->preset_name . "&" . $request->preset_max;
        $array = [$request->preset_name,$request->preset_max];
        setcookie($cookieName, $value, time() + $day);

        return redirect('calibration');

    }

    public function getCurrentCookie(){
        $error = new general_errors();
        $cookieName = 'micPreset';
        if(isset($_COOKIE[$cookieName])){
            $value = $_COOKIE[$cookieName];
            $array = explode('&',$value);
            return $array;
        }else{
            return ['error',$error->general_errors('cookiePreset')];
        }

    }
}
