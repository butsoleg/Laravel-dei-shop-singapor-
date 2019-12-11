<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use AWS;
use Illuminate\Support\Facades\Cookie;



class CommonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public static function call_api( $verb, $api_url, $params){
    
        $token = Cookie::get('Token', 'default');
        
       
        $header = array(
            'Authorization: Bearer '.$token
        );
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $api_url);
        // curl_setopt ($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $verb);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        if ( $params!= null ){
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($ch);
            curl_close($ch);

        $user = json_decode($content);

        return $user;
        
    }

    public static function getPostCurl($url, $params){
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        // curl_setopt ($ch, CURLOPT_POST, true);
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($ch);

        curl_close($ch);

        $user = json_decode($content);

        return $user;
    }
    public static function getPostwithheaderCurl($url, $params){
        $token = Cookie::get('Token', 'default');
        
        
         $header = array(
            'Authorization: Bearer '.$token
        );
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        // curl_setopt ($ch, CURLOPT_POST, true);
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($ch);

        curl_close($ch);

        $user = json_decode($content);

        return $user;
    } 
    public static function getheaderCurl($url){
        $token = Cookie::get('Token', 'default');

        // $token = Session::get('Token', 'default');

         $header = array(
            'Authorization: Bearer '.$token
        );
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        // curl_setopt ($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($ch);

        curl_close($ch);

        $user = json_decode($content);

        return $user;
    }
  

  
}
