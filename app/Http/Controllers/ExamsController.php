<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Answer;
use App\Results;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamsController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        return view('exam.index', compact('exams'));
    }
    public function getQuestions(Request $request)
    {
        $exam_id = $request['exams'];
        
        if ($exam_id == null)
            return back();
        try {
            $exam = Exam::findOrFail($exam_id);
        } catch (ModelNotFoundException $e) {
            return back();
        }
        
        return redirect("exam/" . $exam->id . "/question");
    }
    public function show()
    {
        
    }
    public function create()
    {
    }

    public function store(Request $request)
    {
        Auth::user()->exams()->save(new Exam($request->all()));
        return back();
    }

    public function destroy($id)
    {
        Exam::findOrFail($id)->delete();
        return back();
    }
    public function update()
    {
        
    }
    public function edit()
    {
        
    }
    public function practice($exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        return view('exam.practice', compact('exam'));
    }

    public function model($exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        return view('exam.model', compact('exam'));
    }
    public function results($exam_id, Request $request)
    {
        //Store results against user id and exam id
        $user_id = Auth::user()->id;
        $exam = Exam::findOrFail($exam_id);

        foreach ($exam->questions()->get() as $question)
        {
            $results = Results::where('user_id', '=', $user_id)
                ->where('question_id', '=', $question->id)
                ->first();
            //dd($results);
            if ($results == null)
            {
                $results = new Results;
                $results->user_id = $user_id;
                $results->question_id = $question->id;
            }

            if ($question->options()->count()==0)
                $results->model_text = $request[$question->id];
            else
                $results->option_id = $request[$question->id];

            //dd($results);
            $results->save();
        }
        flash()->success('Success!', 'Submitted Results');
        return redirect ('/');
    }
    public function answers($exam_id, Request $request)
    {
        $exam = Exam::findOrFail($exam_id);
        $questions = $exam->questions()->get();
        foreach ($questions as $question)
        {
            if ($question->options()->get()->count()==0)
            {
                // Store model text answer.
                $question->model_text = $request[$question->id];
            }
            else
            {
                // Store correct option.
                $question->option_id =  $request[$question->id];
            }
            $question->save();
        }

        flash()->success('Success!', 'Your answers have been submitted.');
        
        return redirect("/exam/$exam_id/question");
    }
}
