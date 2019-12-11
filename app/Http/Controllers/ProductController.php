<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Session;
use Cookie;
use View;
use AWS;
use OmiseToken;
use OmiseCustomer;
use App\Helpers\deiAPI;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Experience;
use App\Models\Explore;

class ProductController extends Controller
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
    public function index($id)
    {
        $token = Cookie::get('Token', 'default');
        $product = $this->dei_api->product($token, $id);
        if (empty($product))
            return back()->with('error', 'Product not found');
        $suggested_products = [];
        return view('/product_detail', compact('product', 'suggested_products'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $token = Cookie::get('Token', 'default');

        if (empty($request->search)) {
            $search = '';
            $products = $this->dei_api->products($token, "",['page' => 1]);;
        } else {
            $search = $request->search;
            $products = $this->dei_api->products($token, $search,['page' => 1]);
        }

        $headers = $products->Header[0];
        $products = $products->Products;

        $category_ids = explode(",", $headers->category_ids);
        $brand_ids = explode(",", $headers->brand_ids);

        return view('/search_result', compact('headers', 'category_ids', 'brand_ids', 'products', 'search'));
    }

    public function ajax_pagination(Request $request) {
        $token = Cookie::get('Token', 'default');
        $params = $request->all();

       
        if ($request->ajax()) {
            $page = $request->page;
            if ($request->search)
                $params['search'] = $request->search;
            if ($request->merchant_id)
                $params['merchant_ids'] = $request->merchant_id;
            if ($request->category_id)
                $params['category_ids'] = $request->category_id;
            $params['page'] = $page;
            if($request->route == 'merchant'){
                $products = $this->dei_api->merchant_products($token, $request->merchant_id, "", $params);
            }elseif($request->route == 'category'){
                $products = $this->dei_api->category_products($token, $request->category_id, "", $params);
            }else{
                $products = $this->dei_api->products($token, "", $params);
            }

            $append_products = [];
            foreach ($products->Products as $product) {
                $data = ['data' => ['value' => $product]];
                $product_html = View::make('productitem', $data);
                $append_products[] = $product_html->render();
            }
            return response()->json(['html'=>$append_products, 'params' => $params, 'products' => $products]);
        }

        return; // We do not want to entertain this call if it is not ajax.
    }
   

    public function get_products(Request $request){
        $params =  $request->all();
        $token = Cookie::get('Token', 'default');
        $id = $request->id;

        if (empty($request->search)) {
            $search = '';
            if($request->routeName == 'merchant'){
                $products = $this->dei_api->merchant_products($token, $id,'', $params);
            }elseif($request->routeName == 'category'){
                $id = $request->id;
                $products = $this->dei_api->category_products($token, $id,'', $params);
            }else{
                 $products = $this->dei_api->products($token, "",$params);
            }
        } else {
            $search = $request->search;

            if($request->routeName == 'merchant'){
                $products = $this->dei_api->merchant_products($token, $id,$search, $params);
            }elseif($request->routeName == 'category'){
                $products = $this->dei_api->category_products($token, $id,$search, $params);
            }else{
                $products = $this->dei_api->products($token, $search,$params);
            }
        }

        $headers = $products->Header[0];
        $products = $products->Products;

        $category_ids = explode(",", $headers->category_ids);
        $brand_ids = explode(",", $headers->brand_ids);
        $html = view('products', compact('products'))->render();
        return array('html' => $html, 'headers' => $headers, 'success' => 200);


    }



    public function get_profile(Request $request)
    {
        $token = Cookie::get('Token', 'default');
        $user = $this->dei_api->user_details($token);
        if (isset($user->User)) {
            $request->session()->put('user', (array)$user->User);

            $userDetail = (array)$user->User;
            // return $userDetail;
            // return $userDetail['first_name'];
            return view('myprofile', compact('userDetail'));
        } else {
            // return (array)$user;
            return back()->with('error', 'Unauthorized');
        }
    }

    private function s3_upload($upload_content_file)
    {

        $s3 = AWS::createClient('s3');
        $bucketName = env('AWS_BUCKET');
        $upload_content = time() . $upload_content_file->getClientOriginalName();

        $file_path = $s3->putObject(array(
            'Bucket' => $bucketName,
            'ACL' => 'public-read',
            'Key' => $upload_content,
            'SourceFile' => $upload_content_file,
        ));

        if ($file_path) {
            $url = $file_path->get('ObjectURL');
            $result = $upload_content;
        } else {
            $result = 'fail';
        }

        return $result;
    }

    public function update_profile(Request $request)
    {
        $params = $request->all();
        $update_params = (is_array($params)) ? http_build_query($params) : $params;

        $token = Cookie::get('Token', 'default');
        $user = $this->dei_api->user_update($token, $update_params);
        if (isset($user->status)) {
            if ($user->status == 'success') {
                $request->session()->put('user', (array)$user->User);
                $request->session()->flash('success', 'profile updated successfully!');

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
        } else if (isset($user->User)) {
            return array('user' => $user, 'success' => 200);
        } else {
            return array('success' => 500);
        }
    }

    public function upload_image(Request $request)
    {
        $update_params = [];
        $token = Cookie::get('Token', 'default');
        $user = $this->dei_api->user_details($token);
        if (isset($user->User)) {
//            $request->session()->put('user', (array) $user->User);
            $update_params['first_name'] = $user->User->first_name;
            $update_params['last_name'] = $user->User->last_name;
            $update_params['birthday'] = $user->User->birthday;
            $update_params['gender'] = $user->User->gender;
            $update_params['photo_url'] = env('AWS_BUCKET_URL') . '/' . $this->s3_upload($request->file);
            $update_params = (is_array($update_params)) ? http_build_query($update_params) : $update_params;

            $user = $this->dei_api->user_update($token, $update_params);
            if (isset($user->status)) {
                if ($user->status == 'success') {
//                    $request->session()->put('user', (array) $user->User);
                    $request->session()->flash('success', 'profile updated successfully!');

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
            } else if (isset($user->User)) {
//                $request->session()->put('user', (array) $user->User);
                $request->session()->flash('success', 'profile updated successfully!');

                return array('user' => $user, 'success' => 200);
            } else {
                return array('success' => 500);
            }
        }
    }

    public function change_password(Request $request)
    {
        $token = Cookie::get('Token', 'default');
        $user = $this->dei_api->user_details($token);
        if (isset($user->User)) {
//            $request->session()->put('user', (array) $user->User);
            $userDetail = (array)$user->User;
            return view('change_password', compact('userDetail'));
        } else {
            return back()->with('error', $user->error->message);
        }
    }

    public function change_userpassword(Request $request)
    {
        $params = $request->all();

        $params['password'] = ($params['password'] != null) ? $params['password'] : '';
        $params = (is_array($params)) ? http_build_query($params) : $params;

        $token = Cookie::get('Token', 'default');
        $user = $this->dei_api->change_password($token, $params);
        if (isset($user->status)) {
            if ($user->status == 'success') {
//                $request->session()->put('user', (array) $user->User);
                $request->session()->flash('success', 'password updated successfully!');

                return array('user' => $user, 'success' => 200);
            } else if ($user->status == 'error') {
                return array('user' => $user, 'success' => 400);
            } else {
                $request->session()->flash('error', 'Something went Wrong, please try again!');

                return array('success' => 500);
            }
        } else if (isset($user->success)) {
            if ($user->success == false) {

                return array('user' => $user, 'success' => 300);
            }
        } else if (isset($user->User)) {
            $request->session()->flash('success', 'password updated successfully!');

            return array('user' => $user, 'success' => 200);
        } else {
            $request->session()->flash('error', 'Something went Wrong, please try again!');

            return array('success' => 500);
        }
    }

    public function get_card()
    {
        $token = Cookie::get('Token', 'default');
        $header = array(
            'Authorization: Bearer pkey_test_5hkgtakuchkiwr5hvpn'
        );

        $url = 'https://vault.omise.co/tokens/tokn_test_5hnx5huyra8ng8tnf12';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt ($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        // curl_setopt ($ch, CURLOPT_POSTFIELDS, $params);
        // curl_setopt ($ch, CURLOPT_USERPWD, $params['password']);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($ch);

        curl_close($ch);

        echo "<pre>";
        print_r($content);
        die();
    }

}
