<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request, Category $category)
    {
        $request->validated();
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        Session::flash('message', 'Category is Created Successfully!');
        return redirect(route('categories.index'));
    }

    public function show(Category $category)
    {
        $courses = $category->courses;
        return view('categories.show', get_defined_vars());
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $request->validated();
        $category->name = $request->name;
        $category->update();

        Session::flash('message', 'Category is Updated Successfully!');
        return redirect(route('categories.index'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        Session::flash('message', 'Category is Deleted Successfully');
        return redirect(route('categories.index'));
    }
}
