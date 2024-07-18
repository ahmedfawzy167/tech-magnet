<?php

namespace App\Http\Controllers\Api;

use App\Models\SupportRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupportRequestCollection;
use Illuminate\Http\Request;

class SupportRequestController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(SupportRequest::class);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'problem_description' => 'required|string|max:800',
            'date' => 'required|date_format:Y-m-d H:i:s',
            'user_id' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $support_request = new SupportRequest();
        $support_request->problem_description = $request->problem_description;
        $support_request->date = $request->date;
        $support_request->user_id = $request->user_id;
        $support_request->save();

        return response()->json([
            "status" => 'Success',
            "message" => "Support Request Sent Successfully!",
        ], 201);
    }

    public function index()
    {
        $support_requests = SupportRequest::with('user')->get();
        return SupportRequestCollection::collection($support_requests);
    }
}
