<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Cookie;

class RegisterController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $userDetail = [];
        $params = $request->all();
        
        $user = $this->dei_api->user_register(null, $params);
        if (isset($user->User)) {
//            $request->session()->put('authenticated', time());
//            $request->session()->flash('success', 'Register successfully!');
//            $request->session()->put('user', (array) $user->User);
//            $request->session()->put('Token', (array) $user->Token);
            $experience_id = empty($user->User->experience_id) ? 1 : $user->User->experience_id;
            Cookie::queue(Cookie::make('Token', $user->Token, (86400 * 30))); // 86400 = 1 day
            Cookie::queue(Cookie::make('experience_id', $experience_id, (86400 * 30))); // 86400 = 1 day
            $configparams['experience_id'] = config('launch_current_experience_id');
            $this->dei_api->customer_config($user->Token, $configparams);

            return array('user' => $user, 'success' => 200);
            // return back()->with('success','User Register Successfully');
        } else {
            return array('user' => $user, 'success' => 400);

            return back()->with('error', $user->error->message);
        }
    }

}
