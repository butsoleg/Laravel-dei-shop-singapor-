<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Cookie;

class ResetPasswordController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Password Reset Controller
      |--------------------------------------------------------------------------
      |
      | This controller is responsible for handling password reset requests
      | and uses a simple trait to include this behavior. You're free to
      | explore this trait and override any methods you wish to tweak.
      |
     */

use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    public function reset_password(Request $request)
    {
        $params = $request->all();
        $token = Cookie::get('Token', 'default');
        $user = $this->dei_api->forgot_verify($token, $params);
        if (isset($user->status)) {
            if ($user->status == 'success') {
                $request->session()->flash('success', 'password reset successfully!');

                return array('user' => $user, 'success' => 200);
            } else if ($user->status == 'error') {
                return array('user' => $user, 'success' => 400);
            } else {
                return array('success' => 500);
            }
        } else if (isset($user->success)) {
            if ($user->success == false) {
                return array('user' => $user, 'success' => 300);
            }
        } else {
            return array('success' => 500);
        }
    }

}
