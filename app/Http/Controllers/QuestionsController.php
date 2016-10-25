<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Question;
use App\Http\Requests;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function index($id)
    {
        // Show all questions for this exam
        $exam = Exam::with('questions')->findOrFail($id);
        
        return view('exam.question.index', compact('exam'));
    }

    public function getOptions(Request $request)
    {
        $question_id = $request['questions'];
        if ($question_id == null)
            return back();

        try {
            $question = Question::findOrFail($question_id);
        } catch (ModelNotFound $e) {
            return back();
        }

        return redirect("exam/" . $question->exam_id . "/question/" . $question->id);
    }

    public function show($exam_id, $question_id)
    {
        //Show a particular question (and it's options)
        
        $exam = Exam::with('questions')->findOrFail($exam_id);
        //dd($exam);
        $question = Question::with('options')->findOrFail($question_id);
        //dd($question);
        //$options = $question->options()->get();
        //dd($options);
        return view('exam.question.option.index', compact('exam', 'question'));
    }

    public function create()
    {
        //Send to create page
    }

    public function store($exam_id, Request $request)
    {
        $exam = Exam::findOrFail($exam_id);
        $exam->questions()->save(new Question($request->all()));

        return back();
    }

    public function destroy($id)
    {
        Exam::findOrFail($id)->delete();
        return back();
    }
    public function update($exam_name, $id)
    {
        $exam = Exam::findOrFail($id);
        $exam->exam_name = $exam_name;
        $exam->save();

        return back();
    }
    public function edit()
    {
        return view('exam.edit');
        //Send to edit page
    }
}
