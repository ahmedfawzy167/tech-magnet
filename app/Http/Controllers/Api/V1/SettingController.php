<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Traits\ApiResponder;

class SettingController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $settings = Setting::all();
        return $this->success(SettingResource::collection($settings));
    }
}
