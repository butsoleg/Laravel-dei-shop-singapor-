<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use AWS;
use OmiseToken;
use OmiseCustomer;
use App\Helpers\deiAPI;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Experience;
use App\Models\Explore;

use Config;

use Mail;

use App\Mail\EmailSend;

class HomeController extends Controller
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
        return view('home');
    }

    /**
     * Privacy policy page
     *
     */
    public function privacy()
    {
        return view('privacy')->with([]);
    }

    /**
     * Terms and conditions page
     *
     */
    public function terms()
    {
        return view('terms')->with([]);
    }

    public function select_experience($id) {
        // Validate if the id is a valid experience
        $explore = config('launch_explore');
        $valid = false;
        foreach ($explore as $e) {
            foreach ($e->experience as $ex) {
                if ($id == $ex->id)
                    $valid = true;
            }
        }
        if ($valid === false)
            return redirect()->route('home');

        Cookie::queue(Cookie::make('experience_id', $id, (86400 * 365)));
        $configparams['experience_id'] = $id;
        $token = Cookie::get('Token', 'default');
        $this->dei_api->customer_config($token, $configparams);
        return redirect()->route('home');
    }


    public function merchant(Request $request,$id)
    {
        $token = Cookie::get('Token', 'default');
        $params = ['page' => 1];
        if (!empty($request->get('category_id'))) {
            $params = ['category_ids' => $request->get('category_id')];
        }
        
        $merchant_product = $this->dei_api->merchant_product($token, $id, $params);
        $merchant_detail = $this->dei_api->merchant_detail($token, $id);
        $headers = $merchant_product->Header[0];
        $products = $merchant_product->Products;
        $category_ids = explode(",", $headers->category_ids);
        $brand_ids = explode(",", $headers->brand_ids);
        $merchant_products = [];
        $merchant_details = $merchant_detail->Merchant;
        $merchant_sections = $merchant_detail->Sections;

        foreach ($merchant_product->Products as $value) {
            $merchant_products[] = $value;
        }
        return view('/get_store', compact('merchant_products', 'merchant_details', 'merchant_sections', 'headers', 'category_ids', 'brand_ids', 'products'));
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

    private function s3_upload($user_id, $upload_content_file)
    {

        $s3 = AWS::createClient('s3', ['region' => env('AWS_DEFAULT_REGION')]);
        $bucketName = env('AWS_BUCKET');
//        $upload_content = time() . $upload_content_file->getClientOriginalName();
        $s3Path = "customer/customer-$user_id/profile-photo-" . $upload_content_file->getClientOriginalName();

        $file_path = $s3->putObject(array(
            'Bucket' => $bucketName,
            'ACL' => 'public-read',
            'Key' => $s3Path,
            'SourceFile' => $upload_content_file,
        ));

        if ($file_path) {
            $url = $file_path->get('ObjectURL');
            $result = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $s3Path;
        } else {
            $result = 'fail';
        }

        return $result;
    }

    public function update_profile(Request $request)
    {
        $params = $request->all();

        $params = (is_array($params)) ? http_build_query($params) : $params;
        // return view('myprofile',compact('userDetail'));

        $token = Cookie::get('Token', 'default');
        // $user = $this->dei_api->user_details($token);
        $user = $this->dei_api->user_update($token, $params);
        if (isset($user->status)) {
            if ($user->status == 'success') {
//                $request->session()->put('user', (array) $user->User);
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
                $request->session()->flash('success', 'profile updated successfully!');

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
            $update_params['photo_url'] = $this->s3_upload($user->User->id, $request->file);
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
        // return (array)$user;
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

    /**
     * About Us page
     *
     */
    public function about_us() {
        return view('about_us');
    }

    /**
     * Contact Us page
     *
     */
    public function contact_us() {
        return view('contact_us');
    }

    /**
     * Gift Certificates page
     *
     */
    public function gift_certificates() {
        return view('gift_certificates');
    }


    /**
     * FAQ page
     *
     */
    public function faq() {
        return view('faq');
    }

    /**
     * Vendor Regsiter page
     *
     */
    public function vendor_register() {
        return view('vendor_register');
    }

    /**
     * Email Send
     *
     */
    public function email_send(Request $request)
    {

        $email = 'sudhan@dei.com.sg';

        if ($request->isMethod('post')) {

            if ($request->input('from_page') == 'gift_certificates') {
                $request_content = $request->input('gift_cert_data'); 
                
                $to_name = $request->input('gift_cert_data')['recipient'];

                $subject = 'Gift Certificates';
                $content = $request->input('gift_cert_data')['message'];
                $from_email = $request->input('gift_cert_data')['email'];
                $from_name = $request->input('gift_cert_data')['sender'];
                $amount = $request->input('gift_cert_data')['amount'];
                $send_via = $request->input('gift_cert_data')['send_via'];

                try {
                    Mail::to(trim($email), $to_name)
                        ->send(new EmailSend($subject, $content, $from_email, $from_name, $to_name, $amount, $send_via));

                } catch ( Exception $e ) {
                    Log::error('EmailTemplate.php@send:' . $e->getMessage());
                }

                return redirect()->route('gift_certificates');
            } elseif ($request->input('from_page') == 'contact_us') {
                $request_content = $request->input('form_values'); 

                $to_name = '';

                $subject = 'Contact Us';
                $content = $request_content['content'];
                $from_email = $request_content['email'];
                $from_name = $request_content['name'];

                try {
                    Mail::to(trim($email), $to_name)
                        ->send(new EmailSend($subject, $content, $from_email, $from_name));

                } catch ( Exception $e ) {
                    Log::error('EmailTemplate.php@send:' . $e->getMessage());
                }

                return redirect()->route('contact_us');
            } elseif ($request->input('from_page') == 'vendor_register') {
                $request_content = $request->input('company_data'); 

                $to_name = '';

                $subject = 'Vendor Register';
                $to_name = '';
                $amount = '';
                $send_via = '';
                $company = $request_content['company'];
                $company_description = $request_content['company_description'];
                $admin_firstname = $request_content['admin_firstname'];
                $admin_lastname = $request_content['admin_lastname'];
                $from_name = '';
                $from_name .= $admin_firstname;
                $from_name .= ' ';
                $from_name .= $admin_lastname;
                $from_email = $request_content['email'];
                $phone = $request_content['phone'];
                $url = $request_content['url'];
                $fax = $request_content['fax'];
                $user_data = $request_content['user_data'];
                $address = $request_content['address'];
                $city = $request_content['city'];
                $country = $request_content['country'];
                $state = $request_content['state'];
                $zipcode = $request_content['zipcode'];




                try {
                    Mail::to(trim($email), $to_name)
                        ->send(new EmailSend($subject, $company_description, $from_email, $from_name, $to_name, $amount, $send_via, $company, $phone, $url, $fax, $user_data, $address, $country, $state, $city, $zipcode));

                } catch ( Exception $e ) {
                    Log::error('EmailTemplate.php@send:' . $e->getMessage());
                }

                return redirect()->route('vendor_register');
            }
                        
        }
        
    }

    /**
     * News letter sign up
     *
     */
    public function newsletter_signup(Request $request)
    {

        $email = 'sudhan@dei.com.sg';
        $name = '';
        $subject = 'Newsletter Signup';
        $content = '';

        if ($request->isMethod('post')) {

            $from_email = $request->input('subscribe_email');

            try {
                Mail::to(trim($email), $name)
                    ->send(new EmailSend($subject, $content, $from_email));

            } catch ( Exception $e ) {
                Log::error('EmailTemplate.php@send:' . $e->getMessage());
            }

            return redirect()->route('home');
                        
        }
        
    }

    /**
     * FAQ Registeration page
     *
     */
    public function faq_registration() {
        return view('faq_registration');
    }

    /**
     * FAQ Account Related page
     *
     */
    public function faq_account_related() {
        return view('faq_account_related');
    }

    /**
     * FAQ Payment page
     *
     */
    public function faq_payment() {
        return view('faq_payment');
    }

    /**
     * FAQ Delivery Related page
     *
     */
    public function faq_delivery_related() {
        return view('faq_delivery_related');
    }

    /**
     * FAQ Order Related page
     *
     */
    public function faq_order_related() {
        return view('faq_order_related');
    }

    /**
     * FAQ Customer Related page
     *
     */
    public function faq_customer_related() {
        return view('faq_customer_related');
    }

    /**
     * FAQ How Does It Work page
     *
     */
    public function faq_how_does_it_work() {
        return view('faq_how_does_it_work');
    }

    /**
     * FAQ Others page
     *
     */
    public function faq_others() {
        return view('faq_others');
    }

}
