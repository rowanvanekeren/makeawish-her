<?php
namespace App\Http\Helpers;

class Auth_Errors
{
    public function login_errors($arg){
$login_errors = array(
'name' => 'Naam veld mag niet leeg zijn',
'password' => 'Wachtwoord veld mag niet leeg zijn',
'notfound' => 'No user found with this combination'
);

        return $login_errors[$arg];
    }

}