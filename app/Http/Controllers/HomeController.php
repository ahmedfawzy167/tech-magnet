<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
// use App\Http\Controllers\Controller;
use App\Models\CourseUser;

class HomeController extends Controller
{
  public function index()
  {

    //Fetch The Number Of Courses Avaliable//
    $courses = Course::count();

    //Fetch The Number Of Reviews from Students//
    $reviews = Review::count();

    //Fetch The Number Of Categories//
    $categories = Category::count();

    //Fetch The Number Of Enrollments//
    $enrollments = CourseUser::where('status', 'pending')->count();

    $coursesThisMonth = Course::with(['category', 'objective', 'image'])->whereMonth('created_at', 6)->get();

    return view('home', compact('courses', 'reviews', 'categories', 'enrollments', 'coursesThisMonth'));
  }

  public function search(Request $request)
  {
    $query = $request->input('query');

    $searchResults = (new Search())
      ->registerModel(Course::class, 'name')
      ->search($query);
    return view('search', compact('searchResults'));
  }
}
