<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Answer;
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
    public function answers($exam_id, Request $request)
    {
        $exam = Exam::findOrFail($exam_id);
        $questions = $exam->questions()->get();
        foreach ($questions as $question)
        {
            if ($question->options()->get()->count()==0)
            {
                // Store model text answer.
                $question->answer()->save(new Answer([
                    'model_text' => $request[$question->id]
                    ]));
            }
            else
            {
                // Store correct option.
                $question->answer()->save(new Answer([
                        'option_id' => $request[$question->id]
                        ]));
            }
            
        }
        flash()->success('Success!', 'Your flyer has been created.');
        //Auth::user()->exams()->save(new Exam($request->all()));
        return back();
    }
}
