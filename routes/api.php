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
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login')->middleware('throttle:login');
    Route::post('/logout', 'AuthController@logout')->middleware('jwt-verify');
    Route::post('/refresh', 'AuthController@refresh');
    Route::get('/profile', 'AuthController@profile');
    Route::put('/profile-update', 'AuthController@profileUpdate');
    Route::get('/auth/google', 'SocialiteController@redirect');
    Route::get('/auth/google/callback', 'SocialiteController@callback');
    Route::get('/courses/search', 'CourseController@search');
    Route::get('/courses/filters', 'CourseController@filter');
    Route::apiResource('courses', 'CourseController');
    Route::apiResource('roadmaps', 'RoadmapController');
    Route::apiResource('categories', 'CategoryController');
    Route::apiResource('skills', 'SkillController');
    Route::apiResource('super-skills', 'SuperSkillController');
    Route::apiResource('settings', 'SettingController');
    Route::apiResource('blogs', 'BlogController');


    Route::post('/quiz-user', 'QuizController@attach')->middleware('jwt-verify');
    Route::apiResource('schedules', 'ScheduleController')->middleware('jwt-verify');
    Route::apiResource('attendances', 'AttendanceController')->middleware('jwt-verify');
    Route::apiResource('sessions', 'SessionController')->middleware('jwt-verify');
    Route::apiResource('support-requests', 'SupportRequestController')->middleware('jwt-verify');
    Route::apiResource('questions', 'QuestionController')->middleware('jwt-verify');
    Route::apiResource('quizzes', 'QuizController')->middleware('jwt-verify');
    Route::apiResource('recordings', 'RecordingController')->middleware('jwt-verify');
    Route::apiResource('quizzes', 'QuizController')->middleware('jwt-verify');
    Route::apiResource('assignments', 'AssignmentController')->middleware('jwt-verify');
    Route::apiResource('portfolios', 'PortfolioController')->middleware('jwt-verify');
    Route::apiResource('student-progress', 'StudentProgressController')->middleware('jwt-verify');
    Route::apiResource('projects', 'ProjectController')->middleware('jwt-verify');
    Route::apiResource('reviews', 'ReviewController')->middleware('jwt-verify');
    Route::post('/chats/{user_id}', 'ChatController@sendMessage')->middleware('jwt-verify');
    Route::post('/enrollments', 'EnrollmentController@enroll')->middleware('jwt-verify');
    Route::post('/payments', 'PaymentController@pay')->middleware('jwt-verify');
    Route::post('/payments/store', 'PaymentController@store')->middleware('jwt-verify');
    Route::get('/carts', 'CartController@index')->middleware('jwt-verify');
    Route::get('/carts-total', 'CartController@totalCartItems')->middleware('jwt-verify');
    Route::post('/carts/store', 'CartController@store')->middleware('jwt-verify');
    Route::delete('/carts/destroy/{courseId}', 'CartController@destroy')->middleware('jwt-verify');
    Route::get('/wishlists', 'WishlistController@index')->middleware('jwt-verify');
    Route::get('/wishlists-total', 'WishlistController@totalWishlistItems')->middleware('jwt-verify');
    Route::post('/wishlists/store', 'WishlistController@store')->middleware('jwt-verify');
    Route::delete('/wishlists/destroy/{courseId}', 'WishlistController@destroy')->middleware('jwt-verify');
});
