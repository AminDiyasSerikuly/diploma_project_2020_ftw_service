<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use Session;
use App\City;
use GeoLocation;

class Cities
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
        $raw_city='';
        $geoLocation = GeoLocation::get(request()->ip());
        if(Session::get('city')){
            $raw_city = Session::get('city');
        }
        else{
            $q = \App\City::where('param', $geoLocation->getCityName())->get();
            foreach($q as $r){
                $raw_city = $r->name;
            }
        }
        if (in_array($raw_city, \App\City::getCities())) { 
            $city = $raw_city; 
        }
        else $city = Config::get('app.city'); 
        Config::set('app.city', $city);  
        return $next($request);
    }
}
