<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Telescope\Http\Controllers\HomeController as ControllersHomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth:admin', 'Language'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->middleware(['auth:admin', 'Language'])->name('search');



Route::middleware(['auth:admin', 'Language'])
    ->namespace('App\Http\Controllers\Admin')
    ->prefix('admin')
    ->group(function () {

        ///////////////////////////// Basic Routes /////////
        // Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/profile', 'ProfileController@show')->name('profile.show');
        Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
        Route::put('/profile/update/{id}', 'ProfileController@update')->name('profile.update');
        Route::get('/language/{locale}', 'LanguageController@changeLanguage')->name('change.language');

        //////////////////// Start of Users Routes /////////
        Route::resource('users', 'UserController');
        //////////////////// End of Users Routes /////////

        ////////////////////// Start of Courses Routes ////
        Route::get('courses/trash', 'CourseController@trash')->name('courses.trashed');
        Route::put('courses/restore/{id}', 'CourseController@restore')->name('courses.restore');
        Route::delete('courses/force_delete/{id}', 'CourseController@forceDelete')->name('courses.force-delete');
        Route::resource('courses', 'CourseController');
        //////////////////// End of Courses Routes///////

        //////////////////// Start of Settings Routes/////
        Route::resource('settings', 'SettingController');
        ////////////// End of Settings Routes ///////////////

        ////////////// Start of Categories Routes ///////////////
        Route::get('categories/trash', 'CategoryController@trash')->name('categories.trashed');
        Route::put('categories/restore/{id}', 'CategoryController@restore')->name('categories.restore');
        Route::delete('categories/force_delete/{id}', 'CategoryController@forceDelete')->name('categories.force-delete');
        Route::resource('categories', 'CategoryController');
        ////////////// End of Categories Routes ///////////////

        ////////////// Start of Blogs Routes ///////////////
        Route::get('blogs/trash', 'BlogController@trash')->name('blogs.trashed');
        Route::put('blogs/restore/{id}', 'BlogController@restore')->name('blogs.restore');
        Route::delete('blogs/force_delete/{id}', 'BlogController@forceDelete')->name('blogs.force-delete');
        Route::resource('blogs', 'BlogController');
        ////////////// End of Blogs Routes ///////////////

        ////////////// Start of Objectives Routes ///////////////
        Route::resource('objectives', 'ObjectiveController');
        ////////////// End of Objectives Routes ///////////////

        ////////////// Start of Cities Routes ///////////////
        Route::get('cities/trash', 'CityController@trash')->name('cities.trashed');
        Route::put('cities/restore/{id}', 'CityController@restore')->name('cities.restore');
        Route::delete('cities/force_delete/{id}', 'CityController@forceDelete')->name('cities.force-delete');
        Route::resource('cities', 'CityController');
        ////////////// End of Cities Routes ///////////////

        ////////////// Start of Roles Routes ///////////////
        Route::resource('roles', 'RoleController');
        ////////////// End of Roles Routes ///////////////

        ////////////// Start of Permissions Routes ///////////////
        Route::resource('permissions', 'PermissionController');
        ////////////// End of Permissions Routes ///////////////

        ////////////// Start of SuperSkills Routes ///////////////
        Route::resource('super-skills', 'SuperSkillController');
        ////////////// End of SuperSkills Routes ///////////////

        ////////////// Start of Skills Routes ///////////////
        Route::resource('skills', 'SkillController');
        ////////////// End of Skills Routes ///////////////

        ////////////// Start of Roadmaps Routes ///////////////
        Route::resource('roadmaps', 'RoadmapController');
        ////////////// End of Roadmaps Routes ///////////////

        ////////////// Start of Enrollments Routes ///////////////
        Route::get('enrollments', 'CourseUserController@index')->name('enrollments.index');
        Route::put('enrollments/update/{id}', 'CourseUserController@update')->name('enrollments.update');
        ////////////// End of Enrollments Routes ///////////////

        ////////////// Start of Reviews Routes ///////////////
        Route::resource('reviews', 'ReviewController');
        ////////////// End of Reviews Routes ///////////////

        ////////////// Start of Materials Routes ///////////////
        Route::resource('materials', 'MaterialController');
        ////////////// End of Materials Routes ///////////////

        ////////////// Start of Payments Routes ///////////////
        Route::resource('payments', 'PaymentController');
        ////////////// End of Payments Routes ///////////////

        ////////////// Start of Activity Logs Routes ///////////////
        Route::resource('activity-logs', 'ActivityLogController');
        ////////////// End of Activity Logs Routes ///////////////

    });

Auth::routes();
