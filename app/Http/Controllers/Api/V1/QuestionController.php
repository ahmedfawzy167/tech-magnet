<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Resources\QuestionCollection;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    use ApiResponder;

    public function index()
    {
        if (!auth()->user()->hasRole('Instructor')) {
            return $this->forbidden('Access Forbidden');
        }
        $questions = Question::with('quiz')->get();
        return $this->success(QuestionCollection::collection($questions));
    }

    public function store(StoreQuestionRequest $request)
    {
        if (!auth()->user()->hasRole('Instructor')) {
            return $this->forbidden('Access Forbidden');
        }
        $question = new Question();
        $question->question_text = $request->question_text;
        $question->answers = $request->answers;
        $question->quiz_id = $request->quiz_id;
        $question->save();

        return $this->created($question,"Question Created Successfully");
    }
}
