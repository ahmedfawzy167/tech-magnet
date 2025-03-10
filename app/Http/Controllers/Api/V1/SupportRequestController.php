<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\SupportRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Resources\SupportRequestCollection;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class SupportRequestController extends Controller
{
    use ApiResponder;

    public function store(StoreSupportRequest $request)
    {
        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }
        $support_request = new SupportRequest();
        $support_request->problem_description = $request->problem_description;
        $support_request->date = $request->date;
        $support_request->user_id = auth()->user()->id;
        $support_request->save();

        return $this->created($support_request, "Support Request Sent Successfully");
    }

    public function index()
    {
        if (!auth()->user()->hasRole('Operations')) {
            return $this->forbidden('Access Forbidden');
        }
        $support_requests = SupportRequest::with('user')->get();
        return $this->success(SupportRequestCollection::collection($support_requests));
    }
}
