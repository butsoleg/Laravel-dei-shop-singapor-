<?php

namespace App\Http\Controllers;

use App\Helpers\deiAPI;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public $dei_api;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        define('OMISE_PUBLIC_KEY', 'pkey_test_5hkgtakuchkiwr5hvpn');
        $this->dei_api = new deiAPI();
        $this->middleware('refresh_launch');
    }

    public static function getMainCategories($categories) {
        if (!is_array($categories))
            return [];

        $return = [];

        // Get full list of Categories as Tree
        $launch_categories = config('launch_categories');
        $top_level = self::getCategoriesIn($launch_categories, $categories);
        if (count($top_level) === 1) {
            $second_level = self::getCategoriesIn($top_level[0]->category, $categories);

            if (count($second_level) > 0)
                return $second_level;
        }
        else if (count($top_level) > 1) {
            return $top_level;
        }
        
        return $return;
    }

    public static function setCategoryToURL($url, $category_id) {
        if (substr_count($url, 'category_id=')) {
        }

        return self::appendQueryToURL($url, 'category_id='.$category_id);

    }

    public static function appendQueryToURL($url, $query) {
        $append = '';
        if (substr_count($url, '?')) {
            $append = '&';
        }
        else {
            $append = '?';
        }

        return $url.$append.$query;
    }

    private static function getCategoriesIn($categories, $cat_ids) {
        $return = [];
        foreach ($categories as $cat) {
            if (in_array($cat->id, $cat_ids))
                $return[] = $cat;
        }

        return $return;
    }

}
