<?php

use App\Models\Setting;

if (!function_exists('settings')) {
    function settings()
    {
        $setting = Setting::first();
        return $setting;
    }
}

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($routeName, $output = 'active')
    {
        return request()->routeIs($routeName) ? $output : '';
    }
}

if (!function_exists('getPath')) {
    function getPath($folder,$id,$postfix = null)
    {
        if ($postfix == null) return null;

        if (filter_var($postfix, FILTER_VALIDATE_URL)) {
            return $postfix;
        }
        return asset('storage/' . $folder . '/' . $id . '/' . $postfix);
    }
}
