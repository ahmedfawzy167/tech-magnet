<?php

namespace App\Http\Controllers\Api;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuizResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\QuizCollection;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Quiz::class);
    }

    public function index()
    {
        $quizzes = Quiz::whereHas('users', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();
        return QuizCollection::collection($quizzes);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,50',
            'description' => 'required|max:500',
            'course_id' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $quiz = new Quiz();
        $quiz->name = $request->name;
        $quiz->description = $request->description;
        $quiz->course_id = $request->course_id;
        $quiz->save();

        return response()->json([
            "status" => 'Success',
            "message" => "Quiz Created Successfully!",
        ], 201);
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,50',
            'description' => 'required|max:500',
            'course_id' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $quiz->name = $request->name;
        $quiz->description = $request->description;
        $quiz->course_id = $request->course_id;
        $quiz->update();

        return response()->json([
            "status" => 'Success',
            "message" => "Quiz Updated Successfully!",
        ], 200);
    }

    public function show(Quiz $quiz)
    {
        if ($quiz != null) {
            return new QuizResource($quiz);
        } else {
            return response()->json([
                "message" => "Quiz Not Found"
            ], 404);
        }
    }

    public function attach(Request $request)
    {

        $user = User::find($request->user_id);
        $quiz = Quiz::find($request->quiz_id);

        $quiz->users()->attach($user, [
            'score' => $request->score,
            'date' => $request->date,
        ]);

        return response()->json([
            "message" => "Quizzes Submitted Successfully"
        ]);
    }
}
