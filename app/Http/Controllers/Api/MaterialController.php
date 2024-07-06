<?php

namespace App\Http\Controllers\Api;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\MaterialDetailsResource;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Material::class);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:2,50',
            'description' => 'required|max:500',
            'file'  => 'required|file|mimes:pdf|max:2048',
            'file_type'  => 'required|string',
            'course_id' => 'required|numeric:gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $location = "public/materials";
        $file->storeAs($location, $fileName);

        $material = new Material();
        $material->title = $request->title;
        $material->description = $request->description;
        $material->file = $fileName;
        $material->file_type = $request->file_type;
        $material->course_id = $request->course_id;
        $material->save();

        return response()->json([
            "Status" => "Success",
            "message" => "Material Created Successfully",
        ], 201);
    }

    public function index()
    {
        $materials = Material::with('course')->get();
        return MaterialResource::collection($materials);
    }

    public function show(Material $material)
    {
        if ($material != null) {
            return new MaterialDetailsResource($material);
        } else {
            return response()->json([
                "status"  => "error",
                "message"  => "Material not found"
            ], 404);
        }
    }
}
