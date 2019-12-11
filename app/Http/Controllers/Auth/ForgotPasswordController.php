<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Cookie;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        // $this->middleware('guest');
    }

    public function sendResetLinkEmail(Request $request){
        $params =  $request->all();
        $token = Cookie::get('Token', 'default');
        $user = $this->dei_api->forgot_password($token, $params);
        if(isset($user->status)){
            if($user->status == 'success'){
                    // $request->session()->flash('success', 'Code has been sent to your mail!');
                
                return array('user' => $user, 'success' => 200);
            }
            else if($user->status == 'error'){
                return array('user' => $user, 'success' => 400);
            }else{
                return array( 'success' => 500);
            }
        }else if(isset($user->success)){
            if($user->success == false){
                return array('user' => $user, 'success' => 300);
            }
        }else{
            return array( 'success' => 500);
        }
    }

}
