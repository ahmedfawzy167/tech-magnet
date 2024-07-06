<?php

namespace App\Http\Controllers\Api;
use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return response()->json($cities);
    }

    public function show($id)
    {
        $city = City::find($id);
        if($city != null){
            return response()->json($city);
        }
        else{
            return response()->json([
                "status" => "error",
                "message"  => "City Not Found"
            ],404);
        }
    }


}
