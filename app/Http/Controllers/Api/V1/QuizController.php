<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Quiz;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Http\Resources\QuizResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\QuizCollection;

class QuizController extends Controller
{
    use ApiResponder;

    public function __construct()
    {
        $this->authorizeResource(Quiz::class);
    }

    public function index()
    {
        $quizzes = Quiz::whereHas('users', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();
        return $this->success(QuizCollection::collection($quizzes));
    }

    public function store(StoreQuizRequest $request)
    {

        $quiz = new Quiz();
        $quiz->name = $request->name;
        $quiz->description = $request->description;
        $quiz->course_id = $request->course_id;
        $quiz->save();

        return $this->created($quiz, "Quiz Created Successfully");
    }

    public function update(UpdateQuizRequest $request, Quiz $quiz)
    {
        $quiz->name = $request->name;
        $quiz->description = $request->description;
        $quiz->course_id = $request->course_id;
        $quiz->update();

        return $this->success($quiz, "Quiz Updated Successfully");
    }

    public function show(Quiz $quiz)
    {
        if ($quiz != null) {
            return $this->success(new QuizResource($quiz));
        } else {
            return $this->notFound("Quiz Not Found");
        }
    }

    public function attach(Request $request)
    {
        $user = auth()->user();
        $quiz = Quiz::find($request->quiz_id);

        $quiz->users()->attach($user, [
            'score' => $request->score,
            'date' => $request->date,
        ]);

        return $this->created("Quiz Submitted Successfully");
    }
}
