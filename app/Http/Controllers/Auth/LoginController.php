<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Helpers\auth_errors;
use Validator;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function logout(){
        Auth::logout();
        return redirect()->intended('/');
    }

    public function login(Request $request)
    {
        $error = new auth_errors();
        $this->validate($request, [
            'name' => 'required|max:255',
            'password' => 'required|max:255',

        ]);

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            // Authentication passed...
            return redirect()->intended('wish');
        }else{

            return redirect('login')
                ->withInput($request->only($request->name, 'remember'))
                ->withErrors([
                    'notexist' => $error->login_errors('notfound'),
                ]);
        }
    }

/*    public function __construct()
    {

        $this->middleware('guest', ['except' => 'logout']);
    }*/
}
