<?php


namespace App\Services\Main;

use Illuminate\Support\Facades\Cookie;

class Service
{


    public static function get_location()
    {
        $location = Cookie::get('user_id');

        if ($location)
            return $location;

        $url = 'http://ip-api.com/json/' . @$_SERVER['REMOTE_ADDR'] . '?lang=ru';
        $response = file_get_contents($url);
        $location_data = json_decode($response, 1);
        $location = @$location_data['country'] . ' ' . @$location_data['city'];
        Cookie::queue('location', $location, 60 * 60 * 24 * 365);
        //setcookie('location', $location, time() + 60 * 60 * 24 * 365, '/');
        return trim($location);
    }

}
