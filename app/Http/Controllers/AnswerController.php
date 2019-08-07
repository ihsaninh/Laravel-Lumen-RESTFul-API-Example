<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class AnswerController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        try {
            $answer = Answer::all();

            return response()->json([
                'message' => 'Success Retrieved Answers',
                'answers' => $answer,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $answerData = $request->only(['question_id', 'user_id', 'answer', 'attachment']);
            $answer = Answer::create($answerData);
            return response()->json([
                'message' => 'Success Add Answer',
                'user_question' => $answer,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed Add Answer',
            ], 500);
        }
    }
}
