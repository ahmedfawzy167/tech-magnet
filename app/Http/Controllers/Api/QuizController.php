<?php

namespace App\Http\Controllers\Api;

use App\Models\Quiz;
use App\Models\User;
use App\Http\Resources\QuizResource;
use App\Http\Resources\QuizDetailsResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Quiz::class);
    }

    public function index()
    {
        $quizzes = Quiz::with('course')->get();
        return QuizResource::collection($quizzes);
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
            return new QuizDetailsResource($quiz);
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
