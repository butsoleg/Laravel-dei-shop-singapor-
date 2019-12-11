<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Response;
use Session;
use Cookie;
use AWS;
use App\Helpers\deiAPI;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Experience;
use App\Models\Explore;

class SearchController extends BaseController
{

    private $dei_api;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->dei_api = new deiAPI();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $token = Cookie::get('Token', 'default');
        $results = $this->dei_api->autocomplete_search($token, $request->search);
        return array('status' => 'success', 'result' => $results);
    }

}
