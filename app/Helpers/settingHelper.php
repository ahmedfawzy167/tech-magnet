<?php

use App\Models\Setting;

function settings()
{
    $setting = Setting::first();
    return $setting;
}
