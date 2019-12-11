<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session;
use AWS;
use OmiseCustomer;
use App\Helpers\deiAPI;
use Cookie;
use View;

class CartController extends Controller
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
     * Show the Cart.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $token = Cookie::get('Token', 'default');
        if ($token === 'default') {
            return back()->with('error', 'Login required to add products into Cart. Please try again');
        } else {
            return view('cart');
        }
    }

    public function add_product(Request $request)
    {
        $token = Cookie::get('Token', 'default');
        if ($token === 'default') {
            return array('error' => 'Login required to add products into Cart. Please try again');
        } else {
            $cart = $this->dei_api->cart_details($token);
            if (empty($cart->Cart))
                return array('error' => 'No Cart selected');
            $product_id = explode('=', $request->form_data);
            $product_options = json_encode($request->product_options);
            $synced_cart = $this->dei_api->cart_add($token, ['cart_id' => $cart->Cart->id, 'product_id' => (int)$product_id[1], 'amount' => 1, 'product_options' => $product_options]);

            // Need to add snippet for add-btn
            // Need to add snippet for My Cart
            $target_product = (int)$product_id[1];
            foreach ($synced_cart->Cart->products as $key => $product_item) {
                if ($product_item->id == $target_product) {
                    $cart_item_data = ['launch_cart' => $cart->Cart, 'product_item' => $product_item, 'quantity' => $product_item->quantity, 'key' => $key];
                }
            }
            
            if (isset($cart_item_data)) {
                $cart_row = View::make('cart_productitem', $cart_item_data);
                $add_btn = View::make('productitem_addbtn', $cart_item_data);
            }
            else {
                return ['error' => 'There was a problem adding this product'];
            }

            return ['cart' => $synced_cart, 'cart_row' => $cart_row->render(), 'add_btn' => $add_btn->render()];
        }
    }
    
    public function update_product(Request $request){
        $params = $request->all();
       unset($params['_token']);

       $token = Cookie::get('Token', 'default');
       if ($token === 'default') {
           return array('error' => 'Login required to add products into Cart. Please try again');
       } else {
           $params['product_options'] = ($params['product_options'] != null) ? $params['product_options'] : '';
           // $params['amount'] =  '';

           $params = (is_array($params)) ? http_build_query($params) : $params;
      
           $cart = $this->dei_api->cart_update($token, $params);
           if (isset($cart->status)) {
               if ($cart->status == 'success') {
   //                $request->session()->put('user', (array) $user->User);
                   // $request->session()->flash('success', 'profile updated successfully!');
                   return array('cart' => $cart, 'success' => 200);
               } else if ($cart->status == 'error') {
                   return array('cart' => $cart, 'success' => 400);
               } else {
                   return array('success' => 500);
               }
           } else if (isset($cart->success)) {
               if ($cart->success == false) {
                   return array('cart' => $cart, 'success' => 300);
               }
           } else if (isset($cart->Cart)) {
                   // $request->session()->flash('success', 'profile updated successfully!');

               return array('cart' => $cart, 'success' => 200);
           } else {
               return array('success' => 500);
           }
       }
   }

   public function delete_product(Request $request){
       $params = $request->all();
       unset($params['_token']);
       $id = $params['cart_id'];
       // unset($params['cart_id']);


       $token = Cookie::get('Token', 'default');
       $cart = $this->dei_api->cart_delete($token, $id, $params);
      // return (array) $cart;
           if (isset($cart->status)) {
               if ($cart->status == 'success') {
   //                $request->session()->put('user', (array) $user->User);
                   // $request->session()->flash('success', 'profile updated successfully!');
                   return array('cart' => $cart, 'success' => 200);
               } else if ($cart->status == 'error') {
                   return array('cart' => $cart, 'success' => 400);
               } else {
                   return array('success' => 500);
               }
           } else if (isset($cart->success)) {
               if ($cart->success == false) {
                   return array('cart' => $cart, 'success' => 300);
               }
           } else if (isset($cart->Cart)) {
                   // $request->session()->flash('success', 'profile updated successfully!');

               return array('cart' => $cart, 'success' => 200);
           } else {
               return array('success' => 500);
           }
       
   }
}
