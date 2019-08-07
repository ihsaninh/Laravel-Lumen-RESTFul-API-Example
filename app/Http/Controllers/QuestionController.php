<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class QuestionController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index() 
    {
        try {
            $questions = Question::all();
            return response()->json([
                'message' => 'Success Retrieved Questions',
                'questions' => $questions,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
        }
    }

    public function show(Request $request)
    {
        try {
            $number = $request->number;
            if ($number) {
                $question = Question::where('number', $number)->first();
                $countAll = Question::count();
            } else {
                $question = Question::where('number', 1)->first();
                $countAll = Question::count();
            }
            return response()->json([
                'message' => 'Success Retrieved Question',
                'question' => $question,
                'question_count' => $countAll,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
        }
    }
}
