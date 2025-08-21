<?php


namespace App\Services\Main;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class Service
{


    public static function get_location()
    {
        $ip = @$_SERVER['REMOTE_ADDR'];
        $location = Cookie::get('user_id');

        if ($location)
            return $location;
        elseif ($ip = "127.0.0.1")
            return "Локальный компьютер";

        $url = 'http://ip-api.com/json/' . $ip . '?lang=ru';
        $response = file_get_contents($url);
        $location_data = json_decode($response, 1);
        $location = @$location_data['country'] . ' ' . @$location_data['city'];
        Cookie::queue('location', $location, 60 * 60 * 24 * 365);
        return trim($location);
    }

    public static function date_info()
    {
        $workdays = [1 => 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'];
        $workday = $workdays[(int)date('N')];
        $date = date_parse(date('Y-m-d'));
        $months = [1 => 'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
        $month = $months[$date['month']];
        $time = '<span id="header-timer">' . date('H:i') . '</span>';
        return "<span class='datetime-string'>$workday, $date[day] $month $date[year] $time</span>";
    }


    public static function get_header_categories()
    {
        $data = DB::table('categories')
            ->where([
                "is_active" => 1,
                "is_hidden" => 0,
                "parent_id" => 0,
                //"deleted_at" => null,
            ])
            ->orderBy('name')
            ->get();
        return $data;
    }

}
