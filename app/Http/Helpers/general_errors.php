<?php
/**
 * Created by PhpStorm.
 * User: Rowan
 * Date: 22-12-2016
 * Time: 14:37
 */

namespace App\Http\Helpers;


class General_Errors
{
    public function general_errors($arg){
        $general_errors = array(
            'cookiePreset' => 'No preset chosen ',
        );

        return $general_errors[$arg];
    }
}