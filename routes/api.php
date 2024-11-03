<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::namespace('App\Http\Controllers\Api')->group(function () {
    /* Start of Auth Routes */
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login')->middleware('throttle:login');
    Route::post('/logout', 'AuthController@logout')->middleware('jwt-verify');
    Route::post('/refresh', 'AuthController@refresh')->middleware('jwt-verify');
    Route::get('/profile', 'AuthController@profile')->middleware('jwt-verify');
    Route::put('/profile-update', 'AuthController@profileUpdate')->middleware('jwt-verify');
    Route::get('/auth/google', 'SocialiteController@redirect');
    Route::get('/auth/google/callback', 'SocialiteController@callback');
    /* End of Auth Routes */

    /* Start of Courses Routes */
    Route::get('/courses/search', 'CourseController@search');
    Route::get('/courses/filters', 'CourseController@filter');
    Route::apiResource('courses', 'CourseController');
    /* End of Courses Routes */

    /* Start of Roadmaps Routes */
    Route::apiResource('roadmaps', 'RoadmapController');
    /* End of Roadmaps Routes */

    /* Start of Categories Routes */
    Route::apiResource('categories', 'CategoryController');
    /* End of Categories Routes */

    /* Start of Skills Routes */
    Route::apiResource('skills', 'SkillController');
    /* End of Skills Routes */

    /* Start of Super Skills Routes */
    Route::apiResource('super-skills', 'SuperSkillController');
    /* End of Super Skills Routes */

    /* Start of Settings Routes */
    Route::apiResource('settings', 'SettingController');
    /* End of Settings Routes */

    /* Start of Blogs Routes */
    Route::apiResource('blogs', 'BlogController');
    /* End of Blogs Routes */

    /* Start of Bundles Routes */
    Route::apiResource('/bundles', 'BundleController');
    /* End of Bundles Routes */

    /* Start of Quizzes Routes */
    Route::post('/quiz-user', 'QuizController@attach')->middleware('jwt-verify');
    Route::apiResource('quizzes', 'QuizController')->middleware('jwt-verify');
    /* End of Quizzes Routes */

    /* Start of Schedules Routes */
    Route::apiResource('schedules', 'ScheduleController')->middleware('jwt-verify');
    /* End of Schedules Routes */

    /* Start of Attendances Routes */
    Route::apiResource('attendances', 'AttendanceController')->middleware('jwt-verify');
    /* End of Attendances Routes */

    /* Start of Sessions Routes */
    Route::apiResource('sessions', 'SessionController')->middleware('jwt-verify');
    /* End of Sessions Routes */

    /* Start of Support Requets Routes */
    Route::apiResource('support-requests', 'SupportRequestController')->middleware('jwt-verify');
    /* End of Support Requets Routes */

    /* Start of Questions Routes */
    Route::apiResource('questions', 'QuestionController')->middleware('jwt-verify');
    /* End of Questions Routes */

    /* Start of Assignments Routes */
    Route::apiResource('assignments', 'AssignmentController')->middleware('jwt-verify');
    /* End of Assignments Routes */

    /* Start of Portfolios Routes */
    Route::apiResource('portfolios', 'PortfolioController')->middleware('jwt-verify');
    /* End of Portfolios Routes */

    /* Start of Student Progress Routes */
    Route::apiResource('student-progress', 'StudentProgressController')->middleware('jwt-verify');
    /* End of Student Progress Routes */

    /* Start of Projects Routes */
    Route::apiResource('projects', 'ProjectController')->middleware('jwt-verify');
    /* End of Projects Routes */

    /* Start of Reviews Routes */
    Route::apiResource('reviews', 'ReviewController')->middleware('jwt-verify');
    /* End of Reviews Routes */

    /* Start of Chats Routes */
    Route::post('/chats/{user_id}', 'ChatController@sendMessage')->middleware('jwt-verify');
    /* End of Chats Routes */

    /* Start of Enrollments Routes */
    Route::post('/enrollments', 'EnrollmentController@enroll')->middleware('jwt-verify');
    /* End of Enrollments Routes */

    /* Start of Payments Routes */
    Route::post('/payments', 'PaymentController@pay')->middleware('jwt-verify');
    Route::post('/payments/store', 'PaymentController@store')->middleware('jwt-verify');
    /* End of Payments Routes */

    /* Start of Carts Routes */
    Route::get('/carts', 'CartController@index')->middleware('jwt-verify');
    Route::get('/carts-total', 'CartController@totalCartItems')->middleware('jwt-verify');
    Route::post('/carts/store', 'CartController@store')->middleware('jwt-verify');
    Route::delete('/carts/destroy/{courseId}', 'CartController@destroy')->middleware('jwt-verify');
    /* End of Carts Routes */

    /* Start of Wishlists Routes */
    Route::get('/wishlists', 'WishlistController@index')->middleware('jwt-verify');
    Route::get('/wishlists-total', 'WishlistController@totalWishlistItems')->middleware('jwt-verify');
    Route::post('/wishlists/store', 'WishlistController@store')->middleware('jwt-verify');
    Route::delete('/wishlists/destroy/{courseId}', 'WishlistController@destroy')->middleware('jwt-verify');
    /* End of Wishlists Routes */

    /* Start of Addresses Routes */
    Route::apiResource('/addresses', 'AddressController')->middleware('jwt-verify');
    /* End of Addresses Routes */
});
