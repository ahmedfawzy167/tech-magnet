<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Blog, Course, Review, Category, Session, CourseUser, Bundle, User, City};
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Http\Controllers\Controller;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
  public function index()
  {
    //Fetch The Number Of Courses Avaliable//
    $courses = Course::count();

    //Fetch The Number Of Reviews For Students//
    $reviews = Review::count();

    //Fetch The Number Of Categories//
    $categories = Category::count();

    //Fetch The Number Of Enrollments//
    $enrollments = CourseUser::where('status', 'pending')->count();

    //Fetch The Number Of Courses For June Month//
    $juneCourses = Course::with(['category', 'image'])->whereMonth('created_at', 6)->whereStatus(true)->get();

    //Fetch The Number Of Sessions//
    $sessions = Session::count();

    //Fetch The Number Of Bundles//
    $bundles = Bundle::count();

    //Fetch The Number Of Users//
    $users = User::count();

    //Fetch The Number Of Cities//
    $cities = City::count();


    $chart_options = [
      'chart_title' => 'Courses by Months',
      'report_type' => 'group_by_date',
      'model' => 'App\Models\Course',
      'group_by_field' => 'created_at',
      'group_by_period' => 'month',
      'chart_type' => 'bar',
      'chart_color' => 'rgba(41, 246, 58, 0.2)',
      'chart_border_color' => 'rgba(75, 192, 192, 1)',
    ];
    $chart1 = new LaravelChart($chart_options);

    return view('home', compact('courses', 'reviews', 'categories', 'enrollments', 'juneCourses', 'sessions', 'bundles', 'users', 'cities', 'chart1'));
  }

  public function search(Request $request)
  {
    $query = $request->input('query');

    $searchResults = (new Search())
      ->registerModel(Course::class, 'name')
      ->registerModel(Category::class, 'name')
      ->registerModel(Blog::class, 'title')
      ->search($query);
    return view('search', compact('searchResults'));
  }
}
