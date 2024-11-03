<?php

namespace App\Http\Controllers\Api;

use App\Models\Bundle;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BundleResource;

class BundleController extends Controller
{
    use ApiResponder;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bundles = Bundle::all();
        return $this->success(BundleResource::collection($bundles));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bundle = Bundle::find($id);

        if ($bundle != null) {
            return $this->success(new BundleResource($bundle));
        } else {
            return $this->notFound("Bundle Not Found");
        }
    }
}
