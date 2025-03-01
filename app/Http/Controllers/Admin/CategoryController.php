<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }


    public function store(StoreCategoryRequest $request, Category $category)
    {
        $category::create($request->validated());
        return redirect(route('categories.index'))->with('message', 'Category Created Successfully');
    }

    public function show(Category $category)
    {
        $courses = $category->courses;
        return view('categories.show', get_defined_vars());
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect(route('categories.index'))->with('message', 'Category Updated Successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect(route('categories.index'))->with('message', 'Category Deleted Successfully');
    }

    public function trash()
    {
        $trashedCategories = Category::onlyTrashed()->get();
        return view('categories.trashed', compact('trashedCategories'));
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('categories.index')->with('message', 'Category Restored Successfully');
    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        if ($category->courses()->count() > 0) {
            return redirect()->back()->withErrors([
                'error' => 'Category has Associated Courses!'
            ]);
        }
        $category->forceDelete();
        return redirect()->route('categories.index')->with('message', 'Category Permenantly Deleted Successfully');
    }
}
