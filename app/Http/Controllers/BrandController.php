<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Cookie;
use AWS;
use OmiseToken;
use OmiseCustomer;
use App\Helpers\deiAPI;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Experience;
use App\Models\Explore;

class BrandController extends Controller
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
    public function index(Request $request)
    {
        $launch_brands = config('launch_brands');
        $brand_id = $request->id;
        $brand = $this->dei_api->get_object_by_id($launch_brands, $brand_id, 'brand');
        $category = false;

        if (!$brand)
            abort(404);

        $token = Cookie::get('Token', 'default');
        $params = [];
        $search = "";
        
        if (!empty($request->search)) {
            $params['search'] = $request->search;
            $search = $params['search'];
        }

        $products = $this->dei_api->category_product($token, 151, $params);
        $headers = $products->Header[0];
        $products = $products->Products;
        $category_ids = explode(",", $headers->category_ids);
        $brand_ids = explode(",", $headers->brand_ids);

        return view('/search_result', compact('category', 'brand', 'headers', 'category_ids', 'brand_ids', 'products', 'search'));
    }
}
