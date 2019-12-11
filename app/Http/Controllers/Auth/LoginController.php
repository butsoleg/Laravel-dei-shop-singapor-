<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Helpers\deiAPI;
use Auth;
use Socialite;
use Session;
use Cookie;

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
    public function __construct()
    {
        parent::__construct();
        // $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $params = $request->all();
        $token = Cookie::get('Token', 'default');
        $user = $this->dei_api->user_login($token, $params);
        if (isset($user->User)) {
            $experience_id = empty($user->User->experience_id) ? 1 : $user->User->experience_id;
            Cookie::queue(Cookie::make('Token', $user->Token, (86400 * 365))); // 86400 = 1 day
            Cookie::queue(Cookie::make('experience_id', $experience_id, (86400 * 365))); // 86400 = 1 day
            $request->session()->flash('success', 'Login successfully!');

            return array('user' => $user, 'success' => 200);
        } else {
            return array('user' => $user, 'success' => 400);
        }
    }

    // Login from Facebook
    public function redirectToProvider()
    {
        $platform = false;
        if (\Request::is('*/facebook'))
            $platform = 'facebook';
        else if (\Request::is('*/google'))
            $platform = 'google';
        else
         redirect('home');

        return Socialite::driver($platform)->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        $inputs = $request->all();

        try {
            if (!$request->has('code') || $request->has('denied')) {
                return redirect()->intended($this->redirectPath());       // redirect url
            }

            $platform = false;
            if (\Request::is('*/facebook/*'))
                $platform = 'facebook';
            else if (\Request::is('*/google/*'))
                $platform = 'google';
            else
             redirect('home');

            $user = Socialite::driver($platform)->user();
            $token = Cookie::get('Token', 'default');

            $params['social_id'] = $user->user['id'];
            $params['social_token'] = $user->token;
            $params['email'] = $user->email;
            $params['social_type'] = ucwords($platform);

            $user = $this->dei_api->user_login($token, $params);
            if (isset($user->User)) {

//                $request->session()->put('authenticated', time());
//                $request->session()->put('user', (array) $user->User);
//                $request->session()->put('Token', (array) $user->Token);
                $experience_id = empty($user->User->experience_id) ? 1 : $user->User->experience_id;
                Cookie::queue(Cookie::make('Token', $user->Token, (86400 * 30))); // 86400 = 1 day
                Cookie::queue(Cookie::make('experience_id', $experience_id, (86400 * 30))); // 86400 = 1 day
                redirect('home');
            } else {
                return array('user' => $user, 'success' => 400);
            }
        } catch (InvalidArgumentException $e) {
            return redirect()->intended($this->redirectPath());
        }
        $msz = "Log in Successful";
        return redirect()->intended($this->redirectPath())->with(['signInpopup' => $msz]);
    }

    public function googleProvider()
    {

        return Socialite::driver('google')->redirect();
    }

    // Google Login
    public function googleLogin()
    {
        try {
            $user = Socialite::driver('google')->user();
            echo "<pre>";
            print_r($user);
            die('');
        } catch (\Exception $e) {
            return redirect()->route('login');
        }


        return redirect()->intended($this->redirectPath());
    }

    public function logoutuser(Request $request)
    {
        Cookie::queue(Cookie::make('Token', 'default', (86400 * 365))); // 86400 = 1 day
        Cookie::queue(Cookie::make('experience_id', 0, (86400 * 365))); // 86400 = 1 day
        return redirect('/home')->with('success', 'Logout Successfully');
    }

}
