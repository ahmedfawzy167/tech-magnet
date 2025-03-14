<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Resources\PortfolioResource;
use App\Traits\ApiResponder;

class PortfolioController extends Controller
{
    use ApiResponder;

    public function index()
    {
        if (!auth()->user()->hasRole('Company')) {
            return $this->forbidden('Access Forbidden');
        }
        $portfolios = Portfolio::with(['user', 'course'])->get();

        return $this->success(PortfolioResource::collection($portfolios));
    }

    public function store(StorePortfolioRequest $request)
    {
        if (!auth()->user()->hasRole('Student')) {
            return $this->forbidden('Access Forbidden');
        }
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $location = "public/portfolios";
        $file->storeAs($location, $fileName);

        $portfolio = new Portfolio();
        $portfolio->file = $fileName;
        $portfolio->issue_date = $request->issue_date;
        $portfolio->user_id = auth()->user()->id;
        $portfolio->course_id = $request->course_id;
        $portfolio->save();

        return $this->created($portfolio, "Portfolio Created Successfully!");
    }
}
