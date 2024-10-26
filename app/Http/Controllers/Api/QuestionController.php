<?php

namespace App\Http\Controllers\Api;

use App\Models\Question;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionCollection;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    use ApiResponder;

    public function __construct()
    {
        $this->authorizeResource(Question::class);
    }

    public function index()
    {
        $questions = Question::with('quiz')->get();
        return $this->success(QuestionCollection::collection($questions));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string|max:500',
            'answers' => 'required|string|max:500',
            'quiz_id' => 'required|numeric|gt:0',
        ]);

        $quesion = new Question();
        $quesion->question_text = $request->question_text;
        $quesion->answers = $request->answers;
        $quesion->quiz_id = $request->quiz_id;
        $quesion->save();

        return $this->created("Question Created Successfully!");
    }
}
