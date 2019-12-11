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

class OrderController extends Controller
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
     * Show the orders list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $token = Cookie::get('Token', 'default');
        $orders = $this->dei_api->user_orders($token);
        return view('/order_list', compact('orders'));
    }

}
