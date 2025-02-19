<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use ApiResponder;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::with('country')->get();
        return $this->success(CityResource::collection($cities));
    }


    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        if ($city != null) {
            return $this->success(new CityResource($city));
        } else {
            return $this->notFound("City Not Found");
        }
    }

}
