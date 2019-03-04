<?php
/**
 * Created by PhpStorm.
 * User: thienhmp
 * Date: 03/03/2019
 * Time: 19:25
 */

namespace App\Http\Middleware;


use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class Locale
{
    public function handle($request, \Closure $next){
        if (!Session::has('website_language')) {
            Session::put('website_language', config('app.locale'));
        }
        Lang::setLocale(Session::get('website_language'));
        return $next($request);
    }

}