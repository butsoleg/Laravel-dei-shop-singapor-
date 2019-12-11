<?php

namespace App\Helpers;

use Cookie;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Experience;
use App\Models\Explore;

class deiAPI
{

    public $api_url = 'http://api.dei.com.sg/api/';

    public function launch($token = "")
    {
        $request_api = $this->api_url . 'pageview';
        $launch_response = $this->call_api("GET", $request_api, $token, null);
        $result = json_decode($launch_response);
//        $this->insert_update_brands($result);
//        $this->insert_update_category($result);
//        $this->insert_update_explore($result);
        return $result;
    }

    public function product($token, $id)
    {
        $request_api = $this->api_url . 'product/' . $id . '/detail';
        $launch_response = $this->call_api("GET", $request_api, $token, null);
        $result = json_decode($launch_response);
        return empty($result->Product) ? [] : $result->Product;
    }

    public function user_orders($token)
    {
        $request_api = $this->api_url . 'customer/orders';
        $orders = $this->call_api("GET", $request_api, $token, null);
        $result = json_decode($orders);
        return empty($result->Orders) ? [] : $result->Orders;
    }

    public function products($token, $search = '', $params = [])
    {
        $requested_params = $this->get_product_params($params, $search);


        $query = $this->convertParamsToQueryString($requested_params);
        $request_api = $this->api_url . 'products?' . $query;
        $launch_response = $this->call_api("GET", $request_api, $token, null);
        return json_decode($launch_response);
    }

    public function merchant_products($token, $id,$search = '', $params = [])
    {
        $requested_params = $this->get_product_params($params, $search);

        $query = $this->convertParamsToQueryString($requested_params);
        $request_api = $this->api_url . 'merchant/'.$id.'/products?' . $query;
        $launch_response = $this->call_api("GET", $request_api, $token, null);
        return json_decode($launch_response); 
    } 
    public function category_products($token, $id,$search = '', $params = [])
    {
        $requested_params = $this->get_product_params($params, $search);

        $query = $this->convertParamsToQueryString($requested_params);
        $request_api = $this->api_url . 'category/'.$id.'/products?' . $query;
        $launch_response = $this->call_api("GET", $request_api, $token, null);
        return json_decode($launch_response); 
    }

    public function autocomplete_search($token, $search) {
        $params = [];
        if (!empty($search))
            $params['search'] = urlencode($search);
        else
            return [];
        $query = $this->convertParamsToQueryString($params);
        $request_api = $this->api_url . 'search?' . $query;
        $response = $this->call_api("GET", $request_api, $token, null);
        return json_decode($response);
    }

    public function category_product($token, $id, $params = [])
    {
        if (!isset($params['items_per_page'])) 
            $params['items_per_page'] = 20;
        $query = $this->convertParamsToQueryString($params);
        $request_api = $this->api_url . 'category/' . $id . '/products?'.$query;
        $launch_response = $this->call_api("GET", $request_api, $token, null);
        return json_decode($launch_response);
    }

    public function merchant_product($token, $id, $params = [])
    {
        if (!isset($params['items_per_page'])) 
            $params['items_per_page'] = 20;
        $query = $this->convertParamsToQueryString($params);
        $request_api = $this->api_url . 'merchant/' . $id . '/products?'.$query;
        $launch_response = $this->call_api("GET", $request_api, $token, null);
        return json_decode($launch_response);
    }

    public function merchant_detail($token, $id)
    {
        $request_api = $this->api_url . 'merchant/' . $id . '/detail';
        $launch_response = $this->call_api("GET", $request_api, $token, null);
        return json_decode($launch_response);
    }

    public function customer_config($token, $params)
    {
        $request_api = $this->api_url . 'customer/config';
        $launch_response = $this->call_api("POST", $request_api, $token, $params);
        return json_decode($launch_response);
    }

    public function address_details($token, $params = [])
    {
        $request_url = $this->api_url . 'address';
        if (!empty($params)) {
            $request_params = [];
            foreach ($params as $key => $value) {
                $request_params[] = $key . '=' . $value;
            }
            $request_url .= '?' . implode('&', $request_params);
        }
        $response = $this->call_api("GET", $request_url, $token, null);
        return json_decode($response);
    }

    public function address_add($token, $params = null)
    {
        $request_url = $this->api_url . 'address/add';
        $response = $this->call_api("POST", $request_url, $token, $params);
        return json_decode($response);
    }

    public function address_update($token, $id, $params = null)
    {
        $request_url = $this->api_url . 'address/' . $id;
        $response = $this->call_api("PUT", $request_url, $token, $params);
        return json_decode($response);
    }

    public function address_delete($token, $id)
    {
        $request_url = $this->api_url . 'address/delete/' . $id;
        $response = $this->call_api("DELETE", $request_url, $token, null);
        return json_decode($response);
    }

    public function user_details($token)
    {
        $request_url = $this->api_url . 'customer/detail';
        $response = $this->call_api("GET", $request_url, $token, null);
        return json_decode($response);
    }

    public function cards_get($token)
    {
        $request_url = $this->api_url . 'card';
        $response = $this->call_api("GET", $request_url, $token, null);
        return json_decode($response);
    }

    public function checkout_get($token, $params = null)
    {
        $request_url = $this->api_url . 'checkout';
        if (!empty($params)) {
            $request_params = [];
            foreach ($params as $key => $value) {
                $request_params[] = $key . '=' . $value;
            }
            $request_url .= '?' . implode('&', $request_params);
        }
        $response = $this->call_api("GET", $request_url, $token, null);
        return json_decode($response);
    }

    public function apply_promocode($token, $params = null){
          $request_url = $this->api_url . 'cart/promotion';
     
        $response = $this->call_api("POST", $request_url, $token, $params);
        return json_decode($response);
    }

    public function cart_details($token)
    {
        $request_url = $this->api_url . 'cart';
        $response = $this->call_api("GET", $request_url, $token, null);
        return json_decode($response);
    }

    public function cart_add($token, $params)
    {
        $request_url = $this->api_url . 'cart/add';
        $response = $this->call_api("POST", $request_url, $token, $params);
        return json_decode($response);
    }

    public function cart_update($token, $params)
    {
        $request_url = $this->api_url . 'cart/edit';
        $response = $this->call_api("PUT", $request_url, $token, $params);
        return json_decode($response);
    } 
    
    public function cart_delete($token, $id, $params)
    {
        $request_url = $this->api_url . 'cart/'.$id.'/product/delete?cart_product_id='.$params['cart_product_id'];
        $response = $this->call_api("DELETE", $request_url, $token,null);
        return json_decode($response);
    } 

    public function user_update($token, $params)
    {
        $request_url = $this->api_url . 'customer/update';
        $response = $this->call_api("PUT", $request_url, $token, $params);
        return json_decode($response);
    }

    public function change_password($token, $params)
    {
        $request_url = $this->api_url . 'customer/password';
        $response = $this->call_api("PUT", $request_url, $token, $params);
        return json_decode($response);
    }

    public function forgot_password($token, $params)
    {
        $request_url = $this->api_url . 'forgot';
        $response = $this->call_api("POST", $request_url, $token, $params);
        return json_decode($response);
    }

    public function forgot_verify($token, $params)
    {
        $request_url = $this->api_url . 'forgot/verify';
        $response = $this->call_api("POST", $request_url, $token, $params);
        return json_decode($response);
    }

    public function user_login($token, $params)
    {
        if ($token) {
            $launch = $this->launch($token);
            if ($launch->User && $launch->User !== null)
                return (array) $launch;
        }
        
        $request_url = $this->api_url . 'customer/login';
        $response = $this->call_api("POST", $request_url, null, $params);
        return json_decode($response);
    }

    public function user_register($token, $params)
    {
        $request_url = $this->api_url . 'customer/register';
        $response = $this->call_api("POST", $request_url, $token, $params);
        return json_decode($response);
    }

    public function get_object_by_id($object_array, $id, $nested = false) {
        foreach ($object_array as $o) {
            if ($o->id == $id) return $o;
            if ($nested && is_string($nested) && isset($o->$nested) && count($o->$nested) > 0) {
                $object = $this->get_object_by_id($o->$nested, $id, $nested);
                if ($object) return $object;
            }
        }
        return false;
    }

    public function get_request($token, $url = '', $params = null)
    {
        $request_url = $this->api_url . $url;
        if (!empty($params)) {
            $request_params = [];
            foreach ($params as $key => $value) {
                $request_params[] = $key . '=' . $value;
            }
            $request_url .= '?' . implode('&', $request_params);
        }
        $response = $this->call_api("GET", $request_url, $token, null);
        return json_decode($response);
    }

    private static function call_api($verb, $api_url, $token, $params, $is_json = false)
    {
        if ($is_json) {
            $body = json_encode($params); // Where are you using this $body? Check the register API, it uses the json body.
        }
        if ($token) {
            $header = array(
                'Authorization: Bearer ' . $token
            );
        }

        $exp_id = Cookie::get('experience_id');
        if ($exp_id) {
            $header[] = 'X-Client-ExperienceID: '.$exp_id;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        // curl_setopt ($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $verb);
        if ($token)
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        if ($params != null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }
    private static function get_product_params($params, $search)
    {
         $search_params = '';
        if (!empty($params)){
            if(isset($params['search'])){
                $params['search'] = urlencode($params['search']);
            }
        }
        if (!empty($search))
            $params['search'] = urlencode($search);
        if (!isset($params['items_per_page'])) 
            $params['items_per_page'] = 20; 
        if(empty($params['brand_ids']))
            unset($params['brand_ids']);
        if(empty($params['category_ids']))
            unset($params['category_ids']); 
        if(empty($params['sort_by']))
            unset($params['sort_by']);
        if (isset($params['price_min']) && !empty($params['price_min'])) {
            $params['price_min'] =  intval($params['price_min']); 
        }else{
            unset($params['price_min']);
        }
        if (isset($params['price_max']) && $params['price_max'] != ''){ 
            $params['price_max'] = intval($params['price_max']); 
        }else{
            unset($params['price_max']);
        }
        if (!isset($params['items_per_page'])) 
            $params['items_per_page'] = 20;
        return $params;
    }

    private function insert_update_brands($launchAPI)
    {
        $brands_insert = array();

        $brands_exist = Brands::get()->pluck('id')->toArray();

        foreach ($launchAPI->Configuration->brands as $brand) {
            $brand_object = collect($brand);
            if (in_array($brand->id, $brands_exist)) {
                Brands::where('id', $brand->id)->update($brand_object->toArray());
            } else {
                $brands_insert[] = $brand_object->toArray();
            }
        }

        Brands::insert($brands_insert);
    }

    private function insert_update_category($launchAPI)
    {
        $category_insert = array();

        $category_exist = Category::get()->pluck('id')->toArray();

        foreach ($launchAPI->Home->categories as $category) {
            $parent_arr = collect($category)->toArray();
            $parent_id = $parent_arr['id'];

            foreach ($parent_arr['category'] as $child) {
                $child_arr = collect($child)->toArray();
                unset($child_arr['category']);
                $child_arr['parent_category'] = $parent_id;

                if (in_array($child_arr['id'], $category_exist)) {
                    Category::where('id', $child_arr['id'])->update($child_arr);
                } else {
                    $category_insert[] = $child_arr;
                }
            }

            unset($parent_arr['category']);
            $parent_arr['parent_category'] = 0;

            if (in_array($parent_arr['id'], $category_exist)) {
                Category::where('id', $parent_arr['id'])->update($parent_arr);
            } else {
                $category_insert[] = $parent_arr;
            }
        }

        // dd($category_insert);
        Category::insert($category_insert);
    }

    private function insert_update_explore($launchAPI)
    {

        // NOTE: progress insert update explore
        $explore_insert = array();
        $experience_insert = array();

        $explore_exist = Explore::get()->pluck('id')->toArray();
        $experience_exist = Experience::get()->pluck('id')->toArray();

        foreach ($launchAPI->Configuration->explore as $explore) {
            if (!empty($explore->experience)) {
                $explore_arr = collect($explore)->toArray();
                foreach ($explore->experience as $exp) {
                    $experience = array_merge((array) $exp, ['explore_id' => $explore->id]);
                    if (in_array($experience['id'], $experience_exist)) {
                        Experience::where('id', $experience['id'])->update($experience);
                    } else {
                        $experience_insert[] = $experience;
                    }
                }
                Experience::insert($experience_insert);
            }
            $explore_arr = collect($explore)->toArray();
            unset($explore_arr['experience']);

            if (in_array($explore->id, $explore_exist)) {
                Explore::where('id', $explore->id)->update($explore_arr);
            } else {
                $explore_insert[] = $explore_arr;
            }
        }

        Explore::insert($explore_insert);
    }

    private function convertParamsToQueryString($params = []) {
        $return = "";
        $implode = [];
        foreach ($params as $k => $v) {
            $implode[] = $k.'='.$v;
        }

        return implode('&', $implode);
    }

}
