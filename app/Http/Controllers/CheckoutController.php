<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Helpers\deiAPI;
use Cookie;

class CheckoutController extends Controller
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
         $response = $this->dei_api->address_details($token, ['page' => 1, 'items_per_page' => 1]);
        $addresses = array();
        if (!empty($response->Addresses))
            $addresses = $response->Addresses;
        $cards_response = $this->dei_api->cards_get($token);
        $cards = array();
        if (!empty($cards_response->Cards))
            $cards = $cards_response->Cards;
         // return (array)$cards;

        
        return view('/checkout', compact('addresses', 'cards'));
    }

    public function get_cards(){
        $token = Cookie::get('Token', 'default');

        $cards_response = $this->dei_api->cards_get($token);
         if (!empty($cards_response->Cards)){
            $cards = $cards_response->Cards;
            $html = view('layouts.modal', compact('cards'))->render();
            return array('html' => $html, 'success' => 200);

        }else{
            return array('html' => '', 'success' => 500);

        }
           

    }
    public function get_addresses(){
        $token = Cookie::get('Token', 'default');
         $response = $this->dei_api->address_details($token, ['page' => 1, 'items_per_page' => 4]);
         $addresses = array();
        if (!empty($response->Addresses)){

            $addresses = $response->Addresses;
            $html = view('layouts.addressmodal', compact('addresses'))->render();
            return array('html' => $html, 'success' => 200);
        }

       else{
            return array('html' => '', 'success' => 500);

        }
           

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function do_checkout(Request $request)
    {
           $params = $request->all();
        unset($params['_token']);
//
        if (empty($params)) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
        // send checkout request
        $token = Cookie::get('Token', 'default');
        $checkout = $this->dei_api->checkout_get($token, $params);
        if (isset($checkout->success)) {
            if ($checkout->success == false) {

                return array('checkout' => $checkout, 'success' => 300);
            }
        } else if (isset($checkout->Charge)) {
            Cookie::queue(Cookie::make('order_id', $checkout->Charge->order->id, (86400 * 365))); 
            $request->session()->flash('success', 'Your order has been placed succesffully!');

            return array('checkout' => $checkout, 'success' => 200);
        } else {
            $request->session()->flash('error', 'Something went Wrong, please try again!');

            return array('success' => 500);
        }
        
    }


    public function success()
    {
        $orderDetail = [];
        $token = Cookie::get('Token', 'default');
        $order_id = Cookie::get('order_id', 'default');
        if($order_id != ''){
            $orders =  $this->dei_api->user_orders($token);
            if(!empty($orders)){
                foreach($orders as $order){
                if($order_id == $order->id){
                    $orderDetail = $order;
                }
            }
        }
            Cookie::queue(Cookie::make('order_id', '', (86400 * 365)));        
            return view('checkout_success', compact('orderDetail'));
        }else{
            return redirect('/home')->with('error', 'Something went wrong, please try again');
        }
       
    }

    public function promotion(Request $request){
        $params = $request->all();
        unset($params['_token']);
//
        if (empty($params)) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
        // send checkout request
        $token = Cookie::get('Token', 'default');
        $promocode = $this->dei_api->apply_promocode($token, $params);
         if (isset($promocode->error)){
            return array('promocode' => $promocode, 'success' => 400);

        }else{
            return array('promocode' => $promocode, 'success' => 200);
            
        }

        // lotteries{"error":"Promocode not valid"}
// return (array)$promocode;
//         if (isset($checkout->success) && $checkout->success === false)
//             return back()->with('error', $checkout->alert->message);
            
//         return redirect('/home')->with('success', 'Your order has been placed succesffully');
    }

}
