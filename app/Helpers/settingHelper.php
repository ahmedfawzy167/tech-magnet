<?php

use App\Models\Setting;

function settings()
{
    $setting = Setting::first();
    return $setting;
}

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($routeName, $output = 'active')
    {
        return request()->routeIs($routeName) ? $output : '';
    }
}
