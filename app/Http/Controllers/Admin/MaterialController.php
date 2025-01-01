<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePdfRequest;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Storage::disk('public')->files('materials');
        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        return view('materials.create');
    }

    public function store(StorePdfRequest $request)
    {
        $material = $request->file('file');
        $path = $material->store('Materials', 'google');

        $fileName = $material->getClientOriginalName();

        $fileContent = Storage::disk('google')->get($path);
        Storage::disk('public')->put("materials/{$fileName}", $fileContent);

        return redirect()->route('materials.index')->with('message', 'Material Uploaded Successfully');
    }
}
