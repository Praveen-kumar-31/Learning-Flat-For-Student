<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CodingAnswer;

class CodingAnswerController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required',
            'question_id' => 'required',
            'answer' => 'required',
            'output' => 'required',
        ]);

        CodingAnswer::create($validatedData);

        return response()->json(['message' => 'Coding answer and output stored successfully']);
    }

    public function getAnswerAndOutput($studentId, $questionId)
    {
        $codingAnswer = CodingAnswer::where('student_id', $studentId)
            ->where('question_id', $questionId)
            ->first();

        if ($codingAnswer) {
            return response()->json($codingAnswer);
        } else {
            return response()->json(['message' => 'Coding answer not found'], 404);
        }
    }
}

