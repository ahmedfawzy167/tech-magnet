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
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::get('/profile', 'AuthController@profile');
    Route::put('/profile-update', 'AuthController@profileUpdate');
});

Route::namespace('App\Http\Controllers\Api')->group(function () {

    Route::get('/auth/google', 'SocialiteController@redirect');
    Route::get('/auth/google/callback', 'SocialiteController@callback');
});


Route::middleware('jwt-verify')
    ->namespace('App\Http\Controllers\Api')
    ->group(function () {

        Route::get('/courses/search', 'CourseController@search');
        Route::get('/courses/filters', 'CourseController@filter');
        Route::post('/quiz-user', 'QuizController@attach');
        Route::apiResource('users', 'UserController');
        Route::apiResource('roadmaps', 'RoadmapController');
        Route::apiResource('categories', 'CategoryController');
        Route::apiResource('courses', 'CourseController');
        Route::apiResource('skills', 'SkillController');
        Route::apiResource('cities', 'CityController');
        Route::apiResource('super-skills', 'SuperSkillController');
        Route::apiResource('schedules', 'ScheduleController');
        Route::apiResource('attendances', 'AttendanceController');
        Route::apiResource('settings', 'SettingController');
        Route::apiResource('blogs', 'BlogController');
        Route::apiResource('sessions', 'SessionController');
        Route::apiResource('materials', 'MaterialController');
        Route::apiResource('support-requests', 'SupportRequestController');
        Route::apiResource('objectives', 'ObjectiveController');
        Route::apiResource('questions', 'QuestionController');
        Route::apiResource('quizzes', 'QuizController');
        Route::apiResource('recordings', 'RecordingController');
        Route::apiResource('quizzes', 'QuizController');
        Route::apiResource('portfolios', 'PortfolioController');
        Route::apiResource('student-progress', 'StudentProgressController');
        Route::apiResource('projects', 'ProjectController');
        Route::apiResource('reviews', 'ReviewController');
        Route::post('/chats/{user_id}', 'ChatController@sendMessage');
        Route::post('/enrollments', 'EnrollmentController@enroll');
        Route::post('/payments', 'PaymentController@pay');
        Route::post('/payments/store', 'PaymentController@store');
    });
