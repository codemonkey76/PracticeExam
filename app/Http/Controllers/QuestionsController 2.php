<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Question;
use App\Http\Requests;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function createQuestions($exam_id)
    {
        $exams = Exam::all();
        $questions = [];
        return view('createQuestions', compact('exams', 'questions', 'exam_id'));
    }
    public function store(Request $request)
    {

        // dd($request);
        if ($request['exam']=='selected')
        {
            //dd('Populate list...');
            $exam = Exam::find($request['exams']);
            $questions = $exam->questions();
            return back();
        }
        $exam = Exam::find($request['exams']);
        // dd($request['question']);
        $q = new Question($request->all('questionText'));
        // dd($request->all());
        // dd($q);
        $exam->questions()->save($q);
        return back();
    }
}
