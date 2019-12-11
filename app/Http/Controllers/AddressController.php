<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use AWS;
use OmiseCustomer;
use Cookie;

class AddressController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $token = Cookie::get('Token', 'default');
        $address = $this->dei_api->address_details($token, ['page' => 1, 'items_per_page' => 4]);

        $userDetail = [];
        $user = $this->dei_api->user_details($token);

        if (isset($address->Addresses)) {
            $addresses = (array) $address->Addresses;
            $userDetail = (array) $user->User;
            
            return view('my_address', compact('addresses', 'userDetail'));
        } else if (isset($user->success)) {
            if ($user->success == false) {
                if (isset($user->alert->message)) {
                    return back()->with('error', $user->alert->message);
                }
            }
        } else {
            return back()->with('error', 'Something went wrong, Please try again.');
        }
    }

    public function add()
    {
        
    }

    public function create(Request $request)
    {
        $request_params = [];
        $params = $request->all();
        foreach ($params as $key => $param) {
            if ($key != '_token') {
                $request_params[$key] = $params[$key];
            }
        }
        if (isset($params['is_default'])) {
            if ($params['is_default'] == 'on') {
                $request_params['is_default'] = "1";
            } else {
                $request_params['is_default'] = "0";
            }
        } else {
            $request_params['is_default'] = "0";
        }

        $token = Cookie::get('Token', 'default');
        $user = $this->dei_api->address_add($token, $request_params);

        if (isset($user->status)) {
            if ($user->status == 'success') {
                $request->session()->flash('success', 'Address has been added successfully!');
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
            $request->session()->flash('success', 'Address has been added successfully!');
            return array('user' => $user, 'success' => 200);
        } else if (isset($user->Address)) {
            $request->session()->flash('success', 'Address has been added successfully!');
            return array('user' => $user, 'success' => 200);
        } else {
            return array('success' => 500);
        }
    }

    public function edit($id)
    {
        $addressData = [];
        $token = Cookie::get('Token', 'default');
        $address = $this->dei_api->address_details($token);
        $user = $this->dei_api->user_details($token);

        if (isset($address->Addresses)) {
            $addresses = (array) $address->Addresses;

            foreach ($addresses as $address) {
                // return $address->id;
                if ($address->id == $id) {
                    $addressData = $address;
                }
            }
            $data = (array) $addressData;
            if (!empty($addressData)) {
                $addressData->address_2 = $data['address-2'];
                return array('addressData' => $addressData, 'success' => 200);
            } else {
                return array('addressData' => $addressData, 'success' => 500);
            }
        } else {
            return array('addressData' => $addressData, 'success' => 500);
        }
    }

    public function update(Request $request)
    {
        $request_params = [];
        $params = $request->all();
        $token = Cookie::get('Token', 'default');
        $id = $params['id'];
        if (isset($params['is_default'])) {
            if ($params['is_default'] == 'on') {
                $params['is_default'] = "1";
            } else {
                $params['is_default'] = "0";
            }
        } else {
            $params['is_default'] = "0";
        }
        foreach ($params as $key => $param) {
            if ($key != '_token') {
                $request_params[$key] = $params[$key];
            }
        }

        $request_params = (is_array($request_params)) ? http_build_query($request_params) : $request_params;

        $user = $this->dei_api->address_update($token, $id, $request_params);

        if (isset($user->status)) {
            if ($user->status == 'success') {
                $request->session()->flash('success', 'Address has been updated successfully!');

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
        } else if (isset($user->Address)) {
            $request->session()->flash('success', 'Address has been updated successfully!');

            return array('user' => $user, 'success' => 200);
        } else {
            return array('success' => 500);
        }
    }

    public function delete($id)
    {
            $token = Cookie::get('Token', 'default');
        $user = $this->dei_api->address_delete($token, $id);
        $detail = (array) $user;
        if(isset($user->success)){
            if ($user->success == true) {
                return back()->with('success', 'Address deleted successfully');
            }else{
                return back()->with('error', 'Something went wrong, please try again');

            }
        }else{
            return back()->with('error', 'Something went wrong, please try again');
        }
    }

}
