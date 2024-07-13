<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        Session::flash('message', 'Category Created Successfully!');
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

        Session::flash('message', 'Category Updated Successfully!');
        return redirect(route('categories.index'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        Session::flash('message', 'Category Trashed Successfully');
        return redirect(route('categories.index'));
    }

    public function trash()
    {
        $trashedCategories = Category::onlyTrashed()->get();
        return view('categories.trashed', compact('trashedCategories'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('categories.index')->with('message', 'Category Restored Successfully');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        return redirect()->route('categories.index')->with('message', 'Category Permenantly Deleted Successfully');
    }
}
