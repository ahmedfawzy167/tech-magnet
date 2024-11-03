<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;

class AddressController extends Controller
{
    use ApiResponder;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::where('user_id', auth()->id())->get();
        return $this->success(AddressResource::collection($addresses));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request)
    {
        try {
            Address::create([
                'address' => $request->address,
                'city_id' => $request->city_id,
                'user_id' => auth()->user()->id
            ]);

            $addresses = Address::where('user_id', auth()->user()->id)->get();
            return $this->created(AddressResource::collection($addresses), 'Address Created Successfully');
        } catch (\Exception $e) {
            return $this->notFound($e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        try {

            if ($address) {
                $address->update([
                    'address' => $request->address,
                    'city_id' => $request->city_id,
                ]);

                $addresses = Address::where('user_id', auth()->user()->id)->get();
                return $this->success(AddressResource::collection($addresses), 'Address Updated Successfully');
            }
        } catch (\Exception $e) {
            return $this->notFound($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return $this->notFound("Address Not Found");
        }

        $address->delete();
        $addresses = Address::where('user_id', auth()->user()->id)->get();
        return $this->success(AddressResource::collection($addresses), 'Adress Deleted Successfully');
    }
}
