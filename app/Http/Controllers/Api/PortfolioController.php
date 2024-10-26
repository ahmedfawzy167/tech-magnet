<?php

namespace App\Http\Controllers\Api;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioResource;
use App\Traits\ApiResponder;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    use ApiResponder;

    public function __construct()
    {
        $this->authorizeResource(Portfolio::class);
    }

    public function index()
    {
        $portfolios = Portfolio::with(['user', 'course'])->get();

        return $this->success(PortfolioResource::collection($portfolios));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file'  => 'required|file|mimes:pdf|max:2048',
            'issue_date' => 'required|date_format:Y-m-d',
            'user_id' => 'required|numeric:gt:0',
            'course_id' => 'required|numeric:gt:0',
        ]);

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

        return $this->created($portfolio, "Portfolio Created Successfully!");
    }
}
