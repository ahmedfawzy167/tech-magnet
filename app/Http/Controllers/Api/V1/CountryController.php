<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Country;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    use ApiResponder;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::with('cities')->get();
        return $this->success(CountryResource::collection($countries));
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        $country->load('cities');
        if ($country != null) {
            return $this->success(new CountryResource($country));
        } else {
            return $this->notFound("Country Not Found");
        }
    }

   
}
