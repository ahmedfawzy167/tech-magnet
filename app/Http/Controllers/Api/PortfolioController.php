<?php

namespace App\Http\Controllers\Api;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioResource;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Portfolio::class);
    }

    public function index()
    {
        $portfolios = Portfolio::with(['user', 'course'])->get();

        return PortfolioResource::collection($portfolios);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file'  => 'required|file|mimes:pdf|max:2048',
            'issue_date' => 'required|date_format:Y-m-d',
            'user_id' => 'required|numeric:gt:0',
            'course_id' => 'required|numeric:gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $location = "public/portfolios";
        $file->storeAs($location, $fileName);

        $portfolio = new Portfolio();
        $portfolio->file = $fileName;
        $portfolio->issue_date = $request->issue_date;
        $portfolio->user_id = $request->user_id;
        $portfolio->course_id = $request->course_id;
        $portfolio->save();

        return response()->json([
            "Status" => "Success",
            "message" => "Portfolio Created Successfully",
        ], 201);
    }
}
