<?php

namespace App\Http\Middleware;

use Closure;
use View;
use App\Helpers\deiAPI;
use Cookie;

class RefreshLaunch
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = Cookie::get('Token', 'default');
        $dei_api = new deiAPI();
        $launchAPI = $dei_api->launch($token);

        if (!isset($launchAPI->User)) {
            // In the event that we are not able to ge the User, let's just wait a sec and try again
            // To-Do: debug the actual cause of this issue.
            sleep(1);
            $launchAPI = $dei_api->launch($token);
        }

        $user = $launchAPI->User;
        View::share('user', $user);

        $home = $launchAPI->Home;

        $categories = [];
        if (isset($home->categories) && is_array($home->categories))
            $categories = $home->categories;
        View::share('launch_categories', $categories);

        $banners = [];
        if (isset($home->banner) && is_array($home->banner))
            $banners = $home->banner;
        View::share('launch_banners', $banners);

        $sections = [];
        if (isset($home->sections) && is_array($home->sections))
            $sections = $home->sections;
        View::share('launch_sections', $sections);

        $config = $launchAPI->Configuration;
//        View::share('launch_configuration', $config);

        $urls = [];
        if (isset($config->url) && is_array($config->url))
            $urls = $config->url;
        View::share('launch_urls', $urls);

        $social_types = [];
        if (isset($config->social_type) && is_array($config->social_type))
            $social_types = $config->social_type;
        View::share('social_types', $social_types);

        $gender = [];
        if (isset($config->gender) && is_array($config->gender))
            $gender = $config->gender;
        View::share('gender', $gender);

        $brands = [];
        if (isset($config->brands) && is_array($config->brands))
            $brands = $config->brands;
        View::share('launch_brands', $brands);

        $explore = [];
        if (isset($config->explore) && is_array($config->explore))
            $explore = $config->explore;
        View::share('launch_explore', $explore);
        config(['launch_explore' => $explore]);

        config(['launch_categories' => $categories]);
        config(['launch_brands' => $brands]);

        $current_experience = [];
        $current_explore = [];
        $experience = [];

        $exp_id = Cookie::get('experience_id');
        $new_visitor = false;
        if ($exp_id)
            $experience_id = $exp_id;
        else {
            $new_visitor = true;
            $exp_id = 1; // Set 1 as the default
        }
        View::share('new_visitor', $new_visitor);
        $experience_id = $exp_id ?? 1;
        // Cookie::queue(Cookie::make('experience_id', $experience_id, (86400 * 30))); // We should not set the experience_id cookie here. Experience_id must only be set from the intro modal or from the top nav
//        setcookie('experience_id', $experience_id, time() + (86400 * 30), "/");
        // loop through all of the Explore data and identify the current Experience

        foreach ($explore as $e) {
            foreach ($e->experience as $ex) {
                if ($ex->id == $experience_id) {
                    $current_experience = $ex;
                    $current_explore = $e;
                    $experience = $e->experience;
                }
            }
        }

        View::share('launch_experience', $experience);
        View::share('launch_current_explore', $current_explore);
        View::share('launch_current_experience', $current_experience);
        config(['launch_current_experience_id' => $current_experience->id]);

        $cart = $dei_api->cart_details($token);
        if (empty($cart->Cart))
            View::share('launch_cart', 'Your cart is empty');
        else
            View::share('launch_cart', $cart->Cart);

        View::share('launch_cart_product_count', $this->getCartProductCount($cart));

        return $next($request);
    }

    private function getCartProductCount($cart) {
        if (empty($cart->Cart)) {
            return 0;
        }

        $counter = 0;
        foreach ($cart->Cart->products as $p) {
            $counter += $p->quantity;
        }

        return $counter;
    }

}
