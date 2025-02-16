<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Banner;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;

class BannerController extends Controller
{
    use ApiResponder;

    /**
     * Display a listing of the resource.
     */
   
     public function index(Request $request)
     {
         $query = Banner::with(['image', 'locations']);
     
         if ($request->has('location')) {
             $locationName = $request->query('location');
             $query->whereHas('locations', function ($q) use ($locationName) {
                 $q->where('name', $locationName);
             });
         }
     
         $banners = $query->get();
         
         return $this->success(BannerResource::collection($banners));
     }


    /**
     * Display the specified resource.
     */
    
     public function show(Banner $banner)
     {
         if ($banner != null) {
             return $this->success(new BannerResource($banner));
         } else {
             return $this->notFound("Banner Not Found");
         }
     }

 






}
