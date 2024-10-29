<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{

    public function create()
    {
        return view('materials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file'  => 'required|file|mimes:pdf|max:2048',
        ]);

        // Store the file in Google Drive
        $request->file('file')->store('Materials', 'google');

        return redirect()->back()->with('message', 'Material Uploaded Successfully');
    }
}
