<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use AWS;
use OmiseToken;
use Illuminate\Support\Facades\Cookie;



class CardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        // $this->middleware('auth');
        // define('OMISE_PUBLIC_KEY', 'pkey_test_5g5dyttgllkyiho95ud');
        // define('OMISE_SECRET_KEY', 'skey_test_5hkgtakulfg2inkbryo');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index(){
         // $token = OmiseToken::retrieve('tokn_test_5hqdprbylcx7ib4hpov');
         // echo "<pre>";print_r($token);

         // die();

        $url = 'http://api.dei.com.sg/api/customer/detail';
        $cardsUrl = 'http://api.dei.com.sg/api/card';
         $user =  CommonController::getheaderCurl($url);
         // return (array)$user;
        $card =  CommonController::getheaderCurl($cardsUrl);

       if(isset($user->User)){
          $cards =  (array)$card->Cards;


          $userDetail = (array)$user->User;
            return view('saved_cards',compact('userDetail','cards'));
        }else{
            return back()->with('error', 'Something went wrong, Please try again');
          
        }
}

    public function add(){
    }

    

    public function create(Request $request){
         $params =  $request->all();
 
        $paramsData['customer_token'] = $params['token'];
        $paramsData['card_token'] = $params['card_token'];
        $paramsData['exp_month'] = (int)$params['exp_month'];
        $paramsData['exp_year'] = (int)$params['exp_year'];
        $paramsData['description'] = $params['description'];
        $paramsData['last4'] = $params['last4'];
        $paramsData['brand'] = $params['brand'];
        $paramsData['country'] = $params['country'];

        // $token = Cookie::get('Token', 'default');
        $token = Cookie::get('Token', 'default');

        $header = array(
            'Authorization: Bearer '.$token
        );
        // foreach($params as $key => $param){
        //     if($key )
        // }
    
        $url = 'http://api.dei.com.sg/api/card/add';
        $user = CommonController::getPostwithheaderCurl($url, $paramsData);


       // return (array)$user;
        if(isset($user->status)){
            if($user->status == 'success'){
                $request->session()->flash('success', 'Card added successfully!');
                return array('user' => $user, 'success' => 200);
            }
            else if($user->status == 'error'){
                return array('user' => $user, 'success' => 400);
            }else{
                return array( 'success' => 500);
            }
        }
        else if(isset($user->success)){
            if($user->success == false){
                return array('user' => $user, 'success' => 300);
            }
        }
        else if(isset($user->Card)){
            $request->session()->flash('success', 'Card added successfully!');
            return array('user' => $user, 'success' => 200);
        }
        else{
            return array( 'success' => 500);
        }

    }

    public function edit($cardId){
        // return $cardId;
        $cardsUrl = 'http://api.dei.com.sg/api/card';
        $card =  CommonController::getheaderCurl($cardsUrl);

       if(isset($card->Cards)){
          $cards =  (array)$card->Cards;
            foreach($cards as $card){
                if($card->id == $cardId){
                    $cardData = $card;
                }
            }
            $data =  (array)$cardData;
            // return $data['address-2'];
            if(!empty($cardData)){
                return array('cardData' => $cardData, 'success' => 200);
            }else{
                return array('cardData' => $cardData, 'success' => 500);
            }

        }else{
            return back()->with('error', 'Something went wrong, Please try again');
          
        }
    } 

    public function update(Request $request){
        $request_params = [];
        $params = $request->all();
        $token = Session::get('Token', 'default');
        $header = array(
        'Authorization: Bearer '.$token[0]
        );
        $id  =  $params['card_id'];
          
        $paramsData['customer_token'] = $params['token'];
        $paramsData['card_token'] = $params['card_token'];
        $paramsData['exp_month'] = (int)$params['exp_month'];
        $paramsData['exp_year'] = (int)$params['exp_year'];
        $paramsData['description'] = Session::get('user.first_name');
        $paramsData['last4'] = $params['last4'];
        $paramsData['brand'] = $params['brand'];
        $paramsData['country'] = $params['country'];

        $paramsData = (is_array($paramsData)) ? http_build_query($paramsData) : $paramsData; 

    
        $url = 'http://api.dei.com.sg/api/card/'.$id;

        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        // curl_setopt ($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $paramsData);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($ch);

        curl_close($ch);

        $user = json_decode($content);
       // return (array)$user;
        if(isset($user->status)){
            if($user->status == 'success'){
                    $request->session()->flash('success', 'Card has been updated successfully!');
                
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
        }else if(isset($user->Card)){
                    $request->session()->flash('success', 'Card has been updated successfully!');

                return array('user' => $user, 'success' => 200);

        }

        else{
            return array( 'success' => 500);
        }
    }

    public function delete($id){
// return $id;
        // $token = Session::get('Token', 'default');
        $token = Cookie::get('Token', 'default');

        $header = array(
            'Authorization: Bearer '.$token
        );
        $params['id'] = $id;

        $params = (is_array($params)) ? http_build_query($params) : $params; 

    
        $url = 'http://api.dei.com.sg/api/card/delete/'.$id;

        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        // curl_setopt ($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($ch);

        curl_close($ch);

        $user = json_decode($content);
        $detail =  (array)$user;
       // return $detail[0];
          if(isset($user->success)){
            if ($user->success == true) {
                return back()->with('success', 'Address deleted successfully');
            }else{
                return back()->with('error', 'Something went wrong, please try again');

            }
        }else{
            return back()->with('error', 'Something went wrong, please try again');
        }

      //  if($detail[0] == 0){
      //   return back()->with('error', 'Something went wrong, please try again');
      //  }else{
      // return back()->with('success', 'Card deleted successfully');
      //  }

      
    }
   
}
