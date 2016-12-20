<?php

namespace App\Http\Controllers;
use App\MicPreset;
use Illuminate\Http\Request;

class MicController extends Controller
{
    public function calibration(){

        $presets = MicPreset::paginate(10);
        return view('calibration', ['presets' => $presets]);
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
        setcookie($cookieName, $value, time() + $day);

        return redirect('calibration');

    }
}
